<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vacancy;     // Untuk statistik lowongan
use App\Models\Application; // Untuk statistik pendaftar

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = $user->company; // Asumsi relasi company sudah di-load oleh middleware atau di sini

        if (!$company) {
            // Fallback jika relasi company tidak ditemukan (seharusnya tidak terjadi jika middleware benar)
            Auth::logout();
            return redirect()->route('company.login')->with('error', 'Data perusahaan tidak ditemukan. Silakan login kembali.');
        }

        // 1. Statistik Lowongan
        $totalVacancies = $company->vacancies()->count();
        $openVacanciesCount = $company->vacancies()->where('status', 'open')->count();
        $closedVacanciesCount = $company->vacancies()->where('status', 'closed')->count();

        // 2. Statistik Pendaftar
        // Ambil semua aplikasi untuk lowongan milik perusahaan ini
        $allApplicationsForCompany = Application::whereHas('vacancy', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        });

        $totalApplicants = $allApplicationsForCompany->count();
        $pendingApplicantsCount = (clone $allApplicationsForCompany)->where('status', 'pending')->count(); // Clone agar query awal tidak termodifikasi
        $reviewedApplicantsCount = (clone $allApplicationsForCompany)->where('status', 'reviewed')->count();
        $acceptedApplicantsCount = (clone $allApplicationsForCompany)->where('status', 'accepted')->count();
        // Anda bisa tambahkan status 'completed' jika relevan
        $completedApplicantsCount = (clone $allApplicationsForCompany)->where('status', 'completed')->count();


        // 3. Ambil Beberapa Pendaftar Terbaru yang Statusnya Pending atau Reviewed
        $recentPendingApplicants = Application::whereHas('vacancy', function ($query) use ($company) {
                                        $query->where('company_id', $company->id);
                                    })
                                    ->whereIn('status', ['pending', 'reviewed'])
                                    ->with(['user:id,name', 'vacancy:id,title']) // Eager load
                                    ->latest('application_date')
                                    ->limit(5)
                                    ->get();

        // 4. Ambil Beberapa Lowongan Terbaru/Terpopuler (Opsional)
        $latestCompanyVacancies = $company->vacancies()
                                    ->latest('created_at')
                                    ->limit(3)
                                    ->get(['id', 'title', 'status', 'created_at']);


        return view('company.dashboard', compact(
            'user',
            'company',
            'totalVacancies',
            'openVacanciesCount',
            'closedVacanciesCount',
            'totalApplicants',
            'pendingApplicantsCount',
            'reviewedApplicantsCount',
            'acceptedApplicantsCount',
            'completedApplicantsCount',
            'recentPendingApplicants',
            'latestCompanyVacancies'
        ));
    }
}