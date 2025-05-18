<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Application; 
use Illuminate\Http\RedirectResponse; 
use Illuminate\View\View;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the student's applications.
     * Menampilkan daftar pendaftaran yang dibuat oleh mahasiswa yang login.
     */
    public function index()
    {
        $user = Auth::user();

        
        $applications = $user->applications() // Ambil dari relasi hasMany di model User
                            ->with(['vacancy.company']) // Eager load vacancy dan company-nya
                            ->latest('application_date') // Urutkan terbaru
                            ->paginate(10); // Paginasi

        return view('mahasiswa.applications.index', compact('applications'));
    }

    public function cancel(Application $application): RedirectResponse
    {
        // 1. Authorisasi: Pastikan aplikasi ini milik user yang login
        if (Auth::id() !== $application->user_id) {
            // Seharusnya tidak terjadi jika user hanya lihat daftarnya sendiri,
            // tapi baik untuk keamanan jika URL diakses langsung.
            abort(403, 'Anda tidak diizinkan melakukan tindakan ini.');
        }

        // 2. Validasi: Pastikan status aplikasi adalah 'pending'
        if ($application->status !== 'pending') {
            return redirect()->route('mahasiswa.applications.index')
                         ->with('error', 'Tidak dapat membatalkan pendaftaran yang statusnya bukan \'Pending\'.');
        }

        // 3. Proses Pembatalan: Update status menjadi 'cancelled'
        $application->update(['status' => 'cancelled']);

        // 4. Redirect kembali ke daftar pendaftaran dengan pesan sukses
        return redirect()->route('mahasiswa.applications.index')
                     ->with('success', 'Pendaftaran Anda untuk lowongan "' . ($application->vacancy->title ?? 'N/A') . '" telah berhasil dibatalkan.');
    }

    public function show(Application $application): View|RedirectResponse // Bisa return View atau Redirect
    {
        // 1. Authorisasi: Pastikan aplikasi ini milik user yang login
        if (Auth::id() !== $application->user_id) {
            abort(403, 'Anda tidak diizinkan melihat detail pendaftaran ini.');
            // Atau redirect jika ingin lebih halus:
            // return redirect()->route('mahasiswa.applications.index')->with('error', 'Anda tidak diizinkan melihat detail pendaftaran tersebut.');
        }

        // 2. Eager load relasi yang dibutuhkan untuk detail
        $application->loadMissing(['vacancy.company']); // Load vacancy & company terkait

        // 3. Kirim data ke view
        return view('mahasiswa.applications.show', compact('application'));
    }

}
