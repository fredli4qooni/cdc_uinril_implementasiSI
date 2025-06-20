<section class="relative min-h-screen overflow-hidden bg-white">
    <!-- Ultra Futuristic Background Effects -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Animated Neural Network Lines -->
        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="80" height="80" patternUnits="userSpaceOnUse">
                    <path d="M 80 0 L 0 0 0 80" fill="none" stroke="rgba(59, 130, 246, 0.1)" stroke-width="1" />
                </pattern>
                <linearGradient id="nodeGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.4" />
                    <stop offset="100%" style="stop-color:#6366F1;stop-opacity:0.6" />
                </linearGradient>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />

            <!-- Animated Connection Lines -->
            <g class="animate-pulse">
                <line x1="10%" y1="20%" x2="30%" y2="40%" stroke="url(#nodeGradient)"
                    stroke-width="2" opacity="0.6" />
                <line x1="30%" y1="40%" x2="60%" y2="30%" stroke="url(#nodeGradient)"
                    stroke-width="2" opacity="0.6" />
                <line x1="60%" y1="30%" x2="80%" y2="60%" stroke="url(#nodeGradient)"
                    stroke-width="2" opacity="0.6" />
                <line x1="20%" y1="70%" x2="50%" y2="80%" stroke="url(#nodeGradient)"
                    stroke-width="2" opacity="0.6" />
            </g>

            <!-- Animated Nodes -->
            <circle cx="10%" cy="20%" r="4" fill="url(#nodeGradient)" class="animate-ping" />
            <circle cx="30%" cy="40%" r="6" fill="url(#nodeGradient)" class="animate-pulse" />
            <circle cx="60%" cy="30%" r="5" fill="url(#nodeGradient)" class="animate-bounce" />
            <circle cx="80%" cy="60%" r="4" fill="url(#nodeGradient)" class="animate-ping" />
            <circle cx="20%" cy="70%" r="3" fill="url(#nodeGradient)" class="animate-pulse" />
        </svg>

        <!-- Floating Holographic Elements -->
        <div
            class="absolute top-20 left-16 w-64 h-64 bg-gradient-to-r from-blue-400/20 to-cyan-400/20 rounded-full blur-3xl animate-float">
        </div>
        <div
            class="absolute bottom-32 right-20 w-80 h-80 bg-gradient-to-l from-indigo-400/20 to-purple-400/20 rounded-full blur-3xl animate-float-reverse">
        </div>
        <div
            class="absolute top-1/2 left-1/4 w-32 h-32 bg-gradient-to-br from-cyan-300/30 to-blue-300/30 rounded-full blur-2xl animate-pulse">
        </div>

        <!-- Digital Particles -->
        <div class="absolute top-24 right-40 w-2 h-2 bg-blue-500 rounded-full animate-ping"></div>
        <div class="absolute bottom-56 left-32 w-1 h-1 bg-indigo-500 rounded-full animate-bounce delay-300"></div>
        <div class="absolute top-80 left-1/2 w-3 h-3 bg-cyan-500 rounded-full animate-pulse delay-700"></div>
        <div class="absolute bottom-40 right-1/3 w-2 h-2 bg-purple-500 rounded-full animate-ping delay-1000"></div>

        <!-- Scanning Beam Effects -->
        <div class="absolute inset-0 pointer-events-none">
            <div
                class="absolute w-full h-0.5 bg-gradient-to-r from-transparent via-blue-400/50 to-transparent animate-scan-horizontal">
            </div>
            <div
                class="absolute w-0.5 h-full bg-gradient-to-b from-transparent via-indigo-400/50 to-transparent animate-scan-vertical">
            </div>
        </div>

        <!-- Holographic Overlay -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-blue-50/30 via-transparent to-indigo-50/30 pointer-events-none">
        </div>
    </div>

    <div class="container mx-auto px-6 relative z-10 min-h-screen flex flex-col justify-center">
        <!-- Main Content Grid -->
        <div class="grid grid-cols-12 gap-8 mt-10 items-center">

            <!-- Left Section - Enhanced Brand & CTA -->
            <div class="col-span-12 lg:col-span-6 space-y-10">
                <!-- Futuristic Logo Section -->
                <div class="animate-fade-in-up">
                    <!-- Enhanced Typography -->
                    <div class="space-y-6">
                        <h1 class="text-6xl md:text-8xl font-black leading-none">
                            <span
                                class="block bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent relative">
                                CAREER
                                <div
                                    class="absolute -inset-2 bg-gradient-to-r from-blue-600/10 via-indigo-600/10 to-purple-600/10 blur-xl">
                                </div>
                            </span>
                            <span class="block text-3xl md:text-4xl font-light text-gray-600 mt-4 tracking-wider">
                                Development Center
                            </span>
                        </h1>

                        <div class="relative">
                            <p class="text-xl md:text-2xl text-gray-700 leading-relaxed max-w-2xl">
                                <span class="text-blue-600 font-bold text-2xl">Temukan Peluang Karir</span> bersama kami
                                <br>Akses Informasi <span
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent font-bold">Kerjasama
                                    Magang</span>
                                dengan <span class="text-blue-500 font-semibold">perusahaan terkemuka</span> untuk
                                membangun
                                <span class="text-cyan-600 font-semibold">Karir impian anda </span> dan <span
                                    class="text-indigo-600 font-semibold">Berbagai </span>Event menarik lainnya.
                            </p>
                            <!-- Decorative Elements -->
                            <div
                                class="absolute -right-4 top-0 w-1 h-full bg-gradient-to-b from-blue-400 to-indigo-500 rounded-full opacity-30">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Futuristic CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 animate-fade-in-up delay-300">
                    <a href="{{ route('register') }}" class="group relative overflow-hidden">
                        <!-- Main Button -->
                        <div
                            class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white px-10 py-5 rounded-2xl font-bold text-lg transition-all duration-500 hover:scale-105 shadow-2xl hover:shadow-blue-500/50">
                            <!-- Holographic Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-white/20 via-transparent to-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <!-- Content -->
                            <span class="relative z-10 flex items-center justify-center gap-4">
                                <i class="fas fa-rocket text-xl"></i>
                                <span>Daftar Sekarang</span>
                                <div class="w-2 h-2 bg-white rounded-full animate-ping"></div>
                            </span>
                            <!-- Scanning Effect -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                            </div>
                        </div>
                        <!-- Glow Effect -->
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur opacity-30 group-hover:opacity-60 transition-opacity duration-500 -z-10">
                        </div>
                    </a>

                    <a href="{{ route('public.vacancies.index') }}" class="group relative">
                        <!-- Glass Morphism Button -->
                        <div
                            class="relative border-2 border-blue-400/50 text-blue-600 px-10 py-5 rounded-2xl font-bold text-lg transition-all duration-500 hover:border-blue-500 hover:scale-105 backdrop-blur-sm bg-white/30 hover:bg-white/50 shadow-xl">
                            <span class="flex items-center justify-center gap-4">
                                <i class="fas fa-search-plus text-xl"></i>
                                <span>Jelajahi Peluang</span>
                            </span>
                            <!-- Scanning Line -->
                            <div
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-indigo-500 group-hover:w-full transition-all duration-700">
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Right Section - Enhanced Student Showcase -->
            <div class="col-span-12 lg:col-span-6 space-y-8 p-4 lg:p-8">
                <div class="animate-fade-in-up delay-500">
                    <div class="relative">
                        <!-- Holographic Frame -->
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-blue-400/20 via-indigo-400/20 to-purple-400/20 rounded-3xl blur-2xl">
                        </div>

                        <!-- Main Image Container -->
                        <div
                            class="relative bg-white/40 backdrop-blur-xl rounded-3xl p-6 border border-white/50 shadow-2xl">
                            <!-- Corner Decorations -->
                            <div class="absolute top-4 left-4 w-6 h-6 border-l-2 border-t-2 border-blue-400"></div>
                            <div class="absolute top-4 right-4 w-6 h-6 border-r-2 border-t-2 border-blue-400"></div>
                            <div class="absolute bottom-4 left-4 w-6 h-6 border-l-2 border-b-2 border-blue-400"></div>
                            <div class="absolute bottom-4 right-4 w-6 h-6 border-r-2 border-b-2 border-blue-400"></div>

                            <!-- Student Image -->
                            <div class="relative overflow-hidden rounded-2xl">
                                <img src="{{ asset('images/mahasiswa.png') }}" alt="Future Career Student"
                                    class="w-full h-auto object-contain transform hover:scale-105 transition-transform duration-700">

                                <!-- Digital Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-blue-600/10 via-transparent to-indigo-600/10 pointer-events-none">
                                </div>
                            </div>
                        </div>

                        <!-- Floating Tech Elements -->
                        <div
                            class="absolute -top-6 -right-6 w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl animate-spin-slow flex items-center justify-center shadow-lg">
                            <i class="fas fa-microchip text-white"></i>
                        </div>
                        <div
                            class="absolute -bottom-4 -left-4 w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg animate-bounce flex items-center justify-center shadow-lg">
                            <i class="fas fa-brain text-white text-sm"></i>
                        </div>
                        <div
                            class="absolute top-1/2 -right-8 w-8 h-8 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full animate-pulse flex items-center justify-center shadow-lg">
                            <i class="fas fa-wifi text-white text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ultra-Modern Statistics Grid -->
        <div class="animate-fade-in-up delay-700 mt-24">
            <div class="grid grid-cols-1 md:grid-cols-7 gap-8 max-w-7xl mx-auto">

                <!-- Primary Stat Card -->
                <div class="md:col-span-3 group">
                    <div
                        class="relative h-56 bg-white/60 backdrop-blur-2xl rounded-3xl p-8 border border-white/50 hover:border-blue-300/50 transition-all duration-700 hover:scale-105 shadow-2xl hover:shadow-blue-500/20 overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-5">
                            <div class="absolute inset-0"
                                style="background-image: radial-gradient(circle at 25% 25%, #3b82f6 2px, transparent 2px); background-size: 20px 20px;">
                            </div>
                        </div>

                        <!-- Holographic Corner -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-transparent rounded-full -translate-y-16 translate-x-16">
                        </div>

                        <div class="relative z-10 h-full flex flex-col justify-between">
                            <div class="flex items-center justify-between mb-6">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:rotate-12 transition-transform duration-500">
                                    <i class="fas fa-briefcase text-2xl text-white"></i>
                                </div>
                                <div class="text-right">
                                    <div
                                        class="text-5xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                        {{ $totalActiveVacancies ?? 0 }}
                                    </div>
                                    <div class="text-blue-600 text-sm font-mono tracking-wider">ACTIVE NOW</div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="text-gray-800 font-bold text-lg">Peluang Magang</div>
                                
                            </div>
                        </div>

                        <!-- Scanning Effect -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1500">
                        </div>
                    </div>
                </div>

                <!-- Secondary Stat Cards -->
                <div class="md:col-span-2 group">
                    <div
                        class="relative h-56 bg-white/60 backdrop-blur-2xl rounded-3xl p-6 border border-white/50 hover:border-indigo-300/50 transition-all duration-700 hover:scale-105 shadow-2xl hover:shadow-indigo-500/20">
                        <div class="text-center h-full flex flex-col justify-between">
                            <!-- Icon with Glow -->
                            <div class="relative mx-auto mb-4">
                                <div
                                    class="w-18 h-18 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-500 shadow-2xl">
                                    <i class="fas fa-building text-2xl text-white"></i>
                                </div>
                                <div
                                    class="absolute -inset-2 bg-gradient-to-r from-indigo-500/30 to-purple-600/30 rounded-3xl blur opacity-50 group-hover:opacity-80 transition-opacity duration-500">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div
                                    class="text-4xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    {{ $totalPartnerCompanies ?? 0 }}+
                                </div>
                                <div class="text-indigo-600 text-sm font-bold tracking-wide">Perusahaan Mitra</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 group">
                    <div
                        class="relative h-56 bg-white/60 backdrop-blur-2xl rounded-3xl p-6 border border-white/50 hover:border-cyan-300/50 transition-all duration-700 hover:scale-105 shadow-2xl hover:shadow-cyan-500/20">
                        <div class="text-center h-full flex flex-col justify-between">
                            <!-- Icon with Glow -->
                            <div class="relative mx-auto mb-4">
                                <div
                                    class="w-18 h-18 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-3xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-500 shadow-2xl">
                                    <i class="fas fa-calendar-check text-2xl text-white"></i>
                                </div>
                                <div
                                    class="absolute -inset-2 bg-gradient-to-r from-cyan-500/30 to-blue-600/30 rounded-3xl blur opacity-50 group-hover:opacity-80 transition-opacity duration-500">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div
                                    class="text-4xl font-black bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">
                                    {{ \App\Models\Event::where('is_published', true)->count() }}+
                                </div>
                                <div class="text-cyan-600 text-sm font-bold tracking-wide">Event Karir</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Partner Logos Section -->
        @if ($partnerLogos->isNotEmpty())
            <div class="animate-fade-in-up delay-1000 mt-24">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center space-x-4 mb-6">
                        <div class="w-12 h-px bg-gradient-to-r from-transparent to-blue-400"></div>
                        <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                        <div class="w-12 h-px bg-gradient-to-l from-transparent to-blue-400"></div>
                    </div>

                    <h3 class="text-4xl md:text-5xl font-black mb-6">
                        <span
                            class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Mitra Strategis
                        </span>
                    </h3>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Berkolaborasi dengan <span class="text-blue-600 font-bold">perusahaan teknologi terdepan</span>
                        untuk masa depan yang lebih cerah
                    </p>
                </div>

                <div
                    class="relative max-w-7xl mx-auto bg-white/40 backdrop-blur-2xl rounded-3xl p-10 border border-white/50 shadow-2xl">
                    <!-- Decorative Corner Elements -->
                    <div class="absolute top-6 left-6 w-8 h-8 border-l-2 border-t-2 border-blue-400 rounded-tl-lg">
                    </div>
                    <div class="absolute top-6 right-6 w-8 h-8 border-r-2 border-t-2 border-blue-400 rounded-tr-lg">
                    </div>
                    <div class="absolute bottom-6 left-6 w-8 h-8 border-l-2 border-b-2 border-blue-400 rounded-bl-lg">
                    </div>
                    <div class="absolute bottom-6 right-6 w-8 h-8 border-r-2 border-b-2 border-blue-400 rounded-br-lg">
                    </div>

                    <div id="partnerLogoCarousel" class="carousel slide" data-bs-ride="carousel"
                        data-bs-interval="4000">
                        <div class="carousel-inner">
                            @php
                                $logosPerSlide = 5;
                                $chunkedLogos = $partnerLogos->chunk($logosPerSlide);
                            @endphp

                            @foreach ($chunkedLogos as $index => $logoChunk)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="flex justify-center items-center space-x-16 py-10">
                                        @foreach ($logoChunk as $company)
                                            <a href="{{ $company->website ?? '#' }}" target="_blank"
                                                rel="noopener noreferrer" title="{{ $company->name }}"
                                                class="flex-shrink-0 group">
                                                <div
                                                    class="relative bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-white/60 hover:border-blue-300/60 transition-all duration-500 hover:scale-110 hover:bg-white shadow-xl hover:shadow-2xl">
                                                    <!-- Holographic Border -->
                                                    <div
                                                        class="absolute -inset-1 bg-gradient-to-r from-blue-400/20 to-indigo-500/20 rounded-3xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                                    </div>

                                                    <img src="{{ Storage::url($company->logo_path) }}"
                                                        alt="{{ $company->name }} Logo"
                                                        class="h-16 w-auto object-contain opacity-60 group-hover:opacity-100 transition-all duration-500 relative z-10">

                                                    <!-- Company Name -->
                                                    <div
                                                        class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                        <div
                                                            class="bg-gray-800 text-white text-xs px-3 py-1 rounded-full whitespace-nowrap">
                                                            {{ $company->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Futuristic Navigation Controls -->
                        @if (count($chunkedLogos) > 1)
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#partnerLogoCarousel" data-bs-slide="prev">
                                <div
                                    class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center hover:scale-110 transition-all duration-300 shadow-2xl hover:rotate-12 border border-blue-300/50 backdrop-blur-sm group">
                                    <i class="fas fa-chevron-left text-white text-xl group-hover:text-blue-100"></i>
                                    <div
                                        class="absolute inset-0 bg-white/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#partnerLogoCarousel" data-bs-slide="next">
                                <div
                                    class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center hover:scale-110 transition-all duration-300 shadow-2xl hover:-rotate-12 border border-blue-300/50 backdrop-blur-sm group">
                                    <i class="fas fa-chevron-right text-white text-xl group-hover:text-blue-100"></i>
                                    <div
                                        class="absolute inset-0 bg-white/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    /* Enhanced Animations */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(60px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scan-horizontal {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }

    @keyframes scan-vertical {
        0% {
            top: -100%;
        }

        100% {
            top: 100%;
        }
    }

    @keyframes scan-logo {
        0% {
            transform: translateY(-100%) skewY(-10deg);
            opacity: 0;
        }

        50% {
            opacity: 0.6;
        }

        100% {
            transform: translateY(100%) skewY(-10deg);
            opacity: 0;
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        33% {
            transform: translateY(-20px) rotate(2deg);
        }

        66% {
            transform: translateY(-10px) rotate(-2deg);
        }
    }

    @keyframes float-reverse {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        33% {
            transform: translateY(15px) rotate(-2deg);
        }

        66% {
            transform: translateY(25px) rotate(2deg);
        }
    }

    @keyframes spin-slow {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    /* Custom Classes */
    .animate-fade-in-up {
        animation: fade-in-up 1.2s ease-out forwards;
        opacity: 0;
    }

    .animate-scan-horizontal {
        animation: scan-horizontal 4s linear infinite;
    }

    .animate-scan-vertical {
        animation: scan-vertical 5s linear infinite;
    }

    .animate-scan-logo {
        animation: scan-logo 3s linear infinite;
    }

    .animate-float {
        animation: float 8s ease-in-out infinite;
    }

    .animate-float-reverse {
        animation: float-reverse 10s ease-in-out infinite;
    }

    .animate-spin-slow {
        animation: spin-slow 20s linear infinite;
    }

    .animate-shimmer::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        animation: shimmer 2s infinite;
    }

    /* Delay Classes */
    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    .delay-400 {
        animation-delay: 0.4s;
    }

    .delay-500 {
        animation-delay: 0.5s;
    }

    .delay-700 {
        animation-delay: 0.7s;
    }

    .delay-1000 {
        animation-delay: 1s;
    }

    .delay-1200 {
        animation-delay: 1.2s;
    }

    /* SVG Gradients */
    svg defs {
        display: none;
    }

    /* Carousel Controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: auto;
        top: 50%;
        transform: translateY(-50%);
    }

    .carousel-control-prev {
        left: -100px;
    }

    .carousel-control-next {
        right: -100px;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .carousel-control-prev {
            left: -60px;
        }

        .carousel-control-next {
            right: -60px;
        }
    }

    @media (max-width: 768px) {
        .carousel-control-prev {
            left: -30px;
        }

        .carousel-control-next {
            right: -30px;
        }

        .grid-cols-12 .col-span-7,
        .grid-cols-12 .col-span-5 {
            grid-column: span 12;
        }
    }

    /* Enhanced Glassmorphism */
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
    }

    .backdrop-blur-2xl {
        backdrop-filter: blur(40px);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(243, 244, 246, 0.5);
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #3b82f6, #6366f1);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #2563eb, #4f46e5);
    }

    /* Selection Colors */
    ::selection {
        background: rgba(59, 130, 246, 0.2);
        color: #1e40af;
    }

    /* Focus States */
    a:focus,
    button:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }
</style>

<!-- Additional CSS for SVG Gradients -->
<svg width="0" height="0" style="position: absolute;">
    <defs>
        <linearGradient id="indigo-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" style="stop-color:#6366F1;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#8B5CF6;stop-opacity:1" />
        </linearGradient>
    </defs>
</svg>
