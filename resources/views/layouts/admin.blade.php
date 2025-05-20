<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin CDC UIN RIL - @yield('title', 'Dashboard')</title>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- TailwindCSS Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigo: {
                            50: '#EEF2FF',
                            100: '#E0E7FF',
                            200: '#C7D2FE',
                            300: '#A5B4FC',
                            400: '#818CF8',
                            500: '#6366F1',
                            600: '#4F46E5',
                            700: '#4338CA',
                            800: '#3730A3',
                            900: '#312E81',
                            950: '#1E1B4B',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- HeadlessUI for Dropdown Menus -->
    <script src="https://cdn.jsdelivr.net/npm/@headlessui/vue@latest/dist/headlessui.umd.js"></script>

    <!-- Custom Styles per Halaman -->
    @stack('styles')
</head>

<body class="font-sans bg-gray-50">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen overflow-hidden">
        <!-- Mobile Sidebar Toggle Button -->
        <div class="lg:hidden fixed top-0 left-0 z-40 p-4">
            <button @click="sidebarOpen = !sidebarOpen"
                class="p-2 rounded-md text-indigo-500 bg-white shadow-md hover:bg-indigo-50 focus:outline-none">
                <i x-show="!sidebarOpen" class="fas fa-bars"></i>
                <i x-show="sidebarOpen" class="fas fa-times"></i>
            </button>
        </div>

        <!-- Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"></div>

        <!-- Sidebar -->
        <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
            class="fixed lg:static inset-y-0 left-0 w-64 transform transition-transform duration-300 ease-in-out lg:translate-x-0 z-30">
            <div class="flex flex-col h-full bg-indigo-800 shadow-lg">
                

                <!-- User Info -->
                <div class="flex items-center px-4 py-3 bg-indigo-700 border-b border-indigo-600">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-indigo-200 truncate">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="flex-1 overflow-y-auto">
                    <nav class="mt-2 px-2 space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}"
                            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-900 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                            <i class="fas fa-tachometer-alt fa-fw mr-3 text-indigo-300 group-hover:text-indigo-200"></i>
                            Dashboard
                        </a>

                        <!-- Menu Category: Master Data -->
                        <div class="pt-4 pb-1">
                            <div class="px-3 text-xs font-medium text-indigo-300 uppercase tracking-wider">Master Data
                            </div>
                        </div>

                        <!-- Perusahaan Mitra -->
                        <a href="{{ route('admin.companies.index') }}"
                            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.companies.*') ? 'bg-indigo-900 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                            <i class="fas fa-building fa-fw mr-3 text-indigo-300 group-hover:text-indigo-200"></i>
                            Perusahaan Mitra
                        </a>

                        <!-- Lowongan Kerjasama -->
                        <a href="{{ route('admin.vacancies.index') }}"
                            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.vacancies.*') ? 'bg-indigo-900 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                            <i class="fas fa-briefcase fa-fw mr-3 text-indigo-300 group-hover:text-indigo-200"></i>
                            Lowongan Kerjasama
                        </a>

                        <!-- Event/Loker Umum -->
                        <a href="{{ route('admin.events.index') }}"
                            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.events.*') ? 'bg-indigo-900 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                            <i class="fas fa-calendar-alt fa-fw mr-3 text-indigo-300 group-hover:text-indigo-200"></i>
                            Event/Loker Umum
                        </a>

                        <!-- Data Mahasiswa -->
                        <a href="{{ route('admin.students.index') }}"
                            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.students.*') ? 'bg-indigo-900 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                            <i class="fas fa-users fa-fw mr-3 text-indigo-300 group-hover:text-indigo-200"></i>
                            Data Mahasiswa
                        </a>

                        <!-- Menu Category: Manajemen -->
                        <div class="pt-4 pb-1">
                            <div class="px-3 text-xs font-medium text-indigo-300 uppercase tracking-wider">Manajemen
                            </div>
                        </div>

                        <!-- Status Pendaftaran -->
                        <a href="{{ route('admin.applications.index') }}"
                            class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.applications.*') ? 'bg-indigo-900 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                            <i class="fas fa-file-alt fa-fw mr-3 text-indigo-300 group-hover:text-indigo-200"></i>
                            Status Pendaftaran
                        </a>
                    </nav>
                </div>

                <!-- Logout Button -->
                <div class="bg-indigo-700 p-2">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-md text-indigo-100 hover:bg-indigo-600 hover:text-white">
                            <i class="fas fa-sign-out-alt fa-fw mr-3 text-indigo-300"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm z-10 lg:pl-0">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <!-- Page Title -->
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="mr-3 lg:hidden text-indigo-600 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Admin Panel')</h1>
                    </div>

                    <!-- Right Side Header Elements -->
                    <div class="flex items-center">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center text-gray-700 hover:text-indigo-600 focus:outline-none p-2 rounded-full hover:bg-gray-100">
                                <i class="fas fa-bell"></i>
                            </button>
                            <!-- Notification dropdown content would go here -->
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="py-6 px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200">
                <div class="py-4 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
                    Copyright © CDC UIN RIL {{ date('Y') }}
                </div>
            </footer>
        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Scripts per Halaman -->
    @stack('scripts')
</body>

</html>
