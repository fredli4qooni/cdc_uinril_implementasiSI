{{-- resources/views/mahasiswa/events/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Informasi Event & Loker Umum')

@section('content')
    <div class="bg-gradient-to-b from-indigo-50 to-white min-h-screen pb-12">
        {{-- Hero Section dengan Ilustrasi --}}
        <div class="relative overflow-hidden bg-indigo-900 text-white">
            <div class="container mx-auto px-20 py-16 lg:py-14 relative ">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="space-y-6 animate-fade-in-up">
                        <h1 class="text-4xl lg:text-5xl font-bold leading-tight">
                            Info <span class="text-indigo-300">Event</span> & <span class="text-indigo-300">Loker Umum</span>
                        </h1>
                        <p class="text-lg text-indigo-100 max-w-lg">
                            Tetap update dengan informasi event terbaru dan peluang karir yang dapat mengembangkan potensi
                            dan jaringan profesionalmu.
                        </p>
                    </div>
                    <div class="flex justify-center lg:justify-end">
                        {{-- Placeholder untuk ilustrasi kartun, bisa diganti dengan gambar Anda sendiri --}}
                        <div class="w-96 h-96 lg:w-96 lg:h-96 flex items-center justify-center">
                            <img src="{{ asset('images/i1.png') }}" alt="Ilustrasi Kartun"
                                class="w-full h-full object-contain" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bentuk dekoratif gelombang --}}
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full h-auto fill-white">
                    <path
                        d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="container mx-auto px-4 py-6">
            <h2 class="text-3xl font-bold text-indigo-800 mb-8 text-center">Jelajahi Informasi</h2>

            {{-- Form Pencarian & Filter dengan desain baru --}}
            <div class="max-w-5xl mx-auto mb-10 transition-all duration-300 transform hover:scale-[1.01]">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <form action="{{ route('mahasiswa.events.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                            <div class="md:col-span-6">
                                <label for="search" class="block text-sm font-medium text-indigo-700 mb-2">Cari
                                    Event/Loker</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-indigo-400"></i>
                                    </div>
                                    <input type="text"
                                        class="w-full pl-10 pr-4 py-3 border-0 bg-indigo-50 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300"
                                        id="search" name="search" placeholder="Masukkan kata kunci..."
                                        value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="md:col-span-3">
                                <label for="type" class="block text-sm font-medium text-indigo-700 mb-2">Tipe</label>
                                <div class="relative">
                                    <select name="type" id="type"
                                        class="w-full pl-4 pr-10 py-3 border-0 bg-indigo-50 rounded-lg appearance-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300">
                                        <option value="all" {{ request('type', 'all') == 'all' ? 'selected' : '' }}>Semua
                                            Tipe</option>
                                        <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Event
                                        </option>
                                        <option value="loker_umum" {{ request('type') == 'loker_umum' ? 'selected' : '' }}>
                                            Loker Umum</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-indigo-400"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-span-3 flex flex-col space-y-3">
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center justify-center font-medium">
                                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                                </button>
                                {{-- Tombol Reset --}}
                                @if (request()->hasAny(['search', 'type']) && (request('search') != '' || request('type') != 'all'))
                                    <a href="{{ route('mahasiswa.events.index') }}"
                                        class="w-full text-center bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 transition duration-300 font-medium">
                                        <i class="fas fa-times mr-2"></i> Reset Filter
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Status filter jika ada --}}
            @if (request()->hasAny(['search', 'type']) && (request('search') != '' || request('type') != 'all'))
                <div class="max-w-5xl mx-auto mb-6">
                    <div class="text-sm text-indigo-700 bg-indigo-50 rounded-lg p-3">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>
                                Filter aktif:
                                @if (request('search'))
                                    Kata kunci "{{ request('search') }}"
                                @endif
                                @if (request('type') && request('type') != 'all')
                                    @if (request('search'))
                                        dan
                                    @endif
                                    Tipe "{{ request('type') == 'event' ? 'Event' : 'Loker Umum' }}"
                                @endif
                                ({{ $events->total() }} hasil)
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Filter Tabs untuk akses cepat --}}
            <div class="max-w-5xl mx-auto mb-8">
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('mahasiswa.events.index') }}"
                        class="px-5 py-2 rounded-full {{ !request()->hasAny(['search', 'type']) || (request('type') == 'all' && !request('search')) ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200' }} transition-all duration-300">
                        <i class="fas fa-th-large mr-1"></i> Semua
                    </a>
                    <a href="{{ route('mahasiswa.events.index', ['type' => 'event']) }}"
                        class="px-5 py-2 rounded-full {{ request('type') == 'event' ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200' }} transition-all duration-300">
                        <i class="fas fa-calendar-alt mr-1"></i> Event
                    </a>
                    <a href="{{ route('mahasiswa.events.index', ['type' => 'loker_umum']) }}"
                        class="px-5 py-2 rounded-full {{ request('type') == 'loker_umum' ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200' }} transition-all duration-300">
                        <i class="fas fa-briefcase mr-1"></i> Loker Umum
                    </a>
                </div>
            </div>

            {{-- Daftar Event/Loker dengan card design baru --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($events as $event)
                    <div class="group animate-fade-in transform transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl border border-indigo-50">
                            {{-- Gambar/Poster (jika ada) --}}
                            @if ($event->image_path && Storage::disk('public')->exists($event->image_path))
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ Storage::url($event->image_path) }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                        alt="{{ $event->title }}">

                                    {{-- Badge Tipe --}}
                                    <div class="absolute top-3 right-3">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold rounded-full shadow-md
                                            {{ $event->type == 'event' ? 'bg-indigo-600 text-white' : 'bg-yellow-500 text-white' }}">
                                            {{ $event->type == 'event' ? 'Event' : 'Loker Umum' }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                {{-- Placeholder jika tidak ada gambar dengan icon sesuai tipe --}}
                                <div
                                    class="relative h-48 bg-gradient-to-r {{ $event->type == 'event' ? 'from-indigo-500 to-indigo-700' : 'from-yellow-400 to-yellow-600' }} flex justify-center items-center">
                                    <div class="text-white text-opacity-30">
                                        @if ($event->type == 'event')
                                            <i class="fas fa-calendar-alt text-6xl"></i>
                                        @else
                                            <i class="fas fa-briefcase text-6xl"></i>
                                        @endif
                                    </div>

                                    {{-- Badge Tipe --}}
                                    <div class="absolute top-3 right-3">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold rounded-full shadow-md
                                            {{ $event->type == 'event' ? 'bg-white text-indigo-600' : 'bg-white text-yellow-600' }}">
                                            {{ $event->type == 'event' ? 'Event' : 'Loker Umum' }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="p-6">
                                <h5
                                    class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 hover:line-clamp-none transition-all duration-300">
                                    <a href="{{ route('mahasiswa.events.show', $event->id) }}"
                                        class="hover:text-indigo-600 transition duration-300">
                                        {{ $event->title }}
                                    </a>
                                </h5>

                                <div class="space-y-3 text-gray-600 mb-4">
                                    @if ($event->start_datetime)
                                        <div class="flex items-start">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-indigo-100 rounded-md flex items-center justify-center text-indigo-500">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-gray-800 font-medium">Waktu</p>
                                                <p class="text-sm">
                                                    {{ $event->start_datetime->format('d M Y') }}
                                                    @if ($event->end_datetime && $event->end_datetime->format('Ymd') > $event->start_datetime->format('Ymd'))
                                                        - {{ $event->end_datetime->format('d M Y') }}
                                                    @elseif ($event->start_datetime->format('H:i') != '00:00')
                                                        ({{ $event->start_datetime->format('H:i') }})
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($event->location)
                                        <div class="flex items-start">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-indigo-100 rounded-md flex items-center justify-center text-indigo-500">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-gray-800 font-medium">Lokasi</p>
                                                <p class="text-sm">{{ $event->location }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($event->organizer)
                                        <div class="flex items-start">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-indigo-100 rounded-md flex items-center justify-center text-indigo-500">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-gray-800 font-medium">Penyelenggara</p>
                                                <p class="text-sm">{{ $event->organizer }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Deskripsi Singkat (jika ada) --}}
                                @if ($event->description)
                                    <div class="bg-indigo-50 rounded-lg p-3 mb-4">
                                        <p class="text-sm text-indigo-900 line-clamp-2">
                                            {{ Str::limit($event->description, 120) }}
                                        </p>
                                    </div>
                                @endif

                                <div class="flex gap-2">
                                    {{-- Tombol Detail Internal --}}
                                    <a href="{{ route('mahasiswa.events.show', $event->id) }}"
                                        class="flex-1 bg-indigo-600 text-white py-3 rounded-lg text-center hover:bg-indigo-700 transition duration-300 relative overflow-hidden group">
                                        <span class="relative z-10">
                                            <i class="fas fa-eye mr-2"></i> Detail
                                        </span>
                                        <span
                                            class="absolute inset-0 h-full w-0 bg-indigo-800 transition-all duration-300 group-hover:w-full"></span>
                                    </a>

                                    {{-- Tombol Source URL (jika ada) --}}
                                    @if ($event->source_url)
                                        <a href="{{ $event->source_url }}" target="_blank" rel="noopener noreferrer"
                                            class="bg-indigo-100 text-indigo-700 py-3 px-4 rounded-lg hover:bg-indigo-200 transition duration-300 flex items-center justify-center">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-indigo-50 px-6 py-3 text-sm text-indigo-700 flex items-center justify-between">
                                <div>
                                    <i class="far fa-clock mr-1"></i> {{ $event->created_at->diffForHumans() }}
                                </div>
                                <div>
                                    @if ($event->start_datetime && $event->start_datetime->isFuture())
                                        <span
                                            class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Upcoming</span>
                                    @elseif ($event->end_datetime && $event->end_datetime->isPast())
                                        <span
                                            class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded">Selesai</span>
                                    @elseif (
                                        $event->start_datetime &&
                                            $event->start_datetime->isPast() &&
                                            ($event->end_datetime && $event->end_datetime->isFuture()))
                                        <span
                                            class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">Berlangsung</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12">
                        <div class="max-w-md mx-auto text-center">
                            {{-- Placeholder untuk ilustrasi "tidak ada data" --}}
                            <div
                                class="w-32 h-32 mx-auto mb-6 bg-indigo-100 rounded-full flex items-center justify-center">
                                @if (request('type') == 'event')
                                    <i class="fas fa-calendar-alt text-4xl text-indigo-300"></i>
                                @elseif (request('type') == 'loker_umum')
                                    <i class="fas fa-briefcase text-4xl text-indigo-300"></i>
                                @else
                                    <i class="fas fa-search text-4xl text-indigo-300"></i>
                                @endif
                            </div>

                            <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                @if (request()->hasAny(['search', 'type']) && (request('search') != '' || request('type') != 'all'))
                                    Tidak Ada Hasil Ditemukan
                                @else
                                    Belum Ada Informasi
                                @endif
                            </h3>

                            <p class="text-gray-600 mb-6">
                                @if (request()->hasAny(['search', 'type']) && (request('search') != '' || request('type') != 'all'))
                                    Tidak ada informasi yang sesuai dengan filter yang Anda terapkan.
                                @else
                                    Saat ini belum ada informasi event atau loker umum yang tersedia. Silakan cek kembali
                                    nanti.
                                @endif
                            </p>

                            @if (request()->hasAny(['search', 'type']) && (request('search') != '' || request('type') != 'all'))
                                <a href="{{ route('mahasiswa.events.index') }}"
                                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                                    <i class="fas fa-chevron-left mr-2"></i> Kembali ke Semua Informasi
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Paginasi dengan style baru --}}
            @if ($events->hasPages())
                <div class="mt-10">
                    <div class="bg-white rounded-xl shadow-md p-4">
                        {{ $events->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- CSS untuk animasi --}}
    <style>
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Animasi untuk card saat halaman dimuat */
        .grid>div:nth-child(1) {
            animation-delay: 0.1s;
        }

        .grid>div:nth-child(2) {
            animation-delay: 0.2s;
        }

        .grid>div:nth-child(3) {
            animation-delay: 0.3s;
        }

        .grid>div:nth-child(4) {
            animation-delay: 0.4s;
        }

        .grid>div:nth-child(5) {
            animation-delay: 0.5s;
        }

        .grid>div:nth-child(6) {
            animation-delay: 0.6s;
        }

        /* Truncate text */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
