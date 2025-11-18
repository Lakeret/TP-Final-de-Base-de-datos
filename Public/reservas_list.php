<?php
// reservas_list.php
require_once 'header.php';
if (!is_logged()) {
    header("Location: login.php");
    exit;
}

if (is_admin()) {
    $stmt = $mysqli->prepare("SELECT r.id, u.nombre AS usuario, c.nombre AS cabana, r.fecha_inicio, r.fecha_fin, r.estado FROM reservas r JOIN usuarios u ON r.usuario_id=u.id JOIN cabanas c ON r.cabana_id=c.id ORDER BY r.created_at DESC");
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $uid = $_SESSION['user_id'];
    $stmt = $mysqli->prepare("SELECT r.id, u.nombre AS usuario, c.nombre AS cabana, r.fecha_inicio, r.fecha_fin, r.estado FROM reservas r JOIN usuarios u ON r.usuario_id=u.id JOIN cabanas c ON r.cabana_id=c.id WHERE r.usuario_id=? ORDER BY r.created_at DESC");
    $stmt->bind_param('i',$uid);
    $stmt->execute();
    $res = $stmt->get_result();
}
$reservas = $res->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<h2>Reservas</h2>
<table class="table">
  <thead><tr><th>Usuario</th><th>Cabaña</th><th>Inicio</th><th>Fin</th><th>Estado</th><th>Acciones</th></tr></thead>
  <tbody>
  <?php foreach($reservas as $r): ?>
  <tr>
    <td><?php echo esc($r['usuario']); ?></td>
    <td><?php echo esc($r['cabana']); ?></td>
    <td><?php echo esc($r['fecha_inicio']); ?></td>
    <td><?php echo esc($r['fecha_fin']); ?></td>
    <td><?php echo esc($r['estado']); ?></td>
    <td>
      <?php if ($r['estado'] !== 'cancelada'): ?>
        <?php if (is_admin()): ?>
          <a href="reserva_cancel.php?id=<?php echo $r['id']; ?>&as=cancel" class="btn btn-sm btn-warning">Cancelar</a>
        <?php else: ?>
          <a href="reserva_cancel.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Cancelar reserva?')">Cancelar</a>
        <?php endif; ?>
      <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php require_once 'footer.php'; ?>