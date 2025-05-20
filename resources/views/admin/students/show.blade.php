@extends('layouts.admin')

@section('title', 'Detail Mahasiswa')
@section('page-title', 'Detail Mahasiswa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-medium text-indigo-900">Detail Mahasiswa: {{ $student->name }}</h1>
        <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Account Information -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-indigo-50 px-5 py-4 border-b border-indigo-100">
                    <h2 class="text-base font-medium text-indigo-700">Informasi Akun</h2>
                </div>
                <div class="p-5">
                    <dl class="grid grid-cols-1 gap-y-4">
                        <div class="flex flex-col sm:flex-row sm:gap-x-4">
                            <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Nama</dt>
                            <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->name }}</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-x-4">
                            <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Email</dt>
                            <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->email }}</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-x-4">
                            <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Role</dt>
                            <dd class="mt-1 sm:mt-0 sm:w-2/3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ ucfirst($student->role) }}
                                </span>
                            </dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-x-4">
                            <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Terdaftar</dt>
                            <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->created_at->format('d M Y, H:i') }}</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-x-4">
                            <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Email Verified</dt>
                            <dd class="mt-1 sm:mt-0 sm:w-2/3">
                                @if($student->email_verified_at)
                                    <span class="text-green-600 flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Ya ({{ $student->email_verified_at->format('d M Y, H:i') }})
                                    </span>
                                @else
                                    <span class="text-red-600 flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        Belum
                                    </span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Student Profile -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-indigo-50 px-5 py-4 border-b border-indigo-100 flex justify-between items-center">
                    <h2 class="text-base font-medium text-indigo-700">Profil Mahasiswa</h2>
                    <a href="{{ route('admin.students.edit', $student->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profil
                    </a>
                </div>
                <div class="p-5">
                    @if($student->studentProfile)
                        <dl class="grid grid-cols-1 gap-y-4">
                            <div class="flex flex-col sm:flex-row sm:gap-x-4">
                                <dt class="text-sm font-medium text-gray-500 sm:w-1/3">NIM</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->studentProfile->nim }}</dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:gap-x-4">
                                <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Jurusan</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->studentProfile->major ?? '-' }}</dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:gap-x-4">
                                <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Tahun Masuk</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->studentProfile->entry_year ?? '-' }}</dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:gap-x-4">
                                <dt class="text-sm font-medium text-gray-500 sm:w-1/3">No. Telepon</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->studentProfile->phone_number ?? '-' }}</dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:gap-x-4">
                                <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Alamat</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->studentProfile->address ?? '-' }}</dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:gap-x-4">
                                <dt class="text-sm font-medium text-gray-500 sm:w-1/3">Bio</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:w-2/3">{{ $student->studentProfile->bio ?? '-' }}</dd>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:gap-x-4">
                                <dt class="text-sm font-medium text-gray-500 sm:w-1/3">CV</dt>
                                <dd class="mt-1 sm:mt-0 sm:w-2/3">
                                    @if($student->studentProfile->cv_path && Storage::disk('public')->exists($student->studentProfile->cv_path))
                                        <a href="{{ Storage::url($student->studentProfile->cv_path) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md text-indigo-700 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download CV
                                        </a>
                                    @else
                                        <span class="text-gray-500 text-sm">Belum diupload</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    @else
                        <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-amber-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-amber-700">Profil mahasiswa belum dilengkapi.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection