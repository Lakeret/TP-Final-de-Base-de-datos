<?php
// header.php
require_once 'functions.php';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cabañas - Reserva</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Cabañas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <?php if(is_logged()): ?>
          <li class="nav-item"><a class="nav-link" href="reservas_list.php">Mis Reservas</a></li>
          <?php if(is_admin()): ?>
            <li class="nav-item"><a class="nav-link" href="cabanas_list.php">Administrar Cabañas</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="logout.php">Salir (<?php echo esc($_SESSION['nombre']); ?>)</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="register.php">Registro</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
<?php if ($msg = flash('info')): ?>
  <div class="alert alert-info"><?php echo esc($msg); ?></div>
<?php endif; ?>