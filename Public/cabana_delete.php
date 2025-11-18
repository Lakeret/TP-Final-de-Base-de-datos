<?php
// cabana_delete.php
require_once 'functions.php';
if (!is_admin()) {
    flash('info', 'Acceso no autorizado.');
    header("Location: index.php");
    exit;
}
$id = intval($_GET['id'] ?? 0);
if ($id) {
    $stmt = $mysqli->prepare("DELETE FROM cabanas WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    flash('info', 'Cabaña eliminada.');
}
header("Location: cabanas_list.php");
exit;
?>