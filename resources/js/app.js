// Import Alpine.js
import Alpine from 'alpinejs';

// Import Axios
import axios from 'axios';

// Make Axios available globally
window.axios = axios;

// Set default headers
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// CSRF token
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Initialize Alpine.js
Alpine.start();

// Make Alpine available globally
window.Alpine = Alpine;

console.log('App JS loaded');
