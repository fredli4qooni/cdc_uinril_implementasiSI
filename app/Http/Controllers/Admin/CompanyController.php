<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;          // Model Company
use App\Models\User;             // Model User (untuk opsi buat akun)
use Illuminate\Http\Request;     // Object Request
use Illuminate\Support\Facades\Hash; // Untuk hashing password user
use Illuminate\Support\Facades\Storage; // Untuk manajemen file (logo)
use Illuminate\Validation\Rule; // Untuk aturan validasi (contoh: unique)

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan halaman daftar perusahaan.
     * Method: GET
     * URL: /admin/companies
     * Route Name: admin.companies.index
     */
    public function index(Request $request) // Tambahkan Request $request untuk fitur search/filter
    {
        // Ambil data perusahaan terbaru dengan paginasi
        $companies = Company::latest()->paginate(10); // tampilkan 10 data per halaman

        return view('admin.companies.index', compact('companies')); // Kirim data ke view
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form tambah perusahaan baru.
     * Method: GET
     * URL: /admin/companies/create
     * Route Name: admin.companies.create
     */
    public function create()
    {
        return view('admin.companies.create'); // Tampilkan view form create
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data perusahaan baru dari form ke database.
     * Method: POST
     * URL: /admin/companies
     * Route Name: admin.companies.store
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies,email', // Pastikan email unik di tabel companies
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:25',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255', // Pastikan format URL valid
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Logo: gambar, format tertentu, maks 2MB

            // Validasi untuk Opsi Buat Akun User Perusahaan
            'create_user' => 'sometimes|boolean', // Checkbox 'create_user' ada atau tidak
            'user_email' => [
                'nullable', // Boleh kosong jika create_user tidak dicentang
                'required_if:create_user,1', // Wajib jika create_user dicentang
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email'), 
            ],
            'user_password' => [
                'nullable',
                'required_if:create_user,1', // Wajib jika create_user dicentang
                'string',
                'min:8',             // Minimal 8 karakter
                'confirmed',         // Harus cocok dengan field 'user_password_confirmation'
            ],
        ]);

        // 2. Handle File Upload (Logo)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            // Simpan file di storage/app/public/logos/companies
            $logoPath = $request->file('logo')->store('logos/companies', 'public');
        }

        // 3. Simpan Data Perusahaan ke Database
        $companyData = $validatedData; // Ambil data tervalidasi
        $companyData['logo_path'] = $logoPath; // Tambahkan path logo

        // Hapus data terkait user jika tidak membuat user
        unset($companyData['create_user'], $companyData['user_email'], $companyData['user_password'], $companyData['user_password_confirmation']);

        $company = Company::create($companyData); // Buat record baru

        // 4. Opsional: Buat Akun User Jika Diminta
        $userId = null;
        if ($request->boolean('create_user') && $company) {
            $user = User::create([
                'name' => $validatedData['name'], // Gunakan nama perusahaan sebagai nama user
                'email' => $validatedData['user_email'],
                'password' => Hash::make($validatedData['user_password']),
                'role' => 'perusahaan', // Set role sebagai 'perusahaan'
                'email_verified_at' => now(), // Anggap langsung terverifikasi
            ]);
            $userId = $user->id;

            // Update company record untuk menyimpan user_id
            $company->user_id = $userId;
            $company->save();
        }

        // 5. Redirect ke Halaman Index dengan Pesan Sukses
        return redirect()->route('admin.companies.index')
                         ->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail satu perusahaan (opsional untuk admin, mungkin lebih berguna untuk user).
     * Method: GET
     * URL: /admin/companies/{company}
     * Route Name: admin.companies.show
     */
    public function show(Company $company) // Menggunakan Route Model Binding
    {
        // $company otomatis di-fetch berdasarkan ID di URL
        return view('admin.companies.show', compact('company')); // Tampilkan view detail
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk mengedit data perusahaan.
     * Method: GET
     * URL: /admin/companies/{company}/edit
     * Route Name: admin.companies.edit
     */
    public function edit(Company $company) // Menggunakan Route Model Binding
    {
        return view('admin.companies.edit', compact('company')); // Tampilkan view form edit dengan data company
    }

    /**
     * Update the specified resource in storage.
     * Mengupdate data perusahaan di database berdasarkan input dari form edit.
     * Method: PUT/PATCH
     * URL: /admin/companies/{company}
     * Route Name: admin.companies.update
     */
    public function update(Request $request, Company $company) // Menggunakan Route Model Binding
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('companies', 'email')->ignore($company->id),
            ],
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:25',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Validasi untuk update user terkait 
        ]);

        // 2. Handle File Upload (Update Logo)
        $logoPath = $company->logo_path; // Default pakai logo lama
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($company->logo_path && Storage::disk('public')->exists($company->logo_path)) {
                Storage::disk('public')->delete($company->logo_path);
            }
            // Upload logo baru
            $logoPath = $request->file('logo')->store('logos/companies', 'public');
        } elseif ($request->boolean('remove_logo')) { // Tambahan: Opsi hapus logo tanpa upload baru
             if ($company->logo_path && Storage::disk('public')->exists($company->logo_path)) {
                Storage::disk('public')->delete($company->logo_path);
            }
            $logoPath = null; // Set path jadi null
        }

        // 3. Update Data Perusahaan di Database
        $updateData = $validatedData;
        $updateData['logo_path'] = $logoPath; 

        $company->update($updateData);

        // 4. Redirect ke Halaman Index dengan Pesan Sukses
        return redirect()->route('admin.companies.index')
                         ->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus data perusahaan dari database.
     * Method: DELETE
     * URL: /admin/companies/{company}
     * Route Name: admin.companies.destroy
     */
    public function destroy(Company $company) // Menggunakan Route Model Binding
    {
        // 1. Hapus File Logo dari Storage (jika ada)
        if ($company->logo_path && Storage::disk('public')->exists($company->logo_path)) {
            Storage::disk('public')->delete($company->logo_path);
        }

        // 3. Hapus Data Perusahaan dari Database
        $company->delete();

        // 4. Redirect ke Halaman Index dengan Pesan Sukses
        return redirect()->route('admin.companies.index')
                         ->with('success', 'Perusahaan berhasil dihapus.');
    }
}