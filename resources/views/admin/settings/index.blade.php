<x-app-layout>
    <x-slot name="title">Pengaturan Website</x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Pengaturan Website</h2>
                    <p class="mt-1 text-sm text-gray-600">Kelola informasi publik, identitas sekolah, dan konfigurasi
                        lainnya.</p>
                </div>
            </div>

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="space-y-8">

                    <div class="bg-white p-4 sm:p-8 shadow-sm sm:rounded-2xl border border-gray-100">
                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <span class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </span>
                                Identitas Utama
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 ml-11">Informasi dasar yang akan tampil di header dan
                                footer website.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-1">
                                <x-input-label for="school_logo" value="Logo Sekolah" class="mb-2" />

                                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                                    <input type="file" id="school_logo" name="school_logo" class="hidden"
                                        x-ref="photo" accept="image/*"
                                        x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => { photoPreview = e.target.result; };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                        " />

                                    <div class="mt-2 relative group w-40 h-40 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden"
                                        x-show="! photoPreview">
                                        @if (isset($settings['school_logo']) && $settings['school_logo'])
                                            <img src="{{ Storage::url($settings['school_logo']) }}" alt="Logo"
                                                class="w-full h-full object-contain p-2">
                                        @else
                                            <div class="text-center p-4">
                                                <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-2 w-40 h-40 bg-gray-50 rounded-xl border-2 border-indigo-500 flex items-center justify-center overflow-hidden relative"
                                        x-show="photoPreview" style="display: none;">
                                        <span
                                            class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-green-400 mr-2 mt-2"></span>
                                        <span class="block w-full h-full bg-cover bg-no-repeat bg-center"
                                            x-bind:style="'background-image: url(\'' + photoPreview +
                                                '\'); background-size: contain; background-repeat: no-repeat;'">
                                        </span>
                                    </div>

                                    <div class="mt-4">
                                        <x-secondary-button class="w-40 justify-center"
                                            x-on:click.prevent="$refs.photo.click()">
                                            Pilih Logo Baru
                                        </x-secondary-button>
                                        <p class="text-xs text-gray-500 mt-2 text-center w-40">PNG Transparent (Max 2MB)
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2 space-y-5">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="md:col-span-2">
                                        <x-input-label for="school_name" value="Nama Sekolah" />
                                        <x-text-input id="school_name" name="school_name" type="text"
                                            class="mt-1 block w-full" :value="old('school_name', $settings['school_name'] ?? '')" required />
                                    </div>

                                    <div class="md:col-span-2">
                                        <x-input-label for="school_tagline" value="Motto / Tagline" />
                                        <x-text-input id="school_tagline" name="school_tagline" type="text"
                                            class="mt-1 block w-full" :value="old('school_tagline', $settings['school_tagline'] ?? '')"
                                            placeholder="Cerdas, Berkarakter..." />
                                    </div>

                                    <div>
                                        <x-input-label for="school_email" value="Email Resmi" />
                                        <x-text-input id="school_email" name="school_email" type="email"
                                            class="mt-1 block w-full" :value="old('school_email', $settings['school_email'] ?? '')" />
                                    </div>

                                    <div>
                                        <x-input-label for="school_phone" value="Nomor Telepon" />
                                        <x-text-input id="school_phone" name="school_phone" type="tel"
                                            class="mt-1 block w-full" :value="old('school_phone', $settings['school_phone'] ?? '')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="bg-white p-4 sm:p-8 shadow-sm sm:rounded-2xl border border-gray-100 h-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                                <span class="p-2 bg-red-50 text-red-600 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                Lokasi Sekolah
                            </h3>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="school_address" value="Alamat Lengkap" />
                                    <textarea id="school_address" name="school_address" rows="3"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm transition duration-150 ease-in-out">{{ old('school_address', $settings['school_address'] ?? '') }}</textarea>
                                </div>
                                <div>
                                    <x-input-label for="school_maps_embed" value="Google Maps Embed Link" />
                                    <x-text-input id="school_maps_embed" name="school_maps_embed" type="url"
                                        class="mt-1 block w-full" :value="old('school_maps_embed', $settings['school_maps_embed'] ?? '')"
                                        placeholder="https://www.google.com/maps/embed?..." />
                                    <p class="text-xs text-gray-400 mt-1">Paste link dari menu 'Embed a map' di Google
                                        Maps.</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 sm:p-8 shadow-sm sm:rounded-2xl border border-gray-100 h-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                                <span class="p-2 bg-green-50 text-green-600 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                Jam Operasional
                            </h3>

                            <div>
                                <x-input-label for="school_operating_hours" value="Jadwal Pelayanan" />
                                <div class="relative mt-1">
                                    <textarea id="school_operating_hours" name="school_operating_hours" rows="6"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm font-mono text-sm"
                                        placeholder="Senin - Jumat: 07.00 - 16.00">{{ old('school_operating_hours', $settings['school_operating_hours'] ?? '') }}</textarea>
                                    <div class="absolute top-2 right-2 text-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400 mt-2">Gunakan enter untuk memisahkan baris.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 sm:p-8 shadow-sm sm:rounded-2xl border border-gray-100">
                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <span class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </span>
                                Statistik Sekolah
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 ml-11">Data statistik jumlah siswa, guru, dan alumni.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div>
                                <x-input-label for="tahun_berdiri" value="Tahun Berdiri" />
                                <div class="relative mt-1">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <x-text-input id="tahun_berdiri" name="tahun_berdiri" type="number"
                                        class="pl-10 block w-full" :value="old('tahun_berdiri', $settings['tahun_berdiri'] ?? '')" placeholder="Contoh: 2005" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="peserta_didik" value="Total Siswa" />
                                <div class="relative mt-1">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <x-text-input id="peserta_didik" name="peserta_didik" type="number"
                                        class="pl-10 block w-full" :value="old('peserta_didik', $settings['peserta_didik'] ?? '')" placeholder="0" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="tenaga_pendidik" value="Guru & Staff" />
                                <div class="relative mt-1">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <x-text-input id="tenaga_pendidik" name="tenaga_pendidik" type="number"
                                        class="pl-10 block w-full" :value="old('tenaga_pendidik', $settings['tenaga_pendidik'] ?? '')" placeholder="0" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="alumni" value="Total Alumni" />
                                <div class="relative mt-1">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <x-text-input id="alumni" name="alumni" type="number"
                                        class="pl-10 block w-full" :value="old('alumni', $settings['alumni'] ?? '')" placeholder="0" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 border-t border-gray-200 pt-6">
                        <x-secondary-button type="reset" class="px-6">
                            Reset Perubahan
                        </x-secondary-button>

                        <x-primary-button class="px-8 py-2.5 text-base">
                            Simpan Pengaturan
                        </x-primary-button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
