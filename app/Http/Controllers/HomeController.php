<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Hapus Auth jika tidak ada redirect paksa dari sini
// use Illuminate\Support\Facades\Auth;
use App\Models\Vacancy;
use App\Models\Event;
use App\Models\Company;
use Illuminate\View\View; // Import View

class HomeController extends Controller
{
    public function index()
    {
        // HAPUS BLOK REDIRECT OTOMATIS DARI SINI:
        /*
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'mahasiswa') {
                // INI YANG KITA TIDAK INGINKAN LAGI SECARA OTOMATIS
                // return redirect()->route('mahasiswa.dashboard');
            } elseif ($user->role === 'perusahaan' && $user->company) {
                return redirect()->route('company.dashboard');
            }
        }
        */

        // Ambil data untuk ditampilkan di landing page (tetap sama)
        $latestVacancies = Vacancy::where('type', 'kerjasama')
                                ->where('status', 'open')
                                ->where(function ($q) {
                                    $q->whereNull('deadline')
                                      ->orWhere('deadline', '>=', now()->format('Y-m-d'));
                                })
                                ->with('company:id,name,logo_path')
                                ->latest('created_at')
                                ->limit(3)
                                ->get();

        $latestEvents = Event::where('is_published', true)
                             ->latest('created_at')
                             ->limit(3)
                             ->get();

        $totalActiveVacancies = Vacancy::where('type', 'kerjasama')
                                    ->where('status', 'open')
                                    ->where(function ($q) {
                                        $q->whereNull('deadline')
                                          ->orWhere('deadline', '>=', now()->format('Y-m-d'));
                                    })
                                    ->count();
        $totalPartnerCompanies = Company::count();

        return view('welcome', compact(
            'latestVacancies',
            'latestEvents',
            'totalActiveVacancies',
            'totalPartnerCompanies'
        ));
    }

    public function about(): View
    {
        return view('public.about');
    }

    /**
     * Menampilkan halaman "Kontak Kami".
     */
    public function contact(): View
    {
        // Anda bisa mengirim data kontak dari database jika disimpan di sana
        // $contactInfo = ContactSetting::first();
        // return view('public.contact', compact('contactInfo'));
        return view('public.contact');
    }

    /**
     * Menampilkan halaman informasi "Untuk Perusahaan".
     */
    public function forCompanies(): View
    {
        return view('public.for_companies'); // Gunakan underscore untuk nama file view
    }

    public function publicVacancies(Request $request): View
    {
        $query = Vacancy::where('status', 'open') // Hanya yang statusnya open
                        ->where(function ($q) { // Belum lewat deadline
                            $q->whereNull('deadline')
                              ->orWhere('deadline', '>=', now()->format('Y-m-d'));
                        })
                        ->with('company:id,name,logo_path'); // Ambil info perusahaan

        // Filter (Tipe: Kerjasama default, atau bisa juga tampilkan Umum jika mau)
        $type = $request->input('type', 'kerjasama'); // Default 'kerjasama'
        if ($type !== 'all') {
            $query->where('type', $type);
        }

        // Pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhereHas('company', function($companyQuery) use ($searchTerm) {
                      $companyQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $vacancies = $query->latest('created_at')->paginate(9); // Paginasi (misal 9 kartu per halaman)

        return view('public.vacancies.index', compact('vacancies'));
    }

    /**
     * Menampilkan daftar event & loker umum publik.
     */
    public function publicEvents(Request $request): View
    {
        $query = Event::where('is_published', true) // Hanya yang published
                      // ->where(function($q){ // Opsional: filter tanggal
                      //      $q->whereNull('end_datetime')->orWhere('end_datetime', '>=', now());
                      // })
                      ;

        // Pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%");
            });
        }

        // Filter Tipe
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        $events = $query->orderByRaw('CASE WHEN start_datetime IS NULL THEN created_at ELSE start_datetime END DESC')
                       ->paginate(9);

        return view('public.events.index', compact('events'));
    }
}