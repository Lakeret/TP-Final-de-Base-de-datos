<?php
// reservar.php - crear reserva (usuario)
require_once 'header.php';
if (!is_logged()) {
    flash('info', 'Debes iniciar sesión para reservar.');
    header("Location: login.php");
    exit;
}
$cabana_id = intval($_GET['id'] ?? $_POST['cabana_id'] ?? 0);

// Traer datos cabaña
$stmt = $mysqli->prepare("SELECT id,nombre,precio_noche FROM cabanas WHERE id=?");
$stmt->bind_param('i', $cabana_id);
$stmt->execute();
$res = $stmt->get_result();
$cabana = $res->fetch_assoc();
$stmt->close();
if (!$cabana) { flash('info','Cabaña inexistente.'); header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Validaciones básicas
    if (!$fecha_inicio || !$fecha_fin || $fecha_fin < $fecha_inicio) {
        flash('info', 'Fechas inválidas.');
    } else {
        // Verificar solapamiento simple (evita reservas en mismo rango)
        $stmt = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM reservas WHERE cabana_id=? AND estado!='cancelada' AND NOT (fecha_fin < ? OR fecha_inicio > ?)");
        $stmt->bind_param('iss', $cabana_id, $fecha_inicio, $fecha_fin);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        if ($row['cnt'] > 0) {
            flash('info', 'La cabaña ya está reservada en esas fechas.');
        } else {
            $uid = $_SESSION['user_id'];
            $stmt = $mysqli->prepare("INSERT INTO reservas (usuario_id, cabana_id, fecha_inicio, fecha_fin, estado) VALUES (?, ?, ?, ?, 'pendiente')");
            $stmt->bind_param('iiss', $uid, $cabana_id, $fecha_inicio, $fecha_fin);
            if ($stmt->execute()) {
                flash('info','Reserva creada. Estado: pendiente.');
                header("Location: reservas_list.php");
                exit;
            } else {
                flash('info','Error: ' . $mysqli->error);
            }
            $stmt->close();
        }
    }
}
?>

<h2>Reservar: <?php echo esc($cabana['nombre']); ?></h2>
<form method="post" class="row g-3">
  <input type="hidden" name="cabana_id" value="<?php echo $cabana['id']; ?>">
  <div class="col-md-4"><label class="form-label">Fecha inicio</label><input type="date" class="form-control" name="fecha_inicio" required></div>
  <div class="col-md-4"><label class="form-label">Fecha fin</label><input type="date" class="form-control" name="fecha_fin" required></div>
  <div class="col-md-4 align-self-end">
    <button class="btn btn-primary">Reservar</button>
  </div>
</form>

<?php require_once 'footer.php'; ?>