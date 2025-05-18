{{-- resources/views/mahasiswa/applications/index.blade.php --}}
@extends('layouts.student')

@section('title', 'Status Pendaftaran Magang Saya')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Status Pendaftaran Magang Saya</h2>

        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm flex justify-between items-center transition-all duration-300">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-green-700 hover:text-green-900" data-bs-dismiss="alert" aria-label="Close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4 text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-lg font-semibold">Riwayat Pendaftaran</span>
            </div>
            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">No</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Lowongan</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Perusahaan</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Tanggal Daftar</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Catatan Admin</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Helper status badge
                                if (!function_exists('getStatusBadgeClass')) {
                                    function getStatusBadgeClass($status)
                                    {
                                        switch ($status) {
                                            case 'pending':
                                                return 'bg-yellow-100 text-yellow-800';
                                            case 'reviewed':
                                                return 'bg-blue-100 text-blue-800';
                                            case 'accepted':
                                                return 'bg-green-100 text-green-800';
                                            case 'rejected':
                                                return 'bg-red-100 text-red-800';
                                            case 'cancelled':
                                                return 'bg-gray-100 text-gray-800';
                                            default:
                                                return 'bg-gray-100 text-gray-800';
                                        }
                                    }
                                }
                            @endphp
                            @forelse ($applications as $index => $app)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $applications->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        @if ($app->vacancy)
                                            @if ($app->vacancy->status == 'open' && $app->vacancy->type == 'kerjasama')
                                                <a href="{{ route('mahasiswa.vacancies.show', $app->vacancy_id) }}"
                                                   class="text-blue-600 hover:text-blue-800 font-medium">{{ $app->vacancy->title }}</a>
                                            @else
                                                <span>{{ $app->vacancy->title }}</span>
                                                <span class="text-xs text-gray-500">(Ditutup)</span>
                                            @endif
                                        @else
                                            <span class="text-gray-500">Lowongan Dihapus</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $app->vacancy->company->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $app->application_date->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ getStatusBadgeClass($app->status) }}">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @if ($app->admin_notes)
                                            <span class="italic" title="Catatan Admin: {{ $app->admin_notes }}">{{ Str::limit($app->admin_notes, 50) }}</span>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm flex space-x-2">
                                        @if ($app->status == 'pending')
                                            <form action="{{ route('mahasiswa.applications.cancel', $app->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin membatalkan pendaftaran ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-1 bg-red-500 text-white text-xs font-medium rounded-full hover:bg-red-600 transition-colors duration-200"
                                                        title="Batalkan Pendaftaran">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Batalkan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                        <a href="{{ route('mahasiswa.applications.show', $app->id) }}"
                                           class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-xs font-medium rounded-full hover:bg-blue-600 transition-colors duration-200"
                                           title="Lihat Detail">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                        Anda belum pernah mendaftar ke lowongan manapun.
                                        <br>
                                        <a href="{{ route('mahasiswa.vacancies.index') }}"
                                           class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white font-medium rounded-full hover:bg-blue-600 transition-colors duration-200">
                                            Cari Lowongan Sekarang
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($applications->hasPages())
                <div class="px-6 py-4 bg-gray-50">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection