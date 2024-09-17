<?php
// conexion.php
$host = 'localhost';
$dbname = 'fsi';
$username = 'root12';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la tabla usuarios si no existe
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(50) NOT NULL,
            email VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL
        );
    ");

    // Crear la tabla reservas si no existe
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS reservas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT NOT NULL,
            fecha_reserva DATE NOT NULL,
            habitacion VARCHAR(50) NOT NULL,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
        );
    ");

    // Inicializar la tabla usuarios si está vacía
    $stmt = $pdo->query("SELECT COUNT(*) FROM usuarios");
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        // Insertar usuarios iniciales
        $pdo->exec("
            INSERT INTO usuarios (nombre, email, password) VALUES
            ('Admin', 'admin@example.com', '" . password_hash('admin123', PASSWORD_BCRYPT) . "'),
            ('User1', 'user1@example.com', '" . password_hash('user123', PASSWORD_BCRYPT) . "'),
            ('User2', 'user2@example.com', '" . password_hash('user123', PASSWORD_BCRYPT) . "')
        ");
    }

    // Obtener los IDs de los usuarios recién insertados
    $usuarios = $pdo->query("SELECT id FROM usuarios")->fetchAll(PDO::FETCH_COLUMN);

    // Inicializar la tabla reservas si está vacía y si hay usuarios disponibles
    if (!empty($usuarios)) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM reservas");
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            // Insertar reservas iniciales utilizando los IDs de los usuarios existentes
            $pdo->exec("
                INSERT INTO reservas (usuario_id, fecha_reserva, habitacion) VALUES
                ($usuarios[0], '2024-09-20', 'Habitación 101'),
                ($usuarios[1], '2024-09-21', 'Habitación 102'),
                ($usuarios[2], '2024-09-22', 'Habitación 103')
            ");
        }
    }

} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
