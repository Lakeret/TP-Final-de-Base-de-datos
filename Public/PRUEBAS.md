# Sistema de Cabañas - Guía de Pruebas

# Pasos para Verificar el Sistema

# 1. Iniciar XAMPP
 Abre el Panel de Control de XAMPP
 Inicia **Apache** y **MySQL**

# 2. Verificar y Crear Base de Datos
Abre: `http://localhost/Public/test_db.php`

Este script automáticamente:
-  Verifica la conexión a la BD
-  Crea las tablas si no existen (usuarios, cabanas, reservas)
-  Inserta un usuario admin por defecto
-  Inserta 3 cabañas de ejemplo

# 3. Credenciales por Defecto
**Usuario Admin:**
- Email: `admin@cabanas.com`
- Password: `admin123`

### 4. URLs para Probar

#### Público (sin login):
- **Inicio**: `http://localhost/Public/index.php`
- **Login**: `http://localhost/Public/login.php`
- **Registro**: `http://localhost/Public/register.php`

#### Usuario Logueado:
- **Mis Reservas**: `http://localhost/Public/reservas_list.php`
- **Reservar Cabaña**: Click en "Reservar" desde el inicio

#### Administrador:
- **Gestionar Cabañas**: `http://localhost/Public/cabanas_list.php`
- **Agregar Cabaña**: `http://localhost/Public/cabana_add.php`
- **Editar Cabaña**: Desde la lista de cabañas
- **Ver Todas las Reservas**: `http://localhost/Public/reservas_list.php`

---

## 🧪 Casos de Prueba

### Test 1: Ver Página de Inicio
1. Abre `http://localhost/Public/index.php`
2. **Esperado**: 
   - Ver navbar con logo "🏡 Cabañas"
   - Ver carousel con 3 cabañas
   - Ver tarjetas de cabañas con botón "Reservar"
   - No hay errores 404 en consola

### Test 2: Registro de Usuario
1. Abre `http://localhost/Public/register.php`
2. Completa el formulario:
   - Nombre: "Juan Pérez"
   - Email: "juan@test.com"
   - Contraseña: "test123"
   - Repetir: "test123"
3. Click "Registrarse"
4. **Esperado**: Mensaje "Registro exitoso" y redirige a login

### Test 3: Login
1. Abre `http://localhost/Public/login.php`
2. Ingresa:
   - Email: "admin@cabanas.com"
   - Password: "admin123"
3. Click "Entrar"
4. **Esperado**: 
   - Mensaje "Bienvenido Admin"
   - Navbar muestra "Hola, Admin"
   - Aparecen opciones "Mis Reservas" y "Admin Cabañas"

### Test 4: Crear Reserva
1. Estando logueado, ve al inicio
2. Click en "Reservar" en cualquier cabaña
3. Selecciona fechas futuras
4. Click "Reservar"
5. **Esperado**: Mensaje "Reserva creada" y aparece en "Mis Reservas"

### Test 5: Admin - Agregar Cabaña
1. Login como admin
2. Ve a "Admin Cabañas"
3. Click "Nueva"
4. Completa formulario:
   - Nombre: "Cabaña de Prueba"
   - Descripción: "Test"
   - Precio: 100
   - Capacidad: 4
   - Imagen: "images/test.jpg"
5. Click "Guardar"
6. **Esperado**: Cabaña aparece en la lista

### Test 6: Logout
1. Click en "Cerrar Sesión" en navbar
2. **Esperado**: 
   - Mensaje "Has cerrado sesión"
   - Navbar vuelve a mostrar "Login | Registro"

---

## 🔧 Estructura de Archivos

### Archivos Principales
- `Public/header.php` - Incluye conexión, funciones, sesión y navbar
- `Public/footer.php` - Cierra contenedor y carga Bootstrap JS
- `Public/conexion.php` - Conexión a BD (usa `$link`)
- `Src/functions.php` - Funciones auxiliares (is_logged, is_admin, flash, esc)

### Páginas
- `index.php` - Inicio con carousel y tarjetas
- `login.php` - Inicio de sesión
- `register.php` - Registro de usuarios
- `logout.php` - Cerrar sesión
- `reservar.php` - Crear reserva (usuario)
- `reservas_list.php` - Listar reservas (usuario/admin)
- `reserva_cancel.php` - Cancelar reserva
- `cabanas_list.php` - Listar cabañas (admin)
- `cabana_add.php` - Agregar cabaña (admin)
- `cabana_edit.php` - Editar cabaña (admin)
- `cabana_delete.php` - Eliminar cabaña (admin)

### Assets
- `assets/css/bootstrap.min.css` - Bootstrap local
- `assets/js/bootstrap.bundle.min.js` - Bootstrap JS local
- `assets/images/` - Imágenes de cabañas
- `Public/images/placeholder.php` - Generador de placeholders

---

## ✅ Checklist de Verificación

- [ ] Apache está corriendo
- [ ] MySQL está corriendo
- [ ] Base de datos `cabanas_db` existe
- [ ] Tablas creadas (usuarios, cabanas, reservas)
- [ ] Usuario admin creado
- [ ] Cabañas de ejemplo insertadas
- [ ] Página de inicio carga sin errores
- [ ] Login funciona
- [ ] Registro funciona
- [ ] Navbar muestra opciones correctas según rol
- [ ] Reservas se pueden crear
- [ ] Admin puede gestionar cabañas
- [ ] Bootstrap se carga localmente (sin CDN)
- [ ] No hay errores en consola del navegador

---

## 🐛 Troubleshooting

### Error: "Call to undefined function is_logged()"
**Solución**: Verifica que `header.php` incluya correctamente `Src/functions.php`

### Error: "Undefined variable: $link"
**Solución**: Verifica que `header.php` incluya correctamente `conexion.php`

### Error: Base de datos no existe
**Solución**: 
1. Abre phpMyAdmin: `http://localhost/phpmyadmin`
2. Crea BD llamada `cabanas_db`
3. O ejecuta: `http://localhost/Public/test_db.php`

### Error 404 en imágenes
**Solución**: Las imágenes usan placeholder automático, es normal. Para usar imágenes reales:
1. Sube JPG a `Public/images/`
2. Actualiza campo `imagen` en tabla `cabanas`

---

## 📝 Notas Técnicas

- **Variable de conexión**: Se usa `$link` (no `$mysqli`)
- **Sesiones**: Iniciadas automáticamente en `header.php`
- **Seguridad**: Passwords hasheados con `password_hash()`
- **XSS Protection**: Todas las salidas usan `esc()`
- **SQL Injection**: Se usan prepared statements
- **Bootstrap**: Versión 5.3.8 (local, sin CDN)

---

## 🎯 Próximos Pasos (Opcionales)

1. Agregar validación de fechas en reservas
2. Sistema de pagos
3. Galería de imágenes por cabaña
4. Calificaciones y reviews
5. Notificaciones por email
6. Panel de estadísticas para admin
7. Exportar reportes PDF
8. API REST
