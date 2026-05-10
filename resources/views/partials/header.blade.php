<header class="h-16 sticky top-0 z-20 flex items-center justify-between gap-4 px-4 md:px-6
               bg-white/80 backdrop-blur ring-1 ring-slate-200/60
               dark:bg-surface-dark-soft/80 dark:ring-slate-700/60">

    {{-- Mobile sidebar trigger --}}
    <button type="button"
            id="sidebar-toggle-mobile"
            class="md:hidden h-10 w-10 inline-flex items-center justify-center rounded-lg
                   text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
            aria-label="Open sidebar">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M3 12h18M3 18h18"/>
        </svg>
    </button>

    <div class="flex-1"></div>

    <div class="flex items-center gap-3">
        @if (! empty($authUser))
            <span class="hidden sm:inline text-sm text-slate-600 dark:text-slate-300">
                {{ $authUser->name }}
            </span>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-ghost text-sm">Logout</button>
        </form>
    </div>
</header>
