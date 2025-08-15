document.addEventListener('DOMContentLoaded', () => {
    const idField = document.getElementById('delete_feria_id');
    const nameField = document.getElementById('delete_feria_nombre');

    document.querySelectorAll('.eliminarFeriaBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            idField.value = btn.getAttribute('data-id');
            nameField.textContent = btn.getAttribute('data-nombre');
        });
    });
});
