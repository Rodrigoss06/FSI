<?php
require 'db.php';

if (isset($_POST['crear_cliente'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO clientes (nombre, email) VALUES (?, ?)");
        $stmt->execute([$nombre, $email]);
        header('Location: index.php?mensaje=Cliente creado con éxito');
    } catch (PDOException $e) {
        header('Location: index.php?error=Error al crear el cliente: ' . $e->getMessage());
    }
}
