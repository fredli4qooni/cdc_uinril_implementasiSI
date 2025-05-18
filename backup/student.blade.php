<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Mahasiswa')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts - Classic Serif Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lora:ital,wght@0,400;0,700;1,400&display=swap">
    
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              sepia: {
                50: '#f8f5f0',
                100: '#e8e0d0',
                200: '#d8cbb0',
                300: '#c9b690',
                400: '#b9a170',
                500: '#a98c50',
                600: '#8c7340',
                700: '#6f5a30',
                800: '#524220',
                900: '#352910',
              },
              vintage: {
                red: '#8c3130',
                gold: '#b9a170',
                cream: '#f8f5f0',
                brown: '#5e4b3c',
                navy: '#2a3b55',
              }
            },
            fontFamily: {
              'serif': ['Playfair Display', 'Georgia', 'serif'],
              'serif-body': ['Lora', 'Times New Roman', 'serif'],
            },
            backgroundImage: {
              'parchment': "url('data:image/svg+xml,%3Csvg width=\"100\" height=\"100\" viewBox=\"0 0 100 100\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cfilter id=\"noise\"%3E%3CfeTurbulence type=\"fractalNoise\" baseFrequency=\"0.65\" numOctaves=\"3\" stitchTiles=\"stitch\"/%3E%3CfeColorMatrix type=\"matrix\" values=\"1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 0.15 0\" /%3E%3C/filter%3E%3Crect width=\"100\" height=\"100\" filter=\"url(%23noise)\" fill=\"%23f8f5f0\"/%3E%3C/svg%3E')",
            },
            boxShadow: {
              'vintage': '2px 3px 0 rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(139, 113, 70, 0.15)',
              'vintage-hover': '3px 4px 0 rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(139, 113, 70, 0.25)',
            }
          }
        }
      }
    </script>

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
        }
        ::-webkit-scrollbar-track {
            background: #f8f5f0;
            border: 1px solid #d8cbb0;
        }
        ::-webkit-scrollbar-thumb {
            background: #b9a170;
            border: 2px solid #f8f5f0;
            border-radius: 0;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #8c7340;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        /* Vintage paper texture and stamp effect */
        .vintage-bg {
            background-color: #f8f5f0;
            background-image: url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noise"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3CfeColorMatrix type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 0.15 0" /%3E%3C/filter%3E%3Crect width="100" height="100" filter="url(%23noise)" fill="%23f8f5f0"/%3E%3C/svg%3E');
        }
        
        /* Typewriter effect */
        .typewriter-effect {
            position: relative;
            overflow: hidden;
        }
        
        .typewriter-effect:hover::after {
            content: '';
            position: absolute;
            right: -4px;
            top: 50%;
            height: 50%;
            width: 2px;
            background: #5e4b3c;
            animation: typewriter-blink 0.8s infinite;
            transform: translateY(-50%);
        }
        
        @keyframes typewriter-blink {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }
        
        /* Page flip animation */
        .page-flip {
            transition: transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            transform-origin: center left;
        }
        
        .page-flip:hover {
            transform: rotateY(-10deg);
        }
        
        /* Vintage stamp effect */
        .stamp-effect {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .stamp-effect:hover {
            transform: translateY(-2px);
        }
        
        .stamp-effect::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border: 1px dashed rgba(139, 113, 70, 0.5);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .stamp-effect:hover::before {
            opacity: 1;
        }
        
        /* Dashed border effect */
        .dashed-border {
            background-image: repeating-linear-gradient(to right, #8c7340 0%, #8c7340 50%, transparent 50%, transparent 100%);
            background-size: 8px 1px;
            background-repeat: repeat-x;
            background-position: bottom;
        }
        
        /* Vintage button styles */
        .vintage-button {
            position: relative;
            transition: all 0.2s ease;
            transform-style: preserve-3d;
        }
        
        .vintage-button:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body class="vintage-bg font-serif-body text-vintage-brown min-h-screen flex flex-col antialiased">
    <div id="app" class="flex flex-col min-h-screen">
        <!-- Top Header Banner - Newspaper Style -->
        <div class="bg-vintage-cream border-b-4 border-vintage-gold border-double hidden md:block">
            <div class="max-w-7xl mx-auto py-2 px-4 flex justify-between items-center">
                <div class="text-xs uppercase tracking-widest">Vol. XXIV • Est. 2025</div>
                <div class="text-xs">{{ date('l, F j, Y') }}</div>
            </div>
        </div>
        
        <!-- Main Navbar -->
        <nav class="bg-vintage-cream shadow-vintage border-b border-sepia-200 sticky top-0 left-0 right-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo and Brand -->
                    <div class="flex items-center">
                        <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center page-flip">
                            <div class="h-10 w-10 bg-vintage-gold rounded-full flex items-center justify-center border-2 border-sepia-800 mr-3 shadow-vintage">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sepia-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xl font-serif font-bold tracking-tight text-vintage-navy leading-none">CDC UIN RIL</span>
                                <div class="text-xs italic text-sepia-700 tracking-wide">Biro Penempatan Karirmu</div>
                            </div>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden sm:flex sm:items-center sm:space-x-1">
                        <div class="flex">
                            <a href="{{ route('mahasiswa.dashboard') }}" class="group vintage-button stamp-effect mx-1 py-2 px-3 {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-sepia-100 text-vintage-brown' : 'text-sepia-800 hover:text-vintage-brown' }}">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center typewriter-effect">
                                        <i class="fas fa-home text-sm mr-2 text-vintage-gold"></i>
                                        <span class="font-serif tracking-wide">Dashboard</span>
                                    </div>
                                    <div class="h-0.5 bg-vintage-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 mt-1"></div>
                                </div>
                            </a>
                            
                            <a href="{{ route('mahasiswa.vacancies.index') }}" class="group vintage-button stamp-effect mx-1 py-2 px-3 {{ request()->routeIs('mahasiswa.vacancies.*') ? 'bg-sepia-100 text-vintage-brown' : 'text-sepia-800 hover:text-vintage-brown' }}">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center typewriter-effect">
                                        <i class="fas fa-briefcase text-sm mr-2 text-vintage-gold"></i>
                                        <span class="font-serif tracking-wide">Lowongan Magang</span>
                                    </div>
                                    <div class="h-0.5 bg-vintage-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 mt-1"></div>
                                </div>
                            </a>
                            
                            <a href="{{ route('mahasiswa.events.index') }}" class="group vintage-button stamp-effect mx-1 py-2 px-3 {{ request()->routeIs('mahasiswa.events.*') ? 'bg-sepia-100 text-vintage-brown' : 'text-sepia-800 hover:text-vintage-brown' }}">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center typewriter-effect">
                                        <i class="fas fa-calendar-alt text-sm mr-2 text-vintage-gold"></i>
                                        <span class="font-serif tracking-wide">Event & Loker</span>
                                    </div>
                                    <div class="h-0.5 bg-vintage-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 mt-1"></div>
                                </div>
                            </a>
                            
                            <a href="{{ route('mahasiswa.applications.index') }}" class="group vintage-button stamp-effect mx-1 py-2 px-3 {{ request()->routeIs('mahasiswa.applications.*') ? 'bg-sepia-100 text-vintage-brown' : 'text-sepia-800 hover:text-vintage-brown' }}">
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center typewriter-effect">
                                        <i class="fas fa-file-alt text-sm mr-2 text-vintage-gold"></i>
                                        <span class="font-serif tracking-wide">Status Pendaftaran</span>
                                    </div>
                                    <div class="h-0.5 bg-vintage-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 mt-1"></div>
                                </div>
                            </a>
                        </div>

                        <!-- Profile Dropdown -->
                        <div x-data="{ open: false }" class="relative ml-3">
                            <button 
                                @click="open = !open" 
                                class="flex items-center vintage-button bg-sepia-50 border border-sepia-200 rounded-sm shadow-vintage hover:shadow-vintage-hover px-3 py-2 transition-all duration-300 focus:outline-none"
                            >
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-vintage-navy rounded-full flex items-center justify-center text-vintage-cream mr-2">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <span class="font-serif text-vintage-brown">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down ml-2 text-xs text-sepia-500"></i>
                                </div>
                            </button>

                            <div 
                                x-show="open" 
                                @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-56 border border-sepia-200 rounded-sm shadow-vintage bg-vintage-cream divide-y divide-sepia-200"
                            >
                                <div class="px-4 py-3 bg-sepia-50">
                                    <p class="text-sm font-medium text-vintage-brown font-serif">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-sepia-600 italic mt-1">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('mahasiswa.profile.edit') }}" class="block px-4 py-2 text-sm text-sepia-800 hover:bg-sepia-100 group">
                                        <div class="flex items-center">
                                            <i class="fas fa-user-edit fa-fw mr-2 text-vintage-gold"></i> 
                                            <span class="typewriter-effect">Edit Profil</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-2 text-sm text-vintage-red hover:bg-sepia-100 group"
                                    >
                                        <div class="flex items-center">
                                            <i class="fas fa-sign-out-alt fa-fw mr-2"></i>
                                            <span class="typewriter-effect">Logout</span>
                                        </div>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button 
                            x-data="{ mobileMenuOpen: false }"
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="vintage-button inline-flex items-center justify-center p-2 border border-sepia-200 rounded-sm shadow-vintage text-sepia-800"
                        >
                            <span class="sr-only">Open main menu</span>
                            <i x-show="!mobileMenuOpen" class="fas fa-bars h-6 w-6"></i>
                            <i x-show="mobileMenuOpen" class="fas fa-times h-6 w-6"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-data="{ mobileMenuOpen: false }" x-show="mobileMenuOpen" class="sm:hidden border-t border-sepia-200 bg-sepia-50">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="vintage-button block px-3 py-2 text-base {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-sepia-100 text-vintage-brown border-l-4 border-vintage-gold pl-2' : 'text-sepia-800' }}">
                        <div class="flex items-center">
                            <i class="fas fa-home mr-3 text-vintage-gold"></i>
                            <span class="font-serif">Dashboard</span>
                        </div>
                    </a>
                    <a href="{{ route('mahasiswa.vacancies.index') }}" class="vintage-button block px-3 py-2 text-base {{ request()->routeIs('mahasiswa.vacancies.*') ? 'bg-sepia-100 text-vintage-brown border-l-4 border-vintage-gold pl-2' : 'text-sepia-800' }}">
                        <div class="flex items-center">
                            <i class="fas fa-briefcase mr-3 text-vintage-gold"></i>
                            <span class="font-serif">Lowongan Magang</span>
                        </div>
                    </a>
                    <a href="{{ route('mahasiswa.events.index') }}" class="vintage-button block px-3 py-2 text-base {{ request()->routeIs('mahasiswa.events.*') ? 'bg-sepia-100 text-vintage-brown border-l-4 border-vintage-gold pl-2' : 'text-sepia-800' }}">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-3 text-vintage-gold"></i>
                            <span class="font-serif">Event & Loker</span>
                        </div>
                    </a>
                    <a href="{{ route('mahasiswa.applications.index') }}" class="vintage-button block px-3 py-2 text-base {{ request()->routeIs('mahasiswa.applications.*') ? 'bg-sepia-100 text-vintage-brown border-l-4 border-vintage-gold pl-2' : 'text-sepia-800' }}">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt mr-3 text-vintage-gold"></i>
                            <span class="font-serif">Status Pendaftaran</span>
                        </div>
                    </a>
                </div>
                <div class="pt-4 pb-3 border-t border-sepia-200 bg-sepia-50">
                    <div class="flex items-center px-5 py-2">
                        <div class="h-10 w-10 bg-vintage-navy rounded-full flex items-center justify-center text-vintage-cream mr-3">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div>
                            <div class="font-serif text-base text-vintage-brown">{{ Auth::user()->name }}</div>
                            <div class="font-serif text-sm text-sepia-600 italic">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <a href="{{ route('mahasiswa.profile.edit') }}" class="vintage-button block px-3 py-2 text-base text-sepia-800">
                            <div class="flex items-center">
                                <i class="fas fa-user-edit fa-fw mr-3 text-vintage-gold"></i>
                                <span class="font-serif">Edit Profil</span> 
                            </div>
                        </a>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();"
                           class="vintage-button block px-3 py-2 text-base text-vintage-red"
                        >
                            <div class="flex items-center">
                                <i class="fas fa-sign-out-alt fa-fw mr-3"></i>
                                <span class="font-serif">Logout</span>
                            </div>
                        </a>
                        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Decorative Article Header - Desktop Only -->
        <div class="hidden md:block max-w-7xl mx-auto mt-6 px-4">
            <div class="border-b-2 border-sepia-800 mb-4">
                <div class="flex justify-center -mb-0.5">
                    <div class="bg-vintage-cream px-6 py-1 border-t-2 border-l-2 border-r-2 border-sepia-800 rounded-t-lg">
                        <span class="font-serif text-lg font-bold tracking-widest uppercase">@yield('title', 'Mahasiswa')</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-grow pb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-vintage-cream border border-sepia-200 shadow-vintage p-6">
                    <div class="prose max-w-none">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t-2 border-sepia-300 bg-sepia-50 mt-6">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Footer columns -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                    <div>
                        <h3 class="font-serif text-lg font-bold mb-4 text-vintage-navy">CDC UIN Raden Intan Lampung</h3>
                        <p class="text-sm text-sepia-700 mb-4 leading-relaxed">
                            Pusat pengembangan karir dan penempatan kerja untuk mahasiswa
                            dan alumni UIN Raden Intan Lampung.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-vintage-gold hover:text-vintage-brown transition duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-vintage-gold hover:text-vintage-brown transition duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-vintage-gold hover:text-vintage-brown transition duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="text-vintage-gold hover:text-vintage-brown transition duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold mb-4 text-vintage-navy">Kontak</h3>
                        <div class="space-y-2 text-sm text-sepia-700">
                            <p class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 text-vintage-gold"></i>
                                <span>Jl. Letnan Kolonel H. Endro Suratmin, Sukarame, Bandar Lampung</span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-envelope mt-1 mr-3 text-vintage-gold"></i>
                                <span>cdc@radenintan.ac.id</span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-phone mt-1 mr-3 text-vintage-gold"></i>
                                <span>(0721) 780887</span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="pt-4 border-t border-sepia-200 text-center">
                    <p class="text-sepia-600 text-sm">
                        <span>© {{ date('Y') }} CDC UIN Raden Intan Lampung</span>
                        <span class="mx-2">•</span>
                        <a href="#" class="hover:text-vintage-gold transition duration-300">Pusat Karir & Pengembangan</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Custom Typewriter Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Decorative animation effects
            const vintage = {
                init: function() {
                    // Add page turn effect to navigation links
                    const links = document.querySelectorAll('.vintage-button');
                    links.forEach(link => {
                        link.addEventListener('mouseenter', function() {
                            this.style.transition = 'all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                        });
                    });
                }
            };
            
            vintage.init();
        });
    </script>
</body>
</html>