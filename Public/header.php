<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Incluir conexión y funciones
require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/../Src/functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabañas del Bosque - Tu Refugio Natural</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --forest-green: #2d5016;
            --light-green: #4a7c2c;
            --wood-brown: #8b4513;
            --light-brown: #a0826d;
            --cream: #f5f1e8;
            --dark-text: #2c2416;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f1e8 0%, #e8ded0 100%);
            color: var(--dark-text);
            min-height: 100vh;
        }
        
        /* Navbar Estilo Bosque */
        .navbar-custom {
            background: linear-gradient(135deg, var(--forest-green) 0%, var(--light-green) 100%);
            box-shadow: 0 4px 20px rgba(45, 80, 22, 0.3);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .navbar-brand .icon {
            font-size: 2rem;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: #fff !important;
            transform: translateY(-2px);
        }
        
        .navbar-text {
            color: rgba(255, 255, 255, 0.95) !important;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        
        /* Container Principal */
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin: 2rem auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 1400px;
        }
        
        /* Alertas Personalizadas */
        .alert {
            border: none;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .alert-info {
            background: linear-gradient(135deg, #4a7c2c 0%, #5a9c3c 100%);
            color: white;
        }
        
        /* Botones Estilo Naturaleza */
        .btn-nature {
            background: linear-gradient(135deg, var(--forest-green) 0%, var(--light-green) 100%);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(45, 80, 22, 0.3);
        }
        
        .btn-nature:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(45, 80, 22, 0.4);
            color: white;
        }
        
        .btn-wood {
            background: linear-gradient(135deg, var(--wood-brown) 0%, var(--light-brown) 100%);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
        }
        
        .btn-wood:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(139, 69, 19, 0.4);
            color: white;
        }
        
        /* Títulos */
        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            color: var(--forest-green);
            font-weight: 700;
        }
        
        /* Cards Mejoradas */
        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }
        
        .card-img-top {
            transition: transform 0.4s;
        }
        
        .card:hover .card-img-top {
            transform: scale(1.1);
        }
        
        /* Formularios */
        .form-control, .form-select {
            border: 2px solid #e0d7c7;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--light-green);
            box-shadow: 0 0 0 0.2rem rgba(74, 124, 44, 0.15);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--forest-green);
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="index.php">
      <span class="icon">�️</span>
      <span>Cabañas del Bosque</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">🏡 Inicio</a>
        </li>
        <?php if (is_logged()): ?>
        <li class="nav-item">
          <a class="nav-link" href="reservas_list.php">📅 Mis Reservas</a>
        </li>
        <?php endif; ?>
        <?php if (is_admin()): ?>
        <li class="nav-item">
          <a class="nav-link" href="cabanas_list.php">⚙️ Admin Cabañas</a>
        </li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav">
        <?php if (is_logged()): ?>
        <li class="nav-item">
          <span class="navbar-text me-3">👋 Hola, <?php echo esc($_SESSION['nombre']); ?></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">🚪 Cerrar Sesión</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">🔐 Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">✨ Registro</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="main-container">
<?php 
// Mostrar mensajes flash
if ($msg = flash('info')) {
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
    echo esc($msg);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
}
?>
