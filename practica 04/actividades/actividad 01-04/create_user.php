<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear_usuario'])) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $email, $password]);
            header('Location: index.php?mensaje=Usuario creado con éxito');
        } catch (PDOException $e) {
            header('Location: index.php?error=Error al crear el usuario: ' . $e->getMessage());
        }
    }
}
