{{-- resources/views/company/profile/edit.blade.php --}}
@extends('layouts.company') {{-- Gunakan layout perusahaan --}}

@section('title', 'Edit Profil Perusahaan Anda')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Profil Perusahaan</h1>
                <p class="text-lg text-gray-600">{{ $company->name }}</p>
            </div>

            @include('components.alert-dismissible') {{-- Komponen alert --}}

            <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Kolom Utama (2/3 width) --}}
                    <div class="lg:col-span-2 space-y-8">
                        {{-- Card Informasi Utama (Read-only) --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-2 0H9m-2 0H7m2 0v-4a1 1 0 011-1h2a1 1 0 011 1v4">
                                        </path>
                                    </svg>
                                    Informasi Utama Perusahaan
                                </h2>
                            </div>
                            <div class="p-6 space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>
                                    <input type="text"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed"
                                        value="{{ $company->name }}" readonly disabled>
                                    <p class="mt-2 text-sm text-gray-500">Nama perusahaan dikelola oleh Admin CDC.</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Kontak Utama</label>
                                    <input type="email"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed"
                                        value="{{ $company->email }}" readonly disabled>
                                    <p class="mt-2 text-sm text-gray-500">Email kontak utama dikelola oleh Admin CDC.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Card Detail Perusahaan (Bisa Diedit) --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Detail Perusahaan (Dapat Diedit)
                                </h2>
                            </div>
                            <div class="p-6 space-y-6">
                                {{-- Deskripsi --}}
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                                        Perusahaan</label>
                                    <textarea
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('description') border-red-500 ring-2 ring-red-200 @enderror"
                                        id="description" name="description" rows="5" placeholder="Ceritakan tentang perusahaan Anda...">{{ old('description', $company->description ?? '') }}</textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Alamat (Singkat) --}}
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Kantor
                                        (Singkat)</label>
                                    <input type="text"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('address') border-red-500 ring-2 ring-red-200 @enderror"
                                        id="address" name="address" value="{{ old('address', $company->address ?? '') }}"
                                        placeholder="Alamat singkat kantor">
                                    @error('address')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Grid untuk Phone dan Website --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Nomor Telepon --}}
                                    <div>
                                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                            Telepon</label>
                                        <input type="tel"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('phone_number') border-red-500 ring-2 ring-red-200 @enderror"
                                            id="phone_number" name="phone_number"
                                            value="{{ old('phone_number', $company->phone_number ?? '') }}"
                                            placeholder="+62 21 1234567">
                                        @error('phone_number')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Website --}}
                                    <div>
                                        <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website
                                            Perusahaan</label>
                                        <input type="url"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('website') border-red-500 ring-2 ring-red-200 @enderror"
                                            id="website" name="website" placeholder="https://example.com"
                                            value="{{ old('website', $company->website ?? '') }}">
                                        @error('website')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card Informasi Tambahan --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-purple-50 to-violet-50 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Informasi Tambahan & Kontak
                                </h2>
                            </div>
                            <div class="p-6 space-y-6">
                                {{-- Grid untuk Industri dan Karyawan --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Industri --}}
                                    <div>
                                        <label for="industry"
                                            class="block text-sm font-medium text-gray-700 mb-2">Industri</label>
                                        <input type="text"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('industry') border-red-500 ring-2 ring-red-200 @enderror"
                                            id="industry" name="industry"
                                            value="{{ old('industry', $company->industry ?? '') }}"
                                            placeholder="e.g. Teknologi, Finansial">
                                        @error('industry')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Jumlah Karyawan --}}
                                    <div>
                                        <label for="employee_count_range"
                                            class="block text-sm font-medium text-gray-700 mb-2">Range Jumlah
                                            Karyawan</label>
                                        <input type="text"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('employee_count_range') border-red-500 ring-2 ring-red-200 @enderror"
                                            id="employee_count_range" name="employee_count_range"
                                            placeholder="50-200, 1000+"
                                            value="{{ old('employee_count_range', $company->employee_count_range ?? '') }}">
                                        @error('employee_count_range')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Alamat Lengkap --}}
                                <div>
                                    <label for="full_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                        Lengkap (untuk Peta Google)</label>
                                    <textarea
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('full_address') border-red-500 ring-2 ring-red-200 @enderror"
                                        id="full_address" name="full_address" rows="2" placeholder="Alamat lengkap dengan kode pos">{{ old('full_address', $company->full_address ?? ($company->address ?? '')) }}</textarea>
                                    @error('full_address')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- URL Google Maps Embed --}}
                                <div>
                                    <label for="google_maps_embed_url"
                                        class="block text-sm font-medium text-gray-700 mb-2">URL Google Maps Embed</label>
                                    <textarea
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('google_maps_embed_url') border-red-500 ring-2 ring-red-200 @enderror"
                                        id="google_maps_embed_url" name="google_maps_embed_url" rows="3"
                                        placeholder="Tempel kode iframe dari Google Maps di sini">{{ old('google_maps_embed_url', $company->google_maps_embed_url ?? '') }}</textarea>
                                    <p class="mt-2 text-sm text-gray-500">Buka Google Maps > Cari lokasi > Share > Embed a
                                        map > Copy HTML.</p>
                                    @error('google_maps_embed_url')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Sosial Media --}}
                                <div class="pt-4 border-t border-gray-200">
                                    <h3 class="text-base font-medium text-gray-900 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Link Sosial Media
                                    </h3>
                                    <div class="space-y-4">
                                        {{-- LinkedIn --}}
                                        <div>
                                            <label for="linkedin_url"
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-blue-700" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                                </svg>
                                                LinkedIn URL
                                            </label>
                                            <input type="url"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('linkedin_url') border-red-500 ring-2 ring-red-200 @enderror"
                                                id="linkedin_url" name="linkedin_url"
                                                value="{{ old('linkedin_url', $company->linkedin_url ?? '') }}"
                                                placeholder="https://linkedin.com/company/...">
                                            @error('linkedin_url')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        {{-- Instagram --}}
                                        <div>
                                            <label for="instagram_url"
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-pink-600" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.618 5.367 11.986 11.988 11.986s11.987-5.368 11.987-11.986C24.014 5.367 18.635.001 12.017.001zm4.29 8.988c-.022.147-.035.298-.035.451 0 4.613-3.51 9.932-9.929 9.932-1.971 0-3.804-.578-5.347-1.566.272.032.551.048.835.048 1.638 0 3.144-.559 4.34-1.495-1.53-.029-2.821-.04-3.276-2.067.213.041.432.063.657.063.319 0 .628-.043.922-.124-1.598-.322-2.803-1.733-2.803-3.426v-.043c.471.262 1.009.419 1.581.437-.937-.626-1.552-1.696-1.552-2.91 0-.641.173-1.241.474-1.756 1.724 2.115 4.298 3.506 7.202 3.652-.059-.262-.09-.535-.09-.817 0-1.978 1.602-3.58 3.58-3.58.103 0 .205.004.305.013 1.112-.218 2.158-.622 3.106-1.177-.364 1.14-1.14 2.095-2.147 2.698.989-.118 1.931-.38 2.811-.769-.654.981-1.484 1.842-2.438 2.53z" />
                                                </svg>
                                                Instagram URL
                                            </label>
                                            <input type="url"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('instagram_url') border-red-500 ring-2 ring-red-200 @enderror"
                                                id="instagram_url" name="instagram_url"
                                                value="{{ old('instagram_url', $company->instagram_url ?? '') }}"
                                                placeholder="https://instagram.com/...">
                                            @error('instagram_url')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        {{-- Twitter --}}
                                        <div>
                                            <label for="twitter_url"
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-blue-400" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                                </svg>
                                                Twitter URL
                                            </label>
                                            <input type="url"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('twitter_url') border-red-500 ring-2 ring-red-200 @enderror"
                                                id="twitter_url" name="twitter_url"
                                                value="{{ old('twitter_url', $company->twitter_url ?? '') }}"
                                                placeholder="https://twitter.com/...">
                                            @error('twitter_url')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card Galeri Foto --}}
                        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b font-semibold">Galeri Foto Perusahaan</div>
                            <div class="p-4">
                                <div class="mb-4">
                                    <label for="gallery_photos"
                                        class="block text-sm font-medium text-gray-700 mb-1">Tambah Foto Baru ke Galeri
                                        (Bisa pilih banyak)</label>
                                    <input type="file"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('gallery_photos.*') border-red-500 @enderror"
                                        id="gallery_photos" name="gallery_photos[]" multiple accept="image/*">
                                    @error('gallery_photos.*')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Maks 2MB per foto. Format: JPG, PNG, GIF.</p>
                                </div>

                                @if ($company->photos && $company->photos->isNotEmpty())
                                    <hr class="my-4 border-gray-200">
                                    <h6 class="text-sm font-semibold text-gray-800 mb-3">Foto Saat Ini di Galeri:</h6>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                        @foreach ($company->photos as $photo)
                                            <div class="relative">
                                                <img src="{{ Storage::url($photo->photo_path) }}" alt="Gallery Photo"
                                                    class="w-full h-32 object-cover rounded-lg border">
                                                <div class="absolute top-2 right-2 bg-white bg-opacity-90 rounded p-1">
                                                    <div class="flex items-center">
                                                        <input
                                                            class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded"
                                                            type="checkbox" name="delete_photos[]"
                                                            value="{{ $photo->id }}"
                                                            id="delete_photo_{{ $photo->id }}">
                                                        <label class="ml-1 text-xs text-red-600 font-medium"
                                                            for="delete_photo_{{ $photo->id }}">
                                                            Hapus
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-sm">Belum ada foto di galeri.</p>
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- Kolom Sidebar (1/3 width) --}}
                    <div class="lg:col-span-1 space-y-8">
                        {{-- Card Logo --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden ">
                            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Logo Perusahaan
                                </h2>
                            </div>
                            <div class="p-6">
                                <div class="text-center mb-6">
                                    @if ($company->logo_path && Storage::disk('public')->exists($company->logo_path))
                                        <div class="relative inline-block">
                                            <img id="logo-preview" src="{{ Storage::url($company->logo_path) }}"
                                                alt="Logo Preview"
                                                class="w-32 h-32 object-contain mx-auto bg-gray-50 rounded-lg border border-gray-200 shadow-sm">
                                            <div class="absolute -top-2 -right-2">
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Current
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label
                                                class="inline-flex items-center px-4 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 cursor-pointer transition-colors">
                                                <input type="checkbox" value="1" id="remove_logo"
                                                    name="remove_logo" class="sr-only peer">
                                                <svg class="w-4 h-4 mr-2 peer-checked:text-red-800" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                Hapus logo saat ini
                                            </label>
                                        </div>
                                    @else
                                        <div
                                            class="w-32 h-32 mx-auto bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-xs text-gray-500">No Logo</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Upload Logo
                                        Baru</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="logo"
                                            class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-6 h-6 mb-1 text-gray-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                <p class="text-xs text-gray-500">Pilih file logo</p>
                                            </div>
                                            <input class="hidden @error('logo') border-red-500 @enderror" type="file"
                                                id="logo" name="logo" accept="image/*"
                                                onchange="previewCompanyLogo(event)">
                                        </label>
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG. Maks: 2MB</p>
                                    @error('logo')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Card Actions --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4">
                                        </path>
                                    </svg>
                                    Aksi
                                </h2>
                            </div>
                            <div class="p-6 space-y-4">
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-200 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Perubahan Profil
                                </button>
                                <a href="{{ route('company.dashboard') }}"
                                    class="w-full flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:ring-4 focus:ring-gray-200 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal
                                </a>
                            </div>
                        </div>

                        {{-- Quick Stats Card --}}
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-6 border border-blue-200">
                            <h3 class="text-lg font-semibold text-blue-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                Status Profil
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-blue-700">Kelengkapan Profil</span>
                                    <div class="flex items-center">
                                        @php
                                            $completeness = 0;
                                            $fields = ['description', 'address', 'phone_number', 'website', 'industry'];
                                            foreach ($fields as $field) {
                                                if (!empty($company->$field)) {
                                                    $completeness += 20;
                                                }
                                            }
                                        @endphp
                                        <div class="w-16 bg-blue-200 rounded-full h-2 mr-2">
                                            <div class="bg-blue-600 h-2 rounded-full"
                                                style="width: {{ $completeness }}%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-blue-800">{{ $completeness }}%</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-blue-700">Foto Galeri</span>
                                    <span
                                        class="text-sm font-medium text-blue-800">{{ $company->photos ? $company->photos->count() : 0 }}
                                        foto</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-blue-700">Logo</span>
                                    <span class="text-sm font-medium text-blue-800">
                                        @if ($company->logo_path && Storage::disk('public')->exists($company->logo_path))
                                            ✓ Ada
                                        @else
                                            ✗ Belum
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Fungsi preview logo (pastikan nama fungsi unik jika sudah ada di layout)
        function previewCompanyLogo(event) {
            var reader = new FileReader();
            var output = document.getElementById('logo-preview');
            reader.onload = function() {
                output.src = reader.result;
                output.className =
                    "w-32 h-32 object-contain mx-auto bg-gray-50 rounded-lg border border-gray-200 shadow-sm";
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                @if ($company->logo_path && Storage::disk('public')->exists($company->logo_path))
                    output.src = "{{ Storage::url($company->logo_path) }}";
                @else
                    output.src = "https://via.placeholder.com/150?text=No+Logo";
                @endif
            }
        }

        // Enhanced file upload feedback
        document.getElementById('gallery_photos').addEventListener('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) {
                const label = e.target.parentElement.querySelector('p');
                label.innerHTML =
                `<span class="font-medium text-green-600">${files.length} file(s) selected</span>`;
            }
        });

        // Drag and drop functionality
        const dropZone = document.querySelector('label[for="gallery_photos"]');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('bg-blue-50', 'border-blue-300');
        }

        function unhighlight(e) {
            dropZone.classList.remove('bg-blue-50', 'border-blue-300');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('gallery_photos').files = files;

            if (files.length > 0) {
                const label = dropZone.querySelector('p');
                label.innerHTML = `<span class="font-medium text-green-600">${files.length} file(s) selected</span>`;
            }
        }
    </script>
@endpush
