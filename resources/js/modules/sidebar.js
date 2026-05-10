import { setPreference } from './preferences.js';

/**
 * Sidebar behaviour
 * --------------------------------------------------------------------------
 *  Desktop (≥768px): toggle a fixed-width sidebar between expanded (w-64)
 *                    and collapsed (w-16). State is persisted.
 *  Mobile  (<768px): toggle an off-canvas drawer with a backdrop. State is
 *                    NOT persisted — drawer always closes on next page load.
 * --------------------------------------------------------------------------
 */
export function initSidebar() {
    const $body          = window.$('body');
    const $desktopToggle = window.$('#sidebar-toggle-desktop');
    const $mobileToggle  = window.$('#sidebar-toggle-mobile');
    const $backdrop      = window.$('#sidebar-backdrop');

    // Desktop collapse / expand
    $desktopToggle.on('click', () => {
        const collapsed = $body.toggleClass('sidebar-collapsed').hasClass('sidebar-collapsed');
        setPreference({ sidebar_collapsed: collapsed });
    });

    // Mobile drawer open
    $mobileToggle.on('click', () => {
        $body.addClass('sidebar-mobile-open');
        $backdrop.removeClass('hidden');
    });

    // Mobile drawer close (backdrop click or ESC)
    const closeMobile = () => {
        $body.removeClass('sidebar-mobile-open');
        $backdrop.addClass('hidden');
    };
    $backdrop.on('click', closeMobile);
    window.$(document).on('keydown', (e) => { if (e.key === 'Escape') closeMobile(); });

    // Auto-close mobile drawer on resize past breakpoint
    window.$(window).on('resize', () => {
        if (window.innerWidth >= 768 && $body.hasClass('sidebar-mobile-open')) {
            closeMobile();
        }
    });
}
