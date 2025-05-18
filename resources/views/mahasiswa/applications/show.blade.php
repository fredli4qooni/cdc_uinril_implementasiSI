{{-- resources/views/mahasiswa/applications/show.blade.php --}}
@extends('layouts.student')

@section('title', 'Detail Pendaftaran Lowongan')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header with Back Button -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0 tracking-tight">
                Detail Pendaftaran
            </h2>
            <a href="{{ route('mahasiswa.applications.index') }}"
                class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 hover:shadow-md transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Riwayat Pendaftaran
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl border border-gray-100">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center">
                        <div class="p-3 bg-white/20 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold text-white">
                                {{ $application->vacancy->title ?? 'Lowongan Tidak Ditemukan' }}
                            </h5>
                            <p class="text-blue-100 mt-1">
                                {{ $application->vacancy->company->name ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                    
                    @php
                        $status = $application->status;
                        $badgeClass = 'bg-gray-100 text-gray-800'; // Default
                        
                        if ($status == 'pending') {
                            $badgeClass = 'bg-yellow-100 text-yellow-800 border border-yellow-200';
                            $statusIcon = '<svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                        } elseif ($status == 'accepted' || $status == 'approved') {
                            $badgeClass = 'bg-green-100 text-green-800 border border-green-200';
                            $statusIcon = '<svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                        } elseif ($status == 'rejected' || $status == 'cancelled') {
                            $badgeClass = 'bg-red-100 text-red-800 border border-red-200';
                            $statusIcon = '<svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                        } elseif ($status == 'processing') {
                            $badgeClass = 'bg-blue-100 text-blue-800 border border-blue-200';
                            $statusIcon = '<svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>';
                        } else {
                            $statusIcon = '<svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                        }
                    @endphp
                    
                    <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full shadow-sm {{ $badgeClass }}">
                        {!! $statusIcon !!}
                        Status: {{ ucfirst($status) }}
                    </span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Application Details Column -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 shadow-sm">
                        <div class="flex items-center mb-4">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h6 class="text-lg font-semibold text-gray-800">Detail Lamaran</h6>
                        </div>
                        
                        <hr class="my-4 border-gray-200">
                        
                                                <dl class="space-y-4">
                            <div class="flex flex-col sm:flex-row">
                                <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Tanggal Daftar</dt>
                                <dd class="sm:w-2/3 text-gray-800 font-medium flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $application->application_date->format('l, d F Y, H:i') }}
                                </dd>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row">
                                <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Status</dt>
                                <dd class="sm:w-2/3">
                                    <span class="font-medium {{ str_contains($badgeClass, 'red') ? 'text-red-600' : (str_contains($badgeClass, 'green') ? 'text-green-600' : (str_contains($badgeClass, 'yellow') ? 'text-yellow-600' : 'text-blue-600')) }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </dd>
                            </div>
                            
                            @if ($application->admin_notes)
                                <div class="flex flex-col sm:flex-row">
                                    <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Catatan Admin CDC</dt>
                                    <dd class="sm:w-2/3">
                                        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 text-sm italic text-gray-700">
                                            "{{ $application->admin_notes }}"
                                        </div>
                                    </dd>
                                </div>
                            @endif
                            
                            @if ($application->company_notes)
                                <div class="flex flex-col sm:flex-row">
                                    <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Catatan Perusahaan</dt>
                                    <dd class="sm:w-2/3">
                                        <div class="bg-indigo-50 border-l-4 border-indigo-500 rounded-lg p-4 text-sm italic text-gray-700">
                                            "{{ $application->company_notes }}"
                                        </div>
                                    </dd>
                                </div>
                            @endif
                            
                            @if($application->certificate_path && Storage::disk('public')->exists($application->certificate_path))
                                <div class="flex flex-col sm:flex-row">
                                    <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Sertifikat Magang</dt>
                                    <dd class="sm:w-2/3">
                                        <a href="{{ Storage::url($application->certificate_path) }}" target="_blank" 
                                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Download Sertifikat
                                        </a>
                                        <p class="text-xs text-gray-600 mt-2">
                                            Diterbitkan pada: {{ $application->certificate_issued_at ? $application->certificate_issued_at->format('d F Y') : 'N/A' }}
                                        </p>
                                    </dd>
                                </div>
                            @elseif($application->status == 'completed')
                                <div class="flex flex-col sm:flex-row">
                                    <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Sertifikat Magang</dt>
                                    <dd class="sm:w-2/3">
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-blue-500 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Sertifikat Anda sedang diproses atau belum diunggah oleh perusahaan.
                                        </div>
                                    </dd>
                                </div>
                            @endif
                        </dl>

                        @if ($application->status == 'pending')
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <form action="{{ route('mahasiswa.applications.cancel', $application->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin membatalkan pendaftaran ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Batalkan Pendaftaran
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- Vacancy Details Column -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 shadow-sm">
                        <div class="flex items-center mb-4">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <h6 class="text-lg font-semibold text-gray-800">Informasi Lowongan</h6>
                        </div>
                        
                        <hr class="my-4 border-gray-200">
                        
                        @if ($application->vacancy)
                            <dl class="space-y-4">
                                <div class="flex flex-col sm:flex-row">
                                    <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Posisi</dt>
                                    <dd class="sm:w-2/3 text-gray-800 font-medium">{{ $application->vacancy->title }}</dd>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row">
                                    <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Perusahaan</dt>
                                    <dd class="sm:w-2/3 text-gray-800 flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        {{ $application->vacancy->company->name ?? 'N/A' }}
                                    </dd>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row">
                                    <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Lokasi</dt>
                                    <dd class="sm:w-2/3 text-gray-800 flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $application->vacancy->location ?? '-' }}
                                    </dd>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row">
                                    <dt class="text-sm font-medium text-gray-500 mb-1 sm:mb-0 sm:w-1/3">Deadline</dt>
                                    <dd class="sm:w-2/3 text-gray-800 flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $application->vacancy->deadline ? $application->vacancy->deadline->format('d M Y') : 'Tidak Ditentukan' }}
                                    </dd>
                                </div>
                                
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500 mb-2">Deskripsi</dt>
                                    <dd class="bg-white rounded-lg p-4 text-gray-700 text-sm border border-gray-200">
                                        {{ Str::limit($application->vacancy->description, 150) }}
                                    </dd>
                                </div>
                            </dl>
                            
                            @if ($application->vacancy->status == 'open' && $application->vacancy->type == 'kerjasama')
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <a href="{{ route('mahasiswa.vacancies.show', $application->vacancy_id) }}"
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Detail Lowongan
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            Informasi lowongan tidak ditemukan (mungkin telah dihapus).
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Timeline Footer (optional) -->
            @if($application->status != 'pending' && $application->status != 'cancelled')
            <div class="px-8 pb-8">
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <h6 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Status Timeline
                    </h6>
                    
                    <div class="relative">
                        <!-- Timeline line -->
                        <div class="absolute h-full w-0.5 bg-gray-200 left-2.5 top-0"></div>
                        
                        <!-- Timeline items -->
                        <div class="ml-10">
                            <!-- Pending status -->
                            <div class="relative pb-8">
                                <div class="absolute -left-8 mt-1.5">
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-500 ring-4 ring-white">
                                        <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="flex flex-col sm:flex-row">
                                    <div class="mb-2 sm:mb-0 sm:w-1/4">
                                        <div class="text-sm font-medium text-indigo-600">
                                            {{ $application->application_date->format('d M Y, H:i') }}
                                        </div>
                                    </div>
                                    <div class="sm:w-3/4">
                                        <h3 class="text-lg font-semibold text-gray-900">Pendaftaran Diterima</h3>
                                        <p class="mt-1 text-sm text-gray-500">Pendaftaran Anda telah diterima oleh sistem dan menunggu verifikasi.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Processing status (if applicable) -->
                            @if(in_array($application->status, ['processing', 'approved', 'accepted', 'rejected']))
                            <div class="relative pb-8">
                                <div class="absolute -left-8 mt-1.5">
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-500 ring-4 ring-white">
                                        <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="flex flex-col sm:flex-row">
                                    <div class="mb-2 sm:mb-0 sm:w-1/4">
                                        <div class="text-sm font-medium text-indigo-600">
                                            {{ \Carbon\Carbon::parse($application->application_date)->addDays(1)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="sm:w-3/4">
                                        <h3 class="text-lg font-semibold text-gray-900">Diproses</h3>
                                        <p class="mt-1 text-sm text-gray-500">Pendaftaran Anda sedang diproses oleh Admin CDC.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Final status -->
                            @if(in_array($application->status, ['approved', 'accepted', 'rejected']))
                            <div class="relative">
                                <div class="absolute -left-8 mt-1.5">
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full {{ $application->status == 'rejected' ? 'bg-red-500' : 'bg-green-500' }} ring-4 ring-white">
                                        <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="flex flex-col sm:flex-row">
                                    <div class="mb-2 sm:mb-0 sm:w-1/4">
                                        <div class="text-sm font-medium text-indigo-600">
                                            {{ \Carbon\Carbon::parse($application->application_date)->addDays(3)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="sm:w-3/4">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            @if($application->status == 'approved' || $application->status == 'accepted')
                                                Pendaftaran Diterima
                                            @else
                                                Pendaftaran Ditolak
                                            @endif
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            @if($application->status == 'approved' || $application->status == 'accepted')
                                                Selamat! Pendaftaran Anda telah diterima.
                                            @else
                                                Maaf, pendaftaran Anda tidak dapat diterima saat ini.
                                            @endif
                                            
                                            @if($application->admin_notes || $application->company_notes)
                                                Silakan periksa catatan untuk informasi lebih lanjut.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection