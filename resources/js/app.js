import './bootstrap';
import { initSidebar } from './modules/sidebar.js';
import { initTheme }   from './modules/theme.js';
import { hydrateFromBody } from './modules/preferences.js';

// jQuery is exposed globally by ./bootstrap.
window.$(function () {
    hydrateFromBody();
    initSidebar();
    initTheme();
});
