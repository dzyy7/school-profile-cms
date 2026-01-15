<x-app-layout>
    <x-slot name="title">{{ $post->title }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <a href="/posts" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Berita
            </a>

            <div class="flex gap-2">
                <a
                    class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                    Edit Berita
                </a>
            </div>
        </div>

        <div class="bg-white rounded-t-2xl border-x border-t border-gray-100 p-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-6">
                {{ $post->title }}
            </h1>

            <div class="flex items-center gap-3">
                <img src="{{ $post->author->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) }}"
                    class="w-10 h-10 rounded-full object-cover" alt="{{ $post->author->name }}">

                <div class="flex flex-col">
                    <div class="text-sm">
                        <span class="text-gray-500">Oleh</span>
                        <span class="font-bold text-blue-900">{{ $post->author->name ?? 'Admin' }}</span>
                    </div>
                    @if ($post->status !== 'draft')
                        <div class="text-sm text-gray-600">
                            Diterbitkan
                            {{ $post->created_at->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }}
                            WIB
                        </div>
                    @endif
                </div>


            </div>
        </div>

        @if ($post->image_path)
            <div class="w-full bg-white border-x border-gray-100 p-8">
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                    class="w-full h-auto max-h-[450px] object-cover">
            </div>
        @endif

        <div class="bg-white rounded-b-2xl border-x border-b border-gray-100 p-8 ">
            <article class="prose prose-indigo prose-lg max-w-none text-gray-700">
                {!! $post->content !!}
            </article>
        </div>


    </div>
</x-app-layout>

<style>
    /* CKEditor membungkus <img> di dalam <figure> */
    .prose figure.image {
        margin: 2rem 0;
        width: 100%;
        /* Pastikan figure mengambil lebar penuh */
    }

    .prose figure.image img {
        border-radius: 0.75rem;
        margin: 0 auto;
        /* Tengah-kan gambar */
        display: block;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        height: auto;
    }

    /* Menangani caption jika user menambahkan caption di CKEditor */
    .prose figure figcaption {
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }

    /* Pastikan gambar yang diletakkan di sisi (side image) tetap berfungsi */
    .prose figure.image-style-side {
        float: right;
        max-width: 50%;
        margin-left: 1.5rem;
    }

    /* Sisanya biarkan Tailwind Prose yang bekerja */
</style>
