<x-app-layout>
    <x-slot name="title">Manajemen Banner</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Banner Slider</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola banner slide di halaman utama</p>
        </div>
        <a href="{{ route('banners.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Banner
        </a>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="flex-1">
            <p class="text-sm text-blue-800 font-medium">Tips Banner Slider</p>
            <p class="text-sm text-blue-700 mt-1">Ukuran gambar yang disarankan: 1920x800px. Format: JPG atau PNG.
                Maksimal 5 banner aktif untuk performa optimal.</p>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($banners as $banner)
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden {{ !$banner->is_active ? 'opacity-75 bg-gray-50' : '' }} transition-all hover:shadow-md relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">

                    <!-- Image Section -->
                    <div class="lg:col-span-1">
                        <div class="aspect-video rounded-lg overflow-hidden bg-gray-100 relative group">
                            @if ($banner->image_path)
                                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}"
                                    class="w-full h-full object-cover" />
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 text-sm">
                                    Tidak ada gambar
                                </div>
                            @endif

                            @if (!$banner->is_active)
                                <div
                                    class="absolute inset-0 bg-gray-900/10 flex items-center justify-center pointer-events-none">
                                    <span class="px-2 py-1 bg-gray-800 text-white text-xs rounded">Nonaktif</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="lg:col-span-2 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                @if ($banner->is_active)
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Aktif
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                                        Nonaktif
                                    </span>
                                @endif

                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                                    Urutan: {{ $banner->order }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $banner->title }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-2">{{ $banner->sub_title }}</p>

                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $banner->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap items-center gap-2 mt-4 pt-4 border-t border-gray-100 relative z-20">

                            <!-- Move Up Button -->
                            @unless ($loop->first)
                                <form action="{{ route('banners.up', $banner->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="px-3 py-1.5 text-sm bg-gray-50 hover:bg-gray-200 text-gray-700 rounded-lg transition border border-gray-200 cursor-pointer"
                                        title="Naikkan Urutan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7" />
                                        </svg>
                                    </button>
                                </form>
                            @endunless

                            <!-- Move Down Button -->
                            @unless ($loop->last)
                                <form action="{{ route('banners.down', $banner->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="px-3 py-1.5 text-sm bg-gray-50 hover:bg-gray-200 text-gray-700 rounded-lg transition border border-gray-200 cursor-pointer"
                                        title="Turunkan Urutan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </form>
                            @endunless

                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                            <!-- Toggle Active Button -->
                            <form action="{{ route('banners.toggle', $banner->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('PATCH')
                                @if ($banner->is_active)
                                    <button type="submit"
                                        class="px-3 py-1.5 text-sm bg-yellow-50 hover:bg-yellow-100 text-yellow-700 rounded-lg transition flex items-center gap-1 border border-yellow-200 cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        Nonaktifkan
                                    </button>
                                @else
                                    <button type="submit"
                                        class="px-3 py-1.5 text-sm bg-green-50 hover:bg-green-100 text-green-700 rounded-lg transition flex items-center gap-1 border border-green-200 cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Aktifkan
                                    </button>
                                @endif
                            </form>

                            <!-- Edit Button -->
                            <a href="{{ route('banners.edit', $banner->id) }}"
                                class="px-3 py-1.5 text-sm bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-lg transition flex items-center gap-1 border border-indigo-200 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1.5 text-sm bg-red-50 hover:bg-red-100 text-red-700 rounded-lg transition flex items-center gap-1 border border-red-200 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada banner</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat banner baru untuk slider halaman utama.</p>
                <div class="mt-6">
                    <a href="{{ route('banners.create') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Banner Baru
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</x-app-layout>
