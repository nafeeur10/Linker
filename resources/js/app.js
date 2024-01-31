import './bootstrap';

Alpine.store('global', {
    navigate(url) {
        window.location.href = url;
    }
});
