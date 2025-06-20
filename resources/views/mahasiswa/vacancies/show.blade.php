{{-- resources/views/mahasiswa/vacancies/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Lowongan: ' . $vacancy->title)

@section('content')
    <div class="container mx-auto px-4 py-8 animate-fade-in-down">
        <div class="max-w-7xl mx-auto">
            {{-- Back Button --}}
            <div class="mb-6">
                <a href="{{ url()->previous(route('public.vacancies.index')) }}"
                    class="group inline-flex items-center px-4 py-2 bg-white text-indigo-700 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-all duration-300 shadow-sm hover:shadow transform hover:-translate-y-1">
                    <i class="fas fa-arrow-left mr-2 group-hover:animate-pulse"></i>
                    <span class="font-medium">Kembali ke Daftar Lowongan</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main Content (2 columns) --}}
                <div class="lg:col-span-2">
                    {{-- Header Section --}}
                    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-indigo-100 mb-6">
                        <div class="bg-gradient-to-r from-indigo-700 to-indigo-500 text-white px-8 py-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h1 class="text-2xl md:text-3xl font-bold mb-2">{{ $vacancy->title }}</h1>
                                    <p class="text-indigo-100 flex items-center flex-wrap gap-4">
                                        <span class="flex items-center">
                                            <i class="fas fa-building mr-2"></i>
                                            <a href="#company-profile"
                                                class="hover:text-white transition duration-200">{{ $vacancy->company->name ?? 'N/A' }}</a>
                                        </span>
                                        <span class="hidden md:inline">|</span>
                                        <span class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            {{ $vacancy->location ?? 'N/A' }}
                                        </span>
                                    </p>
                                </div>
                                {{-- Bookmark Button --}}
                                <form action="{{ route('mahasiswa.vacancies.toggleBookmark', $vacancy->id) }}"
                                    method="POST" class="inline" id="bookmarkForm-{{ $vacancy->id }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition duration-300 {{ $isBookmarked ? 'bg-yellow-500/80 hover:bg-yellow-500' : '' }}"
                                        title="{{ $isBookmarked ? 'Hapus dari Simpanan' : 'Simpan Lowongan' }}">
                                        <i class="fas {{ $isBookmarked ? 'fa-bookmark' : 'fa-bookmark' }} mr-2"></i>
                                        <span class="bookmark-text">{{ $isBookmarked ? 'Disimpan' : 'Simpan' }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Tabbed Content --}}
                    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-indigo-100">
                        {{-- Tab Navigation --}}
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8 px-8" aria-label="Tabs">
                                <button
                                    class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition duration-200 border-indigo-500 text-indigo-600"
                                    data-tab="overview">
                                    Overview
                                </button>
                                <button
                                    class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                    data-tab="requirements">
                                    Persyaratan
                                </button>
                                <button
                                    class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                    data-tab="company-info">
                                    Tentang Perusahaan
                                </button>
                            </nav>
                        </div>

                        {{-- Tab Content --}}
                        <div class="p-8">
                            {{-- Overview Tab --}}
                            <div class="tab-content active" id="overview">
                                <div class="border-l-4 border-indigo-500 pl-4 mb-8">
                                    <h5 class="text-xl font-bold text-indigo-700 mb-4 flex items-center">
                                        <i class="fas fa-info-circle mr-2"></i> Deskripsi Pekerjaan/Magang
                                    </h5>
                                    <div class="text-gray-700 leading-relaxed prose max-w-none">
                                        {!! nl2br(e($vacancy->description)) !!}
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div
                                        class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 hover:shadow-md transition duration-300">
                                        <h6 class="text-lg font-semibold text-indigo-700 mb-3 flex items-center">
                                            <i class="fas fa-users mr-3 text-indigo-500"></i> Kuota Tersedia
                                        </h6>
                                        <p class="text-gray-700 ml-8">
                                            <span class="text-2xl font-bold text-indigo-600">{{ $vacancy->slots }}</span>
                                            orang
                                        </p>
                                    </div>

                                    <div
                                        class="bg-gradient-to-r from-indigo-100 to-purple-100 p-6 rounded-xl border border-indigo-200 hover:shadow-md transition duration-300">
                                        <h6 class="text-lg font-semibold text-indigo-700 mb-3 flex items-center">
                                            <i class="fas fa-calendar-times mr-3 text-indigo-500"></i> Deadline Pendaftaran
                                        </h6>
                                        <div class="ml-8">
                                            @if ($vacancy->deadline)
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-gray-700">{{ $vacancy->deadline->format('l, d F Y') }}</span>
                                                    @if ($vacancy->deadline->isPast())
                                                        <span
                                                            class="mt-1 px-2 py-1 bg-red-100 text-red-700 rounded-full text-sm inline-block w-fit">
                                                            Sudah berakhir
                                                        </span>
                                                    @else
                                                        <span
                                                            class="mt-1 px-2 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm inline-block w-fit">
                                                            {{ $vacancy->deadline->diffForHumans() }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg">
                                                    Pendaftaran sedang dibuka
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Requirements Tab --}}
                            <div class="tab-content" id="requirements" style="display: none;">
                                <div class="border-l-4 border-indigo-500 pl-4">
                                    <h5 class="text-xl font-bold text-indigo-700 mb-4 flex items-center">
                                        <i class="fas fa-tasks mr-2"></i> Persyaratan
                                    </h5>
                                    @if ($vacancy->requirements)
                                        <div class="text-gray-700 leading-relaxed prose max-w-none">
                                            {!! nl2br(e($vacancy->requirements)) !!}
                                        </div>
                                    @else
                                        <p class="text-gray-500 italic">Informasi persyaratan tidak disediakan.</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Company Info Tab --}}
                            <div class="tab-content" id="company-info" style="display: none;">
                                <div class="border-l-4 border-indigo-500 pl-4 mb-6">
                                    <h5 class="text-xl font-bold text-indigo-700 mb-4 flex items-center">
                                        <i class="fas fa-building mr-2"></i> Tentang
                                        {{ $vacancy->company->name ?? 'Perusahaan' }}
                                    </h5>
                                    @if ($vacancy->company->description)
                                        <div class="text-gray-700 leading-relaxed prose max-w-none mb-6">
                                            {!! nl2br(e($vacancy->company->description)) !!}
                                        </div>
                                    @endif
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    @if ($vacancy->company->industry)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <i class="fas fa-industry text-indigo-500 mr-3"></i>
                                            <div>
                                                <span class="font-semibold text-gray-700">Industri:</span>
                                                <span class="ml-1 text-gray-600">{{ $vacancy->company->industry }}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($vacancy->company->employee_count_range)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <i class="fas fa-users-cog text-indigo-500 mr-3"></i>
                                            <div>
                                                <span class="font-semibold text-gray-700">Jumlah Karyawan:</span>
                                                <span
                                                    class="ml-1 text-gray-600">{{ $vacancy->company->employee_count_range }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Address and Map Section --}}
                                @if ($vacancy->company->full_address || $vacancy->company->address)
                                    <div class="mb-6">
                                        <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                            <i class="fas fa-map-marked-alt text-indigo-500 mr-3 mt-1"></i>
                                            <div>
                                                <span class="font-semibold text-gray-700">Alamat:</span>
                                                <span
                                                    class="ml-1 text-gray-600">{{ $vacancy->company->full_address ?? $vacancy->company->address }}</span>
                                            </div>
                                        </div>

                                        {{-- Google Maps Embed --}}
                                        @if ($vacancy->company->google_maps_embed_url)
                                            <div class="mt-4">
                                                <h6 class="text-lg font-semibold text-indigo-700 mb-3">Peta Lokasi:</h6>
                                                <div
                                                    class="aspect-video rounded-lg overflow-hidden shadow-lg border border-gray-200">
                                                    {!! $vacancy->company->google_maps_embed_url !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                {{-- Company Gallery --}}
                                @if ($vacancy->company->photos && $vacancy->company->photos->isNotEmpty())
                                    <div class="border-t border-gray-200 pt-6 mt-6">
                                        <h5 class="text-xl font-bold text-indigo-700 mb-4 flex items-center">
                                            <i class="fas fa-images mr-2"></i> Galeri Perusahaan
                                        </h5>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                            @foreach ($vacancy->company->photos as $photo)
                                                <div class="group cursor-pointer"
                                                    onclick="openModal('{{ Storage::url($photo->photo_path) }}', '{{ $photo->caption ?? $vacancy->company->name }}')">
                                                    <div
                                                        class="aspect-square rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                                        <img src="{{ Storage::url($photo->photo_path) }}"
                                                            alt="{{ $photo->caption ?? 'Foto Perusahaan' }}"
                                                            class="w-full h-full object-cover group-hover:brightness-110 transition-all duration-300">
                                                    </div>
                                                    @if ($photo->caption)
                                                        <p class="text-sm text-gray-600 mt-2 text-center">
                                                            {{ $photo->caption }}</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                {{-- Social Media Links --}}
                                <div class="flex flex-wrap gap-3 mt-6">
                                    @if ($vacancy->company->website)
                                        <a href="{{ $vacancy->company->website }}" target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-200 transform hover:scale-105">
                                            <i class="fas fa-globe mr-2"></i> Website
                                        </a>
                                    @endif
                                    @if ($vacancy->company->linkedin_url)
                                        <a href="{{ $vacancy->company->linkedin_url }}" target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 transform hover:scale-105">
                                            <i class="fab fa-linkedin mr-2"></i> LinkedIn
                                        </a>
                                    @endif
                                    @if ($vacancy->company->instagram_url)
                                        <a href="{{ $vacancy->company->instagram_url }}" target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition duration-200 transform hover:scale-105">
                                            <i class="fab fa-instagram mr-2"></i> Instagram
                                        </a>
                                    @endif
                                    @if ($vacancy->company->twitter_url)
                                        <a href="{{ $vacancy->company->twitter_url }}" target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition duration-200 transform hover:scale-105">
                                            <i class="fab fa-twitter mr-2"></i> Twitter
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Apply Button Section --}}
                    <div class="mt-8 text-center">
                        @if ($hasApplied)
                            <div
                                class="inline-flex items-center bg-green-500 text-white px-8 py-4 rounded-xl opacity-75 cursor-not-allowed">
                                <i class="fas fa-check-circle mr-3 text-xl"></i> Anda Sudah Mendaftar
                            </div>
                        @elseif($hasOtherActiveApplication)
                            {{-- VALIDASI BARU DI VIEW --}}
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-4 text-center">
                                <div class="flex items-center justify-center text-yellow-600 mb-3">
                                    <i class="fas fa-exclamation-triangle text-2xl mr-3"></i>
                                    <span class="text-lg font-semibold">Pendaftaran Aktif Ditemukan</span>
                                </div>
                                <p class="text-yellow-700 mb-4 leading-relaxed">
                                    Anda memiliki pendaftaran magang lain yang masih aktif. Anda hanya dapat memiliki satu
                                    pendaftaran aktif pada satu waktu.
                                </p>
                                <a href="{{ route('mahasiswa.applications.index') }}"
                                    class="inline-flex items-center text-yellow-600 hover:text-yellow-800 font-medium transition duration-200">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    Lihat Status Pendaftaran Anda
                                </a>
                            </div>
                            <div class="inline-flex items-center bg-gray-400 text-white px-10 py-4 rounded-xl cursor-not-allowed opacity-75"
                                title="Selesaikan pendaftaran aktif Anda terlebih dahulu">
                                <i class="fas fa-paper-plane mr-3 text-xl"></i>
                                <span class="text-lg font-medium">Daftar Sekarang</span>
                            </div>
                        @else
                            @if (Auth::user()->studentProfile && Auth::user()->studentProfile->cv_path)
                                <form action="{{ route('mahasiswa.vacancies.apply', $vacancy->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin mendaftar ke lowongan ini? Pastikan profil dan CV Anda sudah terbaru.');">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-10 py-4 rounded-xl hover:from-indigo-700 hover:to-indigo-800 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                        <i class="fas fa-paper-plane mr-3 text-xl"></i>
                                        <span class="text-lg font-medium">Daftar Sekarang</span>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('mahasiswa.profile.edit') }}"
                                    class="inline-flex items-center bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-10 py-4 rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <i class="fas fa-exclamation-triangle mr-3 text-xl"></i>
                                    <span class="text-lg font-medium">Lengkapi Profil & CV untuk Mendaftar</span>
                                </a>
                            @endif
                            <p class="text-gray-500 mt-4 text-sm">
                                <i class="fas fa-info-circle mr-1"></i> Pastikan data profil dan CV Anda sudah lengkap dan
                                terbaru
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Sidebar (1 column) --}}
                <div class="lg:col-span-1">
                    {{-- Company Profile Card --}}
                    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-indigo-100 mb-6"
                        id="company-profile">
                        <div class="p-6 text-center bg-gradient-to-br from-indigo-50 to-purple-50">
                            @if ($vacancy->company->logo_path && Storage::disk('public')->exists($vacancy->company->logo_path))
                                <img src="{{ Storage::url($vacancy->company->logo_path) }}"
                                    alt="{{ $vacancy->company->name }} Logo"
                                    class="w-24 h-24 object-contain mx-auto mb-4 rounded-full bg-white p-3 shadow-md">
                            @else
                                <div
                                    class="w-24 h-24 mx-auto mb-4 bg-white rounded-full flex items-center justify-center shadow-md">
                                    <i class="fas fa-building text-3xl text-indigo-400"></i>
                                </div>
                            @endif
                            <h5 class="text-xl font-bold text-indigo-800 mb-2">{{ $vacancy->company->name ?? 'N/A' }}</h5>
                            @if ($vacancy->company->industry)
                                <p class="text-indigo-600 text-sm">{{ $vacancy->company->industry }}</p>
                            @endif
                        </div>

                        <div class="p-0">
                            @if ($vacancy->company->website)
                                <div class="px-6 py-3 border-b border-gray-100 flex items-center">
                                    <i class="fas fa-globe text-indigo-500 mr-3 w-5"></i>
                                    <a href="{{ $vacancy->company->website }}" target="_blank"
                                        class="text-gray-700 hover:text-indigo-600 transition duration-200 truncate">
                                        {{ $vacancy->company->website }}
                                    </a>
                                </div>
                            @endif
                            @if ($vacancy->company->email)
                                <div class="px-6 py-3 border-b border-gray-100 flex items-center">
                                    <i class="fas fa-envelope text-indigo-500 mr-3 w-5"></i>
                                    <span class="text-gray-700 truncate">{{ $vacancy->company->email }}</span>
                                </div>
                            @endif
                            @if ($vacancy->company->phone_number)
                                <div class="px-6 py-3 border-b border-gray-100 flex items-center">
                                    <i class="fas fa-phone text-indigo-500 mr-3 w-5"></i>
                                    <span class="text-gray-700">{{ $vacancy->company->phone_number }}</span>
                                </div>
                            @endif
                            @if ($vacancy->company->address)
                                <div class="px-6 py-3 flex items-start">
                                    <i class="fas fa-map-marker-alt text-indigo-500 mr-3 w-5 mt-1"></i>
                                    <span
                                        class="text-gray-700 text-sm leading-relaxed">{{ $vacancy->company->address }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Social Media Icons --}}
                        @if ($vacancy->company->linkedin_url || $vacancy->company->instagram_url || $vacancy->company->twitter_url)
                            <div class="px-6 py-4 bg-gray-50 text-center">
                                <div class="flex justify-center space-x-3">
                                    @if ($vacancy->company->linkedin_url)
                                        <a href="{{ $vacancy->company->linkedin_url }}" target="_blank"
                                            class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-200 transform hover:scale-110"
                                            title="LinkedIn">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                    @if ($vacancy->company->instagram_url)
                                        <a href="{{ $vacancy->company->instagram_url }}" target="_blank"
                                            class="w-10 h-10 bg-pink-500 text-white rounded-full flex items-center justify-center hover:bg-pink-600 transition duration-200 transform hover:scale-110"
                                            title="Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if ($vacancy->company->twitter_url)
                                        <a href="{{ $vacancy->company->twitter_url }}" target="_blank"
                                            class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition duration-200 transform hover:scale-110"
                                            title="Twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Share Buttons --}}
                    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-indigo-100">
                        <div class="p-6">
                            <h6 class="text-lg font-semibold text-indigo-700 text-center mb-4">Bagikan Lowongan Ini</h6>
                            @php
                                $shareUrl = url()->current();
                                $shareTitle = 'Lowongan: ' . $vacancy->title . ' di ' . ($vacancy->company->name ?? '');
                            @endphp
                            <div class="space-y-3">
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($shareUrl) }}&title={{ urlencode($shareTitle) }}"
                                    target="_blank"
                                    class="flex items-center justify-center w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 transform hover:scale-105">
                                    <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($shareTitle . ' - ' . $shareUrl) }}"
                                    target="_blank"
                                    class="flex items-center justify-center w-full px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 transform hover:scale-105">
                                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareTitle) }}"
                                    target="_blank"
                                    class="flex items-center justify-center w-full px-4 py-3 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition duration-200 transform hover:scale-105">
                                    <i class="fab fa-twitter mr-2"></i> Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Modal for Gallery --}}
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl max-h-full p-4">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 z-10">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <p id="modalCaption" class="text-white text-center mt-4 text-lg"></p>
        </div>
    </div>

    {{-- Custom CSS and JavaScript --}}
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

        .hover\:scale-110:hover {
            transform: scale(1.10);
        }

        .hover\:-translate-y-1:hover {
            transform: translateY(-4px);
        }

        .group:hover .group-hover\:animate-pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .tab-button.active {
            border-color: #4f46e5;
            color: #4f46e5;
        }

        /* Gallery modal styles */
        #imageModal {
            backdrop-filter: blur(4px);
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');

                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-indigo-500', 'text-indigo-600');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });
                    tabContents.forEach(content => {
                        content.style.display = 'none';
                        content.classList.remove('active');
                    });

                    // Add active class to clicked button and show corresponding content
                    this.classList.remove('border-transparent', 'text-gray-500');
                    this.classList.add('border-indigo-500', 'text-indigo-600');

                    const targetContent = document.getElementById(targetTab);
                    if (targetContent) {
                        targetContent.style.display = 'block';
                        targetContent.classList.add('active');
                    }
                });
            });

            // Smooth scroll to company profile when company name is clicked
            document.querySelector('a[href="#company-profile"]')?.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('company-profile').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Gallery modal functions
        function openModal(imageSrc, caption) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');

            modalImage.src = imageSrc;
            modalCaption.textContent = caption;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Re-enable background scrolling
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection
