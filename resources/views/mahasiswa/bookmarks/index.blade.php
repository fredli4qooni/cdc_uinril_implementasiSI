{{-- resources/views/mahasiswa/bookmarks/index.blade.php --}}
@extends('layouts.app') {{-- Gunakan layout app terintegrasi --}}

@section('title', 'Lowongan Tersimpan Saya')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'fade-in': 'fadeIn 0.5s ease-in-out',
                    'slide-up': 'slideUp 0.6s ease-out',
                    'bounce-in': 'bounceIn 0.8s ease-out',
                    'pulse-slow': 'pulse 3s infinite',
                }
            }
        }
    }
</script>
<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .hover-lift:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(79, 70, 229, 0.25);
    }
    
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .glass-effect {
        backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.1);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <!-- Header Section dengan Gradient -->
    <div class="gradient-bg text-white py-16 mb-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row justify-between items-center animate-fade-in">
                <div class="text-center lg:text-left mb-6 lg:mb-0">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-white to-indigo-200">
                        Lowongan Tersimpan
                    </h1>
                    <p class="text-xl text-indigo-100 max-w-2xl">
                        Koleksi lowongan magang pilihan Anda yang telah disimpan untuk kemudahan akses
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('public.vacancies.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-xl text-white font-semibold transition-all duration-300 hover:scale-105 group">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari Lowongan Lain
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-12">
        {{-- Alert dengan Animasi --}}
        @if (session('status'))
            <div class="mb-8 animate-slide-up">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-indigo-500 rounded-r-lg p-4 shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-indigo-800 font-medium">{{ session('status') }}</p>
                        </div>
                        <button type="button" class="ml-auto text-indigo-400 hover:text-indigo-600 transition-colors duration-200" onclick="this.parentElement.parentElement.parentElement.remove()">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if($bookmarkedVacancies->isNotEmpty())
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 animate-slide-up">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-indigo-100 hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center">
                        <div class="p-3 bg-indigo-100 rounded-full">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Tersimpan</p>
                            <p class="text-2xl font-bold text-indigo-900">{{ $bookmarkedVacancies->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-purple-100 hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Perusahaan</p>
                            <p class="text-2xl font-bold text-purple-900">{{ $bookmarkedVacancies->unique('company_id')->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-green-100 hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Tersedia</p>
                            <p class="text-2xl font-bold text-green-900">{{ $bookmarkedVacancies->where('deadline', '>', now())->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vacancy Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach ($bookmarkedVacancies as $index => $vacancy)
                    <div class="hover-lift animate-slide-up bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group"
                         style="animation-delay: {{ $index * 0.1 }}s">
                        
                        <!-- Company Logo Section -->
                        <div class="relative h-32 bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center">
                            @if($vacancy->company->logo_path && Storage::disk('public')->exists($vacancy->company->logo_path))
                                <img src="{{ Storage::url($vacancy->company->logo_path) }}" 
                                     class="h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-110" 
                                     alt="{{ $vacancy->company->name }} Logo">
                            @else
                                <div class="p-4 bg-white rounded-full shadow-lg">
                                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Bookmark Badge -->
                            <div class="absolute top-3 right-3">
                                <div class="bg-indigo-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    Tersimpan
                                </div>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Title and Company -->
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition-colors duration-300">
                                    {{ Str::limit($vacancy->title, 50) }}
                                </h3>
                                <div class="flex items-center text-gray-600 mb-3">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    <span class="font-medium">{{ $vacancy->company->name ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <!-- Info Tags -->
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>{{ $vacancy->location ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span>Kuota: {{ $vacancy->slots }}</span>
                                </div>
                                
                                @if($vacancy->deadline)
                                    <div class="flex items-center text-sm {{ $vacancy->deadline->isPast() ? 'text-red-600' : 'text-gray-600' }}">
                                        <svg class="w-4 h-4 mr-2 {{ $vacancy->deadline->isPast() ? 'text-red-500' : 'text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Deadline: {{ $vacancy->deadline->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                                {{ Str::limit(strip_tags($vacancy->description), 120) }}
                            </p>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('mahasiswa.vacancies.show', $vacancy->id) }}" 
                                   class="flex-1 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 text-center text-sm hover:shadow-lg transform hover:scale-105">
                                    Lihat Detail
                                </a>
                                
                                <form action="{{ route('mahasiswa.vacancies.toggleBookmark', $vacancy->id) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Hapus lowongan ini dari simpanan?')">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full sm:w-auto bg-white border-2 border-red-300 hover:bg-red-50 text-red-600 font-semibold py-3 px-4 rounded-xl transition-all duration-300 text-sm hover:border-red-400 hover:shadow-md group">
                                        <svg class="w-4 h-4 inline mr-1 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Disimpan {{ $vacancy->pivot->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12 animate-fade-in">
                <div class="bg-white rounded-2xl shadow-lg p-4">
                    {{ $bookmarkedVacancies->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 animate-bounce-in">
                <div class="max-w-md mx-auto">
                    <div class="bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full w-32 h-32 flex items-center justify-center mx-auto mb-8 animate-pulse-slow">
                        <svg class="w-16 h-16 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Lowongan Tersimpan</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Mulai simpan lowongan magang yang menarik perhatian Anda agar mudah ditemukan kembali kapan saja.
                    </p>
                    <a href="{{ route('public.vacancies.index') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-2xl transition-all duration-300 hover:shadow-xl transform hover:scale-105 group">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Jelajahi Lowongan Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection