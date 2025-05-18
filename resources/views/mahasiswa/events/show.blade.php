{{-- resources/views/mahasiswa/events/show.blade.php --}}
@extends('layouts.student')

@section('title', 'Detail: ' . $event->title)

@section('content')
    <div class="container mx-auto px-4 py-8 animate-fade-in-down">
        <div class="flex justify-center">
            <div class="w-full max-w-5xl">
                {{-- Tombol Kembali dengan animasi hover --}}
                <div class="mb-6">
                    <a href="{{ route('mahasiswa.events.index') }}" 
                       class="group inline-flex items-center px-4 py-2 bg-white text-indigo-700 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-all duration-300 shadow-sm hover:shadow transform hover:-translate-y-1">
                        <i class="fas fa-arrow-left mr-2 group-hover:animate-pulse"></i> 
                        <span class="font-medium">Kembali ke Daftar Event/Loker</span>
                    </a>
                </div>

                <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-indigo-100 transform transition duration-500 hover:shadow-2xl">
                    {{-- Gambar/Poster dengan overlay gradient pada hover --}}
                    @if ($event->image_path && Storage::disk('public')->exists($event->image_path))
                        <div class="relative overflow-hidden bg-indigo-50 group">
                            <a href="{{ $event->source_url ?? '#' }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="{{ $event->source_url ? '' : 'pointer-events-none' }}">
                                <div class="relative">
                                    <img src="{{ Storage::url($event->image_path) }}" 
                                         class="w-full max-h-[400px] object-contain transition-transform duration-500 group-hover:scale-105" 
                                         alt="{{ $event->title }}">
                                    
                                    @if($event->source_url)
                                    <div class="absolute inset-0 bg-gradient-to-t from-indigo-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center">
                                        <span class="text-white mb-8 px-4 py-2 bg-indigo-600/90 rounded-lg backdrop-blur-sm">
                                            <i class="fas fa-external-link-alt mr-2"></i> Lihat Detail
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endif

                    <div class="p-8">
                        <div class="flex flex-wrap justify-between items-start mb-4">
                            {{-- Badge Tipe dengan animasi pulse --}}
                            <span class="inline-block mb-2 px-4 py-1.5 text-sm font-semibold rounded-full shadow-sm animate-pulse-slow
                                {{ $event->type == 'event' ? 'bg-indigo-100 text-indigo-800 border border-indigo-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                <i class="{{ $event->type == 'event' ? 'fas fa-calendar-day' : 'fas fa-briefcase' }} mr-1"></i>
                                {{ $event->type == 'event' ? 'Event' : 'Loker Umum' }}
                            </span>
                            
                            {{-- Posting time --}}
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-clock mr-1 text-indigo-400"></i> Diposting: {{ $event->created_at->format('d M Y') }}
                            </span>
                        </div>

                        {{-- Judul dengan gradient text --}}
                        <h2 class="text-2xl md:text-3xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-indigo-500">
                            {{ $event->title }}
                        </h2>

                        {{-- Informasi Utama dengan cards --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            @if ($event->start_datetime)
                                <div class="bg-indigo-50 rounded-xl p-5 border border-indigo-100 hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                    <div class="flex items-start">
                                        <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                            <i class="fas fa-calendar-alt text-indigo-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-indigo-700 mb-1">Tanggal & Waktu</p>
                                            <p class="text-gray-700">
                                                {{ $event->start_datetime->format('l, d F Y') }}
                                                @if ($event->start_datetime->format('H:i') != '00:00')
                                                    <span class="font-medium">pukul {{ $event->start_datetime->format('H:i') }}</span>
                                                @endif
                                                @if ($event->end_datetime && $event->end_datetime->format('Ymd') > $event->start_datetime->format('Ymd'))
                                                    <span class="block mt-1">s/d {{ $event->end_datetime->format('l, d F Y') }}</span>
                                                @elseif($event->end_datetime && $event->end_datetime > $event->start_datetime)
                                                    <span class="mx-1">-</span> {{ $event->end_datetime->format('H:i') }}
                                                @endif
                                                <span class="ml-1 text-indigo-600 font-medium">WIB</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($event->location)
                                <div class="bg-indigo-50 rounded-xl p-5 border border-indigo-100 hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                    <div class="flex items-start">
                                        <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                            <i class="fas fa-map-marker-alt text-indigo-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-indigo-700 mb-1">Lokasi</p>
                                            <p class="text-gray-700">{{ $event->location }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($event->organizer)
                                <div class="bg-indigo-50 rounded-xl p-5 border border-indigo-100 hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                    <div class="flex items-start">
                                        <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                            <i class="fas fa-building text-indigo-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-indigo-700 mb-1">Penyelenggara</p>
                                            <p class="text-gray-700">{{ $event->organizer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="bg-indigo-50 rounded-xl p-5 border border-indigo-100 hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start">
                                    <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                        <i class="fas fa-history text-indigo-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-indigo-700 mb-1">Terakhir Update</p>
                                        <p class="text-gray-700">
                                            {{ $event->created_at->diffForHumans() }} 
                                            <span class="text-gray-500">({{ $event->created_at->format('d M Y') }})</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi Lengkap dengan styling --}}
                        @if ($event->description)
                            <div class="mb-8 bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-xl border border-indigo-100">
                                <h5 class="text-xl font-semibold text-indigo-700 mb-4 flex items-center border-b border-indigo-200 pb-3">
                                    <i class="fas fa-align-left mr-3 text-indigo-500"></i> Deskripsi Lengkap
                                </h5>
                                <div class="text-gray-700 leading-relaxed prose max-w-none">
                                    {!! nl2br(e($event->description)) !!}
                                </div>
                            </div>
                        @endif

                        {{-- Tombol Link Sumber dengan animasi --}}
                        <div class="text-center mt-8 pb-4">
                            @if ($event->source_url)
                                <a href="{{ $event->source_url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-8 py-4 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <i class="fas fa-external-link-alt mr-3 text-xl"></i> 
                                    <span class="font-medium text-lg">Kunjungi Sumber / Info Pendaftaran</span>
                                </a>
                                <p class="text-gray-500 mt-4 text-sm">
                                    <i class="fas fa-info-circle mr-1"></i> Link akan membuka di tab baru
                                </p>
                            @else
                                <div class="p-5 bg-gray-50 border border-gray-200 rounded-lg text-gray-600 italic">
                                    <i class="fas fa-info-circle mr-2 text-indigo-400"></i> 
                                    Tidak ada link sumber eksternal yang tersedia untuk informasi ini.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Share buttons --}}
                <div class="mt-6 flex justify-center">
                    <div class="bg-white rounded-xl shadow-md px-6 py-4 inline-flex items-center space-x-4">
                        <span class="text-gray-700 font-medium">Bagikan:</span>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-300 transform hover:scale-110" title="Share ke WhatsApp">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-300 transform hover:scale-110" title="Share ke Facebook">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-300 transform hover:scale-110" title="Copy Link">
                            <i class="fas fa-link text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambahkan CSS untuk animasi --}}
    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-down {
            animation: fadeInDown 0.5s ease-out;
        }
        
        @keyframes pulse-slow {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }
        
        .animate-pulse-slow {
            animation: pulse-slow 3s infinite;
        }
        
        .group:hover .group-hover\:animate-pulse {
            animation: pulse 1.5s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }
    </style>
@endsection