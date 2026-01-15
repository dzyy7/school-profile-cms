<x-app-layout>
    <x-slot name="title">Manajemen Berita</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Berita</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola semua artikel dan pengumuman sekolah</p>
        </div>
        <a href="{{ route('posts.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Buat Berita Baru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
        <form class="flex items-center gap-2" action="{{ route('posts.index') }}" method="GET">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Cari judul berita...">
            </div>

            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Cari
            </button>

            @if (request('keyword'))
                <a href="{{ route('posts.index') }}" class="text-sm text-gray-500 hover:text-red-500 transition">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Berita
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal
                        Publish</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($posts as $post)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $post->image_path ? asset('storage/' . $post->image_path) : 'https://placehold.co/80x80' }}"
                                    alt="Post" class="w-16 h-16 rounded-lg object-cover">
                                <div>
                                    <p class="font-semibold text-gray-800">
                                        {{ Str::limit($post->title, 65) ?? $post->title }}</p>
                                    <p class="text-xs text-gray-500 line-clamp-2">
                                        @php
                                            // 1. Ambil konten asli
                                            $html = $post->content;

                                            // 2. Buang semua tag <figure> beserta isinya (tempat metadata gambar Trix berada)
                                            $cleanHtml = preg_replace('/<figure[^>]*>.*?<\/figure>/s', '', $html);

                                            // 3. Baru kemudian buang tag HTML lainnya agar jadi teks murni
                                            $text = strip_tags($cleanHtml);

                                            // 4. Bersihkan spasi atau baris baru yang berlebihan
                                            $finalText = trim(preg_replace('/\s+/', ' ', $text));
                                        @endphp

                                        {{ Str::limit($finalText, 70) }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $post->status === 'published' ? $post->created_at->format('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($post->status === 'published')
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Published
                                </span>
                            @else
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/posts/{{ $post->slug }}"
                                    class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition"
                                    title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a href="/posts/{{ $post->slug }}/edit"
                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                    title="Edit Berita">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form action="/posts/{{ $post->slug }}" method="POST"
                                    id="form-{{ $post->id }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" onclick="openModal('form-{{ $post->id }}')"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z" />
                                </svg>
                                <p>Belum ada berita yang ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
    <div id="modal-delete" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>

        <div class="relative flex min-h-screen items-center justify-center p-4">
            <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl">
                <div class="flex flex-col items-center text-center">
                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-red-50">
                        <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900">Hapus Berita?</h3>
                    <p class="mt-2 text-sm text-gray-500">Tindakan ini tidak bisa dibatalkan. Berita akan hilang
                        selamanya.</p>
                </div>

                <div class="mt-6 flex gap-3">
                    <button onclick="toggleModal(false)"
                        class="flex-1 rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">
                        Batal
                    </button>
                    <button id="confirm-btn"
                        class="flex-1 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700 shadow-sm shadow-red-200 transition">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
   
    <script>
        let formToSubmit = null;

        function openModal(formId) {
            formToSubmit = formId;
            document.getElementById('modal-delete').classList.remove('hidden');
        }

        function toggleModal(show) {
            if (!show) document.getElementById('modal-delete').classList.add('hidden');
        }

        document.getElementById('confirm-btn').onclick = function() {
            if (formToSubmit) document.getElementById(formToSubmit).submit();
        }
    </script>
</x-app-layout>
