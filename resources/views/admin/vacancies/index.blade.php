@extends('layouts.admin')

@section('title', 'Daftar Lowongan Kerjasama')
@section('page-title', 'Manajemen Lowongan Kerjasama')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Lowongan Kerjasama</h1>
            <a href="{{ route('admin.vacancies.create') }}"
                class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Lowongan Baru
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded relative" role="alert">
                {{ session('success') }}
                <button type="button" class="absolute top-2 right-2 text-green-700" data-bs-dismiss="alert"
                    aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded relative" role="alert">
                {{ session('error') }}
                <button type="button" class="absolute top-2 right-2 text-red-700" data-bs-dismiss="alert"
                    aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        {{-- Tabel Data --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h6 class="text-lg font-semibold text-blue-600">Data Lowongan</h6>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul Lowongan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Perusahaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deadline</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kuota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($vacancies as $index => $vacancy)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $vacancies->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $vacancy->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $vacancy->company->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $vacancy->location ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $vacancy->deadline ? $vacancy->deadline->format('d M Y') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vacancy->slots }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($vacancy->status == 'open')
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Open</span>
                                        @else
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">Closed</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.vacancies.edit', $vacancy->id) }}"
                                            class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-600 mr-1 mb-1"
                                            title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <button type="button"
                                            class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 mb-1"
                                            title="Hapus" data-modal-target="deleteModal{{ $vacancy->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="fixed z-10 inset-0 overflow-y-auto hidden modal-container"
                                            id="deleteModal{{ $vacancy->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $vacancy->id }}" aria-hidden="true">
                                            <div
                                                class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                                <!-- Overlay -->
                                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                                    aria-hidden="true"></div>

                                                <!-- Modal positioning -->
                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                    aria-hidden="true">&#8203;</span>

                                                <!-- Modal content -->
                                                <div
                                                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                    <!-- Modal header -->
                                                    <div class="bg-white px-6 py-4 border-b border-gray-200 relative">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-full bg-red-100 mr-3">
                                                                <svg class="h-6 w-6 text-red-600"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                                </svg>
                                                            </div>
                                                            <h5 class="text-lg font-semibold text-gray-900"
                                                                id="deleteModalLabel{{ $vacancy->id }}">
                                                                Konfirmasi Hapus Lowongan
                                                            </h5>
                                                        </div>
                                                        <button type="button"
                                                            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none"
                                                            data-modal-close aria-label="Close">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="px-6 py-5">
                                                        <div
                                                            class="bg-gray-50 p-4 rounded-lg mb-4 border-l-4 border-red-500">
                                                            <p class="text-gray-700">
                                                                Yakin ingin menghapus lowongan:
                                                            </p>
                                                            <div class="mt-2 p-3 bg-white rounded-md">
                                                                <p class="font-bold text-gray-800">{{ $vacancy->title }}
                                                                </p>
                                                                <p class="text-gray-600">di
                                                                    <strong>{{ $vacancy->company->name ?? 'Perusahaan' }}</strong>
                                                                </p>
                                                            </div>
                                                            <p class="text-sm text-red-600 mt-3">
                                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                                Tindakan ini tidak dapat dibatalkan.
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div
                                                        class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 sm:flex sm:flex-row-reverse">
                                                        <form action="{{ route('admin.vacancies.destroy', $vacancy->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm transition-colors duration-200">
                                                                <i class="fas fa-trash mr-1.5"></i>
                                                                Ya, Hapus
                                                            </button>
                                                        </form>
                                                        <button type="button"
                                                            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:text-sm transition-colors duration-200"
                                                            data-modal-close>
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data
                                        lowongan kerjasama.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Paginasi --}}
                <div class="mt-6 flex justify-center">
                    {{ $vacancies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Script untuk mengelola modal hapus
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan semua tombol hapus
            const deleteButtons = document.querySelectorAll('[data-modal-target]');

            // Mendaftarkan event untuk setiap tombol
            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal-target');
                    const modal = document.getElementById(modalId);

                    if (modal) {
                        // Tampilkan modal
                        modal.classList.remove('hidden');
                    }
                });
            });

            // Mendapatkan semua tombol tutup
            const closeButtons = document.querySelectorAll('[data-modal-close]');

            // Mendaftarkan event untuk setiap tombol tutup
            closeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modal = button.closest('.modal-container');
                    if (modal) {
                        // Sembunyikan modal
                        modal.classList.add('hidden');
                    }
                });
            });

            // Menutup modal jika mengklik diluar konten modal
            document.addEventListener('click', (e) => {
                const modals = document.querySelectorAll('.modal-container:not(.hidden)');
                modals.forEach(modal => {
                    if (e.target === modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        });
    </script>
@endpush
