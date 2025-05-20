{{-- resources/views/company/applicants/show.blade.php --}}
@extends('layouts.company')

@section('title', 'Detail Pendaftar')
@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h2 class="text-xl font-bold text-teal-800 mb-4 sm:mb-0">
            Detail Pendaftar: {{ $application->user->name ?? 'N/A' }}
        </h2>
        <a href="{{ url()->previous(route('company.applicants.index')) }}" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium rounded bg-white border border-teal-300 text-teal-700 hover:bg-teal-50">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    @include('components.alert-dismissible')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kolom Detail Mahasiswa --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow border border-gray-100">
                <div class="bg-teal-500 px-4 py-3 text-white rounded-t-lg">
                    <h3 class="font-medium">Informasi Mahasiswa</h3>
                </div>
                <div class="p-5">
                    @if($application->user && $application->user->studentProfile)
                        <div class="space-y-4">
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
                                <div class="grid grid-cols-3 gap-2 border-b border-gray-100 pb-2">
                                    <div class="text-gray-600 font-medium">{{ $label }}</div>
                                    <div class="col-span-2 text-gray-800">{{ $value }}</div>
                                </div>
                            @endforeach

                            <div class="grid grid-cols-3 gap-2 pt-2">
                                <div class="text-gray-600 font-medium">CV Mahasiswa</div>
                                <div class="col-span-2">
                                    @if($application->user->studentProfile->cv_path && Storage::disk('public')->exists($application->user->studentProfile->cv_path))
                                        <a href="{{ Storage::url($application->user->studentProfile->cv_path) }}" target="_blank" 
                                           class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded bg-teal-500 text-white hover:bg-teal-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download CV
                                        </a>
                                    @else
                                        <span class="text-red-500 text-sm">CV Tidak Tersedia</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 text-yellow-700">
                            Data mahasiswa tidak lengkap atau tidak ditemukan.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom Detail Lamaran & Update Status --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow border border-gray-100">
                <div class="bg-teal-500 px-4 py-3 text-white rounded-t-lg">
                    <h3 class="font-medium">Detail Lamaran & Status</h3>
                </div>
                <div class="p-5">
                    <div class="space-y-4 mb-6">
                        <div class="border-b border-gray-100 pb-2">
                            <p class="text-gray-600 text-sm font-medium">Lowongan Dilamar</p>
                            <p class="text-gray-800 mt-1">{{ $application->vacancy->title ?? 'N/A' }}</p>
                        </div>
                        
                        <div class="border-b border-gray-100 pb-2">
                            <p class="text-gray-600 text-sm font-medium">Tanggal Mendaftar</p>
                            <p class="text-gray-800 mt-1">{{ $application->application_date->format('d F Y - H:i') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Status Saat Ini</p>
                            <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full {{ getStatusBadgeClass($application->status) }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    </div>

                    <hr class="my-4 border-t border-gray-200">

                    <form action="{{ route('company.applicants.updateStatus', $application->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        @php
                            $allowedStatuses = ['reviewed' => 'Telah Direview', 'accepted' => 'Terima', 'rejected' => 'Tolak'];
                        @endphp

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-600 mb-1">
                                Ubah Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" class="w-full rounded border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50" required>
                                <option value="" disabled selected>-- Pilih Tindakan --</option>
                                @foreach($allowedStatuses as $key => $value)
                                    @if($application->status != $key)
                                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endif
                                @endforeach
                                @if(count(array_diff_key($allowedStatuses, [$application->status => ''])) <= 1)
                                    <option value="{{ $application->status }}" disabled> -- Status saat ini: {{ ucfirst($application->status) }} --</option>
                                @endif
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="company_notes" class="block text-sm font-medium text-gray-600 mb-1">
                                Catatan Perusahaan
                            </label>
                            <textarea 
                                name="company_notes" 
                                id="company_notes" 
                                rows="3" 
                                class="w-full rounded border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50" 
                                placeholder="Catatan untuk pendaftar"
                            >{{ old('company_notes', $application->company_notes) }}</textarea>
                            @error('company_notes') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full py-2 px-4 bg-teal-500 text-white font-medium rounded hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-400">
                            Simpan Perubahan
                        </button>
                    </form>

                    <hr class="my-5 border-t border-gray-200">

                    {{-- Bagian Sertifikat --}}
                    <h4 class="text-gray-600 font-medium text-sm mb-3">Sertifikat Magang</h4>

                    @if($application->certificate_path && Storage::disk('public')->exists($application->certificate_path))
                        <div class="bg-gray-50 p-3 rounded border border-gray-200 mb-4">
                            <a href="{{ Storage::url($application->certificate_path) }}" target="_blank" class="text-teal-600 hover:underline flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Lihat Sertifikat
                            </a>
                            <p class="text-gray-600 text-sm mt-2">Tanggal: {{ $application->certificate_issued_at ? $application->certificate_issued_at->format('d M Y') : 'N/A' }}</p>
                            
                            <form action="{{ route('company.applicants.removeCertificate', $application->id) }}" method="POST" class="mt-2" onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-sm hover:underline flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Sertifikat
                                </button>
                            </form>
                        </div>
                    @else
                        @if(in_array($application->status, ['accepted', 'completed']))
                            <form action="{{ route('company.applicants.uploadCertificate', $application->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-50 p-4 rounded border border-gray-200">
                                @csrf
                                <div class="mb-3">
                                    <label for="certificate_file" class="block text-sm font-medium text-gray-600 mb-1">
                                        File Sertifikat <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="file" 
                                        class="w-full text-sm border border-gray-300 rounded p-2"
                                        id="certificate_file" 
                                        name="certificate_file" 
                                        accept=".pdf" 
                                        required
                                    >
                                    @error('certificate_file') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="certificate_issued_at" class="block text-sm font-medium text-gray-600 mb-1">
                                        Tanggal Penerbitan <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="date" 
                                        class="w-full border-gray-300 rounded" 
                                        id="certificate_issued_at" 
                                        name="certificate_issued_at" 
                                        value="{{ old('certificate_issued_at', now()->format('Y-m-d')) }}" 
                                        required
                                    >
                                    @error('certificate_issued_at') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <button type="submit" class="w-full py-2 bg-teal-500 text-white text-sm font-medium rounded hover:bg-teal-600">
                                    Unggah Sertifikat
                                </button>
                            </form>
                        @else
                            <div class="bg-blue-50 text-blue-700 p-3 text-sm rounded border border-blue-100">
                                Sertifikat dapat diunggah setelah status pendaftar adalah 'Accepted' atau 'Completed'.
                            </div>
                        @endif
                    @endif

                    {{-- Tampilkan catatan sebelumnya --}}
                    @if($application->company_notes || $application->admin_notes)
                        <div class="mt-5 pt-3 border-t border-gray-200">
                            @if($application->company_notes)
                                <div class="mb-3">
                                    <p class="text-sm font-medium text-gray-600">Catatan Perusahaan:</p>
                                    <p class="text-sm text-gray-700 mt-1 bg-gray-50 p-2 rounded italic">
                                        "{{ $application->company_notes }}"
                                    </p>
                                </div>
                            @endif
                            
                            @if($application->admin_notes)
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Catatan Admin CDC:</p>
                                    <p class="text-sm text-gray-700 mt-1 bg-gray-50 p-2 rounded italic">
                                        "{{ $application->admin_notes }}"
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection