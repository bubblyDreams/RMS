{{--
    Collapsible sidebar.
    --------------------------------------------------------------------------
    Width / visibility is controlled via two body-level classes:
      • body.sidebar-collapsed   → desktop icon-only mode
      • body.sidebar-mobile-open → mobile drawer open
    The actual transitions live in resources/css/app.css.
--}}
<aside id="sidebar"
       class="flex flex-col bg-brand-700 text-white shadow-lg
              dark:bg-surface-dark dark:border-r dark:border-slate-800">

    {{-- Brand --}}
    <div class="h-16 flex items-center justify-between px-4 border-b border-white/10 dark:border-slate-800">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 min-w-0">
            <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center
                         rounded-lg bg-white/10 text-lg font-bold">H</span>
            <span class="sidebar-brand-text text-lg font-semibold tracking-wide whitespace-nowrap">
                HRMS
            </span>
        </a>

        {{-- Desktop collapse toggle --}}
        <button type="button"
                id="sidebar-toggle-desktop"
                class="hidden md:inline-flex h-8 w-8 items-center justify-center
                       rounded-md text-white/80 hover:bg-white/10 hover:text-white
                       focus:outline-none focus:ring-2 focus:ring-white/40"
                aria-label="Toggle sidebar">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 4h14v2H3V4Zm0 5h14v2H3V9Zm0 5h14v2H3v-2Z"/>
            </svg>
        </button>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-1">
        @php
            $nav = [
                ['route' => 'dashboard', 'label' => 'Dashboard',
                 'icon'  => '<path d="M3 12 12 3l9 9"/><path d="M5 10v10h14V10"/>'],
                ['route' => null, 'label' => 'Employees',
                 'icon'  => '<circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><circle cx="17" cy="7" r="3"/>'],
                ['route' => null, 'label' => 'Attendance',
                 'icon'  => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
                ['route' => null, 'label' => 'Leave',
                 'icon'  => '<path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>'],
                ['route' => null, 'label' => 'Payroll',
                 'icon'  => '<rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/>'],
                ['route' => null, 'label' => 'Reports',
                 'icon'  => '<path d="M3 3v18h18"/><path d="M7 14l4-4 4 4 5-6"/>'],
            ];
        @endphp

        @foreach ($nav as $item)
            @php
                $isActive = $item['route'] && request()->routeIs($item['route']);
                $href     = $item['route'] ? route($item['route']) : '#';
            @endphp
            <a href="{{ $href }}"
               title="{{ $item['label'] }}"
               class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition-colors
                      {{ $isActive
                          ? 'bg-white/15 text-white'
                          : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    {!! $item['icon'] !!}
                </svg>
                <span class="sidebar-label whitespace-nowrap">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Theme launcher --}}
    <div class="border-t border-white/10 dark:border-slate-800 p-3">
        <button type="button"
                id="theme-panel-open"
                title="Theme settings"
                class="w-full flex items-center gap-3 rounded-lg px-3 py-2 text-sm
                       text-white/80 hover:bg-white/10 hover:text-white">
            <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/>
                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
            </svg>
            <span class="sidebar-label whitespace-nowrap">Theme settings</span>
        </button>
    </div>
</aside>
