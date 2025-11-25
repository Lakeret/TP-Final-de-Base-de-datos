<?php
// register.php
require_once 'header.php';
if (is_logged()) {
    header("Location: index.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if (!$nombre || !$email || !$password) {
        flash('info', 'Completa todos los campos.');
    } elseif ($password !== $password2) {
        flash('info', 'Las contraseñas no coinciden.');
    } else {
        // Insertar usuario
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $link->prepare("INSERT INTO usuarios (nombre,email,password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $nombre, $email, $hash);
        if ($stmt->execute()) {
            flash('info', 'Registro exitoso. Ya puedes iniciar sesión.');
            header("Location: login.php");
            exit;
        } else {
            if ($link->errno === 1062) {
                flash('info', 'El email ya está registrado.');
            } else {
                flash('info', 'Error en el registro: ' . $link->error);
            }
        }
        $stmt->close();
    }
}
?>

<style>
    .register-container {
        max-width: 600px;
        margin: 3rem auto;
    }
    
    .register-card {
        background: white;
        border-radius: 25px;
        padding: 3rem;
        box-shadow: 0 15px 50px rgba(45, 80, 22, 0.2);
    }
    
    .register-icon {
        font-size: 4rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    
    .register-title {
        font-family: 'Playfair Display', serif;
        color: var(--forest-green);
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2rem;
    }
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-icon">✨</div>
        <h2 class="register-title">Únete a la Aventura</h2>
        
        <form method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre" required>
                <label for="nombre">👤 Nombre Completo</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="correo@ejemplo.com" required>
                <label for="email">📧 Correo Electrónico</label>
            </div>
            
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                        <label for="password">🔒 Contraseña</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repetir" required>
                        <label for="password2">🔑 Confirmar</label>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-nature w-100">
                🌲 Crear mi Cuenta
            </button>
        </form>
        
        <div class="register-link">
            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
