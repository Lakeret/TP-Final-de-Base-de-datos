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

    $stmt = $mysqli->prepare("SELECT id,nombre,password,rol FROM usuarios WHERE email = ?");
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

<h2>Login</h2>
<form method="post" class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="email" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="password" required>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Entrar</button>
  </div>
</form>

<?php require_once 'footer.php'; ?>