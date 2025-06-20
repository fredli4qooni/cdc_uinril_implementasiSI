{{-- resources/views/admin/companies/_form.blade.php --}}

{{-- Pesan Error Validasi Umum --}}
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul class="list-disc pl-5 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
    {{-- Kolom Kiri --}}
    <div class="md:col-span-8">
        {{-- Card Informasi Dasar Perusahaan --}}
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b font-semibold">Informasi Dasar Perusahaan</div>
            <div class="p-4">
                {{-- Nama Perusahaan --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name', $company->name ?? '') }}" required>
                    @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Email Kontak Perusahaan --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Kontak Perusahaan <span class="text-red-500">*</span></label>
                    <input type="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email', $company->email ?? '') }}" required>
                    @error('email') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="tel" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('phone_number') border-red-500 @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $company->phone_number ?? '') }}">
                    @error('phone_number') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Website --}}
                <div class="mb-4">
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                    <input type="url" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('website') border-red-500 @enderror" id="website" name="website" placeholder="https://example.com" value="{{ old('website', $company->website ?? '') }}">
                    @error('website') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('address') border-red-500 @enderror" id="address" name="address" rows="3">{{ old('address', $company->address ?? '') }}</textarea>
                    @error('address') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('description') border-red-500 @enderror" id="description" name="description" rows="4">{{ old('description', $company->description ?? '') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Card Informasi Tambahan --}}
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b font-semibold">Informasi Tambahan Perusahaan</div>
            <div class="p-4">
                {{-- Industri --}}
                <div class="mb-4">
                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industri</label>
                    <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('industry') border-red-500 @enderror" id="industry" name="industry" value="{{ old('industry', $company->industry ?? '') }}">
                    @error('industry') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Jumlah Karyawan --}}
                <div class="mb-4">
                    <label for="employee_count_range" class="block text-sm font-medium text-gray-700 mb-1">Range Jumlah Karyawan</label>
                    <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('employee_count_range') border-red-500 @enderror" id="employee_count_range" name="employee_count_range" placeholder="Contoh: 50-200, 1000+" value="{{ old('employee_count_range', $company->employee_count_range ?? '') }}">
                    @error('employee_count_range') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Alamat Lengkap (untuk Peta) --}}
                <div class="mb-4">
                    <label for="full_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap (untuk Peta)</label>
                    <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('full_address') border-red-500 @enderror" id="full_address" name="full_address" rows="2">{{ old('full_address', $company->full_address ?? $company->address ?? '') }}</textarea>
                    @error('full_address') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- URL Google Maps Embed --}}
                <div class="mb-4">
                    <label for="google_maps_embed_url" class="block text-sm font-medium text-gray-700 mb-1">URL Google Maps Embed</label>
                    <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('google_maps_embed_url') border-red-500 @enderror" id="google_maps_embed_url" name="google_maps_embed_url" rows="3" placeholder="Tempel kode iframe dari Google Maps di sini">{{ old('google_maps_embed_url', $company->google_maps_embed_url ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Buka Google Maps > Cari lokasi > Share > Embed a map > Copy HTML.</p>
                    @error('google_maps_embed_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Link Sosial Media --}}
                <h6 class="text-base font-semibold text-gray-800 mt-4 mb-3">Link Sosial Media</h6>
                
                {{-- LinkedIn URL --}}
                <div class="mb-4">
                    <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fab fa-linkedin text-blue-600 mr-1"></i> LinkedIn URL
                    </label>
                    <input type="url" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('linkedin_url') border-red-500 @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $company->linkedin_url ?? '') }}">
                    @error('linkedin_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Instagram URL --}}
                <div class="mb-4">
                    <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fab fa-instagram text-pink-600 mr-1"></i> Instagram URL
                    </label>
                    <input type="url" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('instagram_url') border-red-500 @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $company->instagram_url ?? '') }}">
                    @error('instagram_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Twitter URL --}}
                <div class="mb-4">
                    <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fab fa-twitter text-blue-400 mr-1"></i> Twitter URL
                    </label>
                    <input type="url" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('twitter_url') border-red-500 @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $company->twitter_url ?? '') }}">
                    @error('twitter_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Card Galeri Foto Perusahaan (Hanya di mode Edit) --}}
        @if(isset($company) && $company->exists)
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b font-semibold">Galeri Foto Perusahaan</div>
            <div class="p-4">
                <div class="mb-4">
                    <label for="gallery_photos" class="block text-sm font-medium text-gray-700 mb-1">Tambah Foto Baru ke Galeri (Bisa pilih banyak)</label>
                    <input type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('gallery_photos.*') border-red-500 @enderror" id="gallery_photos" name="gallery_photos[]" multiple accept="image/*">
                    @error('gallery_photos.*') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    <p class="mt-1 text-xs text-gray-500">Maks 2MB per foto. Format: JPG, PNG, GIF.</p>
                </div>

                @if($company->photos && $company->photos->isNotEmpty())
                    <hr class="my-4 border-gray-200">
                    <h6 class="text-sm font-semibold text-gray-800 mb-3">Foto Saat Ini di Galeri:</h6>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($company->photos as $photo)
                            <div class="relative">
                                <img src="{{ Storage::url($photo->photo_path) }}" alt="Gallery Photo" class="w-full h-32 object-cover rounded-lg border">
                                <div class="absolute top-2 right-2 bg-white bg-opacity-90 rounded p-1">
                                    <div class="flex items-center">
                                        <input class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded" type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" id="delete_photo_{{ $photo->id }}">
                                        <label class="ml-1 text-xs text-red-600 font-medium" for="delete_photo_{{ $photo->id }}">
                                            Hapus
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Belum ada foto di galeri.</p>
                @endif
            </div>
        </div>
        @endif

        {{-- Card Opsi Buat Akun User (Hanya tampilkan di form create ATAU jika company belum punya user) --}}
        @if(!isset($company) || !$company->user_id)
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden" id="create-user-section">
            <div class="bg-gray-50 px-4 py-3 border-b">
                <div class="flex items-center">
                    <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" value="1" id="create_user_checkbox" name="create_user" {{ old('create_user') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-gray-700" for="create_user_checkbox">
                        Buatkan Akun Login untuk Perusahaan Ini?
                    </label>
                </div>
            </div>
            <div class="p-4" id="user-form-fields" style="{{ old('create_user') ? '' : 'display: none;' }}">
                <p class="text-gray-500 text-sm mb-4">Jika dicentang, perusahaan akan bisa login ke dashboard mereka sendiri.</p>
                
                {{-- Email Login User --}}
                <div class="mb-4">
                    <label for="user_email" class="block text-sm font-medium text-gray-700 mb-1">Email Login <span class="text-red-500">*</span></label>
                    <input type="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('user_email') border-red-500 @enderror" id="user_email" name="user_email" value="{{ old('user_email') }}">
                    @error('user_email') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Password User --}}
                <div class="mb-4">
                    <label for="user_password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                    <input type="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('user_password') border-red-500 @enderror" id="user_password" name="user_password">
                    @error('user_password') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Konfirmasi Password User --}}
                <div class="mb-4">
                    <label for="user_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input type="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" id="user_password_confirmation" name="user_password_confirmation">
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b font-semibold">Informasi Akun Login</div>
            <div class="p-4">
                <p class="text-gray-800">Perusahaan ini sudah memiliki akun login dengan email: <strong>{{ $company->user->email }}</strong></p>
                <p class="text-sm text-gray-500 mt-2">Pengelolaan akun login (reset password, dll.) dapat dilakukan di menu manajemen user (jika ada).</p>
            </div>
        </div>
        @endif
    </div>

    {{-- Kolom Kanan --}}
    <div class="md:col-span-4">
        {{-- Card Logo Perusahaan --}}
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b font-semibold">Logo Perusahaan</div>
            <div class="p-4 text-center">
                {{-- Tampilkan logo saat ini (di form edit) --}}
                @if(isset($company) && $company->logo_path && Storage::disk('public')->exists($company->logo_path))
                    <img id="logo-preview" src="{{ Storage::url($company->logo_path) }}" alt="Logo Preview" class="max-h-36 border rounded p-1 mx-auto mb-4">
                    <div class="flex items-center justify-center mb-3">
                        <input class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded" type="checkbox" value="1" id="remove_logo" name="remove_logo">
                        <label class="ml-2 block text-sm text-gray-700" for="remove_logo">
                            Hapus logo saat ini
                        </label>
                    </div>
                @else
                    <img id="logo-preview" src="https://via.placeholder.com/150" alt="Logo Preview" class="max-h-36 border rounded p-1 mx-auto mb-4">
                    <p class="text-gray-500 text-sm mb-3">Belum ada logo.</p>
                @endif

                {{-- Input File Logo --}}
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Upload Logo Baru (Opsional)</label>
                <input class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('logo') border-red-500 @enderror" type="file" id="logo" name="logo" accept="image/*" onchange="previewLogo(event)">
                <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG. Maks: 2MB.</p>
                @error('logo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Card Aksi --}}
        <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b font-semibold">Aksi</div>
            <div class="p-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md mb-3 flex items-center justify-center transition duration-200">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Data
                </button>
                <a href="{{ route('admin.companies.index') }}" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-md inline-flex items-center justify-center transition duration-200">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Script Sederhana untuk Preview Logo & Toggle User Form --}}
@push('scripts')
<script>
    // Fungsi preview logo
    function previewLogo(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('logo-preview');
            output.src = reader.result;
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        } else {
             // Reset ke default jika file dibatalkan
            @if(isset($company) && $company->logo_path && Storage::disk('public')->exists($company->logo_path))
                output.src = "{{ Storage::url($company->logo_path) }}";
             @else
                output.src = "https://via.placeholder.com/150";
             @endif
        }
    }

    // Fungsi toggle user form
    document.addEventListener('DOMContentLoaded', function() {
        const createUserCheckbox = document.getElementById('create_user_checkbox');
        const userFormFields = document.getElementById('user-form-fields');

        if (createUserCheckbox) { // Pastikan elemen ada
            createUserCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    userFormFields.style.display = 'block';
                } else {
                    userFormFields.style.display = 'none';
                }
            });
        }
    });
</script>
@endpush