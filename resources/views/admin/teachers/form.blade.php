<x-app-layout>
    <x-slot name="title">Tambah Guru Baru</x-slot>

    <div class="max-w-4xl mx-auto mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="/teachers" class="hover:text-indigo-600 transition-colors">Guru</a>
            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-800 font-medium">Tambah Baru</span>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Tambah Guru Baru</h2>
        <p class="text-gray-500 mt-1">Lengkapi data diri dan jabatan guru pengajar.</p>
    </div>

    <form method="POST" action="/teachers" enctype="multipart/form-data" class="max-w-4xl mx-auto">
        @csrf

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 flex flex-col md:flex-row">

            <div
                class="md:w-1/3 bg-gray-50 p-8 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-gray-100 relative group">
                <div class="text-center w-full">
                    <x-input-label for="image_path" value="Foto Profil"
                        class="mb-4 text-center text-lg text-gray-700" />

                    <div class="relative w-48 h-48 mx-auto mb-2">
                        <input id="image_path" name="image_path" type="file" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
                            onchange="previewImage(event)" />

                        <div
                            class="w-full h-full rounded-full bg-white border-2 border-dashed {{ $errors->has('image_path') ? 'border-red-400' : 'border-indigo-300' }} flex flex-col items-center justify-center overflow-hidden relative">
                            <div id="placeholder-icon" class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-indigo-400 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-xs text-gray-500 font-medium">Klik untuk upload</span>
                            </div>
                            <img id="img-preview" src="#" alt="Preview"
                                class="hidden w-full h-full object-cover absolute inset-0" />
                        </div>
                    </div>

                    @error('image_path')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror

                    <div
                        class="bg-blue-50 text-blue-700 px-4 py-3 rounded-lg text-xs text-left mx-auto max-w-xs border border-blue-100 mt-4">
                        <p class="font-bold mb-1">Tips Foto:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Format: JPG/PNG (Max 2MB)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="md:w-2/3 p-8 md:p-10 flex flex-col justify-center">
                <div class="space-y-6">

                    <div>
                        <x-input-label for="name" value="Nama Lengkap & Gelar" class="text-gray-700" />
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 {{ $errors->has('name') ? 'text-red-400' : 'text-gray-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <x-text-input id="name" name="name" type="text"
                                class="pl-10 block w-full py-3 {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300' }} rounded-lg shadow-sm"
                                placeholder="Contoh: Dr. Ahmad Fauzi, S.Pd" :value="old('name')" />
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="jabatan" value="Jabatan / Mata Pelajaran" class="text-gray-700" />
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 {{ $errors->has('jabatan') ? 'text-red-400' : 'text-gray-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <x-text-input id="jabatan" name="jabatan" type="text"
                                class="pl-10 block w-full py-3 {{ $errors->has('jabatan') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300' }} rounded-lg shadow-sm"
                                placeholder="Contoh: Guru Matematika" :value="old('jabatan')" />
                        </div>
                        @error('jabatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 mt-4 border-t border-gray-100 flex items-center gap-4">
                        <x-primary-button class="justify-center py-3 px-6 text-base w-full md:w-auto">
                            Simpan Data Guru
                        </x-primary-button>
                        <a href="/teachers"
                            class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                            Batal
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imageField = document.getElementById("img-preview");
            const placeholder = document.getElementById("placeholder-icon");

            reader.onload = function() {
                if (reader.readyState == 2) {
                    imageField.src = reader.result;
                    imageField.classList.remove("hidden"); // Tampilkan gambar
                    placeholder.classList.add("hidden"); // Sembunyikan icon
                }
            }

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</x-app-layout>
