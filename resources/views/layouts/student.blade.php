{{-- File: resources/views/layouts/student.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'cdc_uinril') }} - @yield('title', 'Mahasiswa')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigo: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        },
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome (untuk ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- Custom Styles per Halaman -->
    @stack('styles')

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        /* Navbar dropdown animation */
        @keyframes dropdownAnimation {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-animation {
            animation: dropdownAnimation 0.3s ease-in-out;
        }

        /* Active nav indicator animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <div id="app" class="flex flex-col min-h-screen">
        {{-- Navbar Atas untuk Mahasiswa --}}
        <nav class="bg-white shadow-md fixed w-full z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto mr-2">
                            </a>
                        </div>

                        <!-- Navigation Links (Desktop) -->
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-4">
                            <a href="{{ route('mahasiswa.dashboard') }}"
                                class="group inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('mahasiswa.dashboard') ? 'border-indigo-500 text-gray-900 font-semibold' : 'border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-800' }} h-full">
                                <i
                                    class="fas fa-tachometer-alt fa-fw mr-1.5 group-hover:text-indigo-500 {{ request()->routeIs('mahasiswa.dashboard') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('mahasiswa.vacancies.index') }}"
                                class="group inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('mahasiswa.vacancies.*') ? 'border-indigo-500 text-gray-900 font-semibold' : 'border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-800' }} h-full">
                                <i
                                    class="fas fa-briefcase fa-fw mr-1.5 group-hover:text-indigo-500 {{ request()->routeIs('mahasiswa.vacancies.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                                <span>Lowongan Magang</span>
                            </a>

                            <a href="{{ route('mahasiswa.events.index') }}"
                                class="group inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('mahasiswa.events.*') ? 'border-indigo-500 text-gray-900 font-semibold' : 'border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-800' }} h-full">
                                <i
                                    class="fas fa-calendar-alt fa-fw mr-1.5 group-hover:text-indigo-500 {{ request()->routeIs('mahasiswa.events.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                                <span>Event & Loker</span>
                            </a>

                            <a href="{{ route('mahasiswa.applications.index') }}"
                                class="group inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('mahasiswa.applications.*') ? 'border-indigo-500 text-gray-900 font-semibold' : 'border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-800' }} h-full">
                                <i
                                    class="fas fa-file-signature fa-fw mr-1.5 group-hover:text-indigo-500 {{ request()->routeIs('mahasiswa.applications.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                                <span>Status Pendaftaran</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right side dropdown menu -->
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        @auth
                            <div class="ml-3 relative" x-data="{ open: false }">
                                <div>
                                    <button @click="open = !open" type="button"
                                        class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 items-center px-3 py-1.5 text-gray-700 hover:bg-gray-100 transition-colors duration-300 rounded-lg"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <i class="fas fa-user-circle fa-fw text-lg mr-1.5 text-indigo-500"></i>
                                        <span>{{ Auth::user()->name }}</span>
                                        <i class="fas fa-chevron-down ml-2 text-xs text-gray-500"></i>
                                    </button>
                                </div>

                                <!-- Dropdown menu, show/hide based on menu state -->
                                <div x-show="open" @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none dropdown-animation"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <div class="py-1">
                                        <a href="{{ route('mahasiswa.profile.edit') }}"
                                            class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors duration-200"
                                            role="menuitem">
                                            <i class="fas fa-user-edit fa-fw mr-2 my-auto"></i>
                                            <span>Edit Profil</span>
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="flex w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                                                role="menuitem">
                                                <i class="fas fa-sign-out-alt fa-fw mr-2 my-auto"></i>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button type="button" id="mobile-menu-button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <i class="fas fa-bars block h-6 w-6"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state -->
            <div class="sm:hidden hidden" id="mobile-menu">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('mahasiswa.dashboard') }}"
                        class="{{ request()->routeIs('mahasiswa.dashboard') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700 font-medium' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 text-base">
                        <i
                            class="fas fa-tachometer-alt fa-fw mr-2 {{ request()->routeIs('mahasiswa.dashboard') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('mahasiswa.vacancies.index') }}"
                        class="{{ request()->routeIs('mahasiswa.vacancies.*') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700 font-medium' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 text-base">
                        <i
                            class="fas fa-briefcase fa-fw mr-2 {{ request()->routeIs('mahasiswa.vacancies.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                        Lowongan Magang
                    </a>

                    <a href="{{ route('mahasiswa.events.index') }}"
                        class="{{ request()->routeIs('mahasiswa.events.*') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700 font-medium' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 text-base">
                        <i
                            class="fas fa-calendar-alt fa-fw mr-2 {{ request()->routeIs('mahasiswa.events.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                        Event & Loker
                    </a>

                    <a href="{{ route('mahasiswa.applications.index') }}"
                        class="{{ request()->routeIs('mahasiswa.applications.*') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700 font-medium' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 text-base">
                        <i
                            class="fas fa-file-signature fa-fw mr-2 {{ request()->routeIs('mahasiswa.applications.*') ? 'text-indigo-500' : 'text-gray-400' }}"></i>
                        Status Pendaftaran
                    </a>
                </div>

                @auth
                    <div class="pt-4 pb-3 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <i class="fas fa-user text-indigo-500"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('mahasiswa.profile.edit') }}"
                                class="block px-4 py-2 text-base text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-user-edit fa-fw mr-2 text-gray-400"></i>
                                Edit Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-base text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt fa-fw mr-2 text-red-400"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </nav>

        <!-- Main Content Area - padding top to match navbar height -->
        <main class="flex-grow pt-20 pb-6">
            {{-- Konten utama dari setiap halaman mahasiswa akan dimuat di sini --}}
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-indigo-900 text-white py-6 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-indigo-200 text-sm">
                        Copyright &copy; Career Development Center (CDC) UIN Raden Intan Lampung {{ date('Y') }}
                    </p>
                    <div class="mt-3 flex justify-center space-x-4">
                        <a href="#" class="text-indigo-300 hover:text-white transition-colors duration-300">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-indigo-300 hover:text-white transition-colors duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-indigo-300 hover:text-white transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-indigo-300 hover:text-white transition-colors duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Alpine.js (for dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Mobile menu toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>

    <!-- Custom Scripts per Halaman -->
    @stack('scripts')
</body>

</html>
