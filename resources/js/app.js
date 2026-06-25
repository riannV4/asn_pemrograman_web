import './bootstrap';
import { parseIndonesianAmount } from './utils/indonesianNumberParser';

import Alpine from 'alpinejs';

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {});
    });
}

window.parseIndonesianAmount = parseIndonesianAmount;
window.Alpine = Alpine;

Alpine.start();
