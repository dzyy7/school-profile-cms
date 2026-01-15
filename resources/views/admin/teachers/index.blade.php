<x-app-layout>
    <x-slot name="title">Manajemen Guru</x-slot>

    <div class="max-w-7xl mx-auto mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Daftar Guru & Staff</h2>
                <p class="text-gray-500 mt-1">Total {{ $teachers->count() ?? 0 }} pengajar aktif di sekolah.</p>
            </div>

            <div class="flex items-center gap-3">
                <form action="/teachers" method="GET" class="relative">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="pl-10 pr-4 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64 shadow-sm transition-all"
                            placeholder="Cari nama guru...">
                    </div>
                </form>

                <a href="/teachers/create"
                    class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-w-7xl mx-auto">

        @forelse($teachers as $teacher)
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                <div class="relative aspect-square overflow-hidden bg-gray-100">
                    @if ($teacher->image_path)
                        <img src="{{ asset('storage/' . $teacher->image_path) }}" alt="{{ $teacher->name }}"
                            class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-300">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>

                <div class="p-5">
                    <div class="mb-4">
                        <h3 class="font-bold text-gray-900 text-lg leading-tight mb-1 truncate"
                            title="{{ $teacher->name }}">
                            {{ $teacher->name }}
                        </h3>
                        <p class="text-sm text-indigo-600 font-medium">
                            {{ $teacher->jabatan }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2 pt-4 border-t border-gray-50">
                        <a href="/teachers/{{ $teacher->id }}/edit"
                            class="flex-1 inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-indigo-600 focus:z-10 focus:ring-2 focus:ring-indigo-500 transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>

                        <form action="/teachers/{{ $teacher->id }}" method="POST" id="form-{{ $teacher->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="button" onclick="openModal('form-{{ $teacher->id }}')"
                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-span-full py-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada data guru</h3>
                    <p class="mt-1 text-gray-500">Mulai dengan menambahkan guru baru ke dalam sistem.</p>
                    <div class="mt-6">
                        <a href="{{ route('teachers.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Guru Baru
                        </a>
                    </div>
                </div>
            </div>
        @endforelse

    </div>

    @if ($teachers->hasPages())
        <div class="max-w-7xl mx-auto mt-8">
            {{ $teachers->links() }}
        </div>
    @endif


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

                    <h3 class="text-lg font-bold text-gray-900">Hapus Guru?</h3>
                    <p class="mt-2 text-sm text-gray-500">Tindakan ini tidak bisa dibatalkan. Guru akan hilang
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
