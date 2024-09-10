<?php
session_start(); // Iniciar la sesión

require 'db.php'; // Conectar a la base de datos

$message = ''; // Mensaje de error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // Verificar si el usuario existe
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Si el usuario existe, verificar la contraseña
        if ($user && password_verify($password, $user['password'])) {
            // Login exitoso: almacenar datos del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            header("Location: user_page.php");
            exit();
        } else {
            $message = "Usuario o contraseña incorrectos.";
        }
    } else {
        $message = "Por favor, completa ambos campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Iniciar Sesión</h1>
        <?php if (!empty($message)): ?>
            <p class="error-message"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" class="user-form">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-input" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-input" required>

            <button type="submit" class="submit-btn">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
