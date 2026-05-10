<!DOCTYPE html>
{{-- The `dark` class on <html> is what Tailwind's darkMode: 'class' looks for.
     We render it server-side from the saved preference to avoid a flash of
     the wrong theme. --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="{{ ($preferences['theme'] ?? 'light') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} — @yield('title', 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen
             {{ ($preferences['sidebar_collapsed'] ?? false) ? 'sidebar-collapsed' : '' }}"
      data-theme="{{ $preferences['theme'] ?? 'light' }}"
      data-sidebar-collapsed="{{ ($preferences['sidebar_collapsed'] ?? false) ? '1' : '0' }}">

    <div class="flex min-h-screen">
        @include('partials.sidebar')

        {{-- Main column --}}
        <div class="flex-1 flex flex-col min-w-0">
            @include('partials.header')

            <main class="flex-1 p-4 md:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    @include('partials.theme-panel')

    {{-- Mobile sidebar backdrop. Only visible when the mobile drawer is open. --}}
    <div id="sidebar-backdrop"
         class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm hidden md:hidden"></div>
</body>
</html>
