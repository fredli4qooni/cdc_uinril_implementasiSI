<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if ($user->role === 'admin') {
                return $next($request); // Lanjutkan jika admin
            } elseif ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard'); // Redirect mahasiswa
            } elseif ($user->role === 'perusahaan') {
                return redirect()->route('company.dashboard'); // Redirect perusahaan
            }
            // Role tidak dikenal, logout
            Auth::guard('web')->logout();
            return redirect()->route('admin.login')->with('error', 'Role tidak valid.');
        }

        // Jika belum login, redirect ke login admin
        return redirect()->route('admin.login');
    }
}