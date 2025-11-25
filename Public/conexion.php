<?php
$link = mysqli_connect("localhost", "root", "", "cabanas_db");
if (mysqli_connect_errno()) {
    echo "Error al conectar a MySQL: " . mysqli_connect_error();
    exit();
}
?>
