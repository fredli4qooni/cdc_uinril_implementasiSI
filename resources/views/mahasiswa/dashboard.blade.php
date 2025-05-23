{{-- resources/views/mahasiswa/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')

@push('styles')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Animasi untuk kartu */
        .hover-up:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        /* Animasi loading bar */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Animasi untuk icon */
        .hover-rotate:hover {
            transform: rotate(10deg);
            transition: transform 0.3s ease;
        }
    </style>
@endpush

@section('content')
    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 min-h-screen py-6 px-10">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-indigo-900">Dashboard Mahasiswa</h2>
                <div class="text-sm text-indigo-600">
                    <span id="currentDate" class="font-medium"></span>
                </div>
            </div>

            {{-- 1. Alert Profil Belum Lengkap --}}
            @if (!$isProfileComplete || !$isCvUploaded)
                <div
                    class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-lg shadow-sm transform transition-all duration-300 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400 text-xl mr-3 hover-rotate"></i>
                        </div>
                        <div>
                            <p class="text-yellow-700">
                                @if (!$isProfileComplete)
                                    Profil Anda belum lengkap ({{ $profileCompleteness }}%).
                                @elseif(!$isCvUploaded)
                                    Anda belum mengunggah CV.
                                @endif
                                <span class="font-medium">Harap lengkapi profil dan unggah CV Anda untuk dapat mendaftar
                                    lowongan magang.</span>
                            </p>
                            <a href="{{ route('mahasiswa.profile.edit') }}"
                                class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                                <i class="fas fa-user-edit mr-1.5"></i> Lengkapi Profil Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                {{-- Kolom Kiri: Profil & Pendaftaran --}}
                <div class="lg:col-span-7">
                    {{-- Card Profil Singkat --}}
                    <div
                        class="bg-white rounded-xl shadow-sm hover-up hover:shadow-lg transition-all duration-300 mb-6 overflow-hidden border border-indigo-100">
                        <div class="flex justify-between items-center px-6 py-4 border-b border-indigo-100">
                            <span class="font-medium text-indigo-800 flex items-center">
                                <i class="fas fa-user-circle text-indigo-600 mr-2"></i> Ringkasan Profil
                            </span>
                            <a href="{{ route('mahasiswa.profile.edit') }}"
                                class="inline-flex items-center px-3 py-1.5 border border-indigo-300 text-sm leading-4 font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-300">
                                <i class="fas fa-edit mr-1.5"></i> Edit Profil
                            </a>
                        </div>

                        <div class="px-6 py-5">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <img src="{{ Auth::user()->studentProfile->avatar_url ?? asset('images/default-avatar.png') }}"
                                        alt="Avatar"
                                        class="w-16 h-16 rounded-full border-2 border-indigo-300 object-cover">
                                </div>

                                <div class="flex-1">
                                    <h5 class="text-lg font-semibold mb-1 text-gray-800">{{ $user->name }}</h5>
                                    <p class="text-gray-600 mb-3">
                                        {{ $user->studentProfile->major ?? 'Jurusan belum diisi' }} - Angkatan
                                        {{ $user->studentProfile->entry_year ?? '?' }} <br>
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-id-card text-indigo-400 mr-1.5"></i> NPM:
                                            {{ $user->studentProfile->nim ?? 'NIM belum diisi' }}
                                        </span>
                                    </p>

                                    <div class="mb-4">
                                        <div class="flex justify-between mb-1">
                                            <label class="text-sm text-gray-600">Kelengkapan Profil</label>
                                            <span
                                                class="text-sm font-semibold text-indigo-700">{{ $profileCompleteness }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                            <div class="h-2.5 {{ $isProfileComplete ? 'bg-green-500' : 'bg-yellow-400 animate-pulse' }}"
                                                style="width: {{ $profileCompleteness }}%"></div>
                                        </div>
                                    </div>

                                    <div class="flex items-center mt-3">
                                        <i
                                            class="fas {{ $isCvUploaded ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-500' }} mr-2 text-lg"></i>
                                        <span class="text-sm {{ $isCvUploaded ? 'text-green-600' : 'text-red-600' }}">
                                            CV {{ $isCvUploaded ? 'Sudah Diunggah' : 'Belum Diunggah' }}
                                            @if ($isCvUploaded && $user->studentProfile->cv_path)
                                                (<a href="{{ Storage::url($user->studentProfile->cv_path) }}"
                                                    target="_blank"
                                                    class="text-indigo-600 hover:text-indigo-800 underline">Lihat</a>)
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card Ringkasan Pendaftaran --}}
                    <div
                        class="bg-white rounded-xl shadow-sm hover-up hover:shadow-lg transition-all duration-300 overflow-hidden border border-indigo-100">
                        <div class="px-6 py-4 border-b border-indigo-100">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-indigo-600 mr-2"></i>
                                <span class="font-medium text-indigo-800">Ringkasan Pendaftaran Magang</span>
                                <span
                                    class="ml-2 bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $totalApplications }}
                                    Total</span>
                            </div>
                        </div>

                        @if ($totalApplications > 0)
                            <div class="divide-y divide-gray-100">
                                @foreach ($applicationStatusSummary as $status => $count)
                                    @if ($count > 0)
                                        {{-- Hanya tampilkan status yg ada jumlahnya --}}
                                        <div
                                            class="px-6 py-3 flex justify-between items-center group hover:bg-indigo-50 transition-colors duration-200">
                                            <div class="flex items-center">
                                                @php
                                                    $badgeClass = 'bg-gray-500';
                                                    if ($status == 'pending') {
                                                        $badgeClass = 'bg-yellow-400';
                                                    } elseif ($status == 'accepted') {
                                                        $badgeClass = 'bg-green-500';
                                                    } elseif ($status == 'rejected') {
                                                        $badgeClass = 'bg-red-500';
                                                    } elseif ($status == 'interviewed') {
                                                        $badgeClass = 'bg-blue-500';
                                                    } elseif ($status == 'completed') {
                                                        $badgeClass = 'bg-indigo-500';
                                                    }
                                                @endphp
                                                <span class="w-3 h-3 rounded-full {{ $badgeClass }} mr-3"></span>
                                                <span
                                                    class="text-gray-700 group-hover:text-indigo-700 transition-colors duration-200">{{ ucfirst($status) }}</span>
                                            </div>
                                            <span
                                                class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $count }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="px-6 py-4 bg-gray-50 text-center">
                                <a href="{{ route('mahasiswa.applications.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                                    <i class="fas fa-history mr-1.5"></i> Lihat Semua Riwayat Pendaftaran
                                </a>
                            </div>
                        @else
                            <div class="px-6 py-8 text-center">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                    <i class="fas fa-file-alt text-2xl"></i>
                                </div>
                                <p class="text-gray-500 mb-4">Anda belum pernah mendaftar lowongan magang.</p>
                                <a href="{{ route('public.vacancies.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                                    <i class="fas fa-search mr-1.5"></i> Cari Lowongan Sekarang
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Kolom Kanan: Peluang Terbaru --}}
                <div class="lg:col-span-5">
                    {{-- Card Lowongan Terbaru --}}
                    <div
                        class="bg-white rounded-xl shadow-sm hover-up hover:shadow-lg transition-all duration-300 mb-6 overflow-hidden border border-indigo-100">
                        <div class="px-6 py-4 border-b border-indigo-100">
                            <div class="flex items-center">
                                <i class="fas fa-briefcase text-green-500 mr-2"></i>
                                <span class="font-medium text-gray-800">Lowongan Magang Terbaru</span>
                            </div>
                        </div>

                        @if ($latestVacancies->isNotEmpty())
                            <div class="divide-y divide-gray-100">
                                @foreach ($latestVacancies as $vacancy)
                                    <a href="{{ route('mahasiswa.vacancies.show', $vacancy->id) }}"
                                        class="block group hover:bg-indigo-50 transition-colors duration-200">
                                        <div class="px-6 py-4">
                                            <div class="flex justify-between mb-1">
                                                <h6
                                                    class="font-medium text-gray-800 group-hover:text-indigo-700 transition-colors duration-200">
                                                    {{ $vacancy->title }}</h6>
                                                <span
                                                    class="text-xs text-gray-500">{{ $vacancy->created_at->diffForHumans(null, true) }}</span>
                                            </div>
                                            <div class="flex flex-wrap text-sm text-gray-500">
                                                <span class="inline-flex items-center mr-3">
                                                    <i class="fas fa-building text-indigo-400 mr-1"></i>
                                                    {{ $vacancy->company->name ?? 'N/A' }}
                                                </span>
                                                <span class="inline-flex items-center">
                                                    <i class="fas fa-map-marker-alt text-indigo-400 mr-1"></i>
                                                    {{ $vacancy->location ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="px-6 py-4 bg-gray-50 text-center">
                                <a href="{{ route('public.vacancies.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-300">
                                    <i class="fas fa-search mr-1.5"></i> Lihat Semua Lowongan Magang
                                </a>
                            </div>
                        @else
                            <div class="px-6 py-8 text-center">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-500 mb-4">
                                    <i class="fas fa-briefcase text-2xl"></i>
                                </div>
                                <p class="text-gray-500">Saat ini belum ada lowongan magang baru.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Card Event/Loker Terbaru --}}
                    <div
                        class="bg-white rounded-xl shadow-sm hover-up hover:shadow-lg transition-all duration-300 overflow-hidden border border-indigo-100">
                        <div class="px-6 py-4 border-b border-indigo-100">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                <span class="font-medium text-gray-800">Event & Loker Umum Terbaru</span>
                            </div>
                        </div>

                        @if ($latestEvents->isNotEmpty())
                            <div class="divide-y divide-gray-100">
                                @foreach ($latestEvents as $event)
                                    <a href="{{ route('mahasiswa.events.show', $event->id) }}"
                                        class="block group hover:bg-indigo-50 transition-colors duration-200">
                                        <div class="px-6 py-4">
                                            <div class="flex justify-between mb-1">
                                                <h6
                                                    class="font-medium text-gray-800 group-hover:text-indigo-700 transition-colors duration-200">
                                                    {{ $event->title }}</h6>
                                                <span
                                                    class="text-xs text-gray-500">{{ $event->created_at->diffForHumans(null, true) }}</span>
                                            </div>
                                            <div class="flex flex-wrap items-center text-sm">
                                                <span
                                                    class="px-2 py-1 text-xs font-medium rounded {{ $event->type == 'event' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }} mr-2">
                                                    {{ ucfirst($event->type) }}
                                                </span>
                                                @if ($event->start_datetime)
                                                    <span class="inline-flex items-center text-gray-500">
                                                        <i class="fas fa-calendar-day text-indigo-400 mr-1"></i>
                                                        {{ $event->start_datetime->format('d M Y') }}
                                                    </span>
                                                @elseif($event->location)
                                                    <span class="inline-flex items-center text-gray-500">
                                                        <i class="fas fa-map-marker-alt text-indigo-400 mr-1"></i>
                                                        {{ $event->location }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="px-6 py-4 bg-gray-50 text-center">
                                <a href="{{ route('public.events.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                                    <i class="fas fa-calendar-alt mr-1.5"></i> Lihat Semua Event & Loker
                                </a>
                            </div>
                        @else
                            <div class="px-6 py-8 text-center">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-500 mb-4">
                                    <i class="fas fa-calendar-alt text-2xl"></i>
                                </div>
                                <p class="text-gray-500">Saat ini belum ada event atau loker umum baru.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            // Tampilkan tanggal saat ini
            document.addEventListener('DOMContentLoaded', function() {
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const today = new Date();
                document.getElementById('currentDate').textContent = today.toLocaleDateString('id-ID', options);

                // Tambahkan animasi untuk elemen-elemen
                const cards = document.querySelectorAll('.hover-up');
                cards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-5px)';
                    });

                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                    });
                });
            });
        </script>
    @endpush
@endsection
