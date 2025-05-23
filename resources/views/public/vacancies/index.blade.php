{{-- resources/views/public/vacancies/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Lowongan Magang')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 overflow-hidden">
    <div class="absolute inset-0 bg-white/60"></div>
    <div class="absolute top-0 left-0 w-full h-full">
        <div class="absolute top-10 left-10 w-32 h-32 bg-emerald-200/30 rounded-full blur-xl"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-cyan-200/30 rounded-full blur-xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-60 h-60 bg-teal-200/20 rounded-full blur-2xl"></div>
    </div>
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
            Peluang 
            <span class="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                Magang
            </span>
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Temukan kesempatan magang di berbagai perusahaan mitra kami dan mulai perjalanan karir profesional Anda
        </p>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search & Filter Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-12 border border-gray-100">
            <form action="{{ route('public.vacancies.index') }}" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                    <!-- Search Input -->
                    <div class="md:col-span-7">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                            Cari Lowongan Magang
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 bg-gray-50 focus:bg-white" 
                                id="search" 
                                name="search" 
                                placeholder="Cari berdasarkan posisi, perusahaan, atau lokasi..." 
                                value="{{ request('search') }}"
                            >
                        </div>
                    </div>
                    
                    <!-- Type Filter -->
                    <div class="md:col-span-2">
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jenis
                        </label>
                        <select 
                            name="type" 
                            id="type" 
                            class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                        >
                            <option value="kerjasama" {{ request('type', 'kerjasama') == 'kerjasama' ? 'selected' : '' }}>Magang Kerjasama</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="md:col-span-3 space-y-2">
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"
                        >
                            <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari
                        </button>
                        @if(request()->hasAny(['search', 'type']))
                            <a 
                                href="{{ route('public.vacancies.index') }}" 
                                class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-all duration-200"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Vacancies Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse ($vacancies as $vacancy)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
                    <!-- Company Logo -->
                    <div class="relative h-32 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                        @if($vacancy->company->logo_path && Storage::disk('public')->exists($vacancy->company->logo_path))
                            <img 
                                src="{{ Storage::url($vacancy->company->logo_path) }}" 
                                class="max-h-16 w-auto object-contain group-hover:scale-110 transition-transform duration-300" 
                                alt="{{ $vacancy->company->name }} Logo"
                            >
                        @else
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                Magang Kerjasama
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col h-auto">
                        <!-- Job Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-600 transition-colors duration-200">
                            {{ Str::limit($vacancy->title, 50) }}
                        </h3>
                        
                        <!-- Company Name -->
                        <div class="flex items-center mb-4">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="text-gray-600 font-medium">{{ $vacancy->company->name ?? 'N/A' }}</span>
                        </div>
                        
                        <!-- Job Details -->
                        <div class="space-y-2 mb-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $vacancy->location ?? 'N/A' }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Kuota: {{ $vacancy->slots }} orang
                            </div>
                            @if($vacancy->deadline)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-red-600 font-medium">Deadline: {{ $vacancy->deadline->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">
                            {{ Str::limit(strip_tags($vacancy->description), 100) }}
                        </p>

                        <!-- Action Button -->
                        <div class="mt-auto">
                            @guest
                                <a 
                                    href="{{ route('login', ['redirect' => route('mahasiswa.vacancies.show', $vacancy->id) ]) }}" 
                                    class="block w-full text-center bg-gradient-to-r from-gray-100 to-gray-200 hover:from-emerald-50 hover:to-teal-50 text-gray-700 hover:text-emerald-700 font-semibold py-3 px-4 rounded-xl transition-all duration-200 border border-gray-200"
                                >
                                    Login untuk Detail & Daftar
                                </a>
                            @else
                                <a 
                                    href="{{ route('mahasiswa.vacancies.show', $vacancy->id) }}" 
                                    class="block w-full text-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-md hover:shadow-lg"
                                >
                                    Lihat Detail & Daftar
                                </a>
                            @endguest
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <p class="text-xs text-gray-500">
                            Diposting: {{ $vacancy->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-12 text-center">
                        <div class="mx-auto w-24 h-24 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6m8 0V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-amber-800 mb-2">
                            @if(request()->filled('search') || (request()->filled('type') && request('type') != 'all'))
                                Tidak Ada Lowongan Ditemukan
                            @else
                                Belum Ada Lowongan Tersedia
                            @endif
                        </h3>
                        <p class="text-amber-700 max-w-md mx-auto">
                            @if(request()->filled('search') || (request()->filled('type') && request('type') != 'all'))
                                Lowongan tidak ditemukan sesuai kriteria pencarian yang Anda masukkan. Coba ubah kata kunci atau filter.
                            @else
                                Saat ini belum ada lowongan magang yang tersedia. Silakan kembali lagi nanti untuk melihat peluang terbaru.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($vacancies->hasPages())
            <div class="flex justify-center mt-12">
                <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                    {{ $vacancies->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Additional Styles for line-clamp -->
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

@endsection