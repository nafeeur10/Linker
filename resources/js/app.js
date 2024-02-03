import './bootstrap';
import '../css/app.css';

Alpine.store('global', {
    navigate(url) {
        window.location.href = url;
    }
});
