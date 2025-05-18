{{-- resources/views/mahasiswa/dashboard.blade.php --}}
@extends('layouts.student')

@section('title', 'Dashboard Mahasiswa')

@push('styles')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Libre+Baskerville:wght@400;700&display=swap">
<style>
    /* Base styling and typography */
    body {
        font-family: 'Libre Baskerville', Georgia, serif;
        background-color: #f8f3e9;
        color: #2c2418;
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Playfair Display', 'Times New Roman', serif;
    }
    
    /* Vintage paper texture */
    .vintage-paper {
        background-color: #f4efe1;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23e0d7bc' fill-opacity='0.2' fill-rule='evenodd'/%3E%3C/svg%3E");
        box-shadow: 0 4px 6px -1px rgba(97, 70, 53, 0.1), 0 2px 4px -1px rgba(97, 70, 53, 0.06);
    }
    
    /* Card styling */
    .vintage-card {
        transition: all 0.5s ease;
        box-shadow: 2px 4px 16px rgba(97, 70, 53, 0.15);
        border: 1px solid #d9ceb0;
        overflow: hidden;
    }
    
    .vintage-card:hover {
        transform: translateY(-8px) rotate(0.5deg);
        box-shadow: 4px 12px 24px rgba(97, 70, 53, 0.2);
    }
    
    /* Header designs */
    .vintage-header {
        position: relative;
        overflow: hidden;
    }
    
    .vintage-header:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: repeating-linear-gradient(90deg, #8b5a2b, #8b5a2b 10px, transparent 10px, transparent 20px);
    }
    
    .vintage-header:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: repeating-linear-gradient(90deg, #8b5a2b, #8b5a2b 10px, transparent 10px, transparent 20px);
    }
    
    /* Vintage buttons */
    .vintage-button {
        font-family: 'Playfair Display', 'Times New Roman', serif;
        position: relative;
        transition: all 0.3s ease;
        border: 2px solid currentColor;
        box-shadow: 2px 2px 0 rgba(0, 0, 0, 0.2);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .vintage-button:hover {
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0 rgba(0, 0, 0, 0.2);
    }
    
    .vintage-button:active {
        transform: translate(0px, 0px);
        box-shadow: 0px 0px 0 rgba(0, 0, 0, 0.2);
    }
    
    /* Progress bar */
    .vintage-progress {
        height: 8px;
        border: 1px solid #8b5a2b;
        padding: 1px;
        background: #f4efe1;
    }
    
    .vintage-progress-bar {
        height: 4px;
        background: repeating-linear-gradient(45deg, #8b5a2b, #8b5a2b 10px, #a67c52 10px, #a67c52 20px);
    }
    
    /* List separators */
    .vintage-divider {
        border-bottom: 1px solid #d9ceb0;
        position: relative;
    }
    
    .vintage-divider:after {
        content: "✦";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: #f4efe1;
        padding: 0 10px;
        color: #8b5a2b;
        font-size: 12px;
    }
    
    /* Typewriter effect for hover */
    @keyframes typewriter {
        from {width: 0;}
        to {width: 100%;}
    }
    
    .typewriter-hover:hover .typewriter-text {
        overflow: hidden;
        white-space: nowrap;
        animation: typewriter 1.5s steps(40, end);
        border-right: 2px solid #8b5a2b;
    }
    
    /* Page flip animation */
    @keyframes pageFlip {
        0% {transform: rotateY(0deg);}
        50% {transform: rotateY(15deg);}
        100% {transform: rotateY(0deg);}
    }
    
    .page-flip:hover {
        animation: pageFlip 1s ease;
        transform-origin: left center;
    }
    
    /* Decorative corners */
    .vintage-corner {
        position: relative;
    }
    
    .vintage-corner:before {
        content: "❦";
        position: absolute;
        top: -5px;
        left: -5px;
        color: #8b5a2b;
        font-size: 20px;
        transform: rotate(-45deg);
    }
    
    .vintage-corner:after {
        content: "❦";
        position: absolute;
        bottom: -5px;
        right: -5px;
        color: #8b5a2b;
        font-size: 20px;
        transform: rotate(135deg);
    }
    
    /* Status pills */
    .vintage-status {
        border: 1px solid currentColor;
        font-family: 'Libre Baskerville', serif;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
    }
</style>
@endpush

@section('content')
<div class="bg-[#f8f3e9] min-h-screen py-10">
    <div class="container mx-auto px-4 py-8">
        <!-- Vintage Header with decorative elements -->
        <div class="text-center mb-12 vintage-header py-4">
            <div class="flex justify-center mb-2">
                <div class="h-1 w-32 bg-[#8b5a2b]"></div>
            </div>
            <h2 class="text-4xl font-bold text-[#2c2418] italic">Selamat Datang</h2>
            <p class="text-sm tracking-widest text-[#5c4d3c] uppercase mt-1">Internship & Employment Gazette</p>
            <div class="flex justify-center mt-2">
                <div class="h-1 w-32 bg-[#8b5a2b]"></div>
            </div>
            <div class="text-xs text-[#5c4d3c] mt-2">EDISI NO. {{ now()->format('Y') }}-{{ now()->format('m') }}</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Profile & Applications Summary -->
            <div class="lg:col-span-7">
                <!-- Profile Card -->
                <div class="vintage-card vintage-paper rounded-none mb-8 vintage-corner">
                    <div class="px-6 py-4 bg-[#8b5a2b] text-[#f4efe1] flex justify-between items-center">
                        <h3 class="font-medium flex items-center text-lg tracking-wide">
                            <i class="fas fa-user-circle mr-2"></i> DOKUMEN PRIBADI
                        </h3>
                        <a href="{{ route('mahasiswa.profile.edit') }}" class="vintage-button bg-[#f4efe1] text-[#8b5a2b] hover:bg-[#e0d7bc] px-3 py-1 text-xs font-bold flex items-center">
                            <i class="fas fa-edit mr-1"></i> UBAH
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="h-20 w-20 rounded-full border-4 border-[#8b5a2b] bg-[#f4efe1] flex items-center justify-center text-[#8b5a2b] mr-5">
                                <i class="fas fa-user-graduate text-3xl"></i>
                            </div>
                            <div class="border-l-2 border-[#d9ceb0] pl-5">
                                <h4 class="text-2xl font-bold text-[#2c2418] font-serif">{{ $user->name }}</h4>
                                <p class="text-[#5c4d3c] italic">
                                    {{ $user->studentProfile->major ?? 'Department Unspecified' }} - Angkatan {{ $user->studentProfile->entry_year ?? '?' }}
                                </p>
                                <p class="text-[#8b5a2b] text-sm mt-1">
                                    NPM.: <span class="font-bold">{{ $user->studentProfile->nim ?? 'Unregistered' }}</span>
                                </p>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-[#5c4d3c]">Kelengkapan Dokumen</span>
                                <span class="text-sm font-medium {{ $isProfileComplete ? 'text-[#3a671a]' : 'text-[#a05b21]' }}">{{ $profileCompleteness }}%</span>
                            </div>
                            <div class="vintage-progress rounded-none">
                                <div class="vintage-progress-bar rounded-none" style="width: {{ $profileCompleteness }}%"></div>
                            </div>
                        </div>
                        
                        <div class="flex items-center typewriter-hover">
                            <div class="mr-3">
                                <i class="fas {{ $isCvUploaded ? 'fa-check-circle text-[#3a671a]' : 'fa-times-circle text-[#a05b21]' }} text-lg"></i>
                            </div>
                            <div class="typewriter-text">
                                <p class="text-[#5c4d3c]">
                                    Curriculum Vitae {{ $isCvUploaded ? 'Submitted for Review' : 'Awaiting Submission' }}
                                    @if($isCvUploaded && $user->studentProfile->cv_path)
                                        <a href="{{ Storage::url($user->studentProfile->cv_path) }}" target="_blank" class="text-[#8b5a2b] hover:underline ml-1 italic">
                                            (Examine Document)
                                        </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Applications Summary Card -->
                <div class="vintage-card vintage-paper rounded-none page-flip">
                    <div class="px-6 py-4 bg-[#3a671a] text-[#f4efe1]">
                        <h3 class="font-medium flex items-center text-lg tracking-wide">
                            <i class="fas fa-file-alt mr-2"></i> RIWAYAT LAMARAN MAGANG ({{ $totalApplications }} Total)
                        </h3>
                    </div>
                    
                    @if($totalApplications > 0)
                        <div class="divide-y divide-[#d9ceb0]">
                            @foreach($applicationStatusSummary as $status => $count)
                                @if($count > 0)
                                <div class="flex items-center justify-between px-6 py-5 hover:bg-[#f0e9d8] transition-colors duration-300">
                                    <div class="flex items-center">
                                        @php 
                                            $statusIcon = match($status) {
                                                'pending' => 'fa-hourglass-half',
                                                'accepted' => 'fa-check-double',
                                                'rejected' => 'fa-times',
                                                'interviewed' => 'fa-comments',
                                                'offered' => 'fa-handshake',
                                                default => 'fa-question'
                                            };
                                            
                                            $statusColor = match($status) {
                                                'pending' => 'text-[#a05b21]',
                                                'accepted' => 'text-[#3a671a]',
                                                'rejected' => 'text-[#8b1a1a]',
                                                'interviewed' => 'text-[#1a4d8b]',
                                                'offered' => 'text-[#5d3a87]',
                                                default => 'text-[#5c4d3c]'
                                            };
                                        @endphp
                                        <i class="fas {{ $statusIcon }} {{ $statusColor }} mr-3 text-lg"></i>
                                        <span class="text-[#2c2418] font-serif">{{ ucfirst($status) }}</span>
                                    </div>
                                    <span class="vintage-status px-3 py-1 rounded-none {{ $statusColor }}">{{ $count }}</span>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="px-6 py-5 bg-[#f0e9d8] text-center">
                            <a href="{{ route('mahasiswa.applications.index') }}" class="vintage-button inline-flex items-center px-5 py-2 bg-[#3a671a] text-[#f4efe1] hover:bg-[#2a5710] transition-colors duration-300 text-xs">
                                LIHAT RIWAYAT LENGKAP
                            </a>
                        </div>
                    @else
                        <div class="px-6 py-12 text-center">
                            <div class="mx-auto h-24 w-24 text-[#d9ceb0] mb-4">
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="mt-2 text-lg font-serif font-medium text-[#2c2418]">No Applications Filed</h3>
                            <p class="mt-2 text-[#5c4d3c] italic">You have yet to submit applications for internship positions.</p>
                            <div class="mt-6">
                                <a href="{{ route('mahasiswa.vacancies.index') }}" class="vintage-button inline-flex items-center px-5 py-2 bg-[#3a671a] text-[#f4efe1] hover:bg-[#2a5710] transition-colors duration-300 text-xs">
                                    PERUSE AVAILABLE POSITIONS
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Latest Opportunities -->
            <div class="lg:col-span-5">
                <!-- Latest Internships Card -->
                <div class="vintage-card vintage-paper rounded-none mb-8 page-flip">
                    <div class="px-6 py-4 bg-[#5d3a87] text-[#f4efe1]">
                        <h3 class="font-medium flex items-center text-lg tracking-wide">
                            <i class="fas fa-briefcase mr-2"></i> LOWONGAN MAGANG TERBARU
                        </h3>
                    </div>
                    
                    @if($latestVacancies->isNotEmpty())
                        <div class="divide-y divide-[#d9ceb0]">
                            @foreach($latestVacancies as $vacancy)
                                <a href="{{ route('mahasiswa.vacancies.show', $vacancy->id) }}" class="block hover:bg-[#f0e9d8] transition-colors duration-300 typewriter-hover">
                                    <div class="px-6 py-5">
                                        <div class="flex justify-between items-start">
                                            <h4 class="typewriter-text text-lg font-medium text-[#2c2418] mb-2 font-serif">{{ $vacancy->title }}</h4>
                                            <span class="text-xs text-[#8b5a2b] italic">{{ $vacancy->created_at->diffForHumans(null, true) }}</span>
                                        </div>
                                        <div class="text-sm text-[#5c4d3c]">
                                            <div class="flex items-center mt-2">
                                                <i class="fas fa-building text-[#8b5a2b] mr-2"></i>
                                                <span class="font-serif">{{ $vacancy->company->name ?? 'Unspecified' }}</span>
                                                <span class="mx-3 text-[#d9ceb0]">•</span>
                                                <i class="fas fa-map-marker-alt text-[#8b5a2b] mr-2"></i>
                                                <span class="font-serif">{{ $vacancy->location ?? 'Unspecified' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="px-6 py-5 bg-[#f0e9d8] text-center">
                            <a href="{{ route('mahasiswa.vacancies.index') }}" class="vintage-button inline-flex items-center px-5 py-2 bg-[#5d3a87] text-[#f4efe1] hover:bg-[#4d2a77] transition-colors duration-300 text-xs">
                                LIHAT SEMUA LOWONGAN
                            </a>
                        </div>
                    @else
                        <div class="px-6 py-12 text-center">
                            <div class="mx-auto h-24 w-24 text-[#d9ceb0] mb-4">
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="mt-2 text-lg font-serif font-medium text-[#2c2418]">No Current Vacancies</h3>
                            <p class="mt-2 text-[#5c4d3c] italic">Presently there are no internship positions advertised.</p>
                        </div>
                    @endif
                </div>

                <!-- Events & Jobs Card -->
                <div class="vintage-card vintage-paper rounded-none page-flip">
                    <div class="px-6 py-4 bg-[#1a4d8b] text-[#f4efe1]">
                        <h3 class="font-medium flex items-center text-lg tracking-wide">
                            <i class="fas fa-calendar-alt mr-2"></i>  PENGUMUMAN EVENT & LOKER
                        </h3>
                    </div>
                    
                    @if($latestEvents->isNotEmpty())
                        <div class="divide-y divide-[#d9ceb0]">
                            @foreach($latestEvents as $event)
                                <a href="{{ route('mahasiswa.events.show', $event->id) }}" class="block hover:bg-[#f0e9d8] transition-colors duration-300 typewriter-hover">
                                    <div class="px-6 py-5">
                                        <div class="flex justify-between items-start">
                                            <h4 class="typewriter-text text-lg font-medium text-[#2c2418] mb-2 font-serif">{{ $event->title }}</h4>
                                            <span class="text-xs text-[#8b5a2b] italic">{{ $event->created_at->diffForHumans(null, true) }}</span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="vintage-status inline-flex items-center px-3 py-1 rounded-none {{ $event->type == 'event' ? 'text-[#1a4d8b]' : 'text-[#a05b21]' }}">
                                                {{ $event->type == 'event' ? 'GATHERING' : 'EMPLOYMENT' }}
                                            </span>
                                            <span class="text-sm text-[#5c4d3c] ml-3 italic">
                                                @if($event->start_datetime)
                                                    <i class="fas fa-calendar-day text-[#8b5a2b] mr-2"></i> {{ $event->start_datetime->format('d M Y') }}
                                                @elseif($event->location)
                                                    <i class="fas fa-map-marker-alt text-[#8b5a2b] mr-2"></i> {{ $event->location }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="px-6 py-5 bg-[#f0e9d8] text-center">
                            <a href="{{ route('mahasiswa.events.index') }}" class="vintage-button inline-flex items-center px-5 py-2 bg-[#1a4d8b] text-[#f4efe1] hover:bg-[#0a3d7b] transition-colors duration-300 text-xs">
                                LIHAT SEMUA PENGUMUMAN
                            </a>
                        </div>
                    @else
                        <div class="px-6 py-12 text-center">
                            <div class="mx-auto h-24 w-24 text-[#d9ceb0] mb-4">
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="mt-2 text-lg font-serif font-medium text-[#2c2418]">No Current Notices</h3>
                            <p class="mt-2 text-[#5c4d3c] italic">Presently there are no gatherings or employment notices advertised.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Vintage Footer -->
        <div class="text-center mt-12 pt-8 border-t border-[#d9ceb0]">
            <p class="text-xs text-[#8b5a2b] uppercase tracking-widest">CDC UIN Raden Intan • {{ now()->format('F d, Y') }} Edition</p>
            <div class="flex justify-center mt-3">
                <svg class="h-6 w-6 text-[#8b5a2b]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l2.4 7.4h7.6l-6 4.6 2.3 7-6.3-4.6-6.3 4.6 2.3-7-6-4.6h7.6z"/>
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection