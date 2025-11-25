<?php
// cabanas_list.php - administrar cabañas (admin)
require_once 'header.php';
if (!is_admin()) {
    flash('info', 'Acceso no autorizado.');
    header("Location: index.php");
    exit;
}
// Obtener lista
$stmt = $link->prepare("SELECT id,nombre,precio_noche,capacidad,imagen FROM cabanas ORDER BY id DESC");
$stmt->execute();
$res = $stmt->get_result();
$cabanas = $res->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<h2>Administrar Cabañas <a href="cabana_add.php" class="btn btn-success btn-sm">Nueva</a></h2>
<table class="table table-striped">
  <thead><tr><th>Nombre</th><th>Precio</th><th>Capacidad</th><th>Imagen</th><th>Acciones</th></tr></thead>
  <tbody>
    <?php foreach($cabanas as $c): ?>
    <tr>
      <td><?php echo esc($c['nombre']); ?></td>
      <td>$<?php echo number_format($c['precio_noche'],2,',','.'); ?></td>
      <td><?php echo esc($c['capacidad']); ?></td>
      <td><img src="<?php echo esc($c['imagen']); ?>" style="height:50px; object-fit:cover;"></td>
      <td>
        <a href="cabana_edit.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
        <a href="cabana_delete.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Eliminar cabaña?')">Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require_once 'footer.php'; ?>
