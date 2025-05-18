@extends('layouts.admin')

@section('title', 'Detail Pendaftaran Magang')
@section('page-title', 'Detail Pendaftaran')

@section('content')
<div class="container-fluid px-4">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Pendaftaran</h1>
        <a href="{{ route('admin.applications.index') }}" class="mt-2 sm:mt-0 px-3 py-2 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                <svg class="h-4 w-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-4">
        {{-- Kolom Detail Lowongan & Perusahaan --}}
        <div class="w-full lg:w-5/12">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="bg-blue-50 border-b border-blue-100 px-4 py-3">
                    <h6 class="text-sm font-semibold text-blue-700">Detail Lowongan Dilamar</h6>
                </div>
                <div class="p-4">
                    @if($application->vacancy)
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Posisi</dt>
                                <dd class="mt-1">{{ $application->vacancy->title }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Perusahaan</dt>
                                <dd class="mt-1">{{ $application->vacancy->company->name ?? 'N/A' }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                                <dd class="mt-1">{{ $application->vacancy->location ?? '-' }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Deadline Lowongan</dt>
                                <dd class="mt-1">{{ $application->vacancy->deadline ? $application->vacancy->deadline->format('d M Y') : '-' }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Deskripsi Singkat</dt>
                                <dd class="mt-1">{!! nl2br(e(Str::limit($application->vacancy->description, 200))) !!}</dd>
                            </div>
                        </dl>
                    @else
                        <div class="bg-yellow-50 text-yellow-700 p-4 rounded border border-yellow-200">
                            Data lowongan tidak ditemukan (mungkin sudah dihapus).
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom Detail Mahasiswa & CV --}}
        <div class="w-full lg:w-7/12">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="bg-blue-50 border-b border-blue-100 px-4 py-3">
                    <h6 class="text-sm font-semibold text-blue-700">Detail Pendaftar (Mahasiswa)</h6>
                </div>
                <div class="p-4">
                    @if($application->user && $application->user->studentProfile)
                        <dl class="grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
                            <dt class="text-sm font-medium text-gray-500 sm:col-span-1">Nama</dt>
                            <dd class="text-sm sm:col-span-3">{{ $application->user->name }}</dd>

                            <dt class="text-sm font-medium text-gray-500 sm:col-span-1">NIM</dt>
                            <dd class="text-sm sm:col-span-3">{{ $application->user->studentProfile->nim }}</dd>

                            <dt class="text-sm font-medium text-gray-500 sm:col-span-1">Jurusan</dt>
                            <dd class="text-sm sm:col-span-3">{{ $application->user->studentProfile->major ?? '-' }}</dd>

                            <dt class="text-sm font-medium text-gray-500 sm:col-span-1">Tahun Masuk</dt>
                            <dd class="text-sm sm:col-span-3">{{ $application->user->studentProfile->entry_year ?? '-' }}</dd>

                            <dt class="text-sm font-medium text-gray-500 sm:col-span-1">Email</dt>
                            <dd class="text-sm sm:col-span-3">{{ $application->user->email }}</dd>

                            <dt class="text-sm font-medium text-gray-500 sm:col-span-1">Telepon</dt>
                            <dd class="text-sm sm:col-span-3">{{ $application->user->studentProfile->phone_number ?? '-' }}</dd>

                            <dt class="text-sm font-medium text-gray-500 sm:col-span-1">Tanggal Daftar</dt>
                            <dd class="text-sm sm:col-span-3">{{ $application->application_date->format('d M Y, H:i') }}</dd>

                            <dt class="text-sm font-medium text-gray-500 sm:col-span-1">CV Mahasiswa</dt>
                            <dd class="text-sm sm:col-span-3">
                                @if($application->user->studentProfile->cv_path && Storage::disk('public')->exists($application->user->studentProfile->cv_path))
                                    <a href="{{ Storage::url($application->user->studentProfile->cv_path) }}" target="_blank" 
                                        class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download / Lihat CV
                                    </a>
                                @else
                                    <span class="text-red-600 font-semibold">CV Belum Diupload!</span>
                                @endif
                            </dd>
                        </dl>
                    @else
                        <div class="bg-yellow-50 text-yellow-700 p-4 rounded border border-yellow-200">
                            Data mahasiswa tidak ditemukan (mungkin akun sudah dihapus).
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Form Update Status --}}
    <div class="bg-white rounded-lg shadow overflow-hidden mt-4">
        <div class="bg-blue-50 border-b border-blue-100 px-4 py-3">
            <h6 class="text-sm font-semibold text-blue-700">Update Status Pendaftaran</h6>
        </div>
        <div class="p-4">
            <form action="{{ route('admin.applications.updateStatus', $application->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Atau PATCH --}}

                 @php
                     $currentStatus = $application->status;
                     $statuses = ['pending' => 'Pending', 'reviewed' => 'Reviewed', 'accepted' => 'Accepted', 'rejected' => 'Rejected', 'cancelled' => 'Cancelled'];
                 @endphp

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Ubah Status Menjadi <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" 
                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('status') border-red-500 @enderror" 
                            required>
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ old('status', $currentStatus) == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-8">
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-1">
                            Catatan Admin (Opsional)
                        </label>
                        <textarea name="admin_notes" id="admin_notes" 
                            class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('admin_notes') border-red-500 @enderror" 
                            rows="3" placeholder="Misal: Alasan penolakan, instruksi selanjutnya, dll.">{{ old('admin_notes', $application->admin_notes) }}</textarea>
                        @error('admin_notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Status
                    </button>
                    <span class="ml-3">Status Saat Ini: 
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        {{ 
                            $currentStatus == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                            ($currentStatus == 'reviewed' ? 'bg-blue-100 text-blue-800' : 
                            ($currentStatus == 'accepted' ? 'bg-green-100 text-green-800' : 
                            ($currentStatus == 'rejected' ? 'bg-red-100 text-red-800' : 
                            'bg-gray-100 text-gray-800')))
                        }}">
                            {{ ucfirst($currentStatus) }}
                        </span>
                    </span>
                </div>
            </form>
        </div>
        {{-- Tampilkan catatan sebelumnya jika ada --}}
        @if($application->admin_notes)
            <div class="bg-gray-50 px-4 py-3 border-t border-gray-100">
                <strong class="text-sm font-medium">Catatan Admin Sebelumnya:</strong>
                <p class="mt-1 text-sm italic">"{{ $application->admin_notes }}"</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
    {{-- Helper JS jika perlu --}}
@endpush