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
        
        .animate-slide-down {
            animation: slideDown 0.3s ease-out forwards;
        }
        
        /* Mobile menu backdrop */
        .mobile-menu-backdrop {
            backdrop-filter: blur(8px);
        }
        
        /* Navbar glassmorphism effect */
        .navbar-glass {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Hover effects */
        .nav-link-hover {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background: linear-gradient(90deg, #3B82F6, #6366F1);
            transition: all 0.3s ease;
        }
        
        .nav-link-hover:hover::after,
        .nav-link-hover.active::after {
            width: 100%;
            left: 0;
        }
        
        /* Button animations */
        .btn-animated {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-animated:hover {
            transform: translateY(-2px);
        }
        
        /* Footer gradient */
        .footer-gradient {
            background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <div id="app-public">
        {{-- Navbar Publik --}}
        <nav class="navbar-glass fixed top-0 left-0 right-0 z-50 transition-all duration-300">
            <div class="container mx-auto px-6">
                <div class="flex items-center justify-between h-20">
                    {{-- Logo --}}
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                            {{-- Logo placeholder - ganti dengan logo asli --}}
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <span class="text-white font-bold text-lg">C</span>
                            </div>
                            <div class="hidden sm:block">
                                <span class="text-xl font-bold text-gray-800">CDC</span>
                                <span class="text-sm text-gray-600 block leading-none">UIN RIL</span>
                            </div>
                        </a>
                    </div>

                    {{-- Desktop Menu --}}
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="{{ route('home') }}" 
                           class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('home') ? 'active text-blue-600' : '' }}">
                            Beranda
                        </a>
                        <a href="{{ route('public.vacancies.index') }}" class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('public.vacancies.index') ? 'active' : '' }}">
                            Lowongan Magang
                        </a>
                        <a href="{{ route('public.events.index') }}" class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('public.events.index') ? 'active' : '' }}">
                            Event/Loker Umum
                        </a>
                        <a href="{{ route('public.about') }}" class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('public.about') ? 'active' : '' }}">
                            Tentang Kami
                        </a>
                        <a href="{{ route('public.forCompanies') }}" class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('public.forCompanies') ? 'active' : '' }}">
                            untuk Perusahaan
                        </a>
                        <a href="{{ route('public.contact') }}" class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('public.contact') ? 'active' : '' }}">
                           Kontak Kami
                        </a>
                    </div>

                    {{-- Auth Buttons Desktop --}}
                    <div class="hidden lg:flex items-center space-x-4">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" 
                                   class="text-gray-700 hover:text-blue-600 font-medium flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300">
                                    <i class="fas fa-sign-in-alt text-sm"></i>
                                    <span>Login Mahasiswa</span>
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="btn-animated bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 hover:shadow-lg">
                                    Daftar Mahasiswa
                                </a>
                            @endif
                            <a href="{{ route('company.login') }}" 
                               class="btn-animated border border-gray-300 text-gray-700 px-4 py-2.5 rounded-lg font-medium hover:border-gray-400 hover:bg-gray-50 flex items-center space-x-2">
                                <i class="fas fa-building text-sm"></i>
                                <span>Login Perusahaan</span>
                            </a>
                        @else
                            @php $dashboardRoute = route(Auth::user()->role . '.dashboard'); @endphp
                            <a href="{{ $dashboardRoute }}" 
                               class="text-blue-600 hover:text-blue-700 font-semibold flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300">
                                <i class="fas fa-tachometer-alt text-sm"></i>
                                <span>Dashboard Saya</span>
                            </a>
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form-public').submit();"
                               class="text-red-600 hover:text-red-700 font-medium flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-red-50 transition-all duration-300">
                                <i class="fas fa-sign-out-alt text-sm"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form-public" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                        @endguest
                    </div>

                    {{-- Mobile Menu Button --}}
                    <div class="lg:hidden">
                        <button id="mobile-menu-btn" class="text-gray-700 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-lg p-2">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="lg:hidden hidden mobile-menu-backdrop fixed inset-0 bg-black/20 z-40">
                <div class="fixed top-0 right-0 h-full w-80 bg-white shadow-2xl transform translate-x-full transition-transform duration-300" id="mobile-menu-panel">
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">C</span>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-gray-800">CDC UIN RIL</span>
                            </div>
                        </div>
                        <button id="mobile-menu-close" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="py-6">
                        {{-- Mobile Navigation --}}
                        <div class="px-6 space-y-4">
                            <a href="{{ route('home') }}" 
                               class="block text-gray-700 hover:text-blue-600 font-medium py-3 border-b border-gray-100 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                                <i class="fas fa-home w-5 mr-3"></i>Beranda
                            </a>
                            {{-- Uncomment when ready
                            <a href="#" class="block text-gray-700 hover:text-blue-600 font-medium py-3 border-b border-gray-100">
                                <i class="fas fa-briefcase w-5 mr-3"></i>Lowongan
                            </a>
                            <a href="#" class="block text-gray-700 hover:text-blue-600 font-medium py-3 border-b border-gray-100">
                                <i class="fas fa-calendar w-5 mr-3"></i>Event
                            </a>
                            <a href="#" class="block text-gray-700 hover:text-blue-600 font-medium py-3 border-b border-gray-100">
                                <i class="fas fa-info-circle w-5 mr-3"></i>Tentang Kami
                            </a>
                            --}}
                        </div>
                        
                        {{-- Mobile Auth Buttons --}}
                        <div class="px-6 mt-8 space-y-4">
                            @guest
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" 
                                       class="block text-center text-gray-700 hover:text-blue-600 font-medium py-3 px-4 border border-gray-300 rounded-lg hover:border-blue-300 transition-all duration-300">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Login Mahasiswa
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" 
                                       class="block text-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-4 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-300">
                                        Daftar Mahasiswa
                                    </a>
                                @endif
                                <a href="{{ route('company.login') }}" 
                                   class="block text-center text-gray-700 hover:text-blue-600 font-medium py-3 px-4 border border-gray-300 rounded-lg hover:border-blue-300 transition-all duration-300">
                                    <i class="fas fa-building mr-2"></i>Login Perusahaan
                                </a>
                            @else
                                @php $dashboardRoute = route(Auth::user()->role . '.dashboard'); @endphp
                                <a href="{{ $dashboardRoute }}" 
                                   class="block text-center text-blue-600 hover:text-blue-700 font-semibold py-3 px-4 bg-blue-50 rounded-lg transition-all duration-300">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Saya
                                </a>
                                <a href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                                   class="block text-center text-red-600 hover:text-red-700 font-medium py-3 px-4 border border-red-300 rounded-lg hover:bg-red-50 transition-all duration-300">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </a>
                                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="pt-20">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="footer-gradient text-white relative overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.3"%3E%3Cpath d="m36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="container mx-auto px-6 py-16 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {{-- About Section --}}
                    <div class="lg:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                <span class="text-white font-bold text-xl">C</span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold">CDC UIN Raden Intan Lampung</h3>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-6 max-w-md">
                            Menjembatani mahasiswa dan alumni dengan dunia karir melalui informasi magang, lowongan kerja, dan pengembangan diri yang berkualitas.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <i class="fab fa-facebook-f text-blue-400"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <i class="fab fa-instagram text-pink-400"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <i class="fab fa-youtube text-red-400"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <i class="fab fa-linkedin text-blue-400"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Navigation Links --}}
                    <div>
                        <h4 class="text-lg font-semibold mb-6 text-white">Navigasi</h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Beranda
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Login Mahasiswa
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('company.login') }}" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Login Perusahaan
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Contact Info --}}
                    <div>
                        <h4 class="text-lg font-semibold mb-6 text-white">Hubungi Kami</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-map-marker-alt text-blue-400 text-sm"></i>
                                </div>
                                <span class="text-gray-300 text-sm leading-relaxed">
                                    Jl. Letkol H. Endro Suratmin, Sukarame, Bandar Lampung
                                </span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-green-400 text-sm"></i>
                                </div>
                                <span class="text-gray-300 text-sm">(0721) 703-260</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-purple-400 text-sm"></i>
                                </div>
                                <span class="text-gray-300 text-sm">cdc@radenintan.ac.id</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Footer Bottom --}}
                <div class="border-t border-white/10 mt-12 pt-8 text-center">
                    <p class="text-gray-400 text-sm">
                        © {{ date('Y') }} {{ config('app.name', 'CDC UIN RIL') }}. All Rights Reserved. 
                        <span class="mx-2">•</span>
                        <a href="#" class="hover:text-white transition-colors duration-300">Privacy Policy</a>
                        <span class="mx-2">•</span>
                        <a href="#" class="hover:text-white transition-colors duration-300">Terms of Service</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    {{-- JavaScript for Mobile Menu --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuPanel = document.getElementById('mobile-menu-panel');
            const mobileMenuClose = document.getElementById('mobile-menu-close');

            function openMobileMenu() {
                mobileMenu.classList.remove('hidden');
                setTimeout(() => {
                    mobileMenuPanel.classList.remove('translate-x-full');
                }, 10);
                document.body.style.overflow = 'hidden';
            }

            function closeMobileMenu() {
                mobileMenuPanel.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            }

            mobileMenuBtn.addEventListener('click', openMobileMenu);
            mobileMenuClose.addEventListener('click', closeMobileMenu);
            
            // Close menu when clicking backdrop
            mobileMenu.addEventListener('click', function(e) {
                if (e.target === mobileMenu) {
                    closeMobileMenu();
                }
            });

            // Close menu on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                    closeMobileMenu();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>