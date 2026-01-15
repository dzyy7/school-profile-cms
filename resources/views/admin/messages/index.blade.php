<x-app-layout>
    <x-slot name="title">Pesan Masuk</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Inbox Pesan</h2>
            <p class="text-sm text-gray-500 mt-1">Pesan dari pengunjung melalui form kontak</p>
        </div>
        <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
            Hapus Semua
        </button>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
        <form class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" placeholder="Cari pengirim atau subjek..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Semua Status</option>
                <option value="unread">Belum Dibaca</option>
                <option value="read">Sudah Dibaca</option>
            </select>
            <button type="submit" class="px-6 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Message 1 -->
        <div class="border-b border-gray-200 hover:bg-gray-50 transition">
            <div class="p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-indigo-700 font-bold text-lg">B</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-semibold text-gray-800">Budi Santoso</h3>
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Baru</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-500 mb-2">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    budi.santoso@email.com
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    2 jam yang lalu
                                </span>
                            </div>
                            <p class="font-medium text-gray-700 mb-2">Pertanyaan tentang Penerimaan Siswa Baru</p>
                            <p class="text-gray-600 text-sm line-clamp-2">Yth. Bapak/Ibu Admin, saya ingin menanyakan tentang persyaratan dan jadwal penerimaan siswa baru tahun ajaran 2025/2026...</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <button class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message 2 -->
        <div class="border-b border-gray-200 hover:bg-gray-50 transition">
            <div class="p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-purple-700 font-bold text-lg">S</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-semibold text-gray-800">Siti Aminah</h3>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-500 mb-2">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    siti.aminah@email.com
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    5 jam yang lalu
                                </span>
                            </div>
                            <p class="font-medium text-gray-700 mb-2">Informasi Biaya Pendidikan</p>
                            <p class="text-gray-600 text-sm line-clamp-2">Selamat siang, mohon info mengenai rincian biaya pendidikan dan apakah ada program beasiswa yang tersedia...</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <button class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message 3 -->
        <div class="border-b border-gray-200 hover:bg-gray-50 transition">
            <div class="p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-green-700 font-bold text-lg">A</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-semibold text-gray-800">Ahmad Fauzi</h3>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-500 mb-2">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    ahmad.fauzi@email.com
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    1 hari yang lalu
                                </span>
                            </div>
                            <p class="font-medium text-gray-700 mb-2">Kerjasama Industri</p>
                            <p class="text-gray-600 text-sm line-clamp-2">Kepada Yth. Kepala Sekolah, kami dari PT ABC ingin menjalin kerjasama untuk program magang siswa...</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <button class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
