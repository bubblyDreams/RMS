import { setPreference } from './preferences.js';

/**
 * Theme + theme-panel controller.
 *  - Adds / removes `dark` on <html> for Tailwind's class-based dark mode.
 *  - Toggles the off-canvas panel via `theme-panel-open` on <body>.
 *  - Persists every change (localStorage + server PATCH).
 */
export function initTheme() {
    const $html     = window.$(document.documentElement);
    const $body     = window.$('body');
    const $openBtn  = window.$('#theme-panel-open');
    const $closeBtn = window.$('#theme-panel-close');
    const $backdrop = window.$('#theme-panel-backdrop');
    const $options  = window.$('.theme-option');
    const $sidebarToggle = window.$('#pref-sidebar-collapsed');

    // -- Panel open / close ------------------------------------------------
    const openPanel = () => {
        $body.addClass('theme-panel-open');
        $backdrop.removeClass('hidden');
    };
    const closePanel = () => {
        $body.removeClass('theme-panel-open');
        $backdrop.addClass('hidden');
    };
    $openBtn.on('click', openPanel);
    $closeBtn.on('click', closePanel);
    $backdrop.on('click', closePanel);
    window.$(document).on('keydown', (e) => {
        if (e.key === 'Escape' && $body.hasClass('theme-panel-open')) closePanel();
    });

    // -- Theme switching ---------------------------------------------------
    const applyTheme = (theme) => {
        if (theme === 'dark') {
            $html.addClass('dark');
        } else {
            $html.removeClass('dark');
        }
        markActive(theme);
    };

    const markActive = (theme) => {
        $options.each(function () {
            const $opt = window.$(this);
            const isActive = $opt.data('theme') === theme;
            $opt.toggleClass('border-brand-500 ring-2 ring-brand-200', isActive)
                .toggleClass('border-slate-200 dark:border-slate-700', !isActive);
        });
    };

    $options.on('click', function () {
        const theme = window.$(this).data('theme');
        applyTheme(theme);
        setPreference({ theme });
    });

    // -- Layout option (mirrored from sidebar collapse) --------------------
    $sidebarToggle.prop('checked', $body.hasClass('sidebar-collapsed'));
    $sidebarToggle.on('change', function () {
        const collapsed = this.checked;
        $body.toggleClass('sidebar-collapsed', collapsed);
        setPreference({ sidebar_collapsed: collapsed });
    });

    // Initial active marker (server-rendered theme).
    markActive($html.hasClass('dark') ? 'dark' : 'light');
}
