<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application; // Model Application
use App\Models\Vacancy;     // Model Vacancy (untuk filter)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Access\AuthorizationException; // Untuk cek akses
use Illuminate\Support\Facades\Storage; // Import Storage

class ApplicantController extends Controller
{
    // Helper function untuk mendapatkan ID company yang sedang login
    private function getCompanyId()
    {
        return Auth::user()->company->id;
    }

    /**
     * Authorization check: Memastikan aplikasi ini untuk lowongan milik perusahaan yg login.
     * @param Application $application
     * @throws AuthorizationException
     */
    private function authorizeAccess(Application $application)
    {
        // Pastikan relasi vacancy ada dan vacancy tersebut milik company ini
        if (!$application->vacancy || $application->vacancy->company_id !== $this->getCompanyId()) {
             throw new AuthorizationException('Anda tidak memiliki izin untuk mengakses data pendaftar ini.');
        }
    }

    /**
     * Display a listing of the applicants for the company's vacancies.
     * Menampilkan daftar pendaftar ke lowongan perusahaan ini.
     */
    public function index(Request $request)
    {
        $companyId = $this->getCompanyId();

        // Query dasar: Ambil aplikasi HANYA untuk lowongan milik perusahaan ini
        $query = Application::whereHas('vacancy', function ($query) use ($companyId) {
                            $query->where('company_id', $companyId);
                        })
                        ->with([ // Eager load data yang dibutuhkan
                            'user:id,name',
                            'user.studentProfile:user_id,nim', // Ambil NIM saja untuk tabel
                            'vacancy:id,title' // Ambil judul lowongan
                        ]);

        // --- Filtering ---
        // Filter by Vacancy
        if ($request->filled('vacancy_id')) {
            // Pastikan vacancy_id yang difilter milik perusahaan ini juga
            $vacancyExists = Vacancy::where('id', $request->vacancy_id)
                                    ->where('company_id', $companyId)
                                    ->exists();
            if ($vacancyExists) {
                $query->where('vacancy_id', $request->vacancy_id);
            } else {
                // Jika mencoba filter lowongan yg bukan miliknya, jangan tampilkan apa2 atau beri error
                 return redirect()->route('company.applicants.index')
                                ->with('error', 'Lowongan yang dipilih tidak valid.');
            }
        }

        // Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        // --- End Filtering ---

        $applications = $query->latest('application_date')->paginate(15);

        // Data untuk dropdown filter
        $vacancies = Vacancy::where('company_id', $companyId) // Hanya lowongan milik perusahaan ini
                           ->orderBy('title')->pluck('title', 'id');
        $statuses = ['pending' => 'Pending', 'reviewed' => 'Reviewed', 'accepted' => 'Accepted', 'rejected' => 'Rejected', 'cancelled' => 'Cancelled', 'completed' => 'Completed'];

        return view('company.applicants.index', compact('applications', 'vacancies', 'statuses'));
    }

    /**
     * Display the specified applicant's application details.
     * Menampilkan detail pendaftar/lamaran.
     */
    public function show(Application $application)
    {
        try {
            $this->authorizeAccess($application); // Cek kepemilikan via lowongan
        } catch (AuthorizationException $e) {
            return redirect()->route('company.applicants.index')->with('error', $e->getMessage());
        }

        // Load relasi lengkap untuk detail
        $application->loadMissing(['user.studentProfile', 'vacancy']);

        return view('company.applicants.show', compact('application'));
    }

    /**
     * Update the status of the specified application by the company.
     * Mengubah status pendaftaran oleh perusahaan.
     */
    public function updateStatus(Request $request, Application $application)
    {
         try {
            $this->authorizeAccess($application); // Cek kepemilikan
        } catch (AuthorizationException $e) {
             // Return JSON response jika request AJAX, atau redirect jika form biasa
             if ($request->expectsJson()) {
                 return response()->json(['error' => $e->getMessage()], 403);
             }
            return redirect()->back()->with('error', $e->getMessage());
        }

        // Perusahaan dapat mengubah ke reviewed, accepted, rejected, atau completed
        $allowedStatuses = ['reviewed', 'accepted', 'rejected', 'completed']; // Ditambahkan status 'completed'
        $validated = $request->validate([
            'status' => ['required', Rule::in($allowedStatuses)],
            'company_notes' => 'nullable|string|max:1000', // Catatan dari perusahaan
        ]);

        $updateData = [
            'status' => $validated['status'],
            'company_notes' => $validated['company_notes'],
        ];

        // Jika status diubah menjadi 'completed', set juga is_completed (jika pakai kolom boolean)
        // if ($validated['status'] === 'completed' && array_key_exists('is_completed', $application->getAttributes())) {
        //     $updateData['is_completed'] = true;
        // }

        $application->update($updateData);

        // TODO: Kirim Notifikasi ke Mahasiswa tentang perubahan status

         // Return JSON response jika request AJAX, atau redirect jika form biasa
         if ($request->expectsJson()) {
             return response()->json([
                'success' => true,
                'message' => 'Status pendaftar berhasil diperbarui.',
                'new_status' => ucfirst($validated['status']),
                'new_badge_class' => getStatusBadgeClass($validated['status']), // Panggil helper
             ]);
         }

        return redirect()->back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    /**
     * Handle the certificate upload by the company.
     *
     * @param Request $request
     * @param Application $application
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadCertificate(Request $request, Application $application)
    {
        try {
            $this->authorizeAccess($application); // Pastikan pendaftar ini untuk lowongan perusahaan
        } catch (AuthorizationException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        // 1. Validasi: Pendaftar harus berstatus 'accepted' atau 'completed' (atau kondisi lain yg disepakati)
        //    Dan belum ada sertifikat terupload
        if (!in_array($application->status, ['accepted', 'completed'])) {
             return redirect()->back()->with('error', 'Sertifikat hanya bisa diunggah untuk pendaftar yang sudah diterima atau menyelesaikan magang.');
        }
        // if ($application->certificate_path) {
        //     return redirect()->back()->with('info', 'Sertifikat sudah pernah diunggah untuk pendaftar ini. Hapus dulu jika ingin mengganti.');
        // }

        // 2. Validasi File Sertifikat
        $request->validate([
            'certificate_file' => 'required|file|mimes:pdf|max:5120', // PDF, maks 5MB
            'certificate_issued_at' => 'required|date|before_or_equal:today',
        ]);

        // 3. Hapus Sertifikat Lama (jika ada dan ingin mengganti)
        if ($application->certificate_path && Storage::disk('public')->exists($application->certificate_path)) {
            Storage::disk('public')->delete($application->certificate_path);
        }

        // 4. Simpan File Sertifikat Baru
        $certificatePath = $request->file('certificate_file')->store('certificates/applications', 'public');

        // 5. Update record aplikasi
        $application->update([
            'certificate_path' => $certificatePath,
            'certificate_issued_at' => $request->certificate_issued_at,
            // Opsional: otomatis set status ke 'completed' jika belum
            //'status' => 'completed', // Pastikan status ini ada di enum/validasi
        ]);

        // TODO: Notifikasi ke Mahasiswa bahwa sertifikat sudah tersedia

        return redirect()->back()->with('success', 'Sertifikat berhasil diunggah untuk ' . $application->user->name . '.');
    }

     /**
     * Handle the certificate removal by the company.
     *
     * @param Application $application
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCertificate(Request $request, Application $application)
    {
        try {
            $this->authorizeAccess($application);
        } catch (AuthorizationException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        if ($application->certificate_path) {
            if (Storage::disk('public')->exists($application->certificate_path)) {
                Storage::disk('public')->delete($application->certificate_path);
            }
            $application->update([
                'certificate_path' => null,
                'certificate_issued_at' => null,
                // Pertimbangkan apakah status harus diubah kembali jika sertifikat dihapus
            ]);
            return redirect()->back()->with('success', 'Sertifikat berhasil dihapus.');
        }
        return redirect()->back()->with('info', 'Tidak ada sertifikat untuk dihapus.');
    }
}