@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="container px-4 mx-auto">
    <h1 class="mt-4 mb-4 text-2xl font-semibold">Selamat Datang, {{ Auth::user()->name }}!</h1>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        {{-- Kartu Mahasiswa --}}
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-4 py-5 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold tracking-wide text-blue-500 uppercase mb-1">
                            Total Mahasiswa
                        </div>
                        <div class="text-xl font-bold text-gray-800">
                            {{ $mahasiswaCount ?? 0 }}
                        </div>
                    </div>
                    <div>
                        <i class="text-2xl text-gray-300 fas fa-users"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.students.index') }}" class="block">
                <div class="px-4 py-2 text-sm text-right text-blue-500 transition-colors duration-150 border-t border-transparent hover:bg-gray-100">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </div>
            </a>
        </div>

        {{-- Kartu Perusahaan Mitra --}}
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-4 py-5 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold tracking-wide text-green-500 uppercase mb-1">
                            Total Perusahaan Mitra
                        </div>
                        <div class="text-xl font-bold text-gray-800">
                            {{ $companyCount ?? 0 }}
                        </div>
                    </div>
                    <div>
                        <i class="text-2xl text-gray-300 fas fa-building"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.companies.index') }}" class="block">
                <div class="px-4 py-2 text-sm text-right text-green-500 transition-colors duration-150 border-t border-transparent hover:bg-gray-100">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </div>
            </a>
        </div>

        {{-- Kartu Lowongan Kerjasama Aktif --}}
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-4 py-5 border-l-4 border-cyan-500">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold tracking-wide text-cyan-500 uppercase mb-1">
                            Lowongan Kerjasama (Aktif)
                        </div>
                        <div class="text-xl font-bold text-gray-800">
                            {{ $activeVacancyCount ?? 0 }}
                        </div>
                    </div>
                    <div>
                        <i class="text-2xl text-gray-300 fas fa-briefcase"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.vacancies.index') }}" class="block">
                <div class="px-4 py-2 text-sm text-right text-cyan-500 transition-colors duration-150 border-t border-transparent hover:bg-gray-100">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </div>
            </a>
        </div>

        {{-- Kartu Total Pendaftar --}}
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-4 py-5 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold tracking-wide text-yellow-500 uppercase mb-1">
                            Total Pendaftar (Magang)
                        </div>
                        <div class="text-xl font-bold text-gray-800">
                            {{ $applicationCount ?? 0 }}
                        </div>
                    </div>
                    <div>
                        <i class="text-2xl text-gray-300 fas fa-file-signature"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.applications.index') }}" class="block">
                <div class="px-4 py-2 text-sm text-right text-yellow-500 transition-colors duration-150 border-t border-transparent hover:bg-gray-100">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </div>
            </a>
        </div>
    </div>

    {{-- Konten Lain (misalnya grafik atau tabel ringkasan aktivitas terbaru) --}}
    <div class="mt-4">
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-4 py-3 border-b border-gray-200">
                <h6 class="m-0 font-bold text-blue-500">Ringkasan Aktivitas</h6>
            </div>
            <div class="p-4">
                <p>Area ini dapat digunakan untuk menampilkan grafik atau ringkasan aktivitas terbaru dalam sistem (membutuhkan implementasi logging aktivitas).</p>
            </div>
        </div>
    </div>
</div>
@endsection