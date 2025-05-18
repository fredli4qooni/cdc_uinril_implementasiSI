<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login via guard 'web'
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            // 2. Cek apakah rolenya 'mahasiswa'
            if ($user->role === 'mahasiswa') {
                // Jika benar mahasiswa, lanjutkan request
                return $next($request);
            } else {
                // Jika login tapi BUKAN mahasiswa (misal admin/company)
                // Redirect ke dashboard mereka masing-masing
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role === 'perusahaan') {
                    return redirect()->route('company.dashboard');
                }
                // Jika role tidak dikenal (seharusnya tidak terjadi), logout saja
                Auth::guard('web')->logout();
                return redirect()->route('login')->with('error', 'Role tidak valid.'); // Ke login utama
            }
        }

        // 3. Jika user belum login sama sekali
        // Redirect ke halaman login utama (mahasiswa)
        return redirect()->route('login');
    }
}