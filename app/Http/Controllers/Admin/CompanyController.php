<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;          // Model Company
use App\Models\CompanyPhoto;     // Model CompanyPhoto untuk gallery
use App\Models\User;             // Model User (untuk opsi buat akun)
use Illuminate\Http\Request;     // Object Request
use Illuminate\Support\Facades\Hash; // Untuk hashing password user
use Illuminate\Support\Facades\Storage; // Untuk manajemen file (logo & gallery)
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

            // Field baru (Embed Gallery 1)
            'industry' => 'nullable|string|max:255',
            'employee_count_range' => 'nullable|string|max:50',
            'full_address' => 'nullable|string',
            'google_maps_embed_url' => ['nullable', 'string', 'max:1000', function ($attribute, $value, $fail) {
                if ($value && (!str_starts_with($value, '<iframe') || !str_contains($value, 'google.com/maps/embed'))) {
                    $fail('URL Google Maps Embed tidak valid. Harus berupa kode iframe dari Google Maps.');
                }
            }],
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',

            // Untuk Company Gallery
            'gallery_photos' => 'nullable|array', // Array file foto
            'gallery_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi setiap file

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
        $companyData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'] ?? null,
            'phone_number' => $validatedData['phone_number'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'website' => $validatedData['website'] ?? null,
            'logo_path' => $logoPath,
            // Field baru
            'industry' => $validatedData['industry'] ?? null,
            'employee_count_range' => $validatedData['employee_count_range'] ?? null,
            'full_address' => $validatedData['full_address'] ?? null,
            'google_maps_embed_url' => $validatedData['google_maps_embed_url'] ?? null,
            'linkedin_url' => $validatedData['linkedin_url'] ?? null,
            'instagram_url' => $validatedData['instagram_url'] ?? null,
            'twitter_url' => $validatedData['twitter_url'] ?? null,
        ];

        $company = Company::create($companyData); // Buat record baru

        // 4. Handle Upload Foto Galeri (jika ada)
        if ($request->hasFile('gallery_photos')) {
            foreach ($request->file('gallery_photos') as $file) {
                $path = $file->store('gallery/companies/' . $company->id, 'public');
                $company->photos()->create([
                    'photo_path' => $path,
                    // 'caption' => 'Default Caption', // Bisa ditambahkan jika diperlukan
                    // 'order' => 0, // Bisa ditambahkan untuk sorting
                ]);
            }
        }

        // 5. Opsional: Buat Akun User Jika Diminta
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

        // 6. Redirect ke Halaman Index dengan Pesan Sukses
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
        // Load foto-foto perusahaan untuk ditampilkan
        $company->load('photos');
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
        $company->load('photos'); // Eager load foto-foto perusahaan
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
            'remove_logo' => 'sometimes|boolean', // Opsi hapus logo

            // Field baru dari langkah sebelumnya (Embed Gallery 1)
            'industry' => 'nullable|string|max:255',
            'employee_count_range' => 'nullable|string|max:50',
            'full_address' => 'nullable|string',
            'google_maps_embed_url' => ['nullable', 'string', 'max:1000', function ($attribute, $value, $fail) {
                if ($value && (!str_starts_with($value, '<iframe') || !str_contains($value, 'google.com/maps/embed'))) {
                    $fail('URL Google Maps Embed tidak valid. Harus berupa kode iframe dari Google Maps.');
                }
            }],
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',

            // Untuk Company Gallery
            'gallery_photos' => 'nullable|array', // Array file foto
            'gallery_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi setiap file
            'delete_photos' => 'nullable|array', // Array ID foto yang akan dihapus
            'delete_photos.*' => 'integer|exists:company_photos,id', // Validasi ID foto
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
        } elseif ($request->boolean('remove_logo')) { // Opsi hapus logo tanpa upload baru
             if ($company->logo_path && Storage::disk('public')->exists($company->logo_path)) {
                Storage::disk('public')->delete($company->logo_path);
            }
            $logoPath = null; // Set path jadi null
        }

        // 3. Update data company (termasuk field baru)
        $company->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'] ?? null,
            'phone_number' => $validatedData['phone_number'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'website' => $validatedData['website'] ?? null,
            'logo_path' => $logoPath,
            // Field baru
            'industry' => $validatedData['industry'] ?? null,
            'employee_count_range' => $validatedData['employee_count_range'] ?? null,
            'full_address' => $validatedData['full_address'] ?? null,
            'google_maps_embed_url' => $validatedData['google_maps_embed_url'] ?? null,
            'linkedin_url' => $validatedData['linkedin_url'] ?? null,
            'instagram_url' => $validatedData['instagram_url'] ?? null,
            'twitter_url' => $validatedData['twitter_url'] ?? null,
        ]);

        // 4. Handle Penghapusan Foto Galeri
        if ($request->has('delete_photos')) {
            foreach ($request->input('delete_photos') as $photoId) {
                $photo = CompanyPhoto::where('id', $photoId)->where('company_id', $company->id)->first();
                if ($photo) {
                    if (Storage::disk('public')->exists($photo->photo_path)) {
                        Storage::disk('public')->delete($photo->photo_path);
                    }
                    $photo->delete();
                }
            }
        }

        // 5. Handle Upload Foto Galeri Baru
        if ($request->hasFile('gallery_photos')) {
            foreach ($request->file('gallery_photos') as $file) {
                $path = $file->store('gallery/companies/' . $company->id, 'public');
                $company->photos()->create([
                    'photo_path' => $path,
                    // 'caption' => 'Default Caption', // Ambil caption dari input jika ada
                    // 'order' => 0, // Atur order jika ada input
                ]);
            }
        }

        // 6. Redirect ke Halaman Index dengan Pesan Sukses
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

        // 2. Hapus semua foto gallery perusahaan
        $photos = CompanyPhoto::where('company_id', $company->id)->get();
        foreach ($photos as $photo) {
            if (Storage::disk('public')->exists($photo->photo_path)) {
                Storage::disk('public')->delete($photo->photo_path);
            }
            $photo->delete();
        }

        // 3. Hapus Data Perusahaan dari Database
        $company->delete();

        // 4. Redirect ke Halaman Index dengan Pesan Sukses
        return redirect()->route('admin.companies.index')
                         ->with('success', 'Perusahaan berhasil dihapus.');
    }
}