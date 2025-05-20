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
                    <input type="text" name="search"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Cari nama, email, NIM, atau jurusan..." value="{{ request('search') }}">
                    <button
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-search mr-2"></i> Cari
                    </button>
                    @if (request()->has('search') && request('search') != '')
                        <a href="{{ route('admin.students.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400 transition">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jurusan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tahun Masuk</th>
                                {{-- Status Akun tetap dikomentari sesuai kode asli --}}
                                {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akun</th> --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($students as $index => $student)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $students->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->studentProfile->nim ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->studentProfile->major ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->studentProfile->entry_year ?? 'N/A' }}</td>
                                    {{-- Status Akun tetap dikomentari --}}
                                    {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($student->is_active ?? true)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Aktif</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Nonaktif</span>
                                    @endif
                                </td> --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.students.show', $student->id) }}"
                                            class="inline-flex items-center px-2 py-1 bg-blue-500 text-white text-xs font-medium rounded hover:bg-blue-600 mr-1 mb-1"
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                            class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-600 mr-1 mb-1"
                                            title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <!-- Button Hapus -->
                                        <button type="button"
                                            class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 mb-1"
                                            title="Hapus Akun" onclick="openModal('deleteModal{{ $student->id }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal Hapus -->
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center transition-opacity hidden z-50"
                                            id="deleteModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                                            <div
                                                class="bg-white rounded-lg shadow-xl max-w-md w-full transform transition-all">
                                                <!-- Header -->
                                                <div class="px-6 py-4 border-b border-gray-200 relative">
                                                    <h5 class="text-lg font-semibold text-gray-900">
                                                        <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                                                        Konfirmasi Hapus Akun
                                                    </h5>
                                                    <button type="button"
                                                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none"
                                                        onclick="closeModal('deleteModal{{ $student->id }}')"
                                                        aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>

                                                <!-- Body -->
                                                <div class="px-6 py-5">
                                                    <div class="text-center mb-4">
                                                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4 text-left">
                                                            <p>Yakin ingin menghapus akun mahasiswa:</p>
                                                            <p class="font-bold text-center my-2">{{ $student->name }}
                                                                ({{ $student->email }})</p>
                                                        </div>

                                                        <div
                                                            class="border-l-4 border-red-600 pl-3 py-2 bg-gray-50 text-left">
                                                            <p class="text-red-600 font-medium">
                                                                <i class="fas fa-exclamation-circle mr-1"></i> PERHATIAN:
                                                            </p>
                                                            <p class="text-gray-700 text-sm mt-1">
                                                                Tindakan ini akan menghapus secara permanen:
                                                            </p>
                                                            <ul class="text-sm text-gray-700 list-disc pl-5 mt-1">
                                                                <li>Data login mahasiswa</li>
                                                                <li>Profil mahasiswa</li>
                                                                <li>Semua riwayat pendaftaran</li>
                                                            </ul>
                                                            <p class="text-sm text-gray-700 font-bold mt-2">Tindakan ini
                                                                tidak dapat dibatalkan!</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Footer -->
                                                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                                                    <button type="button"
                                                        class="px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-1 transition-colors duration-200"
                                                        onclick="closeModal('deleteModal{{ $student->id }}')">
                                                        Batal
                                                    </button>
                                                    <form action="{{ route('admin.students.destroy', $student->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1 transition-colors duration-200">
                                                            <i class="fas fa-trash mr-1.5"></i>
                                                            Ya, Hapus Permanen
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                        @if (request()->has('search') && request('search') != '')
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

@push('scripts')
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // Mencegah scrolling background
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden'); // Mengaktifkan kembali scrolling
        }

        // Menutup modal jika user mengklik diluar modal
        document.addEventListener('click', function(event) {
            const modals = document.querySelectorAll('[id^="deleteModal"]');
            modals.forEach(function(modal) {
                if (event.target === modal) {
                    closeModal(modal.id);
                }
            });
        });

        // Menutup modal dengan tombol Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const visibleModals = document.querySelectorAll('[id^="deleteModal"]:not(.hidden)');
                visibleModals.forEach(function(modal) {
                    closeModal(modal.id);
                });
            }
        });
    </script>
@endpush
