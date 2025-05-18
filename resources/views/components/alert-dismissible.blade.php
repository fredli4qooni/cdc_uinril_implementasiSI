{{-- resources/views/components/alert-dismissible.blade.php --}}

@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700 relative" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="absolute top-0 right-0 p-2 text-green-600 hover:text-green-900" onclick="this.parentElement.remove()" aria-label="Close">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700 relative" role="alert">
        <span>{{ session('error') }}</span>
        <button type="button" class="absolute top-0 right-0 p-2 text-red-600 hover:text-red-900" onclick="this.parentElement.remove()" aria-label="Close">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

@if (session('warning'))
    <div class="mb-4 rounded-lg bg-yellow-100 p-4 text-sm text-yellow-700 relative" role="alert">
        <span>{{ session('warning') }}</span>
        <button type="button" class="absolute top-0 right-0 p-2 text-yellow-600 hover:text-yellow-900" onclick="this.parentElement.remove()" aria-label="Close">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

@if (session('info'))
    <div class="mb-4 rounded-lg bg-blue-100 p-4 text-sm text-blue-700 relative" role="alert">
        <span>{{ session('info') }}</span>
        <button type="button" class="absolute top-0 right-0 p-2 text-blue-600 hover:text-blue-900" onclick="this.parentElement.remove()" aria-label="Close">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

{{-- Anda bisa tambahkan untuk session key lain jika perlu --}}