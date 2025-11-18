<?php
// config.php
// Ajusta estos valores según tu entorno
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'cabanas_db';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_errno) {
    die("Error conexión MySQL: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");
session_start();
?>