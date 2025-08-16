document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('toggleProductos');
    if (toggle) {
        toggle.addEventListener('change', () => {
            document.querySelectorAll('.productos-list').forEach(list => {
                list.classList.toggle('d-none', !toggle.checked);
            });
        });
    }
});