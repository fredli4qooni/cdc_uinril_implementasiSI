<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Vacancy; // Model Vacancy
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user & company yang login
use Illuminate\Validation\Rule; // Untuk validasi status
use Illuminate\Auth\Access\AuthorizationException; // Untuk handle akses ditolak

class VacancyController extends Controller
{
    // Helper function untuk mendapatkan ID company yang sedang login
    private function getCompanyId()
    {
        return Auth::user()->company->id; // Asumsi user login pasti punya relasi company (dicek middleware)
    }

     /**
     * Authorization check: Memastikan lowongan milik perusahaan yang sedang login.
     * @param Vacancy $vacancy
     * @throws AuthorizationException
     */
    private function authorizeAccess(Vacancy $vacancy)
    {
        if ($vacancy->company_id !== $this->getCompanyId()) {
            throw new AuthorizationException('Anda tidak memiliki izin untuk mengakses lowongan ini.');
            // atau abort(403, 'Anda tidak memiliki izin untuk mengakses lowongan ini.');
        }
    }


    /**
     * Display a listing of the company's vacancies.
     * Menampilkan daftar lowongan milik perusahaan ini.
     */
    public function index(Request $request)
    {
        $companyId = $this->getCompanyId();
        $query = Vacancy::where('company_id', $companyId);

        // Filter (contoh: berdasarkan status)
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        // Filter (contoh: berdasarkan tipe jika perusahaan bisa buat loker umum juga?)
        // if ($request->filled('type') && $request->type !== 'all') {
        //     $query->where('type', $request->type);
        // }

        $vacancies = $query->latest()->paginate(10);
        $statuses = ['open' => 'Open', 'closed' => 'Closed']; // Untuk dropdown filter

        return view('company.vacancies.index', compact('vacancies', 'statuses'));
    }

    /**
     * Show the form for creating a new vacancy.
     * Menampilkan form tambah lowongan baru.
     */
    public function create()
    {
        return view('company.vacancies.create');
    }

    /**
     * Store a newly created vacancy in storage.
     * Menyimpan lowongan baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'deadline' => 'nullable|date|after_or_equal:today',
            'slots' => 'required|integer|min:1',
            'status' => ['required', Rule::in(['open', 'closed'])],
            // Tipe mungkin bisa dipilih perusahaan? Atau default 'kerjasama'?
             'type' => ['required', Rule::in(['kerjasama'])], // Default kerjasama saja
        ]);

        // Tambahkan company_id secara otomatis
        $vacancyData = $validatedData;
        $vacancyData['company_id'] = $this->getCompanyId();
        // $vacancyData['type'] = 'kerjasama'; // Set tipe default jika tidak ada input

        Vacancy::create($vacancyData);

        return redirect()->route('company.vacancies.index')
                         ->with('success', 'Lowongan baru berhasil ditambahkan.');
    }

    /**
     * Display the specified vacancy. (Opsional, bisa digabung di edit)
     */
    public function show(Vacancy $vacancy)
    {
         try {
            $this->authorizeAccess($vacancy); // Cek kepemilikan
         } catch (AuthorizationException $e) {
             return redirect()->route('company.vacancies.index')->with('error', $e->getMessage());
         }

        // Tampilkan view detail jika perlu
        return view('company.vacancies.show', compact('vacancy'));
    }

    /**
     * Show the form for editing the specified vacancy.
     * Menampilkan form edit lowongan.
     */
    public function edit(Vacancy $vacancy)
    {
        try {
            $this->authorizeAccess($vacancy); // Cek kepemilikan
         } catch (AuthorizationException $e) {
             return redirect()->route('company.vacancies.index')->with('error', $e->getMessage());
         }

        return view('company.vacancies.edit', compact('vacancy'));
    }

    /**
     * Update the specified vacancy in storage.
     * Mengupdate lowongan.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
         try {
            $this->authorizeAccess($vacancy); // Cek kepemilikan
         } catch (AuthorizationException $e) {
             return redirect()->route('company.vacancies.index')->with('error', $e->getMessage());
         }

         $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'deadline' => 'nullable|date', // Tidak wajib after_or_equal saat update
            'slots' => 'required|integer|min:1',
            'status' => ['required', Rule::in(['open', 'closed'])],
             // 'type' => ['required', Rule::in(['kerjasama'])], // Tipe tidak diubah
        ]);

        // 'company_id' dan 'type' tidak perlu diupdate dari form ini

        $vacancy->update($validatedData);

        return redirect()->route('company.vacancies.index')
                         ->with('success', 'Lowongan berhasil diperbarui.');
    }

    /**
     * Remove the specified vacancy from storage.
     * Menghapus lowongan.
     */
    public function destroy(Vacancy $vacancy)
    {
         try {
            $this->authorizeAccess($vacancy); // Cek kepemilikan
         } catch (AuthorizationException $e) {
             return redirect()->route('company.vacancies.index')->with('error', $e->getMessage());
         }

        // TODO: Pertimbangkan Pendaftar Terkait (sama seperti di Admin Controller)
        // Cek jika ada pendaftar aktif, mungkin cegah hapus?
        // if ($vacancy->applications()->whereNotIn('status', ['rejected', 'cancelled'])->exists()) {
        //     return redirect()->back()->with('error', 'Tidak dapat menghapus lowongan karena masih ada pendaftar aktif/diterima.');
        // }

        $vacancy->delete();

        return redirect()->route('company.vacancies.index')
                         ->with('success', 'Lowongan berhasil dihapus.');
    }
}