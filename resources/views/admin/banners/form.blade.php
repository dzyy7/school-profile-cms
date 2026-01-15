<x-app-layout>
    <x-slot name="title">Tambah Banner Baru</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="/banners" class="hover:text-indigo-600 transition">Banner Slider</a>
            <span>/</span>
            <span class="text-gray-800">Tambah Baru</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Tambah Banner Baru</h2>
    </div>

    <form method="POST" action="/banners" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                    <div>
                        <x-input-label for="title" value="Judul Banner" />
                        <x-text-input
                            id="title"
                            name="title"
                            type="text"
                            class="mt-2 block w-full"
                            :value="old('title')"
                            placeholder="Contoh: Selamat Datang di SMK Negeri 1"
                            required />
                        <p class="text-xs text-gray-500 mt-1">Judul utama yang akan ditampilkan.</p>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="subtitle" value="Subtitle / Deskripsi (Opsional)" />
                        <textarea
                            id="sub_title"
                            name="sub_title"
                            rows="3"
                            class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            placeholder="Contoh: Mencetak Generasi Unggul dan Berprestasi">{{ old('sub_title') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Deskripsi singkat di bawah judul.</p>
                        <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Gambar Banner</h3>

                    <div class="mb-4">
                        <div class="w-full aspect-[21/9] bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300 relative">
                            <div id="placeholder-icon" class="text-center p-8">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-gray-600 font-medium">Preview gambar akan muncul di sini</p>
                                <p class="text-gray-500 text-sm mt-1">Rasio 21:9 (1920x800px)</p>
                            </div>
                            <img id="image-preview" src="#" alt="Preview" class="absolute inset-0 w-full h-full object-cover hidden">
                        </div>
                    </div>

                    <div>
                        <x-input-label for="image_path" value="Upload File" />
                        <input
                            id="image_path"
                            name="image_path"
                            type="file"
                            accept="image/png, image/jpeg, image/jpg"
                            onchange="previewImage(event)"
                            class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition"
                            required />
                        <p class="text-xs text-gray-500 mt-2">
                            Format: JPG, PNG (Max: 2MB). Ukuran optimal: 1920x800px.
                        </p>
                        <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Pengaturan</h3>

                    <div class="mb-4">
                        <x-input-label for="order" value="Urutan Tampil" />
                        <x-text-input
                            id="order"
                            name="order"
                            type="number"
                            min="1"
                            class="mt-2 block w-full"
                            :value="old('order', 1)"
                            required />
                        <p class="text-xs text-gray-500 mt-1">Urutan banner (1, 2, 3...)</p>
                        <x-input-error :messages="$errors->get('order')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 shadow-sm transition">
                            <span class="text-sm font-medium text-gray-700">Aktifkan Banner</span>
                        </label>
                        <p class="text-xs text-gray-500 mt-1 ml-6">Jika tidak dicentang, banner akan disembunyikan (draft).</p>
                    </div>

                    <div class="pt-4 border-t border-gray-200 flex gap-3">
                        <a href="{{ route('banners.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Batal
                        </a>
                        <x-primary-button class="flex-1 justify-center">
                            Simpan Banner
                        </x-primary-button>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 p-6">
                    <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tips Gambar
                    </h3>
                    <ul class="text-sm text-gray-700 space-y-2 list-disc list-inside marker:text-blue-600">
                        <li>Resolusi optimal: <strong>1920x800px</strong>.</li>
                        <li>Pastikan teks pada gambar (jika ada) mudah dibaca.</li>
                        <li>Hindari gambar yang terlalu gelap atau buram.</li>
                        <li>Maksimal 5 banner aktif agar website tetap cepat.</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imageField = document.getElementById('image-preview');
            const placeholder = document.getElementById('placeholder-icon');

            reader.onload = function(){
                if(reader.readyState == 2){
                    imageField.src = reader.result;
                    imageField.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
            }

            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</x-app-layout>
