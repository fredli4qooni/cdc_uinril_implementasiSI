@extends('layouts.admin')

@section('title', 'Daftar Event & Loker Umum')
@section('page-title', 'Manajemen Event & Loker Umum')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Event & Loker Umum</h1>
        <a href="{{ route('admin.events.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i> Tambah Baru
        </a>
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

    {{-- Tabel Data --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-blue-600">Data Event/Loker</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($events as $index => $event)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $events->firstItem() + $index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($event->image_path && Storage::disk('public')->exists($event->image_path))
                                        <img src="{{ Storage::url($event->image_path) }}" alt="Thumb" height="30" class="inline-block mr-2 object-cover">
                                    @endif
                                    {{ $event->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($event->type == 'event')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">Event</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Loker Umum</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->start_datetime ? $event->start_datetime->format('d M Y, H:i') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->end_datetime ? $event->end_datetime->format('d M Y, H:i') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->location ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($event->is_published)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Published</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-600 mr-1 mb-1" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 mb-1" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $event->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    {{-- Modal Hapus --}}
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center transition-opacity hidden" id="deleteModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                                            <div class="px-6 py-4 border-b border-gray-200">
                                                <h5 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h5>
                                                <button type="button" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" data-bs-dismiss="modal" aria-label="Close">
                                                    <span>×</span>
                                                </button>
                                            </div>
                                            <div class="px-6 py-4">
                                                Yakin ingin menghapus <strong>{{ $event->title }}</strong>?
                                            </div>
                                            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2">
                                                <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Akhir Modal --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data event atau loker umum.</ Asher>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Paginasi --}}
            <div class="mt-6 flex justify-center">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>
@endsection