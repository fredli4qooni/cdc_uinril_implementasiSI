<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;          // Model Vacancy
use App\Models\Company;          // Model Company (untuk dropdown)
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar lowongan kerjasama.
     */
    public function index()
    {
        // Ambil data lowongan terbaru, sertakan data perusahaan terkait (Eager Loading)
        $vacancies = Vacancy::with('company') // Load relasi 'company' untuk efisiensi query
                          ->where('type', 'kerjasama') // Hanya tampilkan tipe kerjasama di menu ini
                          ->latest()
                          ->paginate(10);

        return view('admin.vacancies.index', compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form tambah lowongan.
     */
    public function create()
    {
        // Ambil daftar perusahaan untuk dropdown
        $companies = Company::orderBy('name')->pluck('name', 'id'); // Ambil 'name' sebagai teks, 'id' sebagai value

        return view('admin.vacancies.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan lowongan baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'company_id' => 'required|exists:companies,id', // Pastikan company_id ada di tabel companies
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'deadline' => 'nullable|date|after_or_equal:today', // Tanggal tidak boleh sebelum hari ini
            'slots' => 'required|integer|min:1',
            'status' => ['required', Rule::in(['open', 'closed'])], // Harus 'open' atau 'closed'
            // 'type' => ['required', Rule::in(['kerjasama', 'umum'])], // Default 'kerjasama' bisa diset di model atau di sini
        ]);

        // Tambahkan type secara eksplisit jika perlu (meski sudah ada default di db)
        $validatedData['type'] = 'kerjasama';

        Vacancy::create($validatedData);

        return redirect()->route('admin.vacancies.index')
                         ->with('success', 'Lowongan kerjasama berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * (Opsional untuk Admin, bisa skip jika tidak perlu halaman detail khusus)
     */
    public function show(Vacancy $vacancy)
    {
         // Pastikan hanya load lowongan kerjasama
        if ($vacancy->type !== 'kerjasama') {
            abort(404);
        }
        $vacancy->load('company'); // Load relasi company jika belum
        return view('admin.vacancies.show', compact('vacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit lowongan.
     */
    public function edit(Vacancy $vacancy)
    {
         // Pastikan hanya load lowongan kerjasama
        if ($vacancy->type !== 'kerjasama') {
             abort(404); // Atau redirect dengan error
        }

        $companies = Company::orderBy('name')->pluck('name', 'id');
        return view('admin.vacancies.edit', compact('vacancy', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     * Mengupdate lowongan di database.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
         // Pastikan hanya edit lowongan kerjasama
         if ($vacancy->type !== 'kerjasama') {
            abort(403, 'Aksi tidak diizinkan untuk tipe lowongan ini.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'deadline' => 'nullable|date', // Tidak wajib 'after_or_equal:today' saat update
            'slots' => 'required|integer|min:1',
            'status' => ['required', Rule::in(['open', 'closed'])],
        ]);

        // 'type' tidak diubah di sini karena ini CRUD khusus kerjasama

        $vacancy->update($validatedData);

        return redirect()->route('admin.vacancies.index')
                         ->with('success', 'Lowongan kerjasama berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus lowongan dari database.
     */
    public function destroy(Vacancy $vacancy)
    {
        // Pastikan hanya hapus lowongan kerjasama
         if ($vacancy->type !== 'kerjasama') {
            abort(403, 'Aksi tidak diizinkan untuk tipe lowongan ini.');
        }

        // TODO: Pertimbangkan Pendaftaran Terkait
        // Cek apakah ada pendaftar aktif? Jika ya, mungkin cegah hapus atau beri peringatan.
        // if ($vacancy->applications()->where('status', '!=', 'rejected')->exists()) {
        //     return redirect()->back()->with('error', 'Tidak dapat menghapus lowongan karena masih ada pendaftar aktif.');
        // }

        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')
                         ->with('success', 'Lowongan kerjasama berhasil dihapus.');
    }
}