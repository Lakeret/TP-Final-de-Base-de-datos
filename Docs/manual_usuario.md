```markdown
Manual de Usuario - Sistema Reserva de Cabañas

1. Requisitos
- Servidor con PHP 7.4+ y MySQL/MariaDB.
- Colocar el proyecto en el DocumentRoot (ej: /var/www/html/cabanas).
- Asegurar carpeta images/ con imágenes de ejemplo (cabana1.jpg, cabana2.jpg, cabana3.jpg, default.jpg).

2. Configuración inicial
- Abre config.php y ajusta los parámetros: $db_host, $db_user, $db_pass, $db_name.
- Si aún no tienes la base de datos, importa cabanas_db.sql desde tu cliente MySQL:
  mysql -u root -p < cabanas_db.sql
- Crea un admin (si no lo importaste) ejecutando en PHP:
  <?php echo password_hash('admin123', PASSWORD_DEFAULT); ?>
  Y pega el hash en la sentencia INSERT en la tabla usuarios.

3. Registro e inicio de sesión
- Registro: completa nombre, email y contraseña.
- Login: ingresa con el email y contraseña registrados.

4. Home
- Desde Home puedes ver las cabañas en el carousel y en cards.
- Haz clic en "Reservar" para reservar una cabaña (debes estar logueado).

5. Reservas
- El usuario puede ver sus reservas en "Mis Reservas" y cancelarlas.
- El admin puede ver todas las reservas y cancelarlas.

6. Administración de cabañas (solo admin)
- Accede a "Administrar Cabañas" para crear, editar o eliminar cabañas.
- Para la imagen, puedes usar la ruta relativa (ej: images/cabana1.jpg).

7. Buenas prácticas
- Hacer backup de la BD periódicamente.
- Usar HTTPS en producción.
- Validar correctamente la subida de archivos si extiendes para subir imágenes.

8. Problemas comunes
- Error de conexión: revisa config.php y credenciales.
- Error de permisos: verificar permisos de archivos y carpeta images.
- Contraseña admin: si la olvidaste, puedes cambiarla en la tabla usuarios usando un hash generado por password_hash.

Fin del manual.
```