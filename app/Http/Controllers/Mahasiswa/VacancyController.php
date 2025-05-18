<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\Application; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse; 

class VacancyController extends Controller
{
    /**
     * Display a listing of the available cooperation vacancies.
     * Menampilkan daftar lowongan kerjasama yang tersedia untuk mahasiswa.
     */
    public function index(Request $request)
    {
        // Query dasar: ambil lowongan 'kerjasama' yang statusnya 'open'
        $query = Vacancy::where('type', 'kerjasama')
                        ->where('status', 'open')
                        // Pastikan deadline belum lewat (jika deadline ada)
                        ->where(function ($q) {
                            $q->whereNull('deadline')
                              ->orWhere('deadline', '>=', now()->format('Y-m-d'));
                        })
                        ->with('company'); // Eager load data perusahaan

        // --- Fitur Pencarian/Filter (Contoh) ---
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhereHas('company', function($companyQuery) use ($searchTerm) {
                      $companyQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }
        // Tambahkan filter lain jika perlu (misal berdasarkan lokasi/jurusan?)
        // --- Akhir Fitur Pencarian ---

        $vacancies = $query->latest('created_at')->paginate(9); // Paginasi (misal 9 untuk layout 3 kolom)

        return view('mahasiswa.vacancies.index', compact('vacancies'));
    }

    /**
     * Display the specified cooperation vacancy.
     * Menampilkan detail satu lowongan kerjasama.
     */
    public function show(Vacancy $vacancy) // Route Model Binding
    {
        // Pastikan yang diakses adalah lowongan kerjasama dan statusnya open
        if ($vacancy->type !== 'kerjasama' || $vacancy->status !== 'open') {
             abort(404); // Atau redirect ke index dengan pesan error
        }
        // Cek juga deadline (jika ada)
        if ($vacancy->deadline && $vacancy->deadline < now()->startOfDay()) {
             abort(404, 'Lowongan ini sudah ditutup (melewati deadline).');
        }


        // Load relasi company jika belum (sebenarnya tidak perlu jika pakai route model binding)
        $vacancy->loadMissing('company');

        // Cek apakah mahasiswa ini sudah mendaftar ke lowongan ini
        $hasApplied = Auth::user()->applications()
                           ->where('vacancy_id', $vacancy->id)
                           ->exists();

        return view('mahasiswa.vacancies.show', compact('vacancy', 'hasApplied'));
    }

    public function apply(Vacancy $vacancy): RedirectResponse
    {
        $user = Auth::user();

        // === Validasi dan Pemeriksaan ===

        // 1. Cek Lowongan: Tipe, Status, Deadline (redundant check, tapi bagus untuk keamanan)
        if ($vacancy->type !== 'kerjasama' || $vacancy->status !== 'open') {
             return redirect()->route('mahasiswa.vacancies.index')
                          ->with('error', 'Lowongan ini tidak tersedia atau bukan lowongan kerjasama.');
        }
        if ($vacancy->deadline && $vacancy->deadline < now()->startOfDay()) {
             return redirect()->route('mahasiswa.vacancies.show', $vacancy->id)
                          ->with('error', 'Batas waktu pendaftaran untuk lowongan ini sudah lewat.');
        }

        // 2. Cek Profil Mahasiswa (Sangat Penting!)
        // Pastikan mahasiswa sudah melengkapi profil dasarnya, terutama CV.
        // Asumsikan CV wajib untuk mendaftar.
        if (!$user->studentProfile || !$user->studentProfile->cv_path) {
            return redirect()->route('mahasiswa.profile.edit') // Arahkan ke halaman edit profil
                         ->with('warning', 'Harap lengkapi profil Anda dan unggah CV terlebih dahulu sebelum mendaftar.');
        }
        // Anda bisa menambahkan pengecekan field profil lainnya jika diperlukan
        // if (empty($user->studentProfile->major) || empty($user->studentProfile->phone_number)) { ... }

        // 3. Cek Apakah Sudah Pernah Mendaftar
        $existingApplication = Application::where('user_id', $user->id)
                                         ->where('vacancy_id', $vacancy->id)
                                         ->first();

        if ($existingApplication) {
            return redirect()->route('mahasiswa.vacancies.show', $vacancy->id)
                         ->with('info', 'Anda sudah pernah mendaftar ke lowongan ini.');
        }

        // === Proses Pendaftaran ===

        // Semua pengecekan lolos, buat record pendaftaran baru
        Application::create([
            'user_id' => $user->id,
            'vacancy_id' => $vacancy->id,
            'application_date' => now(),
            'status' => 'pending', // Status awal adalah pending
        ]);

        // TODO: Kirim Notifikasi (ke admin/perusahaan jika perlu)

        // Redirect ke halaman status pendaftaran dengan pesan sukses
        return redirect()->route('mahasiswa.applications.index')
                         ->with('success', 'Pendaftaran Anda untuk lowongan "' . $vacancy->title . '" berhasil diajukan.');
    }
}