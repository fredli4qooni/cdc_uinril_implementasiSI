{{-- resources/views/company/applicants/show.blade.php --}}
@extends('layouts.company')

@section('title', 'Detail Pendaftar')
@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h2 class="text-2xl font-bold text-teal-800 flex items-center">
            <span class="bg-teal-100 p-2 rounded-lg mr-3 transform transition-all duration-300 hover:scale-110">
                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <span class="transform transition-all duration-500 hover:text-teal-600">Detail Pendaftar: {{ $application->user->name ?? 'N/A' }}</span>
        </h2>
        <a href="{{ url()->previous(route('company.applicants.index')) }}" 
           class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 text-sm border border-teal-300 rounded-lg text-teal-700 bg-white hover:bg-teal-50 shadow-sm transition-all duration-300 hover:shadow-md">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Pendaftar
        </a>
    </div>

    @include('components.alert-dismissible')

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- Kolom Detail Mahasiswa --}}
        <div class="lg:col-span-7">
            <div class="bg-white rounded-xl shadow-lg h-full overflow-hidden border border-teal-100 transform transition-all duration-500 hover:shadow-2xl">
                <div class="bg-gradient-to-r from-teal-600 to-teal-400 px-4 py-4 text-white">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h6 class="font-bold">Informasi Mahasiswa</h6>
                    </div>
                </div>
                <div class="p-6">
                    @if($application->user && $application->user->studentProfile)
                        <dl class="grid grid-cols-1 sm:grid-cols-12 gap-y-4">
                            @php
                                $fields = [
                                    'Nama Lengkap' => $application->user->name,
                                    'NIM' => $application->user->studentProfile->nim,
                                    'Jurusan / Prodi' => $application->user->studentProfile->major ?? '-',
                                    'Tahun Masuk' => $application->user->studentProfile->entry_year ?? '-',
                                    'Email' => $application->user->email,
                                    'No. Telepon' => $application->user->studentProfile->phone_number ?? '-',
                                    'Alamat' => $application->user->studentProfile->address ?? '-',
                                    'Bio' => $application->user->studentProfile->bio ?? '-'
                                ];
                            @endphp

                            @foreach($fields as $label => $value)
                                <dt class="sm:col-span-4 font-medium text-teal-700 flex items-center">
                                    <span class="bg-teal-50 p-1 rounded-md mr-2">
                                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </span>
                                    {{ $label }}
                                </dt>
                                <dd class="sm:col-span-8 text-gray-800 hover:text-teal-600 transition-colors duration-300">{{ $value }}</dd>
                            @endforeach

                            <dt class="sm:col-span-4 font-medium text-teal-700 flex items-center">
                                <span class="bg-teal-50 p-1 rounded-md mr-2">
                                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </span>
                                CV Mahasiswa
                            </dt>
                            <dd class="sm:col-span-8">
                                @if($application->user->studentProfile->cv_path && Storage::disk('public')->exists($application->user->studentProfile->cv_path))
                                    <a href="{{ Storage::url($application->user->studentProfile->cv_path) }}" target="_blank" 
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-teal-500 hover:bg-teal-600 transform transition-all duration-300 hover:scale-105 shadow-md">
                                        <svg class="w-4 h-4 mr-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Download / Lihat CV
                                    </a>
                                @else
                                    <span class="text-red-600 font-bold bg-red-50 px-3 py-1 rounded-full">CV Tidak Tersedia!</span>
                                @endif
                            </dd>
                        </dl>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 text-yellow-700 rounded-md">
                            <div class="flex">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span>Data mahasiswa tidak lengkap atau tidak ditemukan.</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom Detail Lamaran & Update Status --}}
        <div class="lg:col-span-5">
            <div class="bg-white rounded-xl shadow-lg h-full border border-teal-100 transform transition-all duration-500 hover:shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-teal-400 px-4 py-4 text-white">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <h6 class="font-bold">Detail Lamaran & Status</h6>
                    </div>
                </div>
                <div class="p-6">
                    <dl class="mb-6 space-y-4">
                        <div class="flex flex-col">
                            <dt class="font-medium text-teal-700 flex items-center mb-2">
                                <span class="bg-teal-50 p-1 rounded-md mr-2">
                                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                                Lowongan Dilamar
                            </dt>
                            <dd class="mb-3 pl-8 text-gray-800 hover:text-teal-600 transition-colors duration-300">{{ $application->vacancy->title ?? 'N/A' }}</dd>
                        </div>
                        
                        <div class="flex flex-col">
                            <dt class="font-medium text-teal-700 flex items-center mb-2">
                                <span class="bg-teal-50 p-1 rounded-md mr-2">
                                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                                Tanggal Mendaftar
                            </dt>
                            <dd class="mb-3 pl-8 text-gray-800 hover:text-teal-600 transition-colors duration-300">{{ $application->application_date->format('l, d F Y - H:i') }}</dd>
                        </div>
                        
                        <div class="flex flex-col">
                            <dt class="font-medium text-teal-700 flex items-center mb-2">
                                <span class="bg-teal-50 p-1 rounded-md mr-2">
                                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </span>
                                Status Saat Ini
                            </dt>
                            <dd class="mb-3 pl-8">
                                <span class="px-4 py-1.5 text-base rounded-full shadow-sm {{ getStatusBadgeClass($application->status) }} transform transition-all duration-300 hover:scale-105 inline-block">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </dd>
                        </div>
                    </dl>

                    <div class="relative py-3">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-teal-200"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-3 text-sm text-teal-500 font-medium">Kelola Status</span>
                        </div>
                    </div>

                    <form action="{{ route('company.applicants.updateStatus', $application->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')

                        @php
                            $allowedStatuses = ['reviewed' => 'Telah Direview', 'accepted' => 'Terima', 'rejected' => 'Tolak'];
                        @endphp

                        {{-- Pilih Status Baru --}}
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                                <span class="bg-teal-50 p-1 rounded-md mr-2">
                                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                    </svg>
                                </span>
                                Pilih Status Baru <span class="text-red-600">*</span>
                            </label>
                            <select name="status" id="status" class="w-full rounded-lg border-teal-300 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 @error('status') border-red-500 @enderror transition-all duration-300" required>
                                <option value="" disabled selected>-- Pilih Tindakan --</option>
                                @foreach($allowedStatuses as $key => $value)
                                    {{-- Jangan tampilkan status saat ini sebagai pilihan --}}
                                    @if($application->status != $key)
                                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endif
                                @endforeach
                                {{-- Tampilkan kembali status saat ini jika hanya ada 1 opsi tersisa (atau tidak ada) --}}
                                @if(count(array_diff_key($allowedStatuses, [$application->status => ''])) <= 1)
                                    <option value="{{ $application->status }}" disabled> -- Status saat ini: {{ ucfirst($application->status) }} --</option>
                                @endif
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Catatan Perusahaan --}}
                        <div class="mb-4">
                            <label for="company_notes" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                                <span class="bg-teal-50 p-1 rounded-md mr-2">
                                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </span>
                                Catatan Perusahaan (Opsional)
                            </label>
                            <textarea 
                                name="company_notes" 
                                id="company_notes" 
                                rows="4" 
                                class="w-full rounded-lg border-teal-300 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 @error('company_notes') border-red-500 @enderror transition-all duration-300" 
                                placeholder="Berikan catatan jika perlu (misal: alasan ditolak, info jadwal interview, dll)"
                            >{{ old('company_notes', $application->company_notes) }}</textarea>
                            @error('company_notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="w-full">
                            <button type="submit" class="w-full flex justify-center items-center px-4 py-2 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-300 transform hover:scale-105 shadow-md">
                                <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Simpan Perubahan Status
                            </button>
                        </div>
                    </form>

                    {{-- Bagian Sertifikat --}}
                    <div class="relative py-5 mt-2">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-teal-200"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-3 text-sm text-teal-500 font-medium">Sertifikat Magang</span>
                        </div>
                    </div>

                    @if($application->certificate_path && Storage::disk('public')->exists($application->certificate_path))
                        <div class="mb-4 p-4 border rounded-lg bg-teal-50 border-teal-200 shadow-sm transform transition-all duration-500 hover:shadow-md">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-teal-600 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <a href="{{ Storage::url($application->certificate_path) }}" target="_blank" class="text-teal-600 hover:underline font-medium transition-all duration-300 hover:text-teal-800">Lihat Sertifikat Terupload</a>
                            </div>
                            <span class="text-teal-700 text-sm block mt-2 pl-9">Diunggah: {{ $application->certificate_issued_at ? $application->certificate_issued_at->format('d M Y') : 'N/A' }}</span>

                            {{-- Tombol Hapus Sertifikat --}}
                            <form action="{{ route('company.applicants.removeCertificate', $application->id) }}" method="POST" class="mt-3 pl-9" onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 border border-red-300 text-sm font-medium rounded-lg text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:scale-105 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Sertifikat
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Hanya tampilkan form jika statusnya memungkinkan (misal accepted atau completed) --}}
                        @if(in_array($application->status, ['accepted', 'completed']))
                            <form action="{{ route('company.applicants.uploadCertificate', $application->id) }}" method="POST" enctype="multipart/form-data" class="bg-teal-50 p-4 rounded-lg border border-teal-200 shadow-sm">
                                @csrf
                                <div class="mb-4">
                                    <label for="certificate_file" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                                        <span class="bg-white p-1 rounded-md mr-2 border border-teal-200">
                                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </span>
                                        Unggah File Sertifikat (PDF, maks 5MB) <span class="text-red-600">*</span>
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="file" 
                                            class="w-full border border-teal-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @error('certificate_file') border-red-500 @enderror transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" 
                                            id="certificate_file" 
                                            name="certificate_file" 
                                            accept=".pdf" 
                                            required
                                        >
                                    </div>
                                    @error('certificate_file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="certificate_issued_at" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                                        <span class="bg-white p-1 rounded-md mr-2 border border-teal-200">
                                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </span>
                                        Tanggal Penerbitan Sertifikat <span class="text-red-600">*</span>
                                    </label>
                                    <input 
                                        type="date" 
                                        class="w-full rounded-lg border-teal-300 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 @error('certificate_issued_at') border-red-500 @enderror transition-all duration-300" 
                                        id="certificate_issued_at" 
                                        name="certificate_issued_at" 
                                        value="{{ old('certificate_issued_at', now()->format('Y-m-d')) }}" 
                                        required
                                    >
                                    @error('certificate_issued_at') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div class="w-full">
                                    <button type="submit" class="w-full flex justify-center items-center px-4 py-2 bg-teal-500 text-white font-medium rounded-lg hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400 transition-all duration-300 transform hover:scale-105 shadow-md">
                                        <svg class="w-5 h-5 mr-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                        Unggah Sertifikat
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="bg-teal-50 border-l-4 border-teal-400 p-4 text-sm text-teal-700 rounded-lg shadow-sm">
                                <div class="flex">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>
                                        Sertifikat dapat diunggah setelah status pendaftar adalah <span class="font-bold">'Accepted'</span> atau <span class="font-bold">'Completed'</span>.
                                        <br>Status saat ini: <span class="font-bold text-teal-800">{{ ucfirst($application->status) }}</span>
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Tampilkan catatan sebelumnya --}}
                    @if($application->company_notes || $application->admin_notes)
                        <div class="mt-6 pt-4 border-t border-teal-100">
                            @if($application->company_notes)
                                <div class="bg-white p-3 rounded-lg shadow-sm border border-teal-100 mb-3 transform transition duration-300 hover:shadow-md">
                                    <h6 class="text-sm text-teal-700 font-medium mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Catatan Perusahaan:
                                    </h6>
                                    <p class="italic text-sm mt-1 pl-6 text-gray-700">"{{ $application->company_notes }}"</p>
                                </div>
                            @endif
                            
                            @if($application->admin_notes)
                                <div class="bg-gray-50 p-3 rounded-lg shadow-sm border border-gray-200 transform transition duration-300 hover:shadow-md">
                                    <h6 class="text-sm text-gray-600 font-medium mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Catatan Admin CDC:
                                    </h6>
                                    <p class="italic text-sm mt-1 pl-6 text-gray-700">"{{ $application->admin_notes }}"</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div> {{-- End card-body --}}
            </div> {{-- End card --}}
        </div> {{-- End col --}}
    </div> {{-- End row --}}
</div> {{-- End container --}}
@endsection