<?php
$servername = "localhost";
$username = "root12";
$password = "root"; // Cambia según tu configuración
$dbname = "fsi"; // Cambia según tu configuración

try {
    // Conexión a la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
