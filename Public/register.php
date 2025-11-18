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
        $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre,email,password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $nombre, $email, $hash);
        if ($stmt->execute()) {
            flash('info', 'Registro exitoso. Ya puedes iniciar sesión.');
            header("Location: login.php");
            exit;
        } else {
            if ($mysqli->errno === 1062) {
                flash('info', 'El email ya está registrado.');
            } else {
                flash('info', 'Error en el registro: ' . $mysqli->error);
            }
        }
        $stmt->close();
    }
}
?>

<h2>Registro</h2>
<form method="post" class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input class="form-control" name="nombre" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="email" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="password" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Repetir contraseña</label>
    <input type="password" class="form-control" name="password2" required>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Registrarme</button>
  </div>
</form>

<?php require_once 'footer.php'; ?>