// Scripts generales para la web de cabañas

document.addEventListener('DOMContentLoaded', function () {
  // Auto ocultar flash messages después de X segundos
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(a => {
    setTimeout(() => {
      a.style.transition = 'opacity 0.6s';
      a.style.opacity = '0';
      setTimeout(() => { if (a.parentNode) a.parentNode.removeChild(a); }, 600);
    }, 4000); // 4 segundos
  });

  // Confirm para links o botones con data-confirm
  document.body.addEventListener('click', function (e) {
    const target = e.target.closest('[data-confirm]');
    if (!target) return;
    const msg = target.getAttribute('data-confirm') || '¿Estás seguro?';
    if (!confirm(msg)) {
      e.preventDefault();
    }
  });

  // Ejemplo: mejora para formularios de eliminación que usan POST dinamicamente
  // Busca formularios con .confirm-delete y añade confirmación
  document.querySelectorAll('form.confirm-delete').forEach(form => {
    form.addEventListener('submit', function (ev) {
      if (!confirm('¿Confirma cancelar/eliminar?')) {
        ev.preventDefault();
      }
    });
  });
});