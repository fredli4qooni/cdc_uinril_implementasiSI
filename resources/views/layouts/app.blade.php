{{-- resources/views/layouts/public.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Career Development Center UIN Raden Intan Lampung. Temukan peluang magang, loker, dan event karir.">
    <title>@yield('title', config('app.name', 'Laravel') . ' - Career Development Center')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { 
            font-family: 'Inter', system-ui, -apple-system, sans-serif; 
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .animate-slide-down {
            animation: slideDown 0.3s ease-out forwards;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.2s ease-out forwards;
        }
        
        /* Navbar glassmorphism effect */
        .navbar-glass {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        /* Hover effects */
        .nav-link-hover {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-link-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background: linear-gradient(90deg, #3B82F6, #6366F1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 1px;
        }
        
        .nav-link-hover:hover::after,
        .nav-link-hover.active::after {
            width: 100%;
            left: 0;
        }
        
        .nav-link-hover:hover {
            color: #3B82F6;
            transform: translateY(-1px);
        }
        
        /* Button animations */
        .btn-animated {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-animated:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
        
        /* Mobile menu backdrop */
        .mobile-menu-backdrop {
            backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.5);
        }
        
        /* Dropdown animations */
        .dropdown-enter {
            opacity: 0;
            transform: translateY(-8px) scale(0.95);
        }
        
        .dropdown-enter-active {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: all 0.2s ease-out;
        }
        
        /* Avatar styles */
        .navbar-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }
        
        .navbar-avatar:hover {
            border-color: #3B82F6;
            transform: scale(1.05);
        }
        
        /* Footer gradient */
        .footer-gradient {
            background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <div id="app">
        <!-- Navigation -->
        <nav class="navbar-glass fixed top-0 left-0 right-0 z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo CDC UIN RIL" 
                                 class="h-20 w-auto transition-transform duration-300 group-hover:scale-105">
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="{{ route('home') }}" 
                           class="nav-link-hover font-medium text-gray-700 {{ request()->routeIs('home') ? 'active text-blue-600' : '' }}">
                            Beranda
                        </a>
                        
                        <a href="{{ route('public.vacancies.index') }}" 
                           class="nav-link-hover font-medium text-gray-700 {{ request()->routeIs('public.vacancies.index') || request()->routeIs('mahasiswa.vacancies.*') ? 'active text-blue-600' : '' }}">
                            Lowongan
                        </a>
                        
                        <a href="{{ route('public.events.index') }}" 
                           class="nav-link-hover font-medium text-gray-700 {{ request()->routeIs('public.events.index') || request()->routeIs('mahasiswa.events.*') ? 'active text-blue-600' : '' }}">
                            Event & Loker
                        </a>
                        
                        @auth
                            @if(Auth::user()->role == 'mahasiswa')
                                <a href="{{ route('mahasiswa.dashboard') }}" 
                                   class="nav-link-hover font-medium text-gray-700 {{ request()->routeIs('mahasiswa.dashboard') ? 'active text-blue-600' : '' }}">
                                    Dashboard Saya
                                </a>
                            @endif
                        @endauth

                        <!-- Informasi Dropdown -->
                        <div class="relative group">
                            <button class="nav-link-hover font-medium text-gray-700 flex items-center space-x-1 {{ request()->routeIs('public.about') || request()->routeIs('public.forCompanies') || request()->routeIs('public.contact') ? 'active text-blue-600' : '' }}">
                                <span>Informasi</span>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>
                            
                            <div class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                <div class="py-2">
                                    <a href="{{ route('public.about') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('public.about') ? 'bg-blue-50 text-blue-600' : '' }}">
                                        <i class="fas fa-info-circle w-4 mr-2"></i>Tentang Kami
                                    </a>
                                    <a href="{{ route('public.forCompanies') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('public.forCompanies') ? 'bg-blue-50 text-blue-600' : '' }}">
                                        <i class="fas fa-building w-4 mr-2"></i>Untuk Perusahaan
                                    </a>
                                    <a href="{{ route('public.contact') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('public.contact') ? 'bg-blue-50 text-blue-600' : '' }}">
                                        <i class="fas fa-envelope w-4 mr-2"></i>Kontak
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Menu -->
                    <div class="hidden lg:flex items-center space-x-4">
                        @guest
                            <!-- Login Dropdown -->
                            <div class="relative group">
                                <button class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-300">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span class="font-medium">Login</span>
                                    <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                                </button>
                                
                                <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <div class="py-2">
                                        <a href="{{ route('login') }}" 
                                           class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                            <i class="fas fa-user-graduate w-5 mr-3 text-blue-500"></i>
                                            <span class="font-medium">Mahasiswa</span>
                                        </a>
                                        <a href="{{ route('company.login') }}" 
                                           class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                            <i class="fas fa-building w-5 mr-3 text-green-500"></i>
                                            <span class="font-medium">Perusahaan Mitra</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="btn-animated bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300">
                                    Daftar Mahasiswa
                                </a>
                            @endif
                        @else
                            <!-- User Profile Dropdown -->
                            <div class="relative group">
                                <button class="flex items-center space-x-3 px-2 py-1 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                    @if(Auth::user()->role == 'mahasiswa' && Auth::user()->studentProfile)
                                        <img src="{{ Auth::user()->studentProfile->avatar_url }}" alt="Avatar" class="navbar-avatar">
                                    @elseif(Auth::user()->role == 'perusahaan' && Auth::user()->company && Auth::user()->company->logo_path)
                                        <img src="{{ Storage::url(Auth::user()->company->logo_path) }}" alt="Logo" class="navbar-avatar">
                                    @else
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white text-sm"></i>
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-700">{{ Str::words(Auth::user()->name, 2, '') }}</span>
                                    <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-300 group-hover:rotate-180"></i>
                                </button>
                                
                                <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <div class="py-2">
                                        @if(Auth::user()->role == 'mahasiswa')
                                            <a href="{{ route('mahasiswa.dashboard') }}" 
                                               class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                                                <i class="fas fa-tachometer-alt w-5 mr-3"></i>Dashboard Saya
                                            </a>
                                            <a href="{{ route('mahasiswa.profile.edit') }}" 
                                               class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('mahasiswa.profile.edit') ? 'bg-blue-50 text-blue-600' : '' }}">
                                                <i class="fas fa-user-edit w-5 mr-3"></i>Edit Profil
                                            </a>
                                            <a href="{{ route('mahasiswa.applications.index') }}" 
                                               class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('mahasiswa.applications.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                                                <i class="fas fa-file-signature w-5 mr-3"></i>Status Pendaftaran
                                            </a>
                                            <a href="{{ route('mahasiswa.bookmarks.index') }}" 
                                               class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('mahasiswa.bookmarks.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                                                <i class="fas fa-bookmark fa-fw w-5 mr-3"></i>Bookmarks
                                            </a>
                                        @elseif(Auth::user()->role == 'admin')
                                            <a href="{{ route('admin.dashboard') }}" 
                                               class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                                <i class="fas fa-cogs w-5 mr-3"></i>Panel Admin
                                            </a>
                                        @elseif(Auth::user()->role == 'perusahaan')
                                            <a href="{{ route('company.dashboard') }}" 
                                               class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                                <i class="fas fa-building w-5 mr-3"></i>Dashboard Perusahaan
                                            </a>
                                        @endif
                                        <hr class="my-2 border-gray-100">
                                        <button onclick="event.preventDefault(); document.getElementById('logout-form-app').submit();" 
                                                class="w-full text-left block px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                            <i class="fas fa-sign-out-alt w-5 mr-3"></i>Logout
                                        </button>
                                        @php
                                            $logoutRoute = route('logout');
                                            if(Auth::user()->role == 'admin') $logoutRoute = route('admin.logout');
                                            if(Auth::user()->role == 'company') $logoutRoute = route('company.logout');
                                        @endphp
                                        <form id="logout-form-app" action="{{ $logoutRoute }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>

                    <!-- Mobile menu button -->
                    <div class="lg:hidden">
                        <button type="button" class="mobile-menu-btn p-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-gray-100 transition-colors duration-300" onclick="toggleMobileMenu()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="lg:hidden fixed inset-0 z-50 hidden mobile-menu-backdrop">
                <div class="flex">
                    <div class="w-full max-w-sm bg-white h-full shadow-2xl overflow-y-auto">
                        <div class="p-6">
                            <!-- Mobile menu header -->
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('images/logo-uinril-contoh.png') }}" alt="Logo CDC UIN RIL" class="h-8 w-auto">
                                    <span class="text-lg font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                        CDC UIN RIL
                                    </span>
                                </div>
                                <button type="button" class="p-2 rounded-lg text-gray-600 hover:text-red-600 hover:bg-gray-100 transition-colors duration-300" onclick="toggleMobileMenu()">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Mobile navigation links -->
                            <div class="space-y-2">
                                <a href="{{ route('home') }}" 
                                   class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                    <i class="fas fa-home w-5 mr-3"></i>Beranda
                                </a>
                                
                                <a href="{{ route('public.vacancies.index') }}" 
                                   class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('public.vacancies.index') || request()->routeIs('mahasiswa.vacancies.*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                    <i class="fas fa-briefcase w-5 mr-3"></i>Lowongan
                                </a>
                                
                                <a href="{{ route('public.events.index') }}" 
                                   class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('public.events.index') || request()->routeIs('mahasiswa.events.*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                    <i class="fas fa-calendar-alt w-5 mr-3"></i>Event & Loker
                                </a>
                                
                                @auth
                                    @if(Auth::user()->role == 'mahasiswa')
                                        <a href="{{ route('mahasiswa.dashboard') }}" 
                                           class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                            <i class="fas fa-tachometer-alt w-5 mr-3"></i>Dashboard Saya
                                        </a>
                                    @endif
                                @endauth

                                <!-- Mobile Informasi Section -->
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Informasi</p>
                                    <a href="{{ route('public.about') }}" 
                                       class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('public.about') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                        <i class="fas fa-info-circle w-5 mr-3"></i>Tentang Kami
                                    </a>
                                    <a href="{{ route('public.forCompanies') }}" 
                                       class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('public.forCompanies') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                        <i class="fas fa-building w-5 mr-3"></i>Untuk Perusahaan
                                    </a>
                                    <a href="{{ route('public.contact') }}" 
                                       class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('public.contact') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                        <i class="fas fa-envelope w-5 mr-3"></i>Kontak
                                    </a>
                                </div>

                                <!-- Mobile Auth Section -->
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    @guest
                                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Login</p>
                                        <a href="{{ route('login') }}" 
                                           class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                            <i class="fas fa-user-graduate w-5 mr-3 text-blue-500"></i>Mahasiswa
                                        </a>
                                        <a href="{{ route('company.login') }}" 
                                           class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                            <i class="fas fa-building w-5 mr-3 text-green-500"></i>Perusahaan Mitra
                                        </a>
                                        <a href="{{ route('admin.login') }}" 
                                           class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                            <i class="fas fa-user-shield w-5 mr-3 text-purple-500"></i>Admin CDC
                                        </a>
                                        @if (Route::has('register'))
                                            <div class="pt-4">
                                                <a href="{{ route('register') }}" 
                                                   class="block w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-center py-3 rounded-lg font-medium hover:shadow-lg transition-all duration-300">
                                                    Daftar Mahasiswa
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <div class="flex items-center space-x-3 px-4 py-3 bg-gray-50 rounded-lg mb-4">
                                            @if(Auth::user()->role == 'mahasiswa' && Auth::user()->studentProfile)
                                                <img src="{{ Auth::user()->studentProfile->avatar_url }}" alt="Avatar" class="navbar-avatar">
                                            @elseif(Auth::user()->role == 'perusahaan' && Auth::user()->company && Auth::user()->company->logo_path)
                                                <img src="{{ Storage::url(Auth::user()->company->logo_path) }}" alt="Logo" class="navbar-avatar">
                                            @else
                                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                                <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                            </div>
                                        </div>
                                        
                                        @if(Auth::user()->role == 'mahasiswa')
                                            <a href="{{ route('mahasiswa.profile.edit') }}" 
                                               class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('mahasiswa.profile.edit') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                                <i class="fas fa-user-edit w-5 mr-3"></i>Edit Profil
                                            </a>
                                            <a href="{{ route('mahasiswa.applications.index') }}" 
                                               class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('mahasiswa.applications.index') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                                <i class="fas fa-file-signature w-5 mr-3"></i>Status Pendaftaran
                                            </a>
                                        @elseif(Auth::user()->role == 'admin')
                                            <a href="{{ route('admin.dashboard') }}" 
                                               class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                                <i class="fas fa-cogs w-5 mr-3"></i>Panel Admin
                                            </a>
                                        @elseif(Auth::user()->role == 'perusahaan')
                                            <a href="{{ route('company.dashboard') }}" 
                                               class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                                <i class="fas fa-building w-5 mr-3"></i>Dashboard Perusahaan
                                            </a>
                                        @endif
                                        
                                        <button onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" 
                                                class="w-full text-left block px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors duration-200 mt-4">
                                            <i class="fas fa-sign-out-alt w-5 mr-3"></i>Logout
                                        </button>
                                        @php
                                            $logoutRoute = route('logout');
                                            if(Auth::user()->role == 'admin') $logoutRoute = route('admin.logout');
                                            if(Auth::user()->role == 'company') $logoutRoute = route('company.logout');
                                        @endphp
                                        <form id="logout-form-mobile" action="{{ $logoutRoute }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1" onclick="toggleMobileMenu()"></div>
                </div>
            </div>
        </nav>

        <!-- Main Content with proper top margin -->
        <main class="pt-16">
            @yield('content')
        </main>

        {{-- Footer section can be added here --}}
    </div>

    <!-- Mobile Menu JavaScript -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
            
            // Prevent body scroll when menu is open
            if (!mobileMenu.classList.contains('hidden')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

        // Handle navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });

        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>