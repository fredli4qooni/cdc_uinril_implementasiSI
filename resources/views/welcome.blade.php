{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')
@section('title', 'Selamat Datang di Career Development Center UIN RIL')

@section('content')
    {{-- Hero Section --}}
    <section
        class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 min-h-screen flex items-center overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60"
                viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg
                fill="%23ffffff" fill-opacity="0.4"%3E%3Ccircle cx="30" cy="30" r="4"
                /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        {{-- Floating Elements --}}
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 right-1/4 w-16 h-16 bg-white/10 rounded-full blur-lg animate-bounce"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center text-white">
                <div class="mb-8 animate-fade-in-up">
                    <h1
                        class="text-5xl md:text-7xl font-bold mb-4 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                        Career Development Center
                    </h1>
                    <h2 class="text-2xl md:text-3xl font-light mb-8 text-blue-100">
                        UIN Raden Intan Lampung
                    </h2>
                </div>

                <div class="mb-12 animate-fade-in-up delay-300">
                    <p class="text-lg md:text-xl leading-relaxed max-w-3xl mx-auto text-blue-50">
                        Temukan Peluang Karir Terbaik Anda Bersama Kami. <br>
                        Akses informasi magang, lowongan kerja, dan berbagai event pengembangan karir.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in-up delay-500">
                    <a href="{{ route('register') }}"
                        class="group relative bg-white text-blue-700 px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 hover:bg-blue-50 hover:scale-105 hover:shadow-xl transform">
                        <span class="relative z-10">Daftar Sebagai Mahasiswa</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                        </div>
                    </a>
                    <a href="{{ route('public.vacancies.index') }}"
                        class="group border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 hover:bg-white hover:text-blue-700 hover:scale-105 hover:shadow-xl transform">
                        Lihat Lowongan
                    </a>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    {{-- Section Statistik --}}
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group text-center">
                    <div
                        class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-briefcase text-2xl text-white"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-blue-600 mb-2">{{ $totalActiveVacancies ?? 0 }}+</h3>
                        <p class="text-gray-600 font-medium">Lowongan Magang Aktif</p>
                    </div>
                </div>

                <div class="group text-center">
                    <div
                        class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-building text-2xl text-white"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-green-600 mb-2">{{ $totalPartnerCompanies ?? 0 }}+</h3>
                        <p class="text-gray-600 font-medium">Perusahaan Mitra</p>
                    </div>
                </div>

                <div class="group text-center">
                    <div
                        class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-calendar-check text-2xl text-white"></i>
                        </div>
                        <h3 class="text-4xl font-bold text-purple-600 mb-2">
                            {{ \App\Models\Event::where('is_published', true)->count() }}+</h3>
                        <p class="text-gray-600 font-medium">Event & Loker Umum</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Lowongan Terbaru --}}
    @if ($latestVacancies->isNotEmpty())
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Lowongan Magang <span class="text-blue-600">Terbaru</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Jangan lewatkan kesempatan magang di perusahaan mitra terbaik kami.
                    </p>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 mx-auto mt-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($latestVacancies as $vacancy)
                        <div
                            class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:-translate-y-2">
                            {{-- Company Logo --}}
                            <div
                                class="h-24 bg-gradient-to-br from-gray-50 to-white flex items-center justify-center border-b border-gray-100">
                                @if ($vacancy->company->logo_path && Storage::disk('public')->exists($vacancy->company->logo_path))
                                    <img src="{{ Storage::url($vacancy->company->logo_path) }}"
                                        class="max-h-16 w-auto object-contain group-hover:scale-110 transition-transform duration-300"
                                        alt="{{ $vacancy->company->name }} Logo">
                                @else
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-building text-2xl text-blue-500"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <h3
                                    class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ Str::limit($vacancy->title, 50) }}
                                </h3>
                                <p class="text-gray-600 font-medium mb-4 flex items-center">
                                    <i class="fas fa-building text-blue-500 mr-2"></i>
                                    {{ $vacancy->company->name ?? 'N/A' }}
                                </p>

                                <div class="space-y-2 mb-6">
                                    <p class="text-sm text-gray-500 flex items-center">
                                        <i class="fas fa-map-marker-alt text-red-400 mr-2"></i>
                                        {{ $vacancy->location ?? 'N/A' }}
                                    </p>
                                    @if ($vacancy->deadline)
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-calendar-times text-orange-400 mr-2"></i>
                                            Deadline: {{ $vacancy->deadline->format('d M Y') }}
                                        </p>
                                    @endif
                                </div>

                                <a href="{{ route('mahasiswa.vacancies.show', $vacancy->id) }}"
                                    class="block w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-center py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 hover:shadow-lg transform hover:scale-105">
                                    Detail & Daftar
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('public.vacancies.index') }}"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-full hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 hover:shadow-lg transform hover:scale-105">
                        <span>Lihat Semua Lowongan Magang</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Section Event Terbaru --}}
    @if ($latestEvents->isNotEmpty())
        <section class="py-20 bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/30">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Event & <span class="text-indigo-600">Loker Umum</span> Terbaru
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Update informasi karir dan pengembangan diri Anda.
                    </p>
                    <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto mt-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($latestEvents as $event)
                        <div
                            class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:-translate-y-2">
                            {{-- Event Image --}}
                            <div class="h-48 overflow-hidden relative">
                                @if ($event->image_path && Storage::disk('public')->exists($event->image_path))
                                    <img src="{{ Storage::url($event->image_path) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        alt="{{ $event->title }}">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br {{ $event->type == 'event' ? 'from-blue-400 to-indigo-500' : 'from-yellow-400 to-orange-500' }} flex items-center justify-center">
                                        @if ($event->type == 'event')
                                            <i class="fas fa-calendar-alt text-6xl text-white/80"></i>
                                        @else
                                            <i class="fas fa-briefcase text-6xl text-white/80"></i>
                                        @endif
                                    </div>
                                @endif

                                {{-- Badge --}}
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-semibold {{ $event->type == 'event' ? 'bg-blue-500 text-white' : 'bg-yellow-400 text-gray-800' }}">
                                        {{ $event->type == 'event' ? 'Event' : 'Loker Umum' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3
                                    class="text-xl font-bold text-gray-800 mb-3 group-hover:text-indigo-600 transition-colors duration-300">
                                    {{ Str::limit($event->title, 55) }}
                                </h3>

                                <div class="space-y-2 mb-6">
                                    @if ($event->start_datetime)
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-calendar-alt text-blue-400 mr-2"></i>
                                            {{ $event->start_datetime->format('d M Y') }}
                                        </p>
                                    @endif
                                    @if ($event->location)
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-map-marker-alt text-red-400 mr-2"></i>
                                            {{ $event->location }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Action Button -->
                                <div class="mt-auto">
                                    @guest
                                        <a href="{{ route('login', ['redirect' => route('mahasiswa.events.show', $event->id)]) }}"
                                            class="block w-full text-center bg-gradient-to-r from-gray-100 to-gray-200 hover:from-blue-50 hover:to-blue-100 text-gray-700 hover:text-blue-700 font-semibold py-3 px-4 rounded-xl transition-all duration-200 border border-gray-200">
                                            Login untuk Detail
                                        </a>
                                    @else
                                        <a href="{{ route('mahasiswa.events.show', $event->id) }}"
                                            class="block w-full text-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-md hover:shadow-lg">
                                            Lihat Detail
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('public.events.index') }}"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-full hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 hover:shadow-lg transform hover:scale-105">
                        <span>Lihat Semua Event & Loker</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Section Ajakan untuk Perusahaan --}}
    <section class="py-20 bg-gradient-to-br from-green-50 to-emerald-50 relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="40"
                height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23059669"
                fill-opacity="0.4" fill-rule="evenodd"%3E%3Cpath d="m0 40l40-40h-40v40zm40 0v-40h-40l40 40z"
                /%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Bermitra dengan <span class="text-green-600">CDC UIN RIL</span>
                    </h2>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Jangkau talenta-talenta terbaik dari UIN Raden Intan Lampung untuk kebutuhan magang dan rekrutmen
                        perusahaan Anda.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <div
                                class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1 mr-4 flex-shrink-0">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <p class="text-gray-700">Publikasikan lowongan magang Anda secara gratis.</p>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1 mr-4 flex-shrink-0">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <p class="text-gray-700">Kelola pendaftar dengan mudah melalui dashboard perusahaan.</p>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1 mr-4 flex-shrink-0">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <p class="text-gray-700">Berkontribusi dalam pengembangan karir mahasiswa.</p>
                        </div>
                    </div>

                    <a href="{{ route('company.login') }}"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-full hover:from-green-700 hover:to-emerald-700 transition-all duration-300 hover:shadow-lg transform hover:scale-105">
                        <i class="fas fa-handshake mr-3"></i>
                        <span>Login / Hubungi Kami (Perusahaan)</span>
                    </a>
                </div>

                <div class="text-center lg:text-right">
                    {{-- Placeholder untuk ilustrasi atau bisa diganti dengan gambar asli --}}
                    <div class="relative">
                        <div
                            class="w-80 h-80 mx-auto bg-gradient-to-br from-green-400 to-emerald-500 rounded-3xl flex items-center justify-center shadow-2xl">
                            <i class="fas fa-handshake text-8xl text-white/80"></i>
                        </div>
                        {{-- Floating elements --}}
                        <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-200 rounded-full opacity-60 animate-pulse">
                        </div>
                        <div
                            class="absolute -bottom-4 -left-4 w-20 h-20 bg-emerald-200 rounded-full opacity-40 animate-pulse delay-1000">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Custom CSS untuk animasi --}}
    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }
    </style>

@endsection
