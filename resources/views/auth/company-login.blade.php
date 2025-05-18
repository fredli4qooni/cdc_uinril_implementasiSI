<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

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
                        },
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
</head>

<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">

        <!-- Card -->
        <div
            class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all hover:scale-[1.01] duration-300">
            <!-- Card Header -->
            <div class="p-6 bg-gradient-to-r from-teal-600 to-teal-500 text-white">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-lock mr-2"></i>
                    <span>Selamat Datang Kembali</span>
                </h2>
                <p class="text-teal-100 text-sm mt-1">Silakan masuk untuk mengakses portal</p>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 animate-pulse">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle mr-2 mt-1"></i>
                            <span>{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('company.login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-envelope text-teal-500 mr-2"></i>{{ __('Alamat Email') }}
                        </label>
                        <div class="relative">
                            <input id="email" type="email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all pl-10 @error('email') border-red-300 @enderror"
                                name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                                placeholder="perusahaan@cdc.uin">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400"><i class="fas fa-at"></i></span>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-key text-teal-500 mr-2"></i>{{ __('Password') }}
                        </label>
                        <div class="relative">
                            <input id="password" type="password"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all pl-10 @error('password') border-red-300 @enderror"
                                name="password" required autocomplete="current-password" placeholder="••••••••">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400"><i class="fas fa-lock"></i></span>
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember" type="checkbox"
                            class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500" name="remember">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            {{ __('Ingat Saya') }}
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-teal-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transform transition-all active:scale-95">
                        <i class="fas fa-sign-in-alt mr-2"></i>{{ __('Login') }}
                    </button>

                    <!-- Forgot Password -->
                    {{-- @if (Route::has('password.request'))
                        <div class="text-center mt-4">
                            <a href="{{ route('password.request') }}" class="text-sm text-teal-600 hover:text-teal-800 transition-colors">
                                <i class="fas fa-question-circle mr-1"></i>{{ __('Lupa Password Anda?') }}
                            </a>
                        </div>
                    @endif --}}
                </form>
            </div>

            <!-- Card Footer -->
            <div class="py-4 px-6 bg-gray-50 text-center border-t">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-shield-alt text-teal-500 mr-1"></i>
                    Akses ini khusus untuk Perusahaan Mitra CDC UIN RIL
                </p>
            </div>
        </div>

        <!-- Animated Elements -->
        <div class="mt-8 text-center text-gray-500 text-sm flex justify-center space-x-4">
            <span class="animate-pulse-slow">
                <i class="fas fa-headset text-teal-500 mr-1"></i> Butuh bantuan?
            </span>
            <span>|</span>
            <span>
                <i class="fas fa-envelope text-teal-500 mr-1"></i> support@uinril.ac.id
            </span>
        </div>
    </div>
</body>

</html>
