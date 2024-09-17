<?php
// db.php
$host = 'localhost';
$dbname = 'fsi';
$username = 'root12'; // Cambia esto si tu usuario de MySQL es diferente
$password = 'root'; // Cambia esto si tu contraseña de MySQL es diferente

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear tablas si no existen
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS clientes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL
        );
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS pedidos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            cliente_id INT NOT NULL,
            producto VARCHAR(50) NOT NULL,
            cantidad INT NOT NULL,
            FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE
        );
    ");
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
