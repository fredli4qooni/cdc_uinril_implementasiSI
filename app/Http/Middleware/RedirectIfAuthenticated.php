<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider; // Pastikan ini di-import
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$guards
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
             // Kita hanya fokus pada guard 'web' (default) untuk logika ini
             if ($guard === null || $guard === 'web') {
                 if (Auth::guard('web')->check()) {
                     $user = Auth::guard('web')->user();

                     // Redirect berdasarkan role jika user mencoba akses halaman guest
                     if ($user->role === 'admin') {
                         return redirect(RouteServiceProvider::ADMIN_HOME); // Redirect admin ke dashboard admin
                     } elseif ($user->role === 'mahasiswa') {
                         return redirect(RouteServiceProvider::HOME); // Redirect mahasiswa ke dashboard mahasiswa
                     } elseif ($user->role === 'perusahaan') {
                        // Pastikan perusahaan terhubung ke data company sebelum redirect
                        if ($user->company) {
                             return redirect(RouteServiceProvider::COMPANY_HOME); // Redirect perusahaan ke dashboard perusahaan
                        } else {
                            // Jika tidak terhubung, logout saja agar bisa login lagi
                            Auth::guard('web')->logout();
                            // Tidak perlu redirect spesifik, biarkan request ke halaman guest berlanjut
                            // atau bisa redirect ke login company dengan error
                            // return redirect()->route('company.login')->withErrors(['email' => 'Akun tidak terhubung ke data perusahaan.']);
                        }
                     }
                     // Jika role tidak dikenal, redirect ke home mahasiswa sebagai fallback
                     // atau logout
                     // Auth::guard('web')->logout();
                     // return redirect('/');
                      return redirect(RouteServiceProvider::HOME);
                 }
             }
             // Logika untuk guard lain bisa ditambahkan di sini jika perlu
        }

        // Jika belum login, biarkan akses halaman guest
        return $next($request);
    }
}