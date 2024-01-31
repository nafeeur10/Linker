import axios from 'axios';
import Alpine from 'alpinejs';
import Intersect from '@alpinejs/intersect'

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Alpine.plugin(Intersect);
Alpine.start();
window.Alpine = Alpine