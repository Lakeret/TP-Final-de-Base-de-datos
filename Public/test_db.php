<?php
// test_db.php - Script para verificar la BD
require_once 'conexion.php';

echo "<h2>Prueba de Conexión y Tablas</h2>";

// 1. Verificar conexión
if ($link) {
    echo "✅ Conexión exitosa a la BD 'cabanas_db'<br><br>";
} else {
    echo "❌ Error de conexión<br>";
    exit;
}

// 2. Verificar tabla usuarios
$result = $link->query("SHOW TABLES LIKE 'usuarios'");
if ($result && $result->num_rows > 0) {
    echo "✅ Tabla 'usuarios' existe<br>";
    
    // Contar usuarios
    $count = $link->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc();
    echo "&nbsp;&nbsp;&nbsp;Total usuarios: " . $count['total'] . "<br>";
    
    // Verificar estructura
    $cols = $link->query("DESCRIBE usuarios");
    echo "&nbsp;&nbsp;&nbsp;Columnas: ";
    $col_names = [];
    while ($col = $cols->fetch_assoc()) {
        $col_names[] = $col['Field'];
    }
    echo implode(', ', $col_names) . "<br><br>";
} else {
    echo "❌ Tabla 'usuarios' NO existe<br>";
    echo "<strong>Creando tabla usuarios...</strong><br>";
    
    $sql = "CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        rol VARCHAR(20) DEFAULT 'usuario',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($link->query($sql)) {
        echo "✅ Tabla 'usuarios' creada<br><br>";
        
        // Crear usuario admin por defecto
        $admin_pass = password_hash('admin123', PASSWORD_DEFAULT);
        $link->query("INSERT INTO usuarios (nombre, email, password, rol) VALUES ('Admin', 'admin@cabanas.com', '$admin_pass', 'admin')");
        echo "✅ Usuario admin creado: admin@cabanas.com / admin123<br><br>";
    } else {
        echo "❌ Error creando tabla: " . $link->error . "<br><br>";
    }
}

// 3. Verificar tabla cabanas
$result = $link->query("SHOW TABLES LIKE 'cabanas'");
if ($result && $result->num_rows > 0) {
    echo "✅ Tabla 'cabanas' existe<br>";
    
    // Contar cabañas
    $count = $link->query("SELECT COUNT(*) as total FROM cabanas")->fetch_assoc();
    echo "&nbsp;&nbsp;&nbsp;Total cabañas: " . $count['total'] . "<br>";
    
    if ($count['total'] == 0) {
        echo "<strong>Insertando cabañas de ejemplo...</strong><br>";
        
        $cabanas_ejemplo = [
            ['Cabaña del Bosque', 'Hermosa cabaña rodeada de árboles con vista al lago. Perfecta para escapadas románticas.', 85.00, 2, 'images/cabana1.jpg'],
            ['Cabaña Familiar', 'Amplia cabaña con 3 habitaciones, cocina completa y sala de estar. Ideal para familias.', 150.00, 6, 'images/cabana2.jpg'],
            ['Cabaña Montaña', 'Acogedora cabaña en las montañas con chimenea y jacuzzi. Vista espectacular.', 120.00, 4, 'images/cabana3.jpg']
        ];
        
        foreach ($cabanas_ejemplo as $cab) {
            $stmt = $link->prepare("INSERT INTO cabanas (nombre, descripcion, precio_noche, capacidad, imagen) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('ssdis', $cab[0], $cab[1], $cab[2], $cab[3], $cab[4]);
            $stmt->execute();
            $stmt->close();
        }
        
        echo "✅ 3 cabañas de ejemplo insertadas<br>";
    }
    
    echo "<br>";
} else {
    echo "❌ Tabla 'cabanas' NO existe<br>";
    echo "<strong>Creando tabla cabanas...</strong><br>";
    
    $sql = "CREATE TABLE cabanas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        descripcion TEXT,
        precio_noche DECIMAL(10,2) NOT NULL,
        capacidad INT NOT NULL,
        imagen VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($link->query($sql)) {
        echo "✅ Tabla 'cabanas' creada<br><br>";
    } else {
        echo "❌ Error creando tabla: " . $link->error . "<br><br>";
    }
}

// 4. Verificar tabla reservas
$result = $link->query("SHOW TABLES LIKE 'reservas'");
if ($result && $result->num_rows > 0) {
    echo "✅ Tabla 'reservas' existe<br>";
    
    // Contar reservas
    $count = $link->query("SELECT COUNT(*) as total FROM reservas")->fetch_assoc();
    echo "&nbsp;&nbsp;&nbsp;Total reservas: " . $count['total'] . "<br><br>";
} else {
    echo "❌ Tabla 'reservas' NO existe<br>";
    echo "<strong>Creando tabla reservas...</strong><br>";
    
    $sql = "CREATE TABLE reservas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        cabana_id INT NOT NULL,
        fecha_inicio DATE NOT NULL,
        fecha_fin DATE NOT NULL,
        estado VARCHAR(20) DEFAULT 'pendiente',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
        FOREIGN KEY (cabana_id) REFERENCES cabanas(id)
    )";
    
    if ($link->query($sql)) {
        echo "✅ Tabla 'reservas' creada<br><br>";
    } else {
        echo "❌ Error creando tabla: " . $link->error . "<br><br>";
    }
}

echo "<hr>";
echo "<h3>🎉 Sistema listo para usar!</h3>";
echo "<p><a href='index.php' class='btn btn-primary'>Ir al Inicio</a> ";
echo "<a href='login.php' class='btn btn-secondary'>Ir al Login</a></p>";
?>
