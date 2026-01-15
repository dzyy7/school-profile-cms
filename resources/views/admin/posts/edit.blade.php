<x-app-layout>
    <x-slot name="title">Edit Berita: {{ Str::limit($post->title, 20) }}</x-slot>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
    <style>
        .ck-editor__editable_inline { min-height: 450px; }
    </style>

    <div class="mb-6">
        </div>

    <form method="POST" action="/posts/{{ $post->slug }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                {{-- Judul --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <x-input-label for="title" value="Judul Berita" />
                    <x-text-input id="title" name="title" type="text"
                        class="mt-2 block w-full text-lg font-medium {{ $errors->has('title') ? 'border-red-500' : '' }}"
                        :value="old('title', $post->title)" required />
                    @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- CKEditor Konten --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <x-input-label for="content" value="Konten Berita" class="mb-2" />

                    <textarea id="editor" name="content">
                        {!! old('content', $post->content) !!}
                    </textarea>

                    @error('content')
                        <p class="mt-2 text-sm text-red-600 font-medium italic"> {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-6">
                {{-- Status & Gambar Utama (Tetap sama seperti punyamu, pastikan value-nya benar) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Publikasi</h3>
                    <div class="mb-6">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="status" value="published" class="sr-only peer"
                                {{ old('status', $post->status) == 'published' ? 'checked' : '' }}>
                            <div class="relative w-11 h-6 bg-gray-200 peer-checked:bg-indigo-600 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Publikasikan</span>
                        </label>
                    </div>
                    <x-primary-button class="justify-center w-full py-3">Update Berita</x-primary-button>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Gambar Utama</h3>
                    @if ($post->image_path)
                        <div class="mb-4 relative group">
                            <img src="{{ asset('storage/' . $post->image_path) }}" class="w-full h-40 object-cover rounded-lg border">
                        </div>
                    @endif
                    <input id="image_path" name="image_path" type="file" accept="image/*" class="text-sm" />
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
            ClassicEditor, Essentials, Bold, Italic, Paragraph, List, Link,
            Image, ImageUpload, ImageToolbar, ImageCaption, ImageStyle, ImageResize,
            FileRepository, SimpleUploadAdapter
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [
                    Essentials, Bold, Italic, Paragraph, List, Link,
                    Image, ImageUpload, ImageToolbar, ImageCaption, ImageStyle, ImageResize,
                    FileRepository, SimpleUploadAdapter
                ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|', 'link', 'uploadImage', '|', 'bulletedList', 'numberedList'
                ],
                simpleUpload: {
                    uploadUrl: "{{ route('posts.upload_image') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                }
            })
            .catch(error => { console.error(error); });
    </script>
</x-app-layout>
