<?php
// login.php
require_once 'header.php';

if (is_logged()) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $link->prepare("SELECT id,nombre,password,rol FROM usuarios WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            // login correcto
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['rol'] = $row['rol'];
            flash('info', 'Bienvenido ' . $row['nombre']);
            header("Location: index.php");
            exit;
        } else {
            flash('info', 'Credenciales incorrectas.');
        }
    } else {
        flash('info', 'Credenciales incorrectas.');
    }
    $stmt->close();
}
?>

<style>
    .login-container {
        max-width: 500px;
        margin: 3rem auto;
    }
    
    .login-card {
        background: white;
        border-radius: 25px;
        padding: 3rem;
        box-shadow: 0 15px 50px rgba(45, 80, 22, 0.2);
    }
    
    .login-icon {
        font-size: 4rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    
    .login-title {
        font-family: 'Playfair Display', serif;
        color: var(--forest-green);
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2rem;
    }
    
    .form-floating {
        margin-bottom: 1.5rem;
    }
    
    .form-floating > .form-control {
        border-radius: 15px;
        border: 2px solid #e0d7c7;
        padding: 1.5rem 1rem 0.5rem;
    }
    
    .form-floating > label {
        padding: 1rem;
        color: #666;
    }
    
    .register-link {
        text-align: center;
        margin-top: 1.5rem;
        color: #666;
    }
    
    .register-link a {
        color: var(--forest-green);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .register-link a:hover {
        color: var(--light-green);
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-icon">🏔️</div>
        <h2 class="login-title">Iniciar Sesión</h2>
        
        <form method="post">
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="correo@ejemplo.com" required>
                <label for="email">📧 Correo Electrónico</label>
            </div>
            
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                <label for="password">🔒 Contraseña</label>
            </div>
            
            <button type="submit" class="btn btn-nature w-100">
                🚪 Entrar a tu Refugio
            </button>
        </form>
        
        <div class="register-link">
            ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
