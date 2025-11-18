<?php
// reserva_cancel.php
require_once 'functions.php';
if (!is_logged()) {
    header("Location: login.php");
    exit;
}
$id = intval($_GET['id'] ?? 0);
if (!$id) { header("Location: reservas_list.php"); exit; }

if (!is_admin()) {
    // usuario solo puede cancelar sus reservas
    $stmt = $mysqli->prepare("UPDATE reservas SET estado='cancelada' WHERE id=? AND usuario_id=?");
    $stmt->bind_param('ii', $id, $_SESSION['user_id']);
} else {
    $stmt = $mysqli->prepare("UPDATE reservas SET estado='cancelada' WHERE id=?");
    $stmt->bind_param('i', $id);
}
$stmt->execute();
$stmt->close();
flash('info', 'Reserva cancelada.');
header("Location: reservas_list.php");
exit;
?>