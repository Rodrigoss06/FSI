<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página del Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="user-container">
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        <p>Has iniciado sesión correctamente.</p>
        <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>
</body>
</html>
