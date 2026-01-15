<x-app-layout>
    <x-slot name="title">Edit Banner</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('banners.index') }}" class="hover:text-indigo-600">Banner Slider</a>
            <span>/</span>
            <span class="text-gray-800">Edit Banner</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Edit Banner: {{ $banners->title }}</h2>
    </div>

    <form method="POST" action="/banners/{{ $banners->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">

                    <div>
                        <x-input-label for="title" value="Title" />
                        <x-text-input
                            id="title"
                            name="title"
                            type="text"
                            class="mt-2 block w-full"
                            :value="old('title', $banners->title)"
                            required />
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="sub_title" value="Subtitle" />
                        <x-text-input
                            id="sub_title"
                            name="sub_title"
                            type="text"
                            class="mt-2 block w-full"
                            :value="old('sub_title', $banners->sub_title)"
                            required />
                         @error('sub_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Gambar Banner</h3>

                    <div class="mb-4">
                        <p class="text-xs text-gray-500 mb-2">Gambar Saat Ini:</p>
                        <div class="rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ Storage::url($banners->image_path) }}" alt="Current Banner" class="w-full h-auto object-cover">
                        </div>
                    </div>

                    <div>
                        <x-input-label for="image_path" value="Ganti Gambar (Opsional)" />
                        <input
                            id="image_path"
                            name="image_path"
                            type="file"
                            accept="image/*"
                            class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                        />
                         @error('image_path')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 mt-6 border-t border-gray-200 flex gap-3">
                        <a href="{{ route('banners.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                            Batal
                        </a>
                        <x-primary-button class="flex-1 justify-center">
                            Simpan Perubahan
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
