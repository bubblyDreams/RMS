/**
 * Persists UI preferences (theme, sidebar state) to:
 *   1. localStorage  — instant, used on next page load before JS is ready
 *      (the server-rendered preference still wins; this is a fallback)
 *   2. Server (PATCH /settings/preferences) — durable, follows user across devices
 *
 * The server call is debounced and silently swallows network errors: a flaky
 * network shouldn't break the UI when a user toggles a theme.
 */

const STORAGE_KEY = 'hrms.preferences';
const ENDPOINT    = '/settings/preferences';

let pendingTimer = null;

function readLocal() {
    try {
        return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
    } catch {
        return {};
    }
}

function writeLocal(prefs) {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(prefs));
    } catch {
        // Ignore quota / privacy-mode errors.
    }
}

function flushToServer(prefs) {
    if (!window.$) return;
    window.$.ajax({
        url: ENDPOINT,
        method: 'PATCH',
        contentType: 'application/json',
        data: JSON.stringify(prefs),
    }).fail(() => {
        // Intentional: keep the local copy; user is unblocked.
    });
}

export function setPreference(partial) {
    const next = { ...readLocal(), ...partial };
    writeLocal(next);

    clearTimeout(pendingTimer);
    pendingTimer = setTimeout(() => flushToServer(partial), 250);
    return next;
}

export function getPreference(key, fallback = null) {
    const prefs = readLocal();
    return Object.prototype.hasOwnProperty.call(prefs, key) ? prefs[key] : fallback;
}

export function hydrateFromBody() {
    // Seed localStorage with the server-rendered values so a logout/login
    // round-trip from another browser still reflects current state immediately.
    const body = document.body;
    if (!body) return;
    writeLocal({
        theme:             body.dataset.theme || 'light',
        sidebar_collapsed: body.dataset.sidebarCollapsed === '1',
    });
}
