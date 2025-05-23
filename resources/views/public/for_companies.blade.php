{{-- resources/views/public/for_companies.blade.php --}}
@extends('layouts.app')
@section('title', 'Informasi untuk Perusahaan - CDC UIN RIL')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 py-20 overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative container mx-auto px-4 text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                Untuk Perusahaan <span class="text-yellow-300">Mitra</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 font-light max-w-3xl mx-auto leading-relaxed">
                Bergabunglah dengan Jaringan Kemitraan CDC UIN Raden Intan Lampung dan temukan talenta terbaik untuk perusahaan Anda.
            </p>
        </div>
    </div>
    <!-- Decorative elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-yellow-300/20 rounded-full blur-2xl"></div>
</section>

<!-- Main Content -->
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Why Partner Section -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Mengapa Bermitra dengan <span class="text-blue-600">CDC UIN RIL?</span>
                </h2>
                <p class="text-lg md:text-xl text-gray-700 max-w-4xl mx-auto leading-relaxed">
                    Kami mengundang perusahaan Anda untuk menjadi bagian dari ekosistem pengembangan karir di UIN Raden Intan Lampung. 
                    Dengan bermitra bersama kami, perusahaan Anda akan mendapatkan akses ke talenta-talenta muda yang berpotensi, 
                    energik, dan siap berkontribusi.
                </p>
            </div>

            <!-- Benefits Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-2xl mb-6 group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Akses Talenta Berkualitas</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Temukan mahasiswa dan alumni UIN RIL yang sesuai dengan kebutuhan rekrutmen dan program magang perusahaan Anda.
                        </p>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-2xl mb-6 group-hover:bg-green-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Publikasi Lowongan Efektif</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Publikasikan lowongan magang dan pekerjaan Anda secara gratis dan jangkau ribuan pencari kerja potensial.
                        </p>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-2xl mb-6 group-hover:bg-purple-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Branding Perusahaan</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Tingkatkan citra perusahaan Anda di kalangan akademisi dan calon tenaga kerja profesional.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Partnership Section -->
            <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">
                            Bagaimana Cara Menjadi <span class="text-blue-600">Mitra?</span>
                        </h3>
                        <p class="text-gray-700 mb-8 leading-relaxed">
                            Kami sangat terbuka untuk berbagai bentuk kerjasama yang saling menguntungkan. 
                            Beberapa cara untuk bermitra dengan kami antara lain:
                        </p>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 p-4 bg-blue-50 rounded-xl">
                            <div class="flex-shrink-0 w-3 h-3 bg-blue-500 rounded-full mt-2"></div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Penyediaan Lowongan Magang</h4>
                                <p class="text-gray-600 text-sm">Tawarkan program magang bagi mahasiswa kami untuk mendapatkan pengalaman kerja nyata.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-4 bg-green-50 rounded-xl">
                            <div class="flex-shrink-0 w-3 h-3 bg-green-500 rounded-full mt-2"></div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Publikasi Lowongan Kerja</h4>
                                <p class="text-gray-600 text-sm">Informasikan lowongan pekerjaan di perusahaan Anda kepada jaringan alumni dan mahasiswa tingkat akhir kami.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-4 bg-purple-50 rounded-xl">
                            <div class="flex-shrink-0 w-3 h-3 bg-purple-500 rounded-full mt-2"></div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Campus Hiring & Presentasi Perusahaan</h4>
                                <p class="text-gray-600 text-sm">Selenggarakan sesi rekrutmen atau presentasi profil perusahaan langsung di kampus kami.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-4 bg-yellow-50 rounded-xl">
                            <div class="flex-shrink-0 w-3 h-3 bg-yellow-500 rounded-full mt-2"></div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Partisipasi dalam Job Fair</h4>
                                <p class="text-gray-600 text-sm">Bergabunglah dalam event job fair yang kami adakan secara berkala.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-4 bg-indigo-50 rounded-xl">
                            <div class="flex-shrink-0 w-3 h-3 bg-indigo-500 rounded-full mt-2"></div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Program Kunjungan Industri atau Kuliah Umum</h4>
                                <p class="text-gray-600 text-sm">Berbagi pengalaman dan wawasan industri dengan mahasiswa kami.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 lg:py-20 bg-gradient-to-r from-gray-900 to-blue-900">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-2xl md:text-3xl font-bold text-white mb-6">
                Siap Memulai <span class="text-yellow-300">Kemitraan?</span>
            </h3>
            <p class="text-gray-300 mb-8 leading-relaxed">
                Jika perusahaan Anda tertarik untuk menjalin kemitraan atau ingin mengetahui lebih lanjut mengenai program-program kami, 
                silakan hubungi tim Career Development Center UIN Raden Intan Lampung.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="flex items-center justify-center w-12 h-12 bg-blue-500 rounded-xl mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <h4 class="text-white font-semibold mb-2">Email</h4>
                    <a href="mailto:kerjasama.cdc@uinril.ac.id" class="text-blue-300 hover:text-blue-200 transition-colors duration-300">
                        kerjasama.cdc@uinril.ac.id
                    </a>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="flex items-center justify-center w-12 h-12 bg-green-500 rounded-xl mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                    </div>
                    <h4 class="text-white font-semibold mb-2">Telepon</h4>
                    <p class="text-gray-300">
                        (0721) 123-456<br>
                        <span class="text-sm">(CP: Nama Kontak)</span>
                    </p>
                </div>
            </div>
            
            <p class="text-gray-300 mb-8">
                Atau Anda dapat langsung mengunjungi kantor kami 
                <a href="{{ route('public.contact') }}" class="text-blue-300 hover:text-blue-200 underline transition-colors duration-300">
                    (lihat halaman Kontak Kami)
                </a>
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('company.login') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Login sebagai Perusahaan Mitra
                </a>
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white/30 hover:border-white/60 text-white font-semibold rounded-2xl transition-all duration-300 hover:bg-white/10">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection