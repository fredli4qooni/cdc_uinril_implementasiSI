{{-- resources/views/public/contact.blade.php --}}
@extends('layouts.app')
@section('title', 'Kontak Kami - CDC UIN RIL')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 py-20 overflow-hidden">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                Hubungi <span class="text-yellow-300">Kami</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 font-light leading-relaxed">
                Kami siap membantu Anda mencapai tujuan karir yang diimpikan.
            </p>
        </div>
    </div>
    <!-- Decorative elements -->
    <div class="absolute top-10 right-10 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-10 left-10 w-32 h-32 bg-yellow-300/20 rounded-full blur-3xl"></div>
</section>

<!-- Main Content -->
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Career Development Center<br>
                    <span class="text-blue-600">UIN Raden Intan Lampung</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mx-auto rounded-full"></div>
            </div>

            <!-- Contact Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
                <!-- Address Card -->
                <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Alamat Kantor</h3>
                        <div class="space-y-2 text-gray-600">
                            <p class="font-medium">Pusat Karir UIN Raden Intan Lampung</p>
                            <p>Kampus UIN Raden Intan Lampung</p>
                            <p>Jl. Letkol H. Endro Suratmin, Sukarame</p>
                            <p>Bandar Lampung, Lampung, 35131</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="bg-white rounded-3xl p-8 shadow-xl">
                    <div class="space-y-8">
                        <!-- Phone Section -->
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Telepon</h4>
                            <div class="space-y-1 text-gray-600">
                                <p class="font-medium">(+62) 721-780-887</p>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="flex items-center">
                            <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                            <div class="mx-4">
                                <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                            </div>
                            <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                        </div>

                        <!-- Email Section -->
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Email</h4>
                            <div class="space-y-2">
                                <a href="mailto:careercenter@radenintan.ac.id" class="block text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                                    careercenter@radenintan.ac.id
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Optional Contact Form --}}
            {{-- 
            <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl mb-16">
                <div class="max-w-3xl mx-auto">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                            Atau Kirim Pesan <span class="text-blue-600">Langsung</span>
                        </h3>
                        <p class="text-gray-600">Kami akan merespons pesan Anda dalam 24 jam</p>
                    </div>
                    
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Anda</label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-300">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Anda</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-300">
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subjek</label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-300">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Pesan Anda</label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="5" 
                                      required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-300 resize-none"></textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" 
                                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            --}}

            <!-- Map Section -->
            <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl">
                <div class="text-center mb-8">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                        Lokasi Kami di <span class="text-blue-600">Peta</span>
                    </h3>
                    <p class="text-gray-600">Temukan kami dengan mudah melalui peta interaktif di bawah ini</p>
                </div>
                
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <div class="aspect-video">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.29987654321!2d105.29290561538086!3d-5.369018796097673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40c1a0a9c0c7f3%3A0x9cdd8b6f72a86b1!2sUIN%20Raden%20Intan%20Lampung!5e0!3m2!1sen!2sid!4v1678888888888!5m2!1sen!2sid" 
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                class="w-full h-full">
                        </iframe>
                    </div>
                    
                    <!-- Map Overlay Info -->
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">CDC UIN RIL</p>
                                <p class="text-xs text-gray-600">Bandar Lampung</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    <a href="tel:(0721)123-4567" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        Hubungi Sekarang
                    </a>
                    <a href="mailto:cdc@uinril.ac.id" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        Kirim Email
                    </a>
                    <a href="#" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        Buka di Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection