```sql
-- cabanas_db.sql
-- Crea la base de datos y tablas (puedes usar esta estructura si aún no tienes la DB)
CREATE DATABASE IF NOT EXISTS cabanas_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cabanas_db;

-- Usuarios
CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  rol ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Cabañas
CREATE TABLE IF NOT EXISTS cabanas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  descripcion TEXT,
  precio_noche DECIMAL(9,2) NOT NULL DEFAULT 0,
  capacidad INT NOT NULL DEFAULT 1,
  imagen VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Reservas
CREATE TABLE IF NOT EXISTS reservas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  cabana_id INT NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  estado ENUM('pendiente','confirmada','cancelada') DEFAULT 'pendiente',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (cabana_id) REFERENCES cabanas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sample cabanas
INSERT INTO cabanas (nombre, descripcion, precio_noche, capacidad, imagen) VALUES
('Cabaña Lago Azul','Cabaña con vista al lago, 2 dormitorios, parrilla',4500.00,6,'images/cabana1.jpg'),
('Cabaña Bosque','Acogedora cabaña en el bosque, 1 dormitorio',3500.00,4,'images/cabana2.jpg'),
('Cabaña Montaña','Cabaña panorámica en la montaña',5200.00,8,'images/cabana3.jpg');

-- Demo admin:
-- Generá el hash en PHP: password_hash('admin123', PASSWORD_DEFAULT)
-- Reemplaza REEMPLAZAR_POR_HASH con el hash devuelto por password_hash antes de insertar:
-- Ejemplo de inserción (reemplazar el hash por uno real):
-- INSERT INTO usuarios (nombre, email, password, rol) VALUES ('Administrador','admin@cabanas.local','$2y$10$...hash...', 'admin');
```