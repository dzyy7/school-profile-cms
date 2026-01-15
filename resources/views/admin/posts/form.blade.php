<x-app-layout>
    <x-slot name="title">Buat Berita Baru</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="/posts" class="hover:text-indigo-600">Berita</a>
            <span>/</span>
            <span class="text-gray-800">Buat Baru</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Buat Berita Baru</h2>
    </div>

    <form method="POST" action="/posts" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div>
                        <x-input-label for="title" value="Judul Berita" />

                        <x-text-input id="title" name="title" type="text" {{-- Logika Conditional Class --}}
                            class="mt-2 block w-full text-lg font-medium {{ $errors->has('title') ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : '' }}"
                            :value="old('title')" required placeholder="Masukkan judul berita yang menarik..." />

                        @error('title')
                            <p class="mt-2 text-sm text-red-600 font-medium italic"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <input id="content" type="hidden" name="content" value="{{ old('content') }}">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <x-input-label for="content" value="Konten Berita" class="mb-2" />

                    <textarea id="editor" name="content" style="display: none;">
                        {{ old('content', $post->content ?? '') }}
                    </textarea>

                    @error('content')
                        <p class="mt-2 text-sm text-red-600 font-medium italic"> {{ $message }}</p>
                    @enderror
                </div>

                @error('content')
                    <p class="mt-2 text-sm text-red-600 font-medium italic"> {{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Status Publikasi</h3>
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-sm text-gray-700 font-medium">Publish Sekarang?</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="status" value="draft">
                            <input type="checkbox" name="status" value="published" class="sr-only peer"
                                {{ old('status') == 'published' ? 'checked' : '' }}>

                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                            </div>
                        </label>
                    </div>


                    <div class="flex flex-col gap-3">
                        <x-primary-button class="justify-center w-full py-3">
                            Simpan Berita
                        </x-primary-button>
                        <a href="{{ route('posts.index') }}"
                            class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Batal
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Gambar Utama</h3>

                    <div id="preview-container" class="mb-4 hidden relative group">
                        <img id="image-preview" src="#" alt="Preview"
                            class="w-full h-48 object-cover rounded-lg border border-gray-200">
                        <button type="button" onclick="removePreview()"
                            class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div id="upload-area"
                        class="border-2 border-dashed rounded-lg p-4 text-center hover:bg-gray-50 transition {{ $errors->has('image_path') ? 'border-red-500 bg-red-50' : 'border-gray-300' }}">

                        <input id="image_path" name="image_path" type="file" accept="image/*"
                            onchange="previewImage(this)"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer" />

                        <p class="text-xs text-gray-400 mt-2">JPG, PNG, WEBP (Max: 2MB)</p>
                    </div>

                    @error('image_path')
                        <p class="mt-2 text-sm text-red-600 font-medium italic"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </form>
    <script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
        }
    }
</script>

    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph,
            List,
            Link,
            Image,
            ImageUpload,
            ImageToolbar,
            ImageCaption,
            ImageStyle,
            ImageResize,
            FileRepository,
            SimpleUploadAdapter
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [
                    Essentials, Bold, Italic, Font, Paragraph, List, Link,
                    Image, ImageUpload, ImageToolbar, ImageCaption, ImageStyle, ImageResize,
                    FileRepository, SimpleUploadAdapter
                ],
                toolbar: [
                    'undo', 'redo', '|', 'heading', '|',
                    'bold', 'italic', '|',
                    'link', 'uploadImage', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent'
                ],
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'toggleImageCaption',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side'
                    ]
                },
                // Konfigurasi Upload Adapter
                simpleUpload: {
                    // URL ke method uploadBodyImage di controller
                    uploadUrl: "{{ route('posts.upload_image') }}",

                    // Headers (Wajib ada CSRF Token)
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function previewImage(input) {
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('image-preview');
            const uploadArea = document.getElementById('upload-area');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    // Optional: Beri highlight pada border upload area
                    uploadArea.classList.add('border-indigo-400');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removePreview() {
            const input = document.getElementById('image_path');
            const previewContainer = document.getElementById('preview-container');
            const uploadArea = document.getElementById('upload-area');

            input.value = ""; // Reset input file
            previewContainer.classList.add('hidden');
            uploadArea.classList.remove('border-indigo-400');
        }
    </script>
</x-app-layout>
