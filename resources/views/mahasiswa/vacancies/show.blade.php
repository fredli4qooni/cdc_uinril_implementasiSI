@extends('layouts.app')
@section('title', 'Detail Lowongan: ' . $vacancy->title)

@section('content')
    <div class="container mx-auto px-4 py-8 animate-fade-in-down">
        <div class="flex justify-center">
            <div class="w-full max-w-5xl">
                {{-- Tombol Kembali dengan animasi hover --}}
                <div class="mb-6">
                    <a href="{{ url()->previous(route('public.vacancies.index')) }}"
                        class="group inline-flex items-center px-4 py-2 bg-white text-indigo-700 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-all duration-300 shadow-sm hover:shadow transform hover:-translate-y-1">
                        <i class="fas fa-arrow-left mr-2 group-hover:animate-pulse"></i> 
                        <span class="font-medium">Kembali ke Daftar Lowongan</span>
                    </a>
                </div>

                <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-indigo-100 transform transition duration-500 hover:shadow-2xl">
                    {{-- Header dengan gradient --}}
                    <div class="bg-gradient-to-r from-indigo-700 to-indigo-500 text-white px-8 py-6">
                        <h4 class="text-2xl md:text-3xl font-bold">{{ $vacancy->title }}</h4>
                        <p class="text-indigo-100 mt-2">
                            <i class="fas fa-calendar-alt mr-2"></i> 
                            Diposting: {{ $vacancy->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="p-8">
                        {{-- Informasi Perusahaan dengan card style --}}
                        <div class="flex flex-col md:flex-row items-center mb-8 p-6 bg-indigo-50 rounded-xl border border-indigo-100 transform transition hover:bg-indigo-100 duration-300">
                            <div class="flex-shrink-0 mb-4 md:mb-0">
                                @if ($vacancy->company->logo_path && Storage::disk('public')->exists($vacancy->company->logo_path))
                                    <img src="{{ Storage::url($vacancy->company->logo_path) }}"
                                        alt="{{ $vacancy->company->name }} Logo"
                                        class="mr-6 h-20 w-auto max-w-[180px] object-contain rounded-lg shadow-md bg-white p-3">
                                @else
                                    <div class="mr-6 p-5 bg-white rounded-lg shadow-md">
                                        <i class="fas fa-building text-4xl text-indigo-400"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h5 class="text-xl md:text-2xl font-bold text-indigo-800 mb-2">
                                    {{ $vacancy->company->name ?? 'Informasi Perusahaan Tidak Tersedia' }}
                                </h5>
                                @if ($vacancy->company->website)
                                    <a href="{{ $vacancy->company->website }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center text-indigo-500 hover:text-indigo-700 transition duration-300">
                                        <i class="fas fa-globe mr-2"></i> {{ $vacancy->company->website }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Informasi Lowongan dengan Grid System --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <div class="col-span-1 md:col-span-2">
                                <div class="border-l-4 border-indigo-500 pl-4 mb-6 transform transition hover:border-indigo-700 duration-300">
                                    <h6 class="text-xl font-semibold text-indigo-700 mb-3">
                                        <i class="fas fa-info-circle mr-2"></i> Deskripsi Pekerjaan/Magang
                                    </h6>
                                    <div class="text-gray-700 leading-relaxed prose max-w-none">
                                        {!! nl2br(e($vacancy->description)) !!}
                                    </div>
                                </div>

                                @if ($vacancy->requirements)
                                    <div class="border-l-4 border-indigo-500 pl-4 mb-6 transform transition hover:border-indigo-700 duration-300">
                                        <h6 class="text-xl font-semibold text-indigo-700 mb-3">
                                            <i class="fas fa-tasks mr-2"></i> Persyaratan
                                        </h6>
                                        <div class="text-gray-700 leading-relaxed prose max-w-none">
                                            {!! nl2br(e($vacancy->requirements)) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 hover:shadow-md transition duration-300">
                                <h6 class="text-lg font-semibold text-indigo-700 mb-3 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-3 text-indigo-500 text-xl"></i> Lokasi
                                </h6>
                                <p class="text-gray-700 ml-8">{{ $vacancy->location ?? 'Tidak ditentukan' }}</p>
                            </div>

                            <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 hover:shadow-md transition duration-300">
                                <h6 class="text-lg font-semibold text-indigo-700 mb-3 flex items-center">
                                    <i class="fas fa-users mr-3 text-indigo-500 text-xl"></i> Kuota Tersedia
                                </h6>
                                <p class="text-gray-700 ml-8">
                                    <span class="text-2xl font-bold text-indigo-600">{{ $vacancy->slots }}</span> orang
                                </p>
                            </div>
                        </div>

                        {{-- Deadline Card --}}
                        <div class="bg-gradient-to-r from-indigo-100 to-purple-100 p-6 rounded-xl border border-indigo-200 mb-8 transform hover:scale-105 transition duration-300">
                            <h6 class="text-lg font-semibold text-indigo-700 mb-3 flex items-center">
                                <i class="fas fa-calendar-times mr-3 text-indigo-500 text-xl"></i> Deadline Pendaftaran
                            </h6>
                            <div class="ml-8">
                                @if ($vacancy->deadline)
                                    <div class="flex flex-col md:flex-row md:items-center">
                                        <span class="text-gray-700 text-lg">{{ $vacancy->deadline->format('l, d F Y') }}</span>
                                        @if($vacancy->deadline->isPast())
                                            <span class="md:ml-3 px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm inline-block mt-2 md:mt-0">
                                                Sudah berakhir
                                            </span>
                                        @else
                                            <span class="md:ml-3 px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm inline-block mt-2 md:mt-0">
                                                {{ $vacancy->deadline->diffForHumans() }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="px-4 py-2 bg-green-100 text-green-700 rounded-lg text-lg">
                                        Pendaftaran sedang dibuka
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr class="border-indigo-100 my-8">

                        {{-- Tombol Aksi (Apply) dengan animasi --}}
                        <div class="text-center mt-8">
                            @if ($hasApplied)
                                <div class="inline-flex items-center bg-green-500 text-white px-8 py-4 rounded-xl opacity-75 cursor-not-allowed">
                                    <i class="fas fa-check-circle mr-3 text-xl"></i> Anda Sudah Mendaftar
                                </div>
                            @else
                                {{-- Form untuk Apply --}}
                                <form action="{{ route('mahasiswa.vacancies.apply', $vacancy->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin mendaftar ke lowongan ini? Pastikan profil dan CV Anda sudah terbaru.');">
                                    @csrf
                                    <button type="submit" 
                                        class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-10 py-4 rounded-xl hover:from-indigo-700 hover:to-indigo-800 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                        <i class="fas fa-paper-plane mr-3 text-xl"></i> 
                                        <span class="text-lg font-medium">Daftar Sekarang</span>
                                    </button>
                                </form>
                                
                                <p class="text-gray-500 mt-4 text-sm">
                                    <i class="fas fa-info-circle mr-1"></i> Pastikan data profil dan CV Anda sudah lengkap dan terbaru
                                </p>
                            @endif
                        </div>
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
        
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
        
        .hover\:-translate-y-1:hover {
            transform: translateY(-4px);
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