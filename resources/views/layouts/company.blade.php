{{-- resources/views/layouts/company.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Perusahaan - {{ Auth::user()->company->name ?? config('app.name') }}</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('styles')

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        teal: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <div id="app" class="flex flex-col min-h-screen">
        <nav class="bg-white fixed w-full top-0 left-0 border-b z-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('company.dashboard') }}"
                                class="flex items-center text-teal-600 font-bold text-lg">
                                <img src="{{ asset('images/logo.png') }}" alt="Company Logo"
                                    class="h-20 w-auto mr-4">
                                {{ Auth::user()->company->name ?? 'Dashboard Perusahaan' }}
                            </a>
                        </div>

                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ route('company.dashboard') }}"
                                class="{{ request()->routeIs('company.dashboard')
                                    ? 'border-teal-500 text-gray-900'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} 
                                        inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>
                            <a href="{{ route('company.vacancies.index') }}"
                                class="{{ request()->routeIs('company.vacancies.*')
                                    ? 'border-teal-500 text-gray-900'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} 
                                        inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Kelola Lowongan
                            </a>
                            <a href="{{ route('company.applicants.index') }}"
                                class="{{ request()->routeIs('company.applicants.*')
                                    ? 'border-teal-500 text-gray-900'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} 
                                        inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Lihat Pendaftar
                            </a>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <div class="relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button"
                                    class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 p-1 bg-gray-100 hover:bg-gray-200 transition"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fas fa-user-tie mr-2 text-gray-600"></i>
                                    <span class="mr-1">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                                </button>
                            </div>

                            <div x-show="open" @click.away="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95">
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('company-logout-form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                    tabindex="-1" id="user-menu-item-0">
                                    <i class="fas fa-sign-out-alt fa-fw mr-1"></i> Logout
                                </a>
                                <form id="company-logout-form" action="{{ route('company.logout') }}" method="POST"
                                    class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center sm:hidden">
                        <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500"
                            aria-controls="mobile-menu" aria-expanded="false" x-data="{ open: false }"
                            @click="open = !open">
                            <span class="sr-only">Open main menu</span>
                            <i class="fas fa-bars" x-show="!open"></i>
                            <i class="fas fa-times" x-show="open"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="sm:hidden" id="mobile-menu" x-data="{ open: false }" x-show="open" @click.away="open = false">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('company.dashboard') }}"
                        class="{{ request()->routeIs('company.dashboard') ? 'bg-teal-50 border-teal-500 text-teal-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('company.vacancies.index') }}"
                        class="{{ request()->routeIs('company.vacancies.*') ? 'bg-teal-50 border-teal-500 text-teal-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Kelola Lowongan
                    </a>
                    <a href="{{ route('company.applicants.index') }}"
                        class="{{ request()->routeIs('company.applicants.*') ? 'bg-teal-50 border-teal-500 text-teal-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                        Lihat Pendaftar
                    </a>
                    <div class="border-t border-gray-200 pt-2">
                        <div class="pl-3 pr-4 py-2 flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-user-tie mr-2 text-gray-600"></i>
                                <span class="text-gray-800">{{ Auth::user()->name }}</span>
                            </div>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('company-logout-form-mobile').submit();"
                                class="text-red-600 hover:text-red-800 font-medium">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="company-logout-form-mobile" action="{{ route('company.logout') }}"
                                method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow pt-20 pb-6">
            {{-- Konten utama dari setiap halaman mahasiswa akan dimuat di sini --}}
            @yield('content')
        </main>

        <footer class="bg-white border-t py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-500 text-sm">Panel Perusahaan Mitra © CDC UIN RIL {{ date('Y') }}</p>
            </div>
        </footer>
    </div>

    <!-- Alpine.js -->

    @stack('scripts')
</body>

</html>
