{{-- resources/views/mahasiswa/profile/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Edit Profil Saya')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengaturan Profil</h1>
            <p class="text-gray-600 mb-8">Kelola informasi pribadi dan akademik Anda</p>

            {{-- Notifikasi --}}
            @if (session('status') === 'profile-updated')
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md flex items-center justify-between"
                    x-data="{ show: true }" x-show="show">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-green-700">Profil berhasil diperbarui.</span>
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md flex items-center justify-between"
                    x-data="{ show: true }" x-show="show">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-green-700">Password berhasil diperbarui.</span>
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            @endif

            <div class="grid grid-cols-12 gap-6">
                {{-- Sidebar Navigation --}}
                <div class="col-span-12 lg:col-span-3">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden sticky top-20">
                        <nav class="flex flex-col">
                            <a href="#profile-info"
                                class="px-6 py-4 text-indigo-600 border-l-4 border-indigo-600 bg-indigo-50 font-medium">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Informasi Profil
                                </div>
                            </a>
                            <a href="#security"
                                class="px-6 py-4 text-gray-700 hover:bg-gray-50 border-l-4 border-transparent hover:border-gray-300 font-medium transition-all">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    Keamanan
                                </div>
                            </a>
                            <a href="#danger-zone"
                                class="px-6 py-4 text-red-600 hover:bg-red-50 border-l-4 border-transparent hover:border-red-300 font-medium transition-all">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Danger Zone
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="col-span-12 lg:col-span-9 space-y-6">
                    {{-- Profile Information --}}
                    <div id="profile-info" class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="border-b border-gray-200">
                            <div class="px-6 py-5">
                                <h2 class="text-xl font-semibold text-gray-900">Informasi Akun & Profil</h2>
                                <p class="mt-1 text-sm text-gray-600">Detail informasi personal dan akademik Anda</p>
                            </div>
                        </div>

                        {{-- Form --}}
                        <form method="post" action="{{ route('mahasiswa.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="p-6 space-y-6">
                                {{-- Foto Profil --}}
                                <div class="flex flex-col items-center mb-6 pb-6 border-b border-gray-200">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>

                                    <div
                                        class="relative group w-32 h-32 rounded-full overflow-hidden border-4 border-gray-200 mb-4">
                                        {{-- Avatar Preview --}}
                                        <img id="avatar-preview"
                                            src="{{ $studentProfile->avatar_url ?? asset('images/default-avatar.png') }}"
                                            alt="Foto Profil" class="w-full h-full object-cover">

                                        {{-- Upload Overlay --}}
                                        <label for="avatar_upload"
                                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                            <span class="flex items-center">
                                                <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Ganti Foto
                                            </span>
                                        </label>
                                    </div>

                                    <input type="file" id="avatar_upload" name="avatar"
                                        accept="image/jpeg,image/png,image/gif" class="hidden"
                                        onchange="previewAvatar(event)">

                                    {{-- Error message --}}
                                    @error('avatar')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    {{-- Remove avatar option (if avatar exists) --}}
                                    @if ($studentProfile && $studentProfile->avatar_path)
                                        <div class="mt-2">
                                            <label for="remove_avatar" class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" id="remove_avatar" name="remove_avatar"
                                                    value="1"
                                                    class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                                <span class="ml-2 text-sm text-red-600">Hapus Foto Profil</span>
                                            </label>
                                        </div>
                                    @endif

                                    <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal: 2MB.</p>
                                </div>
                                {{-- Pesan Error Umum --}}
                                @if ($errors->any() && !$errors->hasBag('updatePassword') && !$errors->hasBag('userDeletion'))
                                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-red-500 mr-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-red-700">Terdapat kesalahan pada input Anda. Silakan periksa
                                                kembali.</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Nama --}}
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap</label>
                                        <input id="name" name="name" type="text"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                                            value="{{ old('name', $user->name) }}" required autofocus>
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div>
                                        <label for="email"
                                            class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input id="email" name="email" type="email"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                                            value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror

                                        {{-- Info Verifikasi Email --}}
                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                            <div class="mt-2">
                                                <p class="text-sm text-amber-600">
                                                    Email Anda belum diverifikasi.
                                                    <button form="send-verification"
                                                        class="text-indigo-600 hover:text-indigo-800 underline text-sm">
                                                        Kirim ulang email verifikasi
                                                    </button>
                                                </p>
                                                @if (session('status') === 'verification-link-sent')
                                                    <p class="text-sm text-green-600 mt-1">
                                                        Link verifikasi baru telah dikirim ke alamat email Anda.
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    {{-- NIM --}}
                                    <div>
                                        <label for="nim"
                                            class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                                        <input id="nim" name="nim" type="text"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('nim') border-red-500 @enderror"
                                            value="{{ old('nim', $studentProfile->nim ?? '') }}" required>
                                        @error('nim')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Jurusan --}}
                                    <div>
                                        <label for="major" class="block text-sm font-medium text-gray-700 mb-1">Jurusan
                                            / Prodi</label>
                                        <input id="major" name="major" type="text"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('major') border-red-500 @enderror"
                                            value="{{ old('major', $studentProfile->major ?? '') }}">
                                        @error('major')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Tahun Masuk --}}
                                    <div>
                                        <label for="entry_year" class="block text-sm font-medium text-gray-700 mb-1">Tahun
                                            Masuk</label>
                                        <input id="entry_year" name="entry_year" type="number"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('entry_year') border-red-500 @enderror"
                                            value="{{ old('entry_year', $studentProfile->entry_year ?? '') }}"
                                            placeholder="YYYY">
                                        @error('entry_year')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Nomor Telepon --}}
                                    <div>
                                        <label for="phone_number"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon
                                            Aktif</label>
                                        <input id="phone_number" name="phone_number" type="tel"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('phone_number') border-red-500 @enderror"
                                            value="{{ old('phone_number', $studentProfile->phone_number ?? '') }}">
                                        @error('phone_number')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Alamat --}}
                                <div>
                                    <label for="address"
                                        class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <textarea id="address" name="address" rows="2"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('address') border-red-500 @enderror">{{ old('address', $studentProfile->address ?? '') }}</textarea>
                                    @error('address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Bio --}}
                                <div>
                                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio
                                        Singkat</label>
                                    <textarea id="bio" name="bio" rows="3"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('bio') border-red-500 @enderror">{{ old('bio', $studentProfile->bio ?? '') }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500">Ceritakan sedikit tentang diri dan minat Anda</p>
                                    @error('bio')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Pengelolaan CV --}}
                                <div class="border border-gray-200 rounded-lg p-5 bg-gray-50">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Curriculum Vitae
                                        (CV)</label>

                                    @if ($studentProfile && $studentProfile->cv_path && Storage::disk('public')->exists($studentProfile->cv_path))
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center justify-between p-3 bg-white rounded-lg mb-3 border border-gray-200">
                                            <div class="flex items-center mb-2 sm:mb-0">
                                                <svg class="w-8 h-8 text-red-500 mr-3" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <div>
                                                    <p class="font-medium">CV Saat Ini</p>
                                                    <a href="{{ Storage::url($studentProfile->cv_path) }}"
                                                        target="_blank"
                                                        class="text-sm text-indigo-600 hover:text-indigo-800">
                                                        <span class="flex items-center">
                                                            Lihat File
                                                            <svg class="w-4 h-4 ml-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <label for="remove_cv" class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" id="remove_cv" name="remove_cv"
                                                        value="1"
                                                        class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                                    <span class="ml-2 text-sm text-red-600">Hapus CV</span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="flex items-center p-3 bg-amber-50 border border-amber-200 rounded-lg mb-3 text-amber-700">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Anda belum mengunggah CV.</span>
                                        </div>
                                    @endif

                                    <div class="mt-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload CV Baru</label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="cv_upload"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                                        <span>Upload file</span>
                                                        <input id="cv_upload" name="cv" type="file"
                                                            class="sr-only" accept=".pdf,.doc,.docx">
                                                    </label>
                                                    <p class="pl-1">atau seret dan lepas</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PDF atau Word hingga 5MB</p>
                                            </div>
                                        </div>
                                        @error('cv')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">Mengupload file baru akan menggantikan file CV
                                        yang lama (jika ada).</p>
                                </div>
                            </div>

                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                                <div class="text-xs text-gray-500">Terakhir diperbarui:
                                    {{ $studentProfile->updated_at ?? 'Belum pernah' }}</div>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Password Section --}}
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}"
                        class="hidden">
                        @csrf
                    </form>

                    <div id="security" class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="border-b border-gray-200">
                            <div class="px-6 py-5">
                                <h2 class="text-xl font-semibold text-gray-900">Keamanan Akun</h2>
                                <p class="mt-1 text-sm text-gray-600">Perbarui password untuk menjaga keamanan akun Anda
                                </p>
                            </div>
                        </div>

                        <div class="p-6">
                            @include('mahasiswa.profile.partials.update-password-form')
                        </div>
                    </div>

                    {{-- Danger Zone --}}
                    <div id="danger-zone" class="bg-white rounded-xl shadow-sm overflow-hidden border border-red-200">
                        <div class="border-b border-red-200 bg-red-50">
                            <div class="px-6 py-5">
                                <h2 class="text-xl font-semibold text-red-700 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    Danger Zone
                                </h2>
                                <p class="mt-1 text-sm text-red-600">Tindakan berbahaya yang bersifat permanen</p>
                            </div>
                        </div>

                        <div class="p-6">
                            @include('mahasiswa.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function previewAvatar(event) {
        const reader = new FileReader();
        const preview = document.getElementById('avatar-preview');
        
        reader.onload = function() {
            if (reader.readyState === 2) { // DONE state
                preview.src = reader.result;
            }
        };
        
        if (event.target.files && event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        } else {
            // Reset to default or previous avatar
            @if($studentProfile && $studentProfile->avatar_url && $studentProfile->avatar_url !== asset('images/default-avatar.png'))
                preview.src = "{{ $studentProfile->avatar_url }}";
            @else
                preview.src = "{{ asset('images/default-avatar.png') }}";
            @endif
        }
    }
</script>
@endpush