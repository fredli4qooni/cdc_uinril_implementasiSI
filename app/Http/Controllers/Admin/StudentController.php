<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Model User
use App\Models\StudentProfile; // Model StudentProfile
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk handle CV jika admin bisa upload/hapus
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash; // Jika admin bisa reset password

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar user mahasiswa.
     */
    public function index(Request $request)
    {
        // Query dasar: ambil user dengan role 'mahasiswa'
        $query = User::where('role', 'mahasiswa')
                     ->with('studentProfile'); // Eager load profil mahasiswa

        // --- Fitur Pencarian (Contoh) ---
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhereHas('studentProfile', function($profileQuery) use ($searchTerm) {
                      $profileQuery->where('nim', 'like', "%{$searchTerm}%")
                                   ->orWhere('major', 'like', "%{$searchTerm}%");
                  });
            });
        }
        // --- Akhir Fitur Pencarian ---

        $students = $query->latest('users.created_at')->paginate(15); // Paginasi

        return view('admin.students.index', compact('students'));
    }

    /**
     * Display the specified resource.
     * Menampilkan detail mahasiswa.
     */
    public function show(User $student) // Route model binding ke User
    {
        // Pastikan user adalah mahasiswa
        if ($student->role !== 'mahasiswa') {
            abort(404);
        }
        // Load relasi jika belum (meski di index sudah pakai with, bisa jadi akses langsung)
        $student->load('studentProfile');

        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit data mahasiswa (lebih ke profilnya).
     */
    public function edit(User $student)
    {
        if ($student->role !== 'mahasiswa') {
            abort(404);
        }
        $student->load('studentProfile');

        // Jika student belum punya profile (kasus aneh, harusnya dibuat saat registrasi)
        // Mungkin beri pesan error atau redirect. Untuk sekarang asumsikan profile ada.
        if (!$student->studentProfile) {
             abort(404, 'Profil mahasiswa tidak ditemukan.'); 
        }


        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     * Mengupdate data profil mahasiswa & mungkin status user.
     */
    public function update(Request $request, User $student)
    {
        if ($student->role !== 'mahasiswa' || !$student->studentProfile) {
            abort(404);
        }

        // 1. Validasi Input (gabungan User & Profile)
        $validatedData = $request->validate([
            // Data User (Contoh: Status Akun, Reset Password)
            'name' => 'required|string|max:255', // Nama mungkin bisa diedit admin
            // 'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($student->id)], // Email sebaiknya tidak diubah admin
            'is_active' => 'sometimes|boolean', // Untuk aktivasi/deaktivasi akun (tambah kolom ini jika perlu)
            'new_password' => 'nullable|string|min:8|confirmed', // Untuk reset password

            // Data StudentProfile
            'nim' => ['required', 'string', 'max:20', Rule::unique('student_profiles')->ignore($student->studentProfile->id)],
            'major' => 'nullable|string|max:255',
            'entry_year' => 'nullable|integer|digits:4|min:1900|max:' . (date('Y') + 1), // Validasi tahun
            'phone_number' => 'nullable|string|max:25',
            'address' => 'nullable|string',
            'bio' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Validasi CV (PDF/Word, maks 5MB)
            'remove_cv' => 'sometimes|boolean',
        ]);

        // 2. Update Data User
        $userData = [
            'name' => $validatedData['name'],
            // Jika ada kolom is_active: 'is_active' => $request->boolean('is_active'),
        ];
        if ($request->filled('new_password')) {
            $userData['password'] = Hash::make($validatedData['new_password']);
        }
        $student->update($userData);

        // 3. Update Data StudentProfile
        $profileData = [
            'nim' => $validatedData['nim'],
            'major' => $validatedData['major'],
            'entry_year' => $validatedData['entry_year'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'bio' => $validatedData['bio'],
        ];

        // Handle CV Upload/Removal
        $cvPath = $student->studentProfile->cv_path;
        if ($request->hasFile('cv')) {
            // Hapus CV lama jika ada
            if ($cvPath && Storage::disk('public')->exists($cvPath)) {
                Storage::disk('public')->delete($cvPath);
            }
            // Upload CV baru
            $cvPath = $request->file('cv')->store('cvs/students', 'public');
        } elseif ($request->boolean('remove_cv')) {
            if ($cvPath && Storage::disk('public')->exists($cvPath)) {
                Storage::disk('public')->delete($cvPath);
            }
            $cvPath = null;
        }
        $profileData['cv_path'] = $cvPath;

        $student->studentProfile()->update($profileData); // Update profile via relasi

        return redirect()->route('admin.students.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus akun user (sebaiknya soft delete atau deaktivasi).
     */
    public function destroy(User $student)
    {
        if ($student->role !== 'mahasiswa') {
            abort(404);
        }

        if ($student->studentProfile && $student->studentProfile->cv_path && Storage::disk('public')->exists($student->studentProfile->cv_path)) {
             Storage::disk('public')->delete($student->studentProfile->cv_path);
        }
        $student->delete(); // Ini akan menghapus user dan profile karena cascade
        return redirect()->route('admin.students.index')
                         ->with('success', 'Akun mahasiswa dan profilnya berhasil dihapus permanen.');


    }
}