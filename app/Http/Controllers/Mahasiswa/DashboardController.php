<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vacancy; // Import Vacancy
use App\Models\Event;   // Import Event
use Illuminate\Support\Arr; // Import Arr Facade

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('studentProfile'); // Load profile juga

        // 1. Cek Kelengkapan Profil (Contoh sederhana)
        $profileCompleteness = 0;
        $totalFields = 5; // Jumlah field profil kunci yg ingin dicek (NIM, Major, Year, Phone, CV)
        $filledFields = 0;
        if ($user->studentProfile) {
            if (!empty($user->studentProfile->nim)) $filledFields++;
            if (!empty($user->studentProfile->major)) $filledFields++;
            if (!empty($user->studentProfile->entry_year)) $filledFields++;
            if (!empty($user->studentProfile->phone_number)) $filledFields++;
            if (!empty($user->studentProfile->cv_path)) $filledFields++;

            if ($totalFields > 0) {
                 $profileCompleteness = round(($filledFields / $totalFields) * 100);
            }
        }
        $isProfileComplete = ($profileCompleteness === 100);
        $isCvUploaded = !empty($user->studentProfile->cv_path);

        // 2. Ringkasan Status Pendaftaran
        // Hitung jumlah aplikasi berdasarkan status
        $applicationCounts = $user->applications() // Ambil dari relasi
                                 ->selectRaw('status, count(*) as count') // Pilih status dan hitung
                                 ->groupBy('status') // Kelompokkan berdasarkan status
                                 ->pluck('count', 'status') // Hasil: ['pending' => 2, 'accepted' => 1, ...]
                                 ->all(); // Konversi ke array biasa

        // Pastikan semua status ada di array, set 0 jika tidak ada count
        $applicationStatusSummary = [
            'pending' => Arr::get($applicationCounts, 'pending', 0),
            'reviewed' => Arr::get($applicationCounts, 'reviewed', 0),
            'accepted' => Arr::get($applicationCounts, 'accepted', 0),
            'rejected' => Arr::get($applicationCounts, 'rejected', 0),
            'cancelled' => Arr::get($applicationCounts, 'cancelled', 0),
        ];
        $totalApplications = array_sum($applicationStatusSummary);


        // 3. Ambil Beberapa Lowongan Terbaru yang Masih Buka
        $latestVacancies = Vacancy::where('type', 'kerjasama')
                                ->where('status', 'open')
                                ->where(function ($q) {
                                    $q->whereNull('deadline')
                                      ->orWhere('deadline', '>=', now()->format('Y-m-d'));
                                })
                                ->with('company:id,name') // Hanya ambil id & name company
                                ->latest('created_at')
                                ->limit(3) // Ambil 3 terbaru
                                ->get(['id', 'title', 'company_id', 'location', 'created_at']); // Pilih kolom yg perlu saja

        // 4. Ambil Beberapa Event/Loker Terbaru yang Published
        $latestEvents = Event::where('is_published', true)
                             // Optional: filter tanggal jika perlu
                             // ->where(function($q){
                             //      $q->whereNull('end_datetime')->orWhere('end_datetime', '>=', now());
                             // })
                             ->latest('created_at')
                             ->limit(3)
                             ->get(['id', 'title', 'type', 'location', 'start_datetime', 'created_at']);


        // 5. Kirim semua data ke view
        return view('mahasiswa.dashboard', compact(
            'user',
            'profileCompleteness',
            'isProfileComplete',
            'isCvUploaded',
            'applicationStatusSummary',
            'totalApplications',
            'latestVacancies',
            'latestEvents'
        ));
    }
}