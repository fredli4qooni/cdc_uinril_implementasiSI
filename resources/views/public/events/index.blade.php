{{-- resources/views/public/events/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Event & Loker Umum')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 overflow-hidden">
    <div class="absolute inset-0 bg-white/60"></div>
    <div class="absolute top-0 left-0 w-full h-full">
        <div class="absolute top-10 left-10 w-32 h-32 bg-blue-200/30 rounded-full blur-xl"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-purple-200/30 rounded-full blur-xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-60 h-60 bg-indigo-200/20 rounded-full blur-2xl"></div>
    </div>
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
            Event Karir & 
            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Informasi Loker
            </span>
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Update diri Anda dengan berbagai kegiatan dan peluang terbaru untuk mengembangkan karir impian Anda
        </p>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search & Filter Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-12 border border-gray-100">
            <form action="{{ route('public.events.index') }}" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                    <!-- Search Input -->
                    <div class="md:col-span-6">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                            Cari Event/Loker
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white" 
                                id="search" 
                                name="search" 
                                placeholder="Masukkan kata kunci..." 
                                value="{{ request('search') }}"
                            >
                        </div>
                    </div>
                    
                    <!-- Type Filter -->
                    <div class="md:col-span-3">
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select 
                            name="type" 
                            id="type" 
                            class="block w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                        >
                            <option value="all" {{ request('type', 'all') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                            <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="loker_umum" {{ request('type') == 'loker_umum' ? 'selected' : '' }}>Loker Umum</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="md:col-span-3 space-y-2">
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"
                        >
                            <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Terapkan Filter
                        </button>
                        @if(request()->hasAny(['search', 'type']) && (request('search') != '' || request('type') != 'all'))
                            <a 
                                href="{{ route('public.events.index') }}" 
                                class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-all duration-200"
                            >
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse ($events as $event)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
                    <!-- Event Image/Icon -->
                    <div class="relative h-48 overflow-hidden">
                        @if($event->image_path && Storage::disk('public')->exists($event->image_path))
                            <img 
                                src="{{ Storage::url($event->image_path) }}" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" 
                                alt="{{ $event->title }}"
                            >
                        @else
                            <div class="w-full h-full bg-gradient-to-br {{ $event->type == 'event' ? 'from-blue-400 to-blue-600' : 'from-amber-400 to-orange-500' }} flex items-center justify-center">
                                @if ($event->type == 'event')
                                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h2zm4-3a1 1 0 00-1 1v1h2V4a1 1 0 00-1-1zM4 9v2h2V9H4zm10 0v2h2V9h-2z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                        @endif
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $event->type == 'event' ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $event->type == 'event' ? 'Event' : 'Loker Umum' }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col h-auto">
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                            {{ Str::limit($event->title, 55) }}
                        </h3>
                        
                        <!-- Event Details -->
                        <div class="space-y-2 mb-4 text-sm text-gray-600">
                            @if($event->start_datetime)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $event->start_datetime->format('d M Y') }}
                                </div>
                            @endif
                            @if($event->location)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $event->location }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">
                            {{ Str::limit(strip_tags($event->description), 100) }}
                        </p>

                        <!-- Action Button -->
                        <div class="mt-auto">
                            @guest
                                <a 
                                    href="{{ route('login', ['redirect' => route('mahasiswa.events.show', $event->id) ]) }}" 
                                    class="block w-full text-center bg-gradient-to-r from-gray-100 to-gray-200 hover:from-blue-50 hover:to-blue-100 text-gray-700 hover:text-blue-700 font-semibold py-3 px-4 rounded-xl transition-all duration-200 border border-gray-200"
                                >
                                    Login untuk Detail
                                </a>
                            @else
                                <a 
                                    href="{{ route('mahasiswa.events.show', $event->id) }}" 
                                    class="block w-full text-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-md hover:shadow-lg"
                                >
                                    Lihat Detail
                                </a>
                            @endguest
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <p class="text-xs text-gray-500">
                            Diposting: {{ $event->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-12 text-center">
                        <div class="mx-auto w-24 h-24 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-amber-800 mb-2">
                            @if(request()->hasAny(['search', 'type']) && (request('search') != '' || request('type') != 'all'))
                                Tidak Ada Hasil Ditemukan
                            @else
                                Belum Ada Informasi Tersedia
                            @endif
                        </h3>
                        <p class="text-amber-700 max-w-md mx-auto">
                            @if(request()->hasAny(['search', 'type']) && (request('search') != '' || request('type') != 'all'))
                                Tidak ada event atau loker umum yang sesuai dengan filter yang Anda pilih. Coba ubah kata kunci atau filter.
                            @else
                                Saat ini belum ada informasi event atau loker umum yang tersedia. Silakan kembali lagi nanti.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="flex justify-center mt-12">
                <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                    {{ $events->appends(request()->query())->links() }}
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