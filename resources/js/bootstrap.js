import axios from 'axios';
import jQuery from 'jquery';

// Expose jQuery globally so legacy snippets / Blade-inlined scripts can use it.
window.$ = window.jQuery = jQuery;

// Axios defaults — every AJAX call sends the CSRF token automatically.
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const csrf = document.querySelector('meta[name="csrf-token"]');
if (csrf) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf.getAttribute('content');
    jQuery.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': csrf.getAttribute('content') },
    });
}
