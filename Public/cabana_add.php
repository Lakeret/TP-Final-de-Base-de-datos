<?php
// cabana_add.php
require_once 'header.php';
if (!is_admin()) {
    flash('info', 'Acceso no autorizado.');
    header("Location: index.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio']);
    $capacidad = intval($_POST['capacidad']);
    $imagen = trim($_POST['imagen']); // ruta relativa o URL

    $stmt = $mysqli->prepare("INSERT INTO cabanas (nombre, descripcion, precio_noche, capacidad, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('ssdis', $nombre, $descripcion, $precio, $capacidad, $imagen);
    if ($stmt->execute()) {
        flash('info', 'Cabaña agregada.');
        header("Location: cabanas_list.php");
        exit;
    } else {
        flash('info', 'Error: ' . $mysqli->error);
    }
    $stmt->close();
}
?>

<h2>Agregar Cabaña</h2>
<form method="post" class="row g-3">
  <div class="col-md-6"><label class="form-label">Nombre</label><input name="nombre" class="form-control" required></div>
  <div class="col-md-6"><label class="form-label">Precio por noche</label><input name="precio" class="form-control" required></div>
  <div class="col-md-4"><label class="form-label">Capacidad</label><input name="capacidad" class="form-control" required></div>
  <div class="col-12"><label class="form-label">Imagen (ruta)</label><input name="imagen" class="form-control"></div>
  <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control"></textarea></div>
  <div class="col-12"><button class="btn btn-success">Guardar</button></div>
</form>

<?php require_once 'footer.php'; ?>