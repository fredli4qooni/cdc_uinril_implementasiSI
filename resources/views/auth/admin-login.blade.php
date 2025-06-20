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
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'spin-slow': 'spin 8s linear infinite',
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
        .bg-indigo-gradient {
            background: linear-gradient(135deg, #4338ca 0%, #6366f1 100%);
        }
        
        .bg-dots {
            background-image: radial-gradient(rgba(99, 102, 241, 0.1) 2px, transparent 2px);
            background-size: 20px 20px;
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

        .form-element:nth-child(1) { animation-delay: 0.1s; }
        .form-element:nth-child(2) { animation-delay: 0.2s; }
        .form-element:nth-child(3) { animation-delay: 0.3s; }
        .form-element:nth-child(4) { animation-delay: 0.4s; }
        .form-element:nth-child(5) { animation-delay: 0.5s; }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        
        .login-card {
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        }
        
        .input-focus-effect {
            transition: all 0.3s ease;
        }
        
        .input-focus-effect:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen bg-dots flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-5xl mx-auto flex flex-col md:flex-row bg-white rounded-2xl login-card overflow-hidden">
        <!-- Left Side - Decorative Section -->
        <div class="hidden md:block md:w-1/2 bg-indigo-gradient relative overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-20 left-20 w-40 h-40 bg-white rounded-full opacity-10 animate-pulse-slow"></div>
                <div class="absolute bottom-20 right-10 w-60 h-60 bg-white rounded-full opacity-10 animate-pulse-slow" style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 left-1/3 w-20 h-20 bg-white rounded-full opacity-10 animate-pulse-slow" style="animation-delay: 2s;"></div>
            </div>
            
            <div class="relative z-10 flex flex-col items-center justify-center w-full h-full text-white px-12 py-16">
                <div class="mb-8 floating">
                    <svg class="w-32 h-32 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4L4 8L12 12L20 8L12 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 12L12 16L20 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 16L12 20L20 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold mb-4 animate__animated animate__fadeInUp">Admin Dashboard</h1>
                <p class="text-xl opacity-90 text-center animate__animated animate__fadeInUp animate__delay-1s">
                    Selamat datang kembali! Silahkan masuk untuk melanjutkan.
                </p>
                
                <div class="mt-16 grid grid-cols-2 gap-8 w-full max-w-md">
                    <div class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-lg animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="text-3xl mb-3"><i class="fas fa-chart-line"></i></div>
                        <h3 class="text-lg font-semibold mb-1">Analytics</h3>
                        <p class="text-sm opacity-80">Pantau performa sistem secara real-time</p>
                    </div>
                    <div class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-lg animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="text-3xl mb-3"><i class="fas fa-user-shield"></i></div>
                        <h3 class="text-lg font-semibold mb-1">Security</h3>
                        <p class="text-sm opacity-80">Kelola akses dan keamanan data</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full md:w-1/2 p-8">
            <!-- Mobile Header (Visible only on mobile) -->
            <div class="md:hidden text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
                    <i class="fas fa-user-shield text-2xl text-indigo-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
                <p class="text-gray-600 mt-1">Masuk ke admin panel sistem</p>
            </div>
            
            <!-- Card Header -->
            <div class="mb-8 form-element">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-lock text-indigo-500 mr-3"></i>
                    <span>Selamat Datang Kembali</span>
                </h2>
                <p class="text-gray-600 mt-2">Silakan masuk untuk mengakses panel administrasi</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 animate-pulse form-element">
                    <div class="flex">
                        <i class="fas fa-exclamation-circle mr-2 mt-1"></i>
                        <span>{{ $errors->first('email') }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div class="form-element">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-indigo-500 mr-2"></i>{{ __('Alamat Email') }}
                    </label>
                    <div class="relative group">
                        <input id="email" type="email"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all pl-10 input-focus-effect @error('email') border-red-300 @enderror"
                            name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                            placeholder="your@email.com">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 group-hover:text-indigo-500 transition-colors"><i class="fas fa-at"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-element">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key text-indigo-500 mr-2"></i>{{ __('Password') }}
                    </label>
                    <div class="relative group">
                        <input id="password" type="password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all pl-10 input-focus-effect @error('password') border-red-300 @enderror"
                            name="password" required autocomplete="current-password" placeholder="••••••••">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 group-hover:text-indigo-500 transition-colors"><i class="fas fa-lock"></i></span>
                        </div>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-indigo-500 transition-colors" onclick="togglePasswordVisibility()">
                            <i class="fas fa-eye" id="togglePassword"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center form-element">
                    <input id="remember" type="checkbox"
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" name="remember">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform transition-all active:scale-95 form-element">
                    <i class="fas fa-sign-in-alt mr-2"></i>{{ __('Sign in') }}
                </button>

                <!-- Forgot Password -->
                
            </form>

            <!-- Card Footer -->
            <div class="mt-8 py-4 border-t border-gray-100 text-center form-element">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-shield-alt text-indigo-500 mr-1"></i>
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Animated Elements -->
    <div class="mt-8 text-center text-gray-500 text-sm flex flex-wrap justify-center gap-4">
        <span class="flex items-center animate-pulse-slow">
            <i class="fas fa-headset text-indigo-500 mr-2"></i> Butuh bantuan?
        </span>
        <span class="hidden md:inline">|</span>
        <span class="flex items-center">
            <i class="fas fa-envelope text-indigo-500 mr-2"></i> support@example.com
        </span>
    </div>
    
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>