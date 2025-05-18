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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles per Halaman -->
    @stack('styles')
</head>
<body class="font-sans bg-gray-100">
    <div class="flex min-h-screen" id="wrapper">
        <!-- Sidebar -->
        <div class="w-64 min-h-screen bg-white border-r border-gray-200 transition-all duration-300" id="sidebar-wrapper">
            <div class="p-4 text-lg font-bold border-b border-gray-200 bg-gray-50">
                <i class="fas fa-university mr-2"></i>CDC UIN RIL
            </div>
            <div class="flex flex-col">
                <a class="px-4 py-3 flex items-center text-gray-700 hover:bg-gray-100 hover:text-blue-600 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white hover:text-white' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                   <i class="fas fa-tachometer-alt fa-fw mr-2"></i>Dashboard
                </a>

                <div class="px-4 py-3 font-bold text-gray-700 bg-gray-200">
                    <i class="fas fa-database fa-fw mr-2"></i>Master Data
                </div>
                <a class="px-4 py-3 flex items-center text-gray-700 hover:bg-gray-100 hover:text-blue-600 {{ request()->routeIs('admin.companies.*') ? 'bg-blue-600 text-white hover:text-white' : '' }}"
                   href="{{ route('admin.companies.index') }}">
                   <i class="fas fa-building fa-fw mr-2"></i>Perusahaan Mitra
                </a>
                <a class="px-4 py-3 flex items-center text-gray-700 hover:bg-gray-100 hover:text-blue-600 {{ request()->routeIs('admin.vacancies.*') ? 'bg-blue-600 text-white hover:text-white' : '' }}"
                    href="{{ route('admin.vacancies.index') }}">
                    <i class="fas fa-briefcase fa-fw mr-2"></i>Lowongan Kerjasama
                </a>
                <a class="px-4 py-3 flex items-center text-gray-700 hover:bg-gray-100 hover:text-blue-600 {{ request()->routeIs('admin.events.*') ? 'bg-blue-600 text-white hover:text-white' : '' }}"
                    href="{{ route('admin.events.index') }}">
                    <i class="fas fa-calendar-alt fa-fw mr-2"></i>Event/Loker Umum
                </a>
                <a class="px-4 py-3 flex items-center text-gray-700 hover:bg-gray-100 hover:text-blue-600 {{ request()->routeIs('admin.students.*') ? 'bg-blue-600 text-white hover:text-white' : '' }}"
                    href="{{ route('admin.students.index') }}">
                    <i class="fas fa-users fa-fw mr-2"></i>Data Mahasiswa
                </a>

                <div class="px-4 py-3 font-bold text-gray-700 bg-gray-200">
                    <i class="fas fa-cogs fa-fw mr-2"></i>Manajemen
                </div>
                <a class="px-4 py-3 flex items-center text-gray-700 hover:bg-gray-100 hover:text-blue-600 {{ request()->routeIs('admin.applications.*') ? 'bg-blue-600 text-white hover:text-white' : '' }}"
                    href="{{ route('admin.applications.index') }}">
                    <i class="fas fa-file-alt fa-fw mr-2"></i>Status Pendaftaran
                </a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content Wrapper -->
        <div class="flex-1 min-w-0" id="page-content-wrapper">
            <!-- Top Navigation -->
            <nav class="fixed top-0 right-0 left-64 h-14 bg-white border-b border-gray-200 shadow-sm z-10">
                <div class="flex justify-between items-center h-full px-4">
                    <span class="text-xl font-semibold">@yield('page-title', 'Admin Panel')</span>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none">
                            <i class="fas fa-user fa-fw mr-1"></i> {{ Auth::user()->name ?? 'Admin' }}
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div x-show="open" 
                             @click.away="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                             x-cloak>
                            <a href="#" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt fa-fw mr-1"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- /Top Navigation -->

            <!-- Page Content -->
            <div class="pt-16 px-6 pb-6">
                @yield('content')
            </div>
            <!-- /Page Content -->

            <!-- Footer -->
            <footer class="py-4 bg-white border-t border-gray-200 px-6">
                <div>
                    <span class="text-gray-500">Copyright © CDC UIN RIL {{ date('Y') }}</span>
                </div>
            </footer>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Alpine.js for Dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom Scripts per Halaman -->
    @stack('scripts')
</body>
</html>