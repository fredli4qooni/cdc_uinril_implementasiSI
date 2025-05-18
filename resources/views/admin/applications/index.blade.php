@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran Magang')
@section('page-title', 'Pendaftaran Magang Kerjasama')

@push('styles')
    {{-- Style tambahan jika perlu --}}
@endpush

@section('content')
<div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pendaftaran Magang</h1>
        {{-- Admin tidak tambah pendaftaran --}}
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close">
                <span class="text-green-500">&times;</span>
            </button>
        </div>
    @endif

    {{-- Card Filter --}}
    <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
        <div class="bg-gray-50 px-4 py-3 border-b">
            <h2 class="text-lg font-semibold text-blue-600">Filter Pendaftaran</h2>
        </div>
        <div class="p-4">
            <form action="{{ route('admin.applications.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="vacancy_id" class="block text-sm font-medium text-gray-700 mb-1">Lowongan</label>
                        <select name="vacancy_id" id="vacancy_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="" {{ !request('vacancy_id') ? 'selected' : '' }}>Semua Lowongan</option>
                            @foreach($vacancies as $id => $title)
                                <option value="{{ $id }}" {{ request('vacancy_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="student_search" class="block text-sm font-medium text-gray-700 mb-1">Cari Mahasiswa</label>
                        <input type="text" name="student_search" id="student_search" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Nama, Email, atau NIM..." value="{{ request('student_search') }}">
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">Filter</button>
                    </div>
                    {{-- Tombol Reset jika ada filter aktif --}}
                    @if(request()->hasAny(['status', 'vacancy_id', 'student_search']))
                    <div class="col-span-1 md:col-span-4 flex justify-end mt-2">
                        <a href="{{ route('admin.applications.index') }}" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-1 px-3 rounded-md">Reset Filter</a>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Pendaftaran --}}
    <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
        <div class="bg-gray-50 px-4 py-3 border-b">
            <h2 class="text-lg font-semibold text-blue-600">Daftar Pendaftar</h2>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lowongan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Daftar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($applications as $index => $app)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $applications->firstItem() + $index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $app->user->name ?? 'User Dihapus' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $app->user->studentProfile->nim ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $app->vacancy->title ?? 'Lowongan Dihapus' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $app->vacancy->company->name ?? 'Perusahaan Dihapus' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $app->application_date->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ getStatusBadgeClass($app->status) }}">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.applications.show', $app->id) }}" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-2 mb-1">
                                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                    {{-- Tombol ubah status cepat (jika ingin ada) --}}
                                    {{-- Bisa berupa modal atau dropdown --}}
                                    {{-- ... --}}

                                    {{-- Tombol Hapus Pendaftaran (jika perlu) --}}
                                    {{-- ... (Modal konfirmasi hapus seperti CRUD lain) ... --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada data pendaftaran yang cocok dengan filter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Paginasi --}}
            <div class="flex justify-center mt-4">
                {{ $applications->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- Script tambahan jika diperlukan --}}
@endpush