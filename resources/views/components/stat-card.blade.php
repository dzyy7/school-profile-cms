@props(['title', 'value', 'subtitle' => null, 'icon' => 'chart', 'color' => 'purple', 'trend' => 'up'])

@php
// Definisi warna background dan text icon untuk mode biasa
$colors = [
    'purple' => 'bg-purple-100 text-purple-600',
    'green'  => 'bg-green-100 text-green-600',
    'blue'   => 'bg-blue-100 text-blue-600',
    'gradient' => 'bg-white/20 text-white', // Icon style khusus gradient
];

$iconPaths = [
    'chart'     => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
    'users'     => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
    'mail'      => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
    'lightning' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
];

$isGradient = $color === 'gradient';
$iconPath = $iconPaths[$icon] ?? $iconPaths['chart'];

// Logika pemilihan class warna icon
$iconClass = $isGradient ? $colors['gradient'] : ($colors[$color] ?? $colors['purple']);

// Logika warna teks agar kontras
$textColorTitle = $isGradient ? 'text-white/80' : 'text-gray-500';
$textColorValue = $isGradient ? 'text-white' : 'text-gray-800';
$textColorSub   = $isGradient ? 'text-white/60' : 'text-gray-500';
@endphp

<div class="{{ $isGradient ? 'bg-gradient-to-br from-purple-600 to-purple-700 text-white' : 'bg-white border border-gray-100' }} rounded-xl shadow-sm p-6">

    {{-- Header: Icon & Trend Arrow --}}
    <div class="flex items-center justify-between mb-4">
        <div class="p-3 {{ $iconClass }} rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"/>
            </svg>
        </div>

        @if($trend)
            {{-- Warna panah trend menyesuaikan background --}}
            <svg class="w-5 h-5 {{ $isGradient ? 'text-white' : 'text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
            </svg>
        @endif
    </div>

    {{-- Content: Title, Value, Subtitle --}}
    <h3 class="{{ $textColorTitle }} text-sm font-medium mb-1">{{ $title }}</h3>
    <p class="text-3xl font-bold {{ $textColorValue }} mb-1">{{ $value }}</p>

    @if($subtitle)
        <p class="text-xs {{ $textColorSub }}">{{ $subtitle }}</p>
    @endif

</div>
