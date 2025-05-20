@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="container mx-auto">
    <!-- Welcome Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-500 mt-1">Berikut ringkasan data pada sistem CDC UIN RIL</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Card: Total Mahasiswa -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md hover:translate-y-px">
            <div class="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-indigo-600">Total Mahasiswa</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $mahasiswaCount ?? 0 }}</h2>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-full">
                        <i class="fas fa-users text-xl text-indigo-500"></i>
                    </div>
                </div>
                <div class="mt-4 border-t border-gray-100 pt-3">
                    <a href="{{ route('admin.students.index') }}" class="flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card: Perusahaan Mitra -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md hover:translate-y-px">
            <div class="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-emerald-600">Perusahaan Mitra</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $companyCount ?? 0 }}</h2>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-full">
                        <i class="fas fa-building text-xl text-emerald-500"></i>
                    </div>
                </div>
                <div class="mt-4 border-t border-gray-100 pt-3">
                    <a href="{{ route('admin.companies.index') }}" class="flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-800">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card: Lowongan Kerjasama -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md hover:translate-y-px">
            <div class="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-blue-600">Lowongan Aktif</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $activeVacancyCount ?? 0 }}</h2>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-full">
                        <i class="fas fa-briefcase text-xl text-blue-500"></i>
                    </div>
                </div>
                <div class="mt-4 border-t border-gray-100 pt-3">
                    <a href="{{ route('admin.vacancies.index') }}" class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card: Total Pendaftar -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md hover:translate-y-px">
            <div class="p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-amber-600">Total Pendaftar</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $applicationCount ?? 0 }}</h2>
                    </div>
                    <div class="p-3 bg-amber-50 rounded-full">
                        <i class="fas fa-file-signature text-xl text-amber-500"></i>
                    </div>
                </div>
                <div class="mt-4 border-t border-gray-100 pt-3">
                    <a href="{{ route('admin.applications.index') }}" class="flex items-center text-sm font-medium text-amber-600 hover:text-amber-800">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <!-- Quick Actions Section -->
    <div class="mt-8 mb-6">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Aksi Cepat</h3>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    <!-- Quick Action Button -->
                    <a href="{{ route('admin.students.index') }}" class="flex flex-col items-center justify-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-user-plus text-indigo-500"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Tambah Mahasiswa</span>
                    </a>

                    <!-- Quick Action Button -->
                    <a href="{{ route('admin.companies.index') }}" class="flex flex-col items-center justify-center p-4 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-building text-emerald-500"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Tambah Perusahaan</span>
                    </a>

                    <!-- Quick Action Button -->
                    <a href="{{ route('admin.vacancies.index') }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-briefcase text-blue-500"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Buat Lowongan</span>
                    </a>

                    <!-- Quick Action Button -->
                    <a href="{{ route('admin.events.index') }}" class="flex flex-col items-center justify-center p-4 bg-amber-50 rounded-lg hover:bg-amber-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-calendar-alt text-amber-500"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Buat Event</span>
                    </a>

                    <!-- Quick Action Button -->
                    <a href="{{ route('admin.applications.index') }}" class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-tasks text-purple-500"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Kelola Pendaftaran</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection