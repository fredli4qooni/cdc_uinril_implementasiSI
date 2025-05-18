{{-- resources/views/company/dashboard.blade.php --}}
@extends('layouts.company')

@section('title', 'Dashboard Perusahaan')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<style>
    .scale-hover:hover {
        transform: scale(1.03);
    }
    
    .stat-card {
        @apply relative overflow-hidden transition-all duration-300 ease-in-out;
    }
    
    .stat-card:hover .stat-icon {
        @apply opacity-30;
    }

    @keyframes slideInBottom {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .slide-in-bottom {
        animation: slideInBottom 0.5s ease-out forwards;
    }

    .animation-delay-100 { animation-delay: 0.1s; }
    .animation-delay-200 { animation-delay: 0.2s; }
    .animation-delay-300 { animation-delay: 0.3s; }
    .animation-delay-400 { animation-delay: 0.4s; }
</style>
@endpush

@section('content')
<div class="container px-20 mx-auto py-10">
    <div class="flex flex-col md:flex-row items-center justify-between mb-6 animate__animated animate__fadeIn">
        <h2 class="text-2xl font-bold text-gray-800 mb-3 md:mb-0">
            <span class="inline-block border-b-4 border-teal-500 pb-1">Dashboard {{ $company->name }}</span>
        </h2>
        <a href="{{ route('company.vacancies.create') }}" 
           class="group flex items-center px-5 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1">
            <svg class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Buat Lowongan Baru
        </a>
    </div>

    @include('components.alert-dismissible')

    {{-- Baris Statistik Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="stat-card bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl shadow-xl slide-in-bottom animation-delay-100">
            <a href="{{ route('company.vacancies.index') }}" class="block p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-teal-100 text-sm font-medium uppercase tracking-wider mb-1">Total Lowongan</p>
                        <h5 class="text-4xl font-extrabold">{{ $totalVacancies ?? 0 }}</h5>
                    </div>
                    <div class="stat-icon opacity-20 transition-opacity duration-300">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <div class="stat-card bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-xl slide-in-bottom animation-delay-200">
            <a href="{{ route('company.vacancies.index', ['status' => 'open']) }}" class="block p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider mb-1">Lowongan Dibuka</p>
                        <h5 class="text-4xl font-extrabold">{{ $openVacanciesCount ?? 0 }}</h5>
                    </div>
                    <div class="stat-icon opacity-20 transition-opacity duration-300">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd"></path>
                            <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <div class="stat-card bg-gradient-to-br from-sky-500 to-sky-600 rounded-xl shadow-xl slide-in-bottom animation-delay-300">
            <a href="{{ route('company.applicants.index') }}" class="block p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sky-100 text-sm font-medium uppercase tracking-wider mb-1">Total Pendaftar</p>
                        <h5 class="text-4xl font-extrabold">{{ $totalApplicants ?? 0 }}</h5>
                    </div>
                    <div class="stat-icon opacity-20 transition-opacity duration-300">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <div class="stat-card bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-xl slide-in-bottom animation-delay-400">
            <a href="{{ route('company.applicants.index', ['status' => 'pending']) }}" class="block p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium uppercase tracking-wider mb-1">Pendaftar Pending</p>
                        <h5 class="text-4xl font-extrabold">{{ ($pendingApplicantsCount ?? 0) + ($reviewedApplicantsCount ?? 0) }}</h5>
                    </div>
                    <div class="stat-icon opacity-20 transition-opacity duration-300">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- Kolom Kiri: Pendaftar Terbaru Butuh Tindakan --}}
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl animate__animated animate__fadeInUp">
                <div class="border-b border-gray-100">
                    <div class="flex items-center p-5">
                        <div class="flex-shrink-0 bg-teal-100 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <h6 class="font-bold text-gray-700">Pendaftar Terbaru (Pending/Reviewed)</h6>
                    </div>
                </div>
                
                @if($recentPendingApplicants->isNotEmpty())
                    <div class="divide-y divide-gray-100">
                        @foreach($recentPendingApplicants as $applicant)
                            <a href="{{ route('company.applicants.show', $applicant->id) }}" 
                               class="block p-4 hover:bg-teal-50 transition-colors duration-200">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h6 class="font-semibold text-gray-800 mb-1">{{ $applicant->user->name ?? 'N/A' }}</h6>
                                        <p class="text-sm text-gray-600 mb-2">
                                            Melamar untuk: <span class="italic">{{ $applicant->vacancy->title ?? 'N/A' }}</span>
                                        </p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getStatusBadgeClass($applicant->status) }}">
                                            {{ ucfirst($applicant->status) }}
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs text-gray-500">{{ $applicant->application_date->diffForHumans(null, true) }}</span>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-teal-100 text-teal-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="bg-gray-50 p-4 text-center">
                        <a href="{{ route('company.applicants.index', ['status' => 'pending']) }}" 
                           class="inline-flex items-center text-sm font-medium text-teal-600 hover:text-teal-800 transition-colors duration-200">
                            Lihat Semua Pendaftar Pending/Reviewed
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-500 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500">Tidak ada pendaftar baru yang membutuhkan tindakan saat ini.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Kolom Kanan: Quick Links & Lowongan Saya --}}
        <div class="lg:col-span-5">
            {{-- Quick Links --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6 transition-all duration-300 hover:shadow-xl animate__animated animate__fadeInUp animate__delay-1s">
                <div class="border-b border-gray-100">
                    <div class="flex items-center p-5">
                        <div class="flex-shrink-0 bg-teal-100 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        </div>
                        <h6 class="font-bold text-gray-700">Akses Cepat</h6>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('company.vacancies.create') }}" 
                           class="group flex flex-col items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-teal-300 scale-hover transition-all duration-300">
                            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-green-100 text-green-600 mb-3 
                                        group-hover:bg-green-200 transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-800 group-hover:text-teal-700 transition-colors duration-300">Buat Lowongan</span>
                        </a>

                        <a href="{{ route('company.vacancies.index') }}" 
                           class="group flex flex-col items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-teal-300 scale-hover transition-all duration-300">
                            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-teal-100 text-teal-600 mb-3 
                                        group-hover:bg-teal-200 transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-800 group-hover:text-teal-700 transition-colors duration-300">Semua Lowongan</span>
                        </a>

                        <a href="{{ route('company.applicants.index') }}" 
                           class="group flex flex-col items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-teal-300 scale-hover transition-all duration-300">
                            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-sky-100 text-sky-600 mb-3 
                                        group-hover:bg-sky-200 transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-800 group-hover:text-teal-700 transition-colors duration-300">Semua Pendaftar</span>
                        </a>

                        <a href="{{ route('company.applicants.index', ['status' => 'accepted']) }}" 
                           class="group flex flex-col items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-teal-300 scale-hover transition-all duration-300">
                            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-amber-100 text-amber-600 mb-3 
                                        group-hover:bg-amber-200 transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-800 group-hover:text-teal-700 transition-colors duration-300">Pendaftar Diterima</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Lowongan Terbaru Saya --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl animate__animated animate__fadeInUp animate__delay-2s">
                <div class="border-b border-gray-100">
                    <div class="flex items-center p-5">
                        <div class="flex-shrink-0 bg-teal-100 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h6 class="font-bold text-gray-700">Lowongan Terbaru Anda</h6>
                    </div>
                </div>
                
                @if($latestCompanyVacancies->isNotEmpty())
                    <div class="divide-y divide-gray-100">
                        @foreach($latestCompanyVacancies as $vacancy)
                            <a href="{{ route('company.vacancies.edit', $vacancy->id) }}" 
                               class="block p-4 hover:bg-teal-50 transition-colors duration-200">
                                <div class="flex justify-between items-center">
                                    <h6 class="font-medium text-gray-800">{{ Str::limit($vacancy->title, 35) }}</h6>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getVacancyStatusBadgeClass($vacancy->status) }}">
                                        {{ ucfirst($vacancy->status) }}
                                    </span>
                                </div>
                                <div class="flex items-center mt-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Dibuat: {{ $vacancy->created_at->format('d M Y') }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-100 text-teal-500 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500">Anda belum membuat lowongan.</p>
                        <a href="{{ route('company.vacancies.create') }}" 
                           class="inline-flex items-center mt-4 text-sm font-medium text-teal-600 hover:text-teal-800 transition-colors duration-200">
                            Buat Lowongan Sekarang
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection