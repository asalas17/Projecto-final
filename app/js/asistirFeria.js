document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.inscribirmeBtn').forEach(btn => {
    btn.addEventListener('click', function () {
      const feriaId = this.dataset.feriaId;
      if (!feriaId) return;
      if (!confirm('¿Deseás inscribirte en esta feria?')) return;
      fetch('../app/backend/procesar_inscripcionFeria.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ feria_id: feriaId })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            this.disabled = true;
            alert('Inscripción enviada');
          } else {
            alert(data.error || 'Ocurrió un error');
          }
        })
        .catch(() => alert('Error de comunicación'));
    });
  });
});