{{-- Pesan Error --}}
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul class="list-disc pl-5 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Perusahaan Mitra --}}
            <div class="mb-4">
                <label for="company_id" class="block text-sm font-medium text-gray-700 mb-1">Perusahaan Mitra <span class="text-red-500">*</span></label>
                <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('company_id') border-red-500 @enderror" id="company_id" name="company_id" required>
                    <option value="" disabled {{ old('company_id', $vacancy->company_id ?? '') == '' ? 'selected' : '' }}>-- Pilih Perusahaan --</option>
                    @foreach($companies as $id => $name)
                        <option value="{{ $id }}" {{ old('company_id', $vacancy->company_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('company_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Judul/Posisi Lowongan --}}
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul / Posisi Lowongan <span class="text-red-500">*</span></label>
                <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('title') border-red-500 @enderror" id="title" name="title" value="{{ old('title', $vacancy->title ?? '') }}" required>
                @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Pekerjaan/Magang <span class="text-red-500">*</span></label>
            <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('description') border-red-500 @enderror" id="description" name="description" rows="5" required>{{ old('description', $vacancy->description ?? '') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Persyaratan --}}
        <div class="mb-4">
            <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Persyaratan</label>
            <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('requirements') border-red-500 @enderror" id="requirements" name="requirements" rows="5">{{ old('requirements', $vacancy->requirements ?? '') }}</textarea>
            <p class="mt-1 text-xs text-gray-500">Pisahkan persyaratan dengan baris baru atau bullet points.</p>
            @error('requirements') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Lokasi --}}
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Penempatan</label>
                <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('location') border-red-500 @enderror" id="location" name="location" value="{{ old('location', $vacancy->location ?? '') }}">
                @error('location') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Deadline --}}
            <div class="mb-4">
                <label for="deadline" class="block text-sm font-medium text-gray-700 mb-1">Deadline Pendaftaran</label>
                <input type="date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('deadline') border-red-500 @enderror" id="deadline" name="deadline" value="{{ old('deadline', isset($vacancy->deadline) ? $vacancy->deadline->format('Y-m-d') : '') }}">
                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ada batas waktu.</p>
                @error('deadline') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Kuota/Slots --}}
            <div class="mb-4">
                <label for="slots" class="block text-sm font-medium text-gray-700 mb-1">Kuota/Jumlah Posisi <span class="text-red-500">*</span></label>
                <input type="number" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('slots') border-red-500 @enderror" id="slots" name="slots" value="{{ old('slots', $vacancy->slots ?? 1) }}" min="1" required>
                @error('slots') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Lowongan <span class="text-red-500">*</span></label>
                <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('status') border-red-500 @enderror" id="status" name="status" required>
                    <option value="open" {{ old('status', $vacancy->status ?? 'open') == 'open' ? 'selected' : '' }}>Open (Dibuka)</option>
                    <option value="closed" {{ old('status', $vacancy->status ?? '') == 'closed' ? 'selected' : '' }}>Closed (Ditutup)</option>
                </select>
                @error('status') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-6 flex flex-wrap gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md inline-flex items-center">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Simpan Lowongan
            </button>
            <a href="{{ route('admin.vacancies.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-md inline-flex items-center">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </a>
        </div>
    </div>
</div>