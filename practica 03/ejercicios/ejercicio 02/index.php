<?php
require 'db.php';

// Obtener todos los usuarios
$stmt = $conn->prepare("SELECT * FROM usuarios");
$stmt->execute();
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestión de Usuarios</h1>

    <a href="create.php" class="add-user-btn">Agregar Usuario</a>

    <div class="user-grid">
        <!-- Encabezados de la grid -->
        <div class="user-grid-header">ID</div>
        <div class="user-grid-header">Nombre</div>
        <div class="user-grid-header">Email</div>
        <div class="user-grid-header">Acciones</div>

        <!-- Filas de usuarios -->
        <?php foreach ($usuarios as $usuario): ?>
            <div class="user-grid-item"><?= htmlspecialchars($usuario['id']); ?></div>
            <div class="user-grid-item"><?= htmlspecialchars($usuario['nombre']); ?></div>
            <div class="user-grid-item"><?= htmlspecialchars($usuario['email']); ?></div>
            <div class="user-grid-item">
                <a href="edit.php?id=<?= $usuario['id']; ?>" class="edit-btn">Editar</a>
                <a href="delete.php?id=<?= $usuario['id']; ?>" class="delete-btn" onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">Eliminar</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
