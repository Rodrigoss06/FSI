<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

// Obtener el usuario por ID
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $usuario['password'];

    if (!empty($nombre) && !empty($email)) {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$nombre, $email, $password, $id]);
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
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Editar Usuario</h1>
        <form method="POST" class="user-form">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-input" value="<?= htmlspecialchars($usuario['nombre']); ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-input" value="<?= htmlspecialchars($usuario['email']); ?>" required>

            <label for="password">Password (dejar en blanco para no cambiarla)</label>
            <input type="password" name="password" id="password" class="form-input">

            <button type="submit" class="submit-btn">Guardar Cambios</button>
        </form>
        <a href="index.php" class="back-link">Volver al listado</a>
    </div>
</body>
</html>
