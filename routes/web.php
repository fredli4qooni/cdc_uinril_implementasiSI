<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller Autentikasi Admin
use App\Http\Controllers\Auth\AdminLoginController;

// Controller Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; // Alias agar tidak konflik
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ApplicationController;

// Controller Mahasiswa
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController; // Alias
use App\Http\Controllers\Mahasiswa\VacancyController as MahasiswaVacancyController;
use App\Http\Controllers\Mahasiswa\EventController as MahasiswaEventController;
use App\Http\Controllers\Mahasiswa\ApplicationController as MahasiswaApplicationController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController; // Asumsi controller profil mahasiswa
use App\Http\Controllers\ProfileController;



// Halaman Awal / Landing Page
Route::get('/', function () {
    // Jika sudah login, arahkan ke dashboard masing-masing
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        } elseif ($user->role == 'perusahaan') {
            // return redirect()->route('perusahaan.dashboard'); // Nanti jika ada
            return redirect('/login'); // Fallback sementara
        }
    }
    // Jika belum login, tampilkan halaman welcome atau arahkan ke login mahasiswa
    // return view('welcome'); // Jika ada halaman welcome
    return redirect()->route('login'); // Arahkan langsung ke login mahasiswa
});

// === RUTE AUTENTIKASI ADMIN ===
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    // Anda bisa menambahkan route lain seperti forgot password khusus admin di sini jika perlu
});

// === RUTE ADMIN (Membutuhkan Login Admin) ===
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Perusahaan Mitra
    Route::resource('companies', CompanyController::class);

    // CRUD Lowongan Kerjasama
    Route::resource('vacancies', VacancyController::class);

    // CRUD Event/Loker Umum
    Route::resource('events', EventController::class);

    // Manajemen Data Mahasiswa (List, Show, Edit, Update, Destroy)
    Route::resource('students', StudentController::class)->except([
        'create',
        'store'
    ]);

    // Manajemen Status Pendaftaran
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::match(['put', 'patch'], 'applications/{application}/update-status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    // Route::delete('applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy'); // Opsional
});


// === RUTE MAHASISWA (Membutuhkan Login Mahasiswa/Umum) ===
// Middleware 'auth' saja cukup karena role mahasiswa adalah default/umum setelah login via Breeze
Route::middleware(['auth', 'mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () { 
    // Dashboard Mahasiswa
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');

    // Lihat Lowongan Magang Kerjasama
    Route::get('/lowongan', [MahasiswaVacancyController::class, 'index'])->name('vacancies.index');
    Route::get('/lowongan/{vacancy}', [MahasiswaVacancyController::class, 'show'])->name('vacancies.show');
    Route::post('/lowongan/{vacancy}/apply', [MahasiswaVacancyController::class, 'apply'])->name('vacancies.apply'); // Proses pendaftaran

    // Lihat Event & Loker Umum
    Route::get('/event-loker', [MahasiswaEventController::class, 'index'])->name('events.index');
    Route::get('/event-loker/{event}', [MahasiswaEventController::class, 'show'])->name('events.show'); // Detail jika perlu

    // Lihat Status Pendaftaran Pribadi
    Route::get('/pendaftaran', [MahasiswaApplicationController::class, 'index'])->name('applications.index');
    Route::get('/pendaftaran/{application}', [MahasiswaApplicationController::class, 'show'])->name('applications.show'); // Pastikan hanya bisa lihat milik sendiri
    Route::delete('/pendaftaran/{application}', [MahasiswaApplicationController::class, 'cancel'])->name('applications.cancel'); // Opsi batal daftar

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Ini untuk hapus akun, kita biarkan dulu
    });
});

// === RUTE PERUSAHAAN MITRA (Nanti Dibuat) ===
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use App\Http\Controllers\Company\VacancyController as CompanyVacancyController;
use App\Http\Controllers\Company\ApplicantController;

// --- Rute Autentikasi Perusahaan Mitra ---
Route::prefix('perusahaan')->name('company.')->group(function () {
    // Rute menampilkan form login perusahaan
    Route::get('/login', [CompanyLoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
    // Rute memproses login perusahaan
    Route::post('/login', [CompanyLoginController::class, 'login'])->middleware('guest');
    // Rute logout perusahaan (perlu middleware auth company nanti)
    Route::post('/logout', [CompanyLoginController::class, 'logout'])->middleware('auth')->name('logout');
});

// --- Rute Perusahaan Mitra ---
Route::middleware(['auth', 'company'])->prefix('perusahaan')->name('company.')->group(function () {

    // Dashboard Perusahaan
    Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
    Route::resource('lowongan', CompanyVacancyController::class)->parameters(['lowongan' => 'vacancy'])->names('vacancies');

    // Rute untuk Melihat & Mengelola Pendaftar
    Route::get('pendaftar', [ApplicantController::class, 'index'])->name('applicants.index');
    // Rute untuk detail pendaftar (Application model)
    Route::get('pendaftar/{application}', [ApplicantController::class, 'show'])->name('applicants.show');
    // Rute untuk update status oleh perusahaan
    Route::match(['put', 'patch'], 'pendaftar/{application}/update-status', [ApplicantController::class, 'updateStatus'])->name('applicants.updateStatus');

    // Rute untuk Upload Sertifikat
    Route::post('pendaftar/{application}/upload-sertifikat', [ApplicantController::class, 'uploadCertificate'])->name('applicants.uploadCertificate');
    // Rute untuk Hapus Sertifikat
    Route::delete('pendaftar/{application}/remove-sertifikat', [ApplicantController::class, 'removeCertificate'])->name('applicants.removeCertificate');
});



require __DIR__ . '/auth.php';
