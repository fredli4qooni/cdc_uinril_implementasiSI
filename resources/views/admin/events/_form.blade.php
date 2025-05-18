{{-- Pesan Error --}}
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc pl-5 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-12 gap-4">
    {{-- Kolom Kiri --}}
    <div class="md:col-span-8">
        <div class="bg-white rounded-lg shadow-md mb-4 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b">Detail Informasi</div>
            <div class="p-4">
                {{-- Judul --}}
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Event / Lowongan <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('title') border-red-300 @enderror" id="title" name="title" value="{{ old('title', $event->title ?? '') }}" required>
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Tipe --}}
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe <span class="text-red-500">*</span></label>
                    <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('type') border-red-300 @enderror" id="type" name="type" required>
                        <option value="" disabled {{ old('type', $event->type ?? '') == '' ? 'selected' : '' }}>-- Pilih Tipe --</option>
                        <option value="event" {{ old('type', $event->type ?? '') == 'event' ? 'selected' : '' }}>Event (Seminar, Workshop, Job Fair, dll)</option>
                        <option value="loker_umum" {{ old('type', $event->type ?? '') == 'loker_umum' ? 'selected' : '' }}>Loker Umum (Informasi Lowongan)</option>
                    </select>
                    @error('type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('description') border-red-300 @enderror" id="description" name="description" rows="6">{{ old('description', $event->description ?? '') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Link Sumber --}}
                <div class="mb-4">
                    <label for="source_url" class="block text-sm font-medium text-gray-700 mb-1">Link Sumber / Pendaftaran</label>
                    <input type="url" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('source_url') border-red-300 @enderror" id="source_url" name="source_url" placeholder="https://contoh.com/info" value="{{ old('source_url', $event->source_url ?? '') }}">
                    <p class="mt-1 text-xs text-gray-500">Link ke website asli acara atau detail lowongan.</p>
                    @error('source_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan --}}
    <div class="md:col-span-4">
        <div class="bg-white rounded-lg shadow-md mb-4 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b">Jadwal & Lokasi</div>
            <div class="p-4">
                {{-- Tanggal Mulai --}}
                <div class="mb-4">
                    <label for="start_datetime" class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu Mulai</label>
                    <input type="datetime-local" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('start_datetime') border-red-300 @enderror" id="start_datetime" name="start_datetime" value="{{ old('start_datetime', isset($event->start_datetime) ? $event->start_datetime->format('Y-m-d\TH:i') : '') }}">
                    @error('start_datetime') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Tanggal Selesai --}}
                <div class="mb-4">
                    <label for="end_datetime" class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu Selesai</label>
                    <input type="datetime-local" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('end_datetime') border-red-300 @enderror" id="end_datetime" name="end_datetime" value="{{ old('end_datetime', isset($event->end_datetime) ? $event->end_datetime->format('Y-m-d\TH:i') : '') }}">
                    @error('end_datetime') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Lokasi --}}
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('location') border-red-300 @enderror" id="location" name="location" value="{{ old('location', $event->location ?? '') }}">
                    <p class="mt-1 text-xs text-gray-500">Misal: Gedung Serba Guna UIN / Online / Nama Perusahaan.</p>
                    @error('location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Penyelenggara --}}
                <div class="mb-4">
                    <label for="organizer" class="block text-sm font-medium text-gray-700 mb-1">Penyelenggara (Event)</label>
                    <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('organizer') border-red-300 @enderror" id="organizer" name="organizer" value="{{ old('organizer', $event->organizer ?? '') }}">
                    @error('organizer') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md mb-4 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b">Gambar & Publikasi</div>
            <div class="p-4">
                {{-- Upload Gambar --}}
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar/Poster (Opsional)</label>
                    {{-- Preview Gambar (jika ada) --}}
                    @if(isset($event) && $event->image_path && Storage::disk('public')->exists($event->image_path))
                        <img id="image-preview" src="{{ Storage::url($event->image_path) }}" alt="Image Preview" class="mb-2 max-h-36 border rounded">
                        <div class="flex items-center mb-2">
                            <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" value="1" id="remove_image" name="remove_image">
                            <label class="ml-2 text-sm text-gray-700" for="remove_image">
                                Hapus gambar saat ini
                            </label>
                        </div>
                    @else
                        <img id="image-preview" src="https://via.placeholder.com/150?text=No+Image" alt="Image Preview" class="mb-2 max-h-36 border rounded">
                    @endif
                    <input class="mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('image') border-red-300 @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG. Maks: 2MB.</p>
                    @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Status Publikasi --}}
                <div class="mb-4">
                    <label for="is_published" class="block text-sm font-medium text-gray-700 mb-1">Status Publikasi <span class="text-red-500">*</span></label>
                    <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('is_published') border-red-300 @enderror" id="is_published" name="is_published" required>
                        <option value="1" {{ old('is_published', $event->is_published ?? true) == true ? 'selected' : '' }}>Published (Tampilkan)</option>
                        <option value="0" {{ old('is_published', $event->is_published ?? true) == false ? 'selected' : '' }}>Draft (Simpan sebagai draft)</option>
                    </select>
                    @error('is_published') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md mb-4 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b">Aksi</div>
            <div class="p-4">
                <button type="submit" class="w-full flex justify-center items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md mb-2 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Simpan Data
                </button>
                <a href="{{ route('admin.events.index') }}" class="w-full flex justify-center items-center bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Script Preview Image --}}
@push('scripts')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        } else {
            // Reset ke default/gambar lama jika file dibatalkan
            @if(isset($event) && $event->image_path && Storage::disk('public')->exists($event->image_path))
                output.src = "{{ Storage::url($event->image_path) }}";
            @else
                output.src = "https://via.placeholder.com/150?text=No+Image";
            @endif
        }
    }
</script>
@endpush