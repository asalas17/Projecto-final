document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.card[data-href]').forEach(card => {
        card.addEventListener('click', () => {
            window.location.href = card.dataset.href;
        });
    });
    const toggle = document.getElementById('toggleProductos');
    if (toggle) {
        toggle.addEventListener('change', () => {
            document.querySelectorAll('.productos-list').forEach(list => {
                list.classList.toggle('d-none', !toggle.checked);
            });
        });
    }
});