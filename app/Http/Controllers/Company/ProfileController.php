<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company; // Model Company
use App\Models\CompanyPhoto; // Model CompanyPhoto
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Display the company's profile edit form.
     */
    public function edit(Request $request): View
    {
        $company = Auth::user()->company; // Ambil data company dari user yang login
        if (!$company) {
            // Seharusnya tidak terjadi jika middleware 'company' bekerja
            abort(404, 'Data perusahaan tidak ditemukan.');
        }
        $company->load('photos'); // Eager load foto galeri

        return view('company.profile.edit', compact('company'));
    }

    /**
     * Update the company's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $company = Auth::user()->company;
        if (!$company) {
            abort(404, 'Data perusahaan tidak ditemukan.');
        }

        $validatedData = $request->validate([
            // Perusahaan mungkin tidak boleh edit nama & email utama, itu oleh Admin
            // 'name' => 'required|string|max:255',
            // 'email' => ['required', 'string', 'email', 'max:255', Rule::unique('companies', 'email')->ignore($company->id)],
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:25',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_logo' => 'sometimes|boolean',

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

            'gallery_photos' => 'nullable|array',
            'gallery_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:company_photos,id',
        ]);

        // Handle Logo Upload/Removal
        $logoPath = $company->logo_path;
        if ($request->hasFile('logo')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo')->store('logos/companies', 'public');
        } elseif ($request->boolean('remove_logo')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = null;
        }

        // Data untuk diupdate (Perusahaan tidak boleh edit nama & email utama via profil ini)
        $updateData = [
            'address' => $validatedData['address'] ?? $company->address,
            'phone_number' => $validatedData['phone_number'] ?? $company->phone_number,
            'description' => $validatedData['description'] ?? $company->description,
            'website' => $validatedData['website'] ?? $company->website,
            'logo_path' => $logoPath,
            'industry' => $validatedData['industry'] ?? $company->industry,
            'employee_count_range' => $validatedData['employee_count_range'] ?? $company->employee_count_range,
            'full_address' => $validatedData['full_address'] ?? $company->full_address,
            'google_maps_embed_url' => $validatedData['google_maps_embed_url'] ?? $company->google_maps_embed_url,
            'linkedin_url' => $validatedData['linkedin_url'] ?? $company->linkedin_url,
            'instagram_url' => $validatedData['instagram_url'] ?? $company->instagram_url,
            'twitter_url' => $validatedData['twitter_url'] ?? $company->twitter_url,
        ];

        $company->update($updateData);

        // Handle Penghapusan Foto Galeri
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

        // Handle Upload Foto Galeri Baru
        if ($request->hasFile('gallery_photos')) {
            foreach ($request->file('gallery_photos') as $file) {
                $path = $file->store('gallery/companies/' . $company->id, 'public');
                $company->photos()->create([
                    'photo_path' => $path,
                ]);
            }
        }

        return redirect()->route('company.profile.edit')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}