{{-- resources/views/company/vacancies/_form.blade.php --}}

{{-- Tailwind Animation & Transition CSS --}}
<style>
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .hover-scale {
        transition: transform 0.3s ease;
    }
    
    .hover-scale:hover {
        transform: scale(1.02);
    }
    
    .input-focus-effect {
        transition: all 0.3s ease;
    }
    
    .input-focus-effect:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(13, 148, 136, 0.1), 0 4px 6px -2px rgba(13, 148, 136, 0.05);
    }
</style>

{{-- Pesan Error dengan Animasi --}}
@if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-md fade-in">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">Ada beberapa masalah dengan form ini:</p>
                <ul class="list-disc ml-5 text-sm text-red-700 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="bg-gradient-to-br from-teal-50 to-white rounded-xl shadow-lg mb-8 overflow-hidden border border-teal-100 hover-scale fade-in">
    <div class="bg-teal-700 text-white px-6 py-4 border-b border-teal-800">
        <h2 class="text-xl font-bold flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Form Lowongan Kerja
        </h2>
    </div>
    
    <div class="p-8">
        <div class="grid grid-cols-1 gap-8">
            {{-- Judul/Posisi Lowongan --}}
            <div class="transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                <label for="title" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Judul / Posisi Lowongan <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative rounded-md shadow-sm">
                    <input type="text" 
                        class="w-full rounded-lg border-2 border-teal-200 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 py-3 px-4 input-focus-effect bg-white @error('title') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                        id="title" 
                        name="title" 
                        placeholder="Masukkan judul lowongan"
                        value="{{ old('title', $vacancy->title ?? '') }}" 
                        required>
                </div>
                @error('title') 
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                <label for="description" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Deskripsi Pekerjaan/Magang <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative rounded-md shadow-sm">
                    <textarea 
                        class="w-full rounded-lg border-2 border-teal-200 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 py-3 px-4 input-focus-effect bg-white @error('description') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                        id="description" 
                        name="description" 
                        rows="5"
                        placeholder="Jelaskan deskripsi pekerjaan secara detail" 
                        required>{{ old('description', $vacancy->description ?? '') }}</textarea>
                </div>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Persyaratan --}}
            <div class="transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                <label for="requirements" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Persyaratan
                </label>
                <div class="relative rounded-md shadow-sm">
                    <textarea 
                        class="w-full rounded-lg border-2 border-teal-200 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 py-3 px-4 input-focus-effect bg-white @error('requirements') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                        id="requirements" 
                        name="requirements" 
                        placeholder="Masukkan persyaratan untuk posisi ini"
                        rows="5">{{ old('requirements', $vacancy->requirements ?? '') }}</textarea>
                </div>
                <p class="mt-2 text-sm text-teal-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Pisahkan persyaratan dengan baris baru atau bullet points.
                </p>
                @error('requirements')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Lokasi --}}
                <div class="transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    <label for="location" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Lokasi Penempatan
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="text" 
                            class="w-full rounded-lg border-2 border-teal-200 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 py-3 px-4 input-focus-effect bg-white @error('location') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                            id="location" 
                            name="location" 
                            placeholder="Contoh: Jakarta, Remote, dll"
                            value="{{ old('location', $vacancy->location ?? '') }}">
                    </div>
                    @error('location')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Deadline --}}
                <div class="transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    <label for="deadline" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Deadline Pendaftaran
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="date" 
                            class="w-full rounded-lg border-2 border-teal-200 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 py-3 px-4 input-focus-effect bg-white @error('deadline') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                            id="deadline" 
                            name="deadline" 
                            value="{{ old('deadline', isset($vacancy->deadline) ? $vacancy->deadline->format('Y-m-d') : '') }}">
                    </div>
                    <p class="mt-2 text-sm text-teal-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Kosongkan jika tidak ada batas waktu.
                    </p>
                    @error('deadline')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Kuota/Slots --}}
                <div class="transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    <label for="slots" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Kuota/Jumlah Posisi <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="number" 
                            class="w-full rounded-lg border-2 border-teal-200 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 py-3 px-4 input-focus-effect bg-white @error('slots') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                            id="slots" 
                            name="slots" 
                            placeholder="Masukkan jumlah posisi yang dibuka"
                            value="{{ old('slots', $vacancy->slots ?? 1) }}" 
                            min="1" 
                            required>
                    </div>
                    @error('slots')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    <label for="status" class="block text-sm font-medium text-teal-700 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Status Lowongan <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <select 
                            class="w-full rounded-lg border-2 border-teal-200 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 py-3 px-4 input-focus-effect bg-white appearance-none @error('status') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                            id="status" 
                            name="status" 
                            required>
                            <option value="open" {{ old('status', $vacancy->status ?? 'open') == 'open' ? 'selected' : '' }}>
                                Open (Buka Pendaftaran)
                            </option>
                            <option value="closed" {{ old('status', $vacancy->status ?? '') == 'closed' ? 'selected' : '' }}>
                                Closed (Tutup Pendaftaran)
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-teal-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- Tipe (Hidden jika default 'kerjasama') --}}
            <input type="hidden" name="type" value="kerjasama">

            {{-- Tombol Aksi --}}
            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <button type="submit" class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-700 border border-transparent rounded-lg font-medium text-white hover:from-teal-600 hover:to-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Simpan Lowongan
                </button>
                <a href="{{ route('company.vacancies.index') }}" class="flex-1 inline-flex justify-center items-center px-6 py-3 border-2 border-teal-300 rounded-lg font-medium text-teal-700 bg-white hover:bg-teal-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk Interaksi dan Animasi --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi fade-in untuk semua elemen dengan kelas fade-in
        document.querySelectorAll('.fade-in').forEach(function(element, index) {
            element.style.animationDelay = (index * 0.1) + 's';
        });
        
        // Script untuk efek focus pada input
        const inputElements = document.querySelectorAll('input, textarea, select');
        inputElements.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring', 'ring-teal-200', 'ring-opacity-50');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring', 'ring-teal-200', 'ring-opacity-50');
            });
        });
    });
</script>