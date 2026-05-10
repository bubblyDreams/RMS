{{--
    Off-canvas theme settings panel.
    Slides in from the right; toggled by adding `theme-panel-open` to <body>.
--}}
<aside id="theme-panel"
       class="fixed inset-y-0 right-0 z-50 w-80 max-w-[90vw]
              bg-white shadow-2xl ring-1 ring-slate-200
              dark:bg-surface-dark-soft dark:ring-slate-700
              flex flex-col">

    <div class="h-16 flex items-center justify-between px-5 border-b border-slate-200 dark:border-slate-700">
        <h2 class="text-base font-semibold text-slate-800 dark:text-slate-100">Theme settings</h2>
        <button type="button" id="theme-panel-close"
                class="h-8 w-8 inline-flex items-center justify-center rounded-md
                       text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800"
                aria-label="Close theme settings">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 6l12 12M18 6L6 18"/>
            </svg>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto p-5 space-y-6">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400 mb-3">
                Appearance
            </p>

            <div class="grid grid-cols-2 gap-3">
                {{-- Light --}}
                <button type="button"
                        class="theme-option group flex flex-col items-center gap-2 rounded-xl
                               border-2 border-slate-200 p-3 text-left transition
                               hover:border-brand-400 dark:border-slate-700 dark:hover:border-brand-500"
                        data-theme="light">
                    <div class="w-full h-20 rounded-md bg-white ring-1 ring-slate-200 flex items-center justify-center">
                        <svg class="h-6 w-6 text-amber-500" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <circle cx="12" cy="12" r="4"/>
                            <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Light</span>
                </button>

                {{-- Dark --}}
                <button type="button"
                        class="theme-option group flex flex-col items-center gap-2 rounded-xl
                               border-2 border-slate-200 p-3 text-left transition
                               hover:border-brand-400 dark:border-slate-700 dark:hover:border-brand-500"
                        data-theme="dark">
                    <div class="w-full h-20 rounded-md bg-slate-900 ring-1 ring-slate-700 flex items-center justify-center">
                        <svg class="h-6 w-6 text-slate-200" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Dark</span>
                </button>
            </div>
        </div>

        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400 mb-3">
                Layout
            </p>
            <label class="flex items-center justify-between gap-3 rounded-lg border border-slate-200 dark:border-slate-700 p-3">
                <span class="text-sm text-slate-700 dark:text-slate-200">Collapse sidebar</span>
                <input type="checkbox" id="pref-sidebar-collapsed"
                       class="h-4 w-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
            </label>
        </div>
    </div>

    <div class="p-4 border-t border-slate-200 dark:border-slate-700">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Preferences sync to your account automatically.
        </p>
    </div>
</aside>

{{-- Backdrop for the theme panel --}}
<div id="theme-panel-backdrop"
     class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm hidden"></div>
