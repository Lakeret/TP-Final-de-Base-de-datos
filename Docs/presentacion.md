```markdown
Presentación - Proyecto "Reserva de Cabañas"
(Slide por slide - importar a PowerPoint)

Slide 1 - Título
- Reserva de Cabañas
- Autor: (tu nombre)
- Fecha: (fecha)

Slide 2 - Objetivo
- Crear una aplicación web en PHP/MySQL para gestionar cabañas y reservas.
- Funcionalidades: registro/login, CRUD cabañas, reservas, sesiones y roles.

Slide 3 - Tecnologías
- PHP + MySQL (mysqli)
- Bootstrap 5 (CSS/JS)
- Estructura MVC simple (archivos separados)
- Servidor: Apache/Nginx + PHP

Slide 4 - Diagrama ER
- Mostrar imagen del diagrama ER (incluir er_diagram.svg exportado)

Slide 5 - Estructura de la BD
- usuarios(id, nombre, email, password, rol, created_at)
- cabanas(id, nombre, descripcion, precio_noche, capacidad, imagen, created_at)
- reservas(id, usuario_id, cabana_id, fecha_inicio, fecha_fin, estado, created_at)

Slide 6 - Vistas principales
- Home: carousel + cards (mostrar capturas)
- Registro / Login
- Administrar Cabañas (admin)
- Mis Reservas / Gestión de Reservas

Slide 7 - Seguridad
- Hash de contraseñas con password_hash
- Consultas preparadas (mysqli prepare / bind_param)
- Roles (user / admin)

Slide 8 - Demo
- Flujo: Registrarse -> Login -> Ver cabañas -> Reservar -> Ver reservas
- Mostrar pantallazos o demo en vivo

Slide 9 - Manual de Usuario
- Breve explicación de pasos (ver archivo manual)

Slide 10 - Conclusiones y próximos pasos
- Mejoras: subida segura de imágenes, manejo avanzado de disponibilidad, pasarela de pago, notificaciones por mail.
```