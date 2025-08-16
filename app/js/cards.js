document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.card[data-href]').forEach(card => {
    card.addEventListener('click', () => {
      window.location.href = card.dataset.href;
    });
  });
});