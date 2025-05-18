<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCompany
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if ($user->role === 'perusahaan') {
                // Tambahan: Pastikan user terhubung ke company (sudah ada sebelumnya)
                if (Auth::guard('web')->user()->company) {
                    return $next($request); // Lanjutkan jika perusahaan valid
                } else {
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('company.login')->withErrors(['email' => 'Akun tidak terhubung ke data perusahaan.']);
                }
            } elseif ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard'); // Redirect mahasiswa
            } elseif ($user->role === 'admin') {
                 return redirect()->route('admin.dashboard'); // Redirect admin
            }
             // Role tidak dikenal, logout
             Auth::guard('web')->logout();
             return redirect()->route('company.login')->with('error', 'Role tidak valid.');
        }

        // Jika belum login, redirect ke login perusahaan
        return redirect()->route('company.login');
    }
}