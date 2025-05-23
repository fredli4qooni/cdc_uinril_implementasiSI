<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller Autentikasi Admin
use App\Http\Controllers\Auth\AdminLoginController;

// Controller Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; 
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
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController; // <-- IMPORT INI

// === RUTE PERUSAHAAN MITRA  ===
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use App\Http\Controllers\Company\VacancyController as CompanyVacancyController;
use App\Http\Controllers\Company\ApplicantController;


// --- RUTE HALAMAN PUBLIK ---
Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('public.about');
Route::get('/kontak-kami', [HomeController::class, 'contact'])->name('public.contact');
Route::get('/untuk-perusahaan', [HomeController::class, 'forCompanies'])->name('public.forCompanies');
Route::get('/lowongan', [HomeController::class, 'publicVacancies'])->name('public.vacancies.index');
Route::get('/event-loker', [HomeController::class, 'publicEvents'])->name('public.events.index');

// === RUTE AUTENTIKASI ADMIN ===
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
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
Route::middleware(['auth', 'mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () { 
    // Dashboard Mahasiswa
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');

    // Lihat Lowongan Magang Kerjasama
    
    //Route::get('/lowongan', [MahasiswaVacancyController::class, 'index'])->name('vacancies.index');
    Route::get('/lowongan/{vacancy}', [MahasiswaVacancyController::class, 'show'])->name('vacancies.show');
    Route::post('/lowongan/{vacancy}/apply', [MahasiswaVacancyController::class, 'apply'])->name('vacancies.apply'); // Proses pendaftaran

    // Lihat Event & Loker Umum
    //Route::get('/event-loker', [MahasiswaEventController::class, 'index'])->name('events.index');
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
