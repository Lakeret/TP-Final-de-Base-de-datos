<?php
// cabana_edit.php
require_once 'header.php';
if (!is_admin()) {
    flash('info', 'Acceso no autorizado.');
    header("Location: index.php");
    exit;
}
$id = intval($_GET['id'] ?? 0);
if (!$id) { header("Location: cabanas_list.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio']);
    $capacidad = intval($_POST['capacidad']);
    $imagen = trim($_POST['imagen']);

    $stmt = $link->prepare("UPDATE cabanas SET nombre=?, descripcion=?, precio_noche=?, capacidad=?, imagen=? WHERE id=?");
    $stmt->bind_param('ssdiss', $nombre, $descripcion, $precio, $capacidad, $imagen, $id);
    if ($stmt->execute()) {
        flash('info', 'Cabaña actualizada.');
        header("Location: cabanas_list.php");
        exit;
    } else {
        flash('info', 'Error: ' . $link->error);
    }
    $stmt->close();
}

// Traer datos actuales
$stmt = $link->prepare("SELECT nombre,descripcion,precio_noche,capacidad,imagen FROM cabanas WHERE id=?");
$stmt->bind_param('i',$id);
$stmt->execute();
$res = $stmt->get_result();
if (!$c = $res->fetch_assoc()) {
    flash('info','Cabaña no encontrada.');
    header("Location: cabanas_list.php");
    exit;
}
$stmt->close();
?>

<h2>Editar Cabaña</h2>
<form method="post" class="row g-3">
  <div class="col-md-6"><label class="form-label">Nombre</label><input name="nombre" value="<?php echo esc($c['nombre']); ?>" class="form-control" required></div>
  <div class="col-md-6"><label class="form-label">Precio por noche</label><input name="precio" value="<?php echo esc($c['precio_noche']); ?>" class="form-control" required></div>
  <div class="col-md-4"><label class="form-label">Capacidad</label><input name="capacidad" value="<?php echo esc($c['capacidad']); ?>" class="form-control" required></div>
  <div class="col-12"><label class="form-label">Imagen (ruta)</label><input name="imagen" value="<?php echo esc($c['imagen']); ?>" class="form-control"></div>
  <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control"><?php echo esc($c['descripcion']); ?></textarea></div>
  <div class="col-12"><button class="btn btn-primary">Guardar cambios</button></div>
</form>

<?php require_once 'footer.php'; ?>
