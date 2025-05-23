{{-- resources/views/mahasiswa/applications/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Status Pendaftaran Magang Saya')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }
    
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .status-animation {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .8; }
    }
    
    .floating-action {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 50;
    }
    
    .skeleton {
        animation: skeleton-loading 1s linear infinite alternate;
    }
    
    @keyframes skeleton-loading {
        0% { opacity: 1; }
        100% { opacity: 0.4; }
    }
</style>
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <!-- Header Section -->
        <div class="gradient-bg text-white py-16">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Status Pendaftaran</h1>
                        <p class="text-xl text-indigo-100">Pantau perkembangan aplikasi magang Anda</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="glass-effect rounded-2xl p-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-indigo-100">Total Aplikasi</p>
                                    <p class="text-2xl font-bold">{{ $applications->total() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8 max-w-7xl -mt-8">
            {{-- Alert Sukses --}}
            @if (session('success'))
                <div class="mb-8">
                    <div class="bg-emerald-50 border-l-4 border-emerald-400 p-6 rounded-r-xl shadow-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @php
                    $statusCounts = [
                        'pending' => $applications->where('status', 'pending')->count(),
                        'reviewed' => $applications->where('status', 'reviewed')->count(),
                        'accepted' => $applications->where('status', 'accepted')->count(),
                        'rejected' => $applications->where('status', 'rejected')->count()
                    ];
                @endphp
                
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-orange-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Menunggu</p>
                            <p class="text-3xl font-bold text-orange-600">{{ $statusCounts['pending'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-blue-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Direview</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $statusCounts['reviewed'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-emerald-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Diterima</p>
                            <p class="text-3xl font-bold text-emerald-600">{{ $statusCounts['accepted'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-red-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Ditolak</p>
                            <p class="text-3xl font-bold text-red-600">{{ $statusCounts['rejected'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications Grid -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-white">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h2 class="text-xl font-bold">Riwayat Pendaftaran</h2>
                        </div>
                        <div class="text-white/80 text-sm">
                            {{ $applications->total() }} aplikasi
                        </div>
                    </div>
                </div>

                @php
                    // Helper status badge
                    if (!function_exists('getStatusBadgeClass')) {
                        function getStatusBadgeClass($status)
                        {
                            switch ($status) {
                                case 'pending':
                                    return 'bg-gradient-to-r from-orange-400 to-orange-500 text-white';
                                case 'reviewed':
                                    return 'bg-gradient-to-r from-blue-400 to-blue-500 text-white';
                                case 'accepted':
                                    return 'bg-gradient-to-r from-emerald-400 to-emerald-500 text-white';
                                case 'rejected':
                                    return 'bg-gradient-to-r from-red-400 to-red-500 text-white';
                                case 'cancelled':
                                    return 'bg-gradient-to-r from-gray-400 to-gray-500 text-white';
                                default:
                                    return 'bg-gradient-to-r from-gray-400 to-gray-500 text-white';
                            }
                        }
                    }
                @endphp

                @forelse ($applications as $index => $app)
                    <div class="border-b border-gray-100 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300">
                        <div class="p-6">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-center">
                                <!-- Number & Company Logo -->
                                <div class="lg:col-span-1 flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        {{ $applications->firstItem() + $index }}
                                    </div>
                                </div>

                                <!-- Job Details -->
                                <div class="lg:col-span-4">
                                    <div class="space-y-1">
                                        @if ($app->vacancy)
                                            @if ($app->vacancy->status == 'open' && $app->vacancy->type == 'kerjasama')
                                                <a href="{{ route('mahasiswa.vacancies.show', $app->vacancy_id) }}"
                                                   class="text-lg font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                                                    {{ $app->vacancy->title }}
                                                </a>
                                            @else
                                                <span class="text-lg font-semibold text-gray-700">{{ $app->vacancy->title }}</span>
                                                <span class="inline-block ml-2 px-2 py-1 text-xs bg-red-100 text-red-600 rounded-full">Ditutup</span>
                                            @endif
                                        @else
                                            <span class="text-lg font-semibold text-gray-500">Lowongan Dihapus</span>
                                        @endif
                                        <p class="text-sm text-gray-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            {{ $app->vacancy->company->name ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="lg:col-span-2">
                                    <div class="text-sm text-gray-600">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $app->application_date->format('d M Y') }}
                                        <br>
                                        <span class="text-xs text-gray-500">{{ $app->application_date->format('H:i') }}</span>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="lg:col-span-2">
                                    <span class="inline-flex px-3 py-2 text-xs font-semibold rounded-full {{ getStatusBadgeClass($app->status) }} {{ $app->status == 'pending' ? 'status-animation' : '' }}">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </div>

                                <!-- Admin Notes -->
                                <div class="lg:col-span-2">
                                    @if ($app->admin_notes)
                                        <div class="group relative">
                                            <p class="text-xs text-gray-600 italic cursor-help">
                                                {{ Str::limit($app->admin_notes, 30) }}
                                            </p>
                                            <div class="absolute bottom-full left-0 mb-2 hidden group-hover:block z-10">
                                                <div class="bg-gray-800 text-white text-xs rounded-lg px-3 py-2 max-w-xs">
                                                    {{ $app->admin_notes }}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="lg:col-span-1">
                                    <div class="flex flex-wrap gap-2 justify-end">
                                        @if ($app->status == 'pending')
                                            <form action="{{ route('mahasiswa.applications.cancel', $app->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin membatalkan pendaftaran ini?')"
                                                  class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-medium rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-md hover:shadow-lg"
                                                        title="Batalkan Pendaftaran">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Batalkan
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('mahasiswa.applications.show', $app->id) }}"
                                           class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-xs font-medium rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg"
                                           title="Lihat Detail">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Aplikasi</h3>
                        <p class="text-gray-500 mb-6">Anda belum pernah mendaftar ke lowongan manapun.</p>
                        <a href="{{ route('mahasiswa.vacancies.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari Lowongan Sekarang
                        </a>
                    </div>
                @endforelse

                @if ($applications->hasPages())
                    <div class="px-8 py-6 bg-gray-50 border-t">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Floating Action Button -->
        <div class="floating-action">
            <a href="{{ route('public.vacancies.index') }}"
               class="w-14 h-14 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-full shadow-2xl hover:shadow-3xl hover:scale-110 transition-all duration-300 flex items-center justify-center group">
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Auto dismiss alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);

    // Add loading animation for buttons
    document.querySelectorAll('button[type="submit"]').forEach(button => {
        button.addEventListener('click', function() {
            if (this.form.checkValidity()) {
                this.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
                this.disabled = true;
            }
        });
    });
</script>
@endpush