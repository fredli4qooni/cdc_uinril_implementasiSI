{{-- resources/views/mahasiswa/vacancies/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Lowongan Magang Kerjasama')

@section('content')
    <div class="bg-gradient-to-b from-indigo-50 to-white min-h-screen pb-12">
        {{-- Hero Section dengan Ilustrasi --}}
        <div class="relative overflow-hidden bg-indigo-900 text-white">
            <div class="container mx-auto px-20 py-16 lg:py-14 relative">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="space-y-6 animate-fade-in-up">
                        <h1 class="text-4xl lg:text-5xl font-bold leading-tight">
                            Temukan Magang <span class="text-indigo-300">Impianmu</span>
                        </h1>
                        <p class="text-lg text-indigo-100 max-w-lg">
                            Jelajahi berbagai lowongan magang kerjasama dari perusahaan terkemuka untuk mengembangkan karir
                            dan keterampilanmu.
                        </p>
                    </div>
                    <div class="flex justify-center lg:justify-end">
                        {{-- Placeholder untuk ilustrasi kartun, bisa diganti dengan gambar Anda sendiri --}}
                        <div class="w-96 h-96 lg:w-96 lg:h-96 flex items-center justify-center">
                            <img src="{{ asset('images/i2.png') }}" alt="Ilustrasi Kartun"
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
            <h2 class="text-3xl font-bold text-indigo-800 mb-6 text-center">Lowongan Magang Tersedia</h2>

            {{-- Form Pencarian dengan desain baru --}}
            <div class="max-w-4xl mx-auto mb-10 transition-all duration-300 transform hover:scale-[1.01]">
                <div class="bg-white rounded-xl shadow-lg p-1">
                    <form action="{{ route('mahasiswa.vacancies.index') }}" method="GET"
                        class="flex flex-col sm:flex-row items-center">
                        <div class="flex-grow p-2 w-full sm:w-auto">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-indigo-400"></i>
                                </div>
                                <input type="text"
                                    class="w-full pl-10 pr-4 py-3 border-0 bg-indigo-50 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300"
                                    id="search" name="search"
                                    placeholder="Cari berdasarkan posisi, perusahaan, atau lokasi..."
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="flex space-x-2 p-2 w-full sm:w-auto">
                            <button type="submit"
                                class="w-full sm:w-auto bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition duration-300 flex items-center justify-center font-medium">
                                <span>Cari Lowongan</span>
                            </button>
                            {{-- Tombol Reset (muncul jika ada search term) --}}
                            @if (request()->filled('search'))
                                <a href="{{ route('mahasiswa.vacancies.index') }}"
                                    class="w-full sm:w-auto bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 transition duration-300 flex items-center justify-center font-medium">
                                    <i class="fas fa-times mr-2"></i> Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Status pencarian dan jumlah hasil --}}
            @if (request()->filled('search'))
                <div class="max-w-4xl mx-auto mb-6">
                    <div class="text-sm text-indigo-700 bg-indigo-50 rounded-lg p-3">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>Hasil pencarian untuk "{{ request('search') }}" ({{ $vacancies->total() }} lowongan
                                ditemukan)</span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Daftar Lowongan dengan grid system yang diperbarui --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($vacancies as $vacancy)
                    <div class="group animate-fade-in transform transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl border border-indigo-50">
                            {{-- Header Card --}}
                            <div class="bg-gradient-to-r from-indigo-500 to-indigo-700 p-4 text-white">
                                <h5 class="text-xl font-bold truncate">{{ $vacancy->title }}</h5>
                                <div class="flex items-center text-indigo-100 mt-1">
                                    <i class="fas fa-building mr-2"></i>
                                    <span class="truncate">{{ $vacancy->company->name ?? 'N/A' }}</span>
                                </div>
                            </div>

                            {{-- Logo Perusahaan --}}
                            <div class="flex justify-center items-center p-4 bg-white border-b border-indigo-50">
                                @if ($vacancy->company->logo_path && Storage::disk('public')->exists($vacancy->company->logo_path))
                                    <img src="{{ Storage::url($vacancy->company->logo_path) }}"
                                        class="h-16 w-auto object-contain" alt="{{ $vacancy->company->name }} Logo">
                                @else
                                    <div
                                        class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-500">
                                        <i class="fas fa-building text-3xl"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <div class="space-y-3 text-gray-600">
                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-indigo-100 rounded-md flex items-center justify-center text-indigo-500">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-800 font-medium">Lokasi</p>
                                            <p class="text-sm">
                                                {{ $vacancy->location ?? 'Informasi lokasi tidak tersedia' }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-indigo-100 rounded-md flex items-center justify-center text-indigo-500">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-800 font-medium">Kuota</p>
                                            <p class="text-sm">{{ $vacancy->slots }} orang</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-indigo-100 rounded-md flex items-center justify-center text-indigo-500">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-800 font-medium">Deadline</p>
                                            @if ($vacancy->deadline)
                                                <p class="text-sm">
                                                    {{ $vacancy->deadline->format('d M Y') }}
                                                    <span class="text-xs text-indigo-500">
                                                        ({{ $vacancy->deadline->diffForHumans() }})
                                                    </span>
                                                </p>
                                            @else
                                                <p class="text-sm text-green-600 font-medium">Pendaftaran dibuka</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <a href="{{ route('mahasiswa.vacancies.show', $vacancy->id) }}"
                                        class="block w-full bg-indigo-600 text-white py-3 rounded-lg text-center hover:bg-indigo-700 transition duration-300 font-medium relative overflow-hidden group">
                                        <span class="relative z-10">Lihat Detail</span>
                                        <span
                                            class="absolute inset-0 h-full w-0 bg-indigo-800 transition-all duration-300 group-hover:w-full"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12">
                        <div class="max-w-md mx-auto text-center">
                            {{-- Placeholder untuk ilustrasi "tidak ada data" --}}
                            <div class="w-32 h-32 bg-indigo-100 rounded-full mx-auto flex items-center justify-center mb-6">
                                <i class="fas fa-search text-4xl text-indigo-300"></i>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                @if (request()->filled('search'))
                                    Lowongan Tidak Ditemukan
                                @else
                                    Belum Ada Lowongan
                                @endif
                            </h3>

                            <p class="text-gray-600 mb-6">
                                @if (request()->filled('search'))
                                    Pencarian untuk "{{ request('search') }}" tidak menemukan hasil. Silakan coba dengan
                                    kata kunci lain.
                                @else
                                    Saat ini belum ada lowongan magang kerjasama yang tersedia. Silakan cek kembali nanti.
                                @endif
                            </p>

                            @if (request()->filled('search'))
                                <a href="{{ route('mahasiswa.vacancies.index') }}"
                                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                                    <i class="fas fa-chevron-left mr-2"></i> Kembali ke Semua Lowongan
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Paginasi dengan style baru --}}
            @if ($vacancies->hasPages())
                <div class="mt-10">
                    <div class="bg-white rounded-xl shadow-md p-4">
                        {{ $vacancies->appends(request()->query())->links('vendor.pagination.tailwind') }}
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
    </style>
@endsection
