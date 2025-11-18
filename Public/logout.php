<?php
// logout.php
require_once 'functions.php';
session_unset();
session_destroy();
session_start();
flash('info', 'Has cerrado sesión.');
header("Location: index.php");
exit;
?>