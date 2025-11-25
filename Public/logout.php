<?php
// logout.php
session_start();
require_once __DIR__ . '/../Src/functions.php';
session_unset();
session_destroy();
session_start();
flash('info', 'Has cerrado sesión.');
header("Location: index.php");
exit;
?>
