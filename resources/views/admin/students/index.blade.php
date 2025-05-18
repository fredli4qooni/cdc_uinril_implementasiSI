@extends('layouts.admin')

@section('title', 'Manajemen Data Mahasiswa')
@section('page-title', 'Data Mahasiswa')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Data Mahasiswa</h1>
        {{-- Admin tidak tambah manual, jadi tombol tambah tetap dikomentari --}}
        {{-- <a href="{{ route('admin.students.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i> Tambah Mahasiswa
        </a> --}}
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded relative" role="alert">
            {{ session('success') }}
            <button type="button" class="absolute top-2 right-2 text-green-700" data-bs-dismiss="alert" aria-label="Close">
                <span>×</span>
            </button>
        </div>
    @endif

    {{-- Card Filter/Search --}}
    <div class="bg-white shadow-md rounded-lg mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-gray-900">Filter / Cari Mahasiswa</h6>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.students.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                <input type="text" name="search" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama, email, NIM, atau jurusan..." value="{{ request('search') }}">
                <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
                @if(request()->has('search') && request('search') != '')
                    <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400 transition">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Tabel Data Mahasiswa --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-blue-600">Daftar Akun Mahasiswa</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Masuk</th>
                            {{-- Status Akun tetap dikomentari sesuai kode asli --}}
                            {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akun</th> --}}
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($students as $index => $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $students->firstItem() + $index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->studentProfile->nim ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->studentProfile->major ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->studentProfile->entry_year ?? 'N/A' }}</td>
                                {{-- Status Akun tetap dikomentari --}}
                                {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    @if($student->is_active ?? true)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Aktif</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Nonaktif</span>
                                    @endif
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.students.show', $student->id) }}" class="inline-flex items-center px-2 py-1 bg-blue-500 text-white text-xs font-medium rounded hover:bg-blue-600 mr-1 mb-1" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.students.edit', $student->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-600 mr-1 mb-1" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 mb-1" title="Hapus Akun" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    {{-- Modal Hapus --}}
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center transition-opacity hidden" id="deleteModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                                            <div class="px-6 py-4 border-b border-gray-200">
                                                <h5 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus Akun</h5>
                                                <button type="button" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" data-bs-dismiss="modal" aria-label="Close">
                                                    <span>×</span>
                                                </button>
                                            </div>
                                            <div class="px-6 py-4">
                                                Yakin ingin menghapus akun mahasiswa <strong>{{ $student->name }} ({{ $student->email }})</strong>? Tindakan ini akan menghapus data login dan profil mahasiswa terkait secara permanen.
                                            </div>
                                            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2">
                                                <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">Ya, Hapus Permanen</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Akhir Modal --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    @if(request()->has('search') && request('search') != '')
                                        Mahasiswa tidak ditemukan untuk pencarian "{{ request('search') }}".
                                    @else
                                        Belum ada data mahasiswa terdaftar.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Paginasi --}}
            <div class="mt-6 flex justify-center">
                {{ $students->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection