<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\StudentProfile; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Validation\Rule; 

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     * Modifikasi untuk menampilkan form profil mahasiswa.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Pastikan user adalah mahasiswa dan punya profile
        // Jika belum punya profile, buatkan yang kosong (seharusnya sudah dibuat saat registrasi)
        if ($user->role === 'mahasiswa' && !$user->studentProfile) {
            StudentProfile::create(['user_id' => $user->id]);
            $user->refresh(); // Refresh data user
        }

        // Kirim data user dan studentProfile ke view
        return view('mahasiswa.profile.edit', [
            'user' => $user,
            'studentProfile' => $user->studentProfile ?? null, // Kirim profile jika ada
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // === Update Data User (dari Breeze) ===
        $userData = $request->validated();
        if (empty($userData['password'])) {
            unset($userData['password']);
        }
        if ($user->email !== $userData['email']) {
            $userData['email_verified_at'] = null;
        }
        $user->fill($userData);
        $user->save();

        // === Update Data Student Profile ===
        if ($user->role === 'mahasiswa' && $user->studentProfile) {
            $profileDataValidated = $request->validate([
                'nim' => ['required', 'string', 'max:20', Rule::unique('student_profiles')->ignore($user->studentProfile->id)],
                'major' => ['nullable', 'string', 'max:255'],
                'entry_year' => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:' . (date('Y') + 1)],
                'phone_number' => ['nullable', 'string', 'max:25'],
                'address' => ['nullable', 'string'],
                'bio' => ['nullable', 'string'],
                'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
                'remove_cv' => ['sometimes', 'boolean'],
                'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'], // Validasi Avatar (gambar, maks 2MB)
                'remove_avatar' => ['sometimes', 'boolean'], // Untuk opsi hapus avatar
            ]);

            $studentProfile = $user->studentProfile;

            // Handle CV Upload/Removal
            $cvPath = $studentProfile->cv_path;
            if ($request->hasFile('cv')) {
                if ($cvPath && Storage::disk('public')->exists($cvPath)) {
                    Storage::disk('public')->delete($cvPath);
                }
                $cvPath = $request->file('cv')->store('cvs/students', 'public');
            } elseif ($request->boolean('remove_cv')) {
                if ($cvPath && Storage::disk('public')->exists($cvPath)) {
                    Storage::disk('public')->delete($cvPath);
                }
                $cvPath = null;
            }

            // Handle Avatar Upload/Removal
            $avatarPath = $studentProfile->avatar_path;
            if ($request->hasFile('avatar')) {
                // Hapus avatar lama jika ada
                if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
                    Storage::disk('public')->delete($avatarPath);
                }
                // Simpan avatar baru
                $avatarPath = $request->file('avatar')->store('avatars/students', 'public');
            } elseif ($request->boolean('remove_avatar')) {
                // Hapus avatar jika dicentang
                if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
                    Storage::disk('public')->delete($avatarPath);
                }
                $avatarPath = null; // Set path jadi null
            }

            // Update data StudentProfile
            $studentProfile->update([
                'nim' => $profileDataValidated['nim'],
                'major' => $profileDataValidated['major'],
                'entry_year' => $profileDataValidated['entry_year'],
                'phone_number' => $profileDataValidated['phone_number'],
                'address' => $profileDataValidated['address'],
                'bio' => $profileDataValidated['bio'],
                'cv_path' => $cvPath,
                'avatar_path' => $avatarPath, // Simpan path avatar
            ]);
        }

        return Redirect::route('mahasiswa.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Hapus CV dan Avatar sebelum hapus user/profile (jika cascade delete aktif)
        if ($user->studentProfile) {
            // Hapus CV jika ada
            if ($user->studentProfile->cv_path && Storage::disk('public')->exists($user->studentProfile->cv_path)) {
                Storage::disk('public')->delete($user->studentProfile->cv_path);
            }
            
            // Hapus Avatar jika ada
            if ($user->studentProfile->avatar_path && Storage::disk('public')->exists($user->studentProfile->avatar_path)) {
                Storage::disk('public')->delete($user->studentProfile->avatar_path);
            }
        }

        Auth::logout();

        $user->delete(); // Ini akan trigger cascade delete ke profile jika di set di migrasi

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}