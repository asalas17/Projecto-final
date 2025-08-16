document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('toggleProductos');
    if (toggle) {
        const update = () => {
            document.querySelectorAll('.productos-list').forEach(list => {
                list.classList.toggle('d-none', !toggle.checked);
            });
        };
        toggle.addEventListener('change', update);
        update();
    }
});