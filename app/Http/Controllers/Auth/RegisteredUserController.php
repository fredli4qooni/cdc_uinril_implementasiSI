<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\StudentProfile; 

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nim' => ['required', 'string', 'max:20', 'unique:'.StudentProfile::class], // Tambah validasi NIM
            // Tambahkan validasi lain jika perlu di form register (misal: jurusan, tahun masuk)
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', // <-- SET ROLE MAHASISWA DI SINI
        ]);

        // Buat juga StudentProfile saat registrasi
        StudentProfile::create([
            'user_id' => $user->id,
            'nim' => $request->nim, // Ambil NIM dari request
            // Isi field profile lain dari request jika ada
            // 'major' => $request->major,
            // 'entry_year' => $request->entry_year,
        ]);


        event(new Registered($user));

        Auth::login($user);

        // Redirect ke dashboard mahasiswa setelah registrasi
        return redirect(route('mahasiswa.dashboard', absolute: false)); // Gunakan route name dashboard mahasiswa
    }
}
