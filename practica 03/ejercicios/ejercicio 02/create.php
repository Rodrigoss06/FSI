<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!empty($nombre) && !empty($email) && !empty($password)) {
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $password]);
        header("Location: index.php");
        exit();
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Agregar Usuario</h1>
        <form method="POST" class="user-form">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-input" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-input" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-input" required>

            <button type="submit" class="submit-btn">Crear Usuario</button>
        </form>
        <a href="index.php" class="back-link">Volver al listado</a>
    </div>
</body>
</html>
