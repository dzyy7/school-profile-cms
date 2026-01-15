<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 z-20 md:hidden">
</div>

<aside :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full md:translate-x-0 md:w-20 w-64'"
    class="fixed md:static inset-y-0 left-0 z-30 bg-gradient-to-b from-indigo-900 to-indigo-800 text-white transition-all duration-300 flex-shrink-0 h-screen flex flex-col shadow-2xl md:shadow-none">

    <div class="p-6 flex items-center justify-between border-b border-indigo-700 shrink-0">
        <div class="flex items-center gap-3 overflow-hidden" :class="sidebarOpen ? 'block' : 'hidden md:hidden'">
            <div class="w-10 h-10  rounded-lg flex items-center justify-center p-1 flex-shrink-0 shadow-inner">
                @if (get_setting('school_logo'))
                    <img src="{{ Storage::url(get_setting('school_logo')) }}" alt="Logo"
                        class="w-full h-full object-contain">
                @else
                    <span class="text-indigo-900 font-bold text-lg">
                        {{ substr(get_setting('school_name', 'S'), 0, 1) }}
                    </span>
                @endif
            </div>

            <div class="flex-1 min-w-0" x-show="sidebarOpen">
                <h2 class="font-bold text-sm leading-tight truncate">
                    {{ get_setting('school_name', 'SCHOOL CMS') }}
                </h2>
                <p class="text-[10px] uppercase tracking-wider text-indigo-300 font-semibold mt-0.5">
                    Admin Panel
                </p>
            </div>
        </div>

        <div x-show="!sidebarOpen" class="hidden md:flex items-center justify-center w-full">
            @if (get_setting('school_logo'))
                <img src="{{ Storage::url(get_setting('school_logo')) }}" alt="Logo"
                    class="w-8 h-8 object-contain rounded">
            @else
                <span class="text-white font-bold text-lg">S</span>
            @endif
        </div>

        <button @click="sidebarOpen = !sidebarOpen"
            class="text-white hover:bg-indigo-700 p-2 rounded-lg ml-auto md:ml-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <nav class="p-4 space-y-2 flex-1 overflow-y-auto custom-scrollbar">
        <x-nav-item href="/dashboard" :active="request()->is('dashboard')" icon="home">
            <span x-show="sidebarOpen" class="md:inline-block" :class="!sidebarOpen ? 'hidden' : ''">Dashboard</span>
        </x-nav-item>

        <x-nav-item href="/banners" :active="request()->is('banners*')" icon="image">
            <span x-show="sidebarOpen" class="md:inline-block" :class="!sidebarOpen ? 'hidden' : ''">Banner
                Slider</span>
        </x-nav-item>

        <x-nav-item href="/posts" :active="request()->is('posts*')" icon="newspaper">
            <span x-show="sidebarOpen" class="md:inline-block" :class="!sidebarOpen ? 'hidden' : ''">Manajemen
                Berita</span>
        </x-nav-item>

        <x-nav-item href="/teachers" :active="request()->is('teachers*')" icon="users">
            <span x-show="sidebarOpen" class="md:inline-block" :class="!sidebarOpen ? 'hidden' : ''">Manajemen
                Guru</span>
        </x-nav-item>

        <x-nav-item href="/messages" :active="request()->is('messages*')" icon="mail">
            <span x-show="sidebarOpen" class="md:inline-block" :class="!sidebarOpen ? 'hidden' : ''">Pesan Masuk</span>
        </x-nav-item>

        <x-nav-item href="/settings" :active="request()->is('settings*')" icon="settings">
            <span x-show="sidebarOpen" class="md:inline-block" :class="!sidebarOpen ? 'hidden' : ''">Pengaturan</span>
        </x-nav-item>
    </nav>

    <div class="p-4 border-t border-indigo-700/50 bg-indigo-900/50 shrink-0">
        <a href="/profile">
            <div class="flex items-center gap-3 px-2 py-3 justify-center md:justify-start">
                <div
                    class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg border border-indigo-400/30">
                    <span class="text-xs font-bold uppercase">
                        {{ Auth::user()->initials ?? substr(Auth::user()->name, 0, 2) }}
                    </span>
                </div>

                <div x-show="sidebarOpen" class="flex-1 min-w-0 transition-opacity duration-300 md:block"
                    :class="!sidebarOpen ? 'hidden' : ''">
                    <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-indigo-300 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </a>
    </div>
</aside>
