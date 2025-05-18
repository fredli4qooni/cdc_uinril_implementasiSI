{{-- Pesan Error --}}
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="mb-0 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="flex flex-col md:flex-row gap-4">
    {{-- Kolom Kiri: Data User & Akun --}}
    <div class="md:w-5/12">
        <div class="bg-white rounded-lg shadow-md mb-4">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg">Data Akun</div>
            <div class="p-4">
                {{-- Nama --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="name" name="name" value="{{ old('name', $student->name ?? '') }}" required>
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                {{-- Email (Readonly untuk Admin) --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100" id="email" value="{{ $student->email ?? '' }}" readonly disabled>
                    <p class="mt-1 text-xs text-gray-500">Email tidak dapat diubah oleh Admin.</p>
                </div>

                {{-- Reset Password (Opsional) --}}
                <hr class="my-4 border-gray-200">
                <p class="font-medium mb-2">Reset Password (Opsional)</p>
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" class="w-full px-3 py-2 border @error('new_password') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="new_password" name="new_password" autocomplete="new-password">
                    @error('new_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="new_password_confirmation" name="new_password_confirmation" autocomplete="new-password">
                    <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah password.</p>
                </div>

                {{-- Status Akun (jika ada kolom is_active) --}}
                {{-- <hr class="my-4 border-gray-200">
                <div class="flex items-center mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="is_active" id="is_active" value="1" {{ old('is_active', $student->is_active ?? true) ? 'checked' : '' }}>
                        <span class="ml-2">Akun Aktif</span>
                    </label>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Data Profil Mahasiswa --}}
    <div class="md:w-7/12">
        <div class="bg-white rounded-lg shadow-md mb-4">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg">Profil Mahasiswa</div>
            <div class="p-4">
                {{-- NIM --}}
                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">NIM <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-3 py-2 border @error('nim') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="nim" name="nim" value="{{ old('nim', $student->studentProfile->nim ?? '') }}" required>
                    @error('nim') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Jurusan --}}
                <div class="mb-4">
                    <label for="major" class="block text-sm font-medium text-gray-700 mb-1">Jurusan / Program Studi</label>
                    <input type="text" class="w-full px-3 py-2 border @error('major') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="major" name="major" value="{{ old('major', $student->studentProfile->major ?? '') }}">
                    @error('major') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Tahun Masuk --}}
                <div class="mb-4">
                    <label for="entry_year" class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                    <input type="number" class="w-full px-3 py-2 border @error('entry_year') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="entry_year" name="entry_year" value="{{ old('entry_year', $student->studentProfile->entry_year ?? '') }}" placeholder="Contoh: 2020">
                    @error('entry_year') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="tel" class="w-full px-3 py-2 border @error('phone_number') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="phone_number" name="phone_number" value="{{ old('phone_number', $student->studentProfile->phone_number ?? '') }}">
                    @error('phone_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea class="w-full px-3 py-2 border @error('address') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="address" name="address" rows="3">{{ old('address', $student->studentProfile->address ?? '') }}</textarea>
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Bio --}}
                <div class="mb-4">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio Singkat</label>
                    <textarea class="w-full px-3 py-2 border @error('bio') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="bio" name="bio" rows="3">{{ old('bio', $student->studentProfile->bio ?? '') }}</textarea>
                    @error('bio') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Upload/Kelola CV --}}
                <div class="mb-4">
                    <label for="cv" class="block text-sm font-medium text-gray-700 mb-1">Curriculum Vitae (CV)</label>
                    @if($student->studentProfile && $student->studentProfile->cv_path && Storage::disk('public')->exists($student->studentProfile->cv_path))
                        <div class="mb-2">
                            <a href="{{ Storage::url($student->studentProfile->cv_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                Lihat CV Saat Ini
                            </a>
                            <div class="flex items-center mt-1">
                                <input type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" id="remove_cv" name="remove_cv" value="1">
                                <label class="ml-2 text-sm text-red-600" for="remove_cv">
                                    Hapus CV saat ini
                                </label>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mb-2">Belum ada CV.</p>
                    @endif
                    <input class="w-full px-3 py-2 border @error('cv') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" type="file" id="cv" name="cv" accept=".pdf,.doc,.docx">
                    <p class="mt-1 text-xs text-gray-500">Upload CV baru (PDF/Word, maks 5MB). Upload baru akan menggantikan yang lama.</p>
                    @error('cv') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md mb-4">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-lg">Aksi</div>
            <div class="p-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm mb-2 flex justify-center items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.students.index') }}" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow-sm flex justify-center items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Batal
                </a>
            </div>
        </div>
    </div>
</div>