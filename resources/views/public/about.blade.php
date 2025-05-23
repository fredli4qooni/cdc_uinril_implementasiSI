{{-- resources/views/public/about.blade.php --}}
@extends('layouts.app')
@section('title', 'Tentang Kami - CDC UIN RIL')

@section('content')
    {{-- Header Halaman dengan Gradient Background --}}
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-20">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-fade-in">
                Tentang Career Development Center
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 font-light">
                UIN Raden Intan Lampung
            </p>
            <div class="mt-8">
                <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                {{-- Welcome Section --}}
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-12 border border-gray-100">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6 text-center">
                        Selamat Datang di CDC UIN Raden Intan Lampung
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600 leading-relaxed text-center">
                        Career Development Center (CDC) UIN Raden Intan Lampung adalah unit yang berdedikasi untuk menjadi
                        jembatan antara mahasiswa dan alumni dengan dunia profesional. Kami berkomitmen untuk mempersiapkan
                        sumber daya manusia yang unggul, kompetitif, dan siap menghadapi tantangan global.
                    </p>
                </div>

                {{-- Vision Section --}}
                <div
                    class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 md:p-10 mb-8 border-l-4 border-blue-500">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-8 h-8 text-blue-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Visi Kami
                    </h3>
                    <p class="text-gray-700 text-lg leading-relaxed italic">
                        "Menjadi pusat pengembangan karir yang profesional, inovatif, dan terpercaya dalam mempersiapkan
                        lulusan UIN Raden Intan Lampung yang berdaya saing tinggi di tingkat nasional dan internasional."
                    </p>
                </div>

                {{-- Mission Section --}}
                <div
                    class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-8 md:p-10 mb-12 border-l-4 border-green-500">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-8 h-8 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        Misi Kami
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-green-600 font-semibold text-sm">1</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Menyediakan layanan informasi karir yang akurat dan terkini mengenai peluang magang,
                                lowongan kerja, dan beasiswa.
                            </p>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-green-600 font-semibold text-sm">2</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Menyelenggarakan program pelatihan dan pengembangan diri untuk meningkatkan kompetensi dan
                                kesiapan kerja mahasiswa dan alumni.
                            </p>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-green-600 font-semibold text-sm">3</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Membangun dan memperluas jaringan kerjasama dengan berbagai industri, perusahaan, dan
                                instansi pemerintah maupun swasta.
                            </p>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-green-600 font-semibold text-sm">4</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Memberikan layanan konseling karir untuk membantu mahasiswa dan alumni dalam perencanaan dan
                                pengambilan keputusan karir.
                            </p>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-green-600 font-semibold text-sm">5</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Melakukan studi pelacakan alumni (tracer study) untuk evaluasi dan peningkatan kualitas
                                layanan.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Services Section --}}
                <div class="mb-12">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">
                        Layanan Unggulan
                    </h3>
                    <div class="grid md:grid-cols-3 gap-6">
                        {{-- Service Card 1 --}}
                        <div
                            class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200">
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-500 transition-colors duration-300">
                                        <svg class="w-6 h-6 text-blue-500 group-hover:text-white transition-colors duration-300"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h2zm-2 8a1 1 0 001 1h10a1 1 0 001-1V8a1 1 0 00-1-1H5a1 1 0 00-1 1v6zm6-4a1 1 0 011 1v2a1 1 0 11-2 0v-2a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h5
                                        class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                        Informasi Karir
                                    </h5>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Akses ke banyak informasi lowongan magang dari berbagai perusahaan mitra
                                    dan sumber terpercaya.
                                </p>
                            </div>
                        </div>

                        {{-- Service Card 2 --}}
                        <div
                            class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200">
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-green-500 transition-colors duration-300">
                                        <svg class="w-6 h-6 text-green-500 group-hover:text-white transition-colors duration-300"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                        </svg>
                                    </div>
                                    <h5
                                        class="text-xl font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                                        Pelatihan & Workshop
                                    </h5>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Program peningkatan soft skills dan hard skills seperti pembuatan CV, teknik wawancara,
                                    dan keahlian spesifik industri.
                                </p>
                            </div>
                        </div>

                        {{-- Service Card 4 --}}
                        <div
                            class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-amber-200">
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-amber-500 transition-colors duration-300">
                                        <svg class="w-6 h-6 text-amber-500 group-hover:text-white transition-colors duration-300"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h5
                                        class="text-xl font-bold text-gray-800 group-hover:text-amber-600 transition-colors duration-300">
                                        Event Karir
                                    </h5>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Informasi dan partisipasi dalam job fair, seminar karir, campus hiring, dan kunjungan
                                    industri.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CTA Section --}}
                <div class="text-center bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 md:p-12 text-white">
                    <h4 class="text-2xl font-bold mb-4">Siap Memulai Perjalanan Karir Anda?</h4>
                    <p class="text-blue-100 mb-6 text-lg">
                        Bergabunglah dengan ribuan mahasiswa dan alumni yang telah merasakan manfaat layanan CDC UIN RIL
                    </p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
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
    </style>
@endsection
