import './bootstrap';
import { parseIndonesianAmount } from './utils/indonesianNumberParser';

import Alpine from 'alpinejs';

window.parseIndonesianAmount = parseIndonesianAmount;
window.Alpine = Alpine;

Alpine.start();
