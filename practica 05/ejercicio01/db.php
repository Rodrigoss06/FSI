<?php
// db.php

$host = 'localhost';
$dbname = 'fsi';
$username = 'root12'; // Cambia esto si tu usuario de MySQL es diferente
$password = 'root'; // Cambia esto si tu contraseña de MySQL es diferente// Cambia si tienes una contraseña para MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establece el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa.<br>";

    // Crear tabla Usuarios si no existe
    $sqlUsuarios = "CREATE TABLE IF NOT EXISTS Usuarios (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        nombres VARCHAR(100) NOT NULL,
        apellidos VARCHAR(100) NOT NULL,
        dni VARCHAR(8) NOT NULL,
        celular VARCHAR(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    $pdo->exec($sqlUsuarios);
    echo "Tabla Usuarios verificada o creada.<br>";

    // Crear tabla Reservas si no existe
    $sqlReservas = "CREATE TABLE IF NOT EXISTS Reservas (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        fechaingreso DATE NOT NULL,
        noches INT(3) NOT NULL,
        habitacion VARCHAR(15) NOT NULL,
        huespedes INT(3) NOT NULL,
        usuario_id INT(11),
        FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    $pdo->exec($sqlReservas);
    echo "Tabla Reservas verificada o creada.<br>";

    // Verificar si la tabla Usuarios está vacía
    $sqlCheckUsuarios = "SELECT COUNT(*) FROM Usuarios";
    $stmt = $pdo->query($sqlCheckUsuarios);
    $usuariosCount = $stmt->fetchColumn();

    if ($usuariosCount == 0) {
        // Inicializar con algunos usuarios si la tabla está vacía
        $sqlInsertUsuarios = "INSERT INTO Usuarios (nombres, apellidos, dni, celular) VALUES 
        ('Juan', 'Pérez', '12345678', '999999999'),
        ('Ana', 'Gómez', '87654321', '888888888'),
        ('Luis', 'Rodríguez', '11223344', '777777777')";

        $pdo->exec($sqlInsertUsuarios);
        echo "Datos iniciales insertados en la tabla Usuarios.<br>";
    } else {
        echo "La tabla Usuarios ya tiene datos.<br>";
    }

    // Verificar si la tabla Reservas está vacía
    $sqlCheckReservas = "SELECT COUNT(*) FROM Reservas";
    $stmt = $pdo->query($sqlCheckReservas);
    $reservasCount = $stmt->fetchColumn();

    if ($reservasCount == 0) {
        // Inicializar con algunas reservas si la tabla está vacía
        $sqlInsertReservas = "INSERT INTO Reservas (fechaingreso, noches, habitacion, huespedes, usuario_id) VALUES 
        ('2024-10-01', 3, '101', 2, 1),
        ('2024-10-05', 2, '202', 3, 2),
        ('2024-10-10', 5, '303', 1, 3)";

        $pdo->exec($sqlInsertReservas);
        echo "Datos iniciales insertados en la tabla Reservas.<br>";
    } else {
        echo "La tabla Reservas ya tiene datos.<br>";
    }

} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
