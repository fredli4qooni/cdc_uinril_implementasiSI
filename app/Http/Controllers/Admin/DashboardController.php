<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Application;
use App\Models\Event;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Hitung Jumlah Mahasiswa Aktif (role = mahasiswa)
        //    (Asumsikan semua user mahasiswa aktif, atau tambahkan filter `where('is_active', true)` jika ada)
        $mahasiswaCount = User::where('role', 'mahasiswa')->count();

        // 2. Hitung Jumlah Perusahaan Mitra
        $companyCount = Company::count();

        // 3. Hitung Jumlah Lowongan Kerjasama yang Sedang Dibuka
        $activeVacancyCount = Vacancy::where('type', 'kerjasama')
            ->where('status', 'open')
            ->count();

        // 4. Hitung Jumlah Total Pendaftaran Magang Kerjasama
        //    (Kita bisa filter berdasarkan lowongan kerjasama jika perlu)
        $applicationCount = Application::whereHas('vacancy', function ($query) {
            $query->where('type', 'kerjasama');
        })->count();

        // 5. (Opsional) Hitung Jumlah Event/Loker Umum yang sedang Published
        $publishedEventCount = Event::where('is_published', true)->count();


        // 6. Kirim data count ke view
        return view('admin.dashboard', compact(
            'mahasiswaCount',
            'companyCount',
            'activeVacancyCount',
            'applicationCount',
            'publishedEventCount' // Kirim juga jika dihitung
        ));
    }
}
