<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
    <style>
        /* Mengatur tinggi minimal editor */
        .ck-editor__editable_inline {
            min-height: 350px;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
    <style>
        trix-toolbar [data-trix-button] {
            background: white;
            border: 1px solid #e5e7eb;
            /* gray-200 */
            border-radius: 0.375rem;
            /* rounded-md */
        }

        trix-toolbar [data-trix-button].trix-active {
            background: #e0e7ff;
            /* indigo-100 */
            color: #4338ca;
            /* indigo-700 */
        }

        trix-editor {
            min-height: 300px;
            /* Tinggi minimal editor */
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">

        <x-sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">
            <x-header />

            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
