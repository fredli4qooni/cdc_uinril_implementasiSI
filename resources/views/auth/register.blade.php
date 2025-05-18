<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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
                        },
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .register-card-shadow {
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 10px 10px -5px rgba(79, 70, 229, 0.04);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-element {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }

        .form-element:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-element:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-element:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-element:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-element:nth-child(5) {
            animation-delay: 0.5s;
        }

        .form-element:nth-child(6) {
            animation-delay: 0.6s;
        }

        .bg-indigo-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="grid md:grid-cols-2 min-h-screen">
        <!-- Illustration/Image Section -->
        <div
            class="hidden md:flex flex-col items-center justify-center bg-indigo-gradient p-8 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-white"></div>
                <div class="absolute bottom-10 right-10 w-32 h-32 rounded-full bg-white"></div>
                <div class="absolute top-1/3 right-1/4 w-16 h-16 rounded-full bg-white"></div>
            </div>

            <!-- Placeholder for your custom cartoon illustration -->
            <div class="w-3/4 h-96 bg-white/20 rounded-xl backdrop-blur-sm flex items-center justify-center mb-8 animate-float">
                <img src="{{ asset('images/register.png') }}" alt="Ilustrasi Kartun" class="h-full object-contain">
            </div>


            <div class="text-white z-10 text-center">
                <h1 class="text-3xl font-bold mb-2">Career Development Center UIN RIL</h1>
                <p class="text-indigo-100 max-w-md">Lengkapi formulir pendaftaran untuk membuat akun baru dan mengakses
                    berbagai layanan CDC.</p>
            </div>
        </div>

        <!-- Register Form Section -->
        <div class="flex items-center justify-center p-4 md:p-8">
            <div class="w-full max-w-md">
                <div
                    class="bg-white register-card-shadow rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-xl p-8">
                    <div class="flex justify-center ">
                            <img src="{{ asset('images/logo.png') }}" alt="My Logo" class="h-40 w-40">
                    </div>

                    <h2 class="text-center text-3xl font-bold text-gray-900 mb-2 animate__animated animate__fadeInDown">
                        Registrasi Mahasiswa</h2>
                    <p class="text-center text-gray-500 mb-6 animate__animated animate__fadeIn animate__delay-1s">
                        Daftarkan diri Anda untuk akses penuh</p>

                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded mb-6 animate__animated animate__fadeIn"
                            role="alert">
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div class="form-element">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                    autofocus autocomplete="name"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                    @error('name') border-red-500 @enderror"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NIM --}}
                        <div class="form-element">
                            <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">Nomor Pokok
                                Mahasiswa (NPM)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                    </svg>
                                </div>
                                <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required
                                    autocomplete="username"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                    @error('nim') border-red-500 @enderror"
                                    placeholder="Contoh: 2271020103">
                            </div>
                            @error('nim')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-element">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    required autocomplete="email"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                    @error('email') border-red-500 @enderror"
                                    placeholder="nama@gmail.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-element">
                            <label for="password"
                                class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required
                                    autocomplete="new-password"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                    @error('password') border-red-500 @enderror"
                                    placeholder="Minimal 8 karakter">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="form-element">
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    required autocomplete="new-password"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                                    placeholder="Masukkan ulang password Anda">
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-element pt-2">
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-1">
                                Daftar Sekarang
                            </button>
                        </div>

                        {{-- Login Link --}}
                        <div class="text-center mt-6 form-element">
                            <p class="text-sm text-gray-600">
                                Sudah punya akun?
                                <a href="{{ route('login') }}"
                                    class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                                    Login di sini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="text-center mt-8 text-sm text-gray-500">
                    &copy; {{ date('Y') }} CDC UIN Raden Intan Lampung. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>

</html>
