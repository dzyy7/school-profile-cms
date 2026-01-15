@vite(['resources/css/app.css', 'resources/js/app.js'])

<x-app-layout>
    <x-slot name="title">Dashboard Admin</x-slot>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <x-stat-card title="Total Berita" value="{{ $count_posts }}" subtitle="Total berita publised" icon="chart"
            color="purple" />

        <x-stat-card title="Total Guru" value="{{ $count_guru }}" subtitle="Guru aktif terdaftar" icon="users"
            color="green" />

        <x-stat-card title="Total admin" value="{{ $count_admin }}" subtitle="Admin terdaftar" icon="lightning"
            color="gradient" />

        <x-stat-card title="Pesan Masuk" value="12" subtitle="3 pesan belum dibaca" icon="mail" color="blue" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Notifications -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">Notifikasi</h2>
                    <a href="#" class="text-sm text-purple-600 hover:text-purple-700 font-medium">Hapus semua</a>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <!-- Alert Item -->
                <div class="flex items-start gap-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex-shrink-0">
                        <span
                            class="inline-block px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded uppercase">High</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-800 font-medium mb-1">Pesan kontak baru dari orang tua siswa
                            memerlukan respon segera</p>
                        <p class="text-xs text-gray-500">2 jam yang lalu</p>
                    </div>
                    <button
                        class="flex-shrink-0 px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-50">
                        Lihat
                    </button>
                </div>

                <!-- Alert Item -->
                <div class="flex items-start gap-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex-shrink-0">
                        <span
                            class="inline-block px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded uppercase">Low</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-800 font-medium mb-1">Data guru berhasil diupdate. Perubahan telah
                            disimpan ke sistem.</p>
                        <p class="text-xs text-gray-500">5 jam yang lalu</p>
                    </div>
                    <button
                        class="flex-shrink-0 px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-50">
                        Lihat
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Recent Posts -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Berita Terbaru</h2>
                <div class="space-y-4">
                    @forelse($latestPosts as $post)
                        <div class="flex gap-3">
                            @if ($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post"
                                    class="w-14 h-14 rounded-lg object-cover flex-shrink-0">
                            @else
                                <div
                                    class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-semibold text-gray-800 mb-1 line-clamp-1">
                                    {{ $post->title }}
                                </h3>
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

                                    {{ Str::limit($finalText, 12) }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400">Tidak ada berita terbaru.</p>
                    @endforelse
                </div>
            </div>

            <!-- CMS Version -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Versi CMS</h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Version 1.0.0</span>
                        <span class="px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">LATEST</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Aksi Cepat</h2>
                </div>
                <div class="space-y-3">
                    <a href="/posts/create"
                        class="flex items-center gap-3 p-3 bg-purple-50 border-l-4 border-purple-500 rounded hover:bg-purple-100 transition">
                        <div
                            class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">Buat Berita Baru</p>
                            <p class="text-xs text-gray-500">Tambah artikel atau pengumuman</p>
                        </div>
                    </a>
                    <a href="/teachers/create"
                        class="flex items-center gap-3 p-3 bg-green-50 border-l-4 border-green-500 rounded hover:bg-green-100 transition">
                        <div
                            class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">Tambah Guru</p>
                            <p class="text-xs text-gray-500">Daftarkan guru atau staff baru</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </x-app>
