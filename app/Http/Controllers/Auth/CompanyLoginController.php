<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // Untuk error spesifik

class CompanyLoginController extends Controller
{
    public function __construct()
    {
        // Terapkan guest ke guard 'web' saja (default)
        // Pengecekan role akan dilakukan di method login dan middleware EnsureUserIsCompany
        $this->middleware('guest:web')->except('logout');
    }

    /**
     * Menampilkan form login perusahaan.
     */
    public function showLoginForm()
    {
        return view('auth.company-login'); // Buat view ini
    }

    /**
     * Memproses attempt login perusahaan.
     */
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Autentikasi menggunakan Guard 'web' (default)
        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::guard('web')->user();

            // 3. Cek Role User
            if ($user->role === 'perusahaan') {
                // Cek apakah user terhubung ke data company
                if (!$user->company) { // Asumsi relasi User hasOne Company sudah ada
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    throw ValidationException::withMessages([
                        'email' => 'Akun perusahaan ini tidak terhubung dengan data perusahaan mitra. Hubungi Admin.',
                    ]);
                }

                // Regenerate session & redirect ke dashboard perusahaan
                $request->session()->regenerate();
                return redirect()->intended(route('company.dashboard')); // Arahkan ke dashboard company
            } else {
                // Jika role salah (misal admin/mahasiswa coba login di sini), logout lagi
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                throw ValidationException::withMessages([
                    'email' => 'Akses ditolak. Akun ini bukan akun perusahaan mitra.',
                ]);
            }
        }

        // 4. Jika attempt login gagal
        throw ValidationException::withMessages([
            'email' => __('auth.failed'), // Pesan error standar Laravel
        ]);
    }

    /**
     * Logout user perusahaan.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Logout dari guard default sudah cukup
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
