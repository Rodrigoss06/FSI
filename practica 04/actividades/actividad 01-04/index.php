<?php
require 'db.php';

// Obtener usuarios y reservas
$usuarios = $pdo->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
$reservas = $pdo->query("SELECT r.*, u.nombre AS usuario_nombre FROM reservas r JOIN usuarios u ON r.usuario_id = u.id")->fetchAll(PDO::FETCH_ASSOC);

// Mensajes de éxito/error
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de reservas de hotel que permite crear usuarios y realizar reservas.">
    <meta name="keywords" content="reservas, hotel, usuarios, PHP, MySQL">
    <meta name="author" content="Tu Nombre">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reservas de Hotel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Enlace a Bootstrap CSS -->
</head>
<body>
    <div class="container mt-5">
        <h1>Reservas de Hotel</h1>

        <!-- Mensajes de éxito/error -->
        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Sección de usuarios -->
        <div class="row">
            <!-- Formulario para crear usuario -->
            <div class="col-md-6">
                <h2>Crear Usuario</h2>
                <form method="post" action="create_user.php">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" name="crear_usuario" class="btn btn-primary">Crear Usuario</button>
                </form>
            </div>

            <!-- Lista de usuarios -->
            <div class="col-md-6">
                <h2>Lista de Usuarios</h2>
                <ul class="list-group">
                    <?php foreach ($usuarios as $usuario): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $usuario['nombre']; ?> (<?php echo $usuario['email']; ?>)
                            <a href="delete_user.php?usuario_id=<?php echo $usuario['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Sección de reservas -->
        <div class="row mt-5">
            <!-- Formulario para crear reserva -->
            <div class="col-md-6">
                <h2>Realizar Reserva</h2>
                <form method="post" action="create_reserva.php">
                    <div class="form-group">
                        <label for="usuario_id">Usuario:</label>
                        <select name="usuario_id" id="usuario_id" class="form-control" required>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_reserva">Fecha de Reserva:</label>
                        <input type="date" name="fecha_reserva" id="fecha_reserva" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="habitacion">Habitación:</label>
                        <input type="text" name="habitacion" id="habitacion" class="form-control" required>
                    </div>
                    <button type="submit" name="crear_reserva" class="btn btn-primary">Realizar Reserva</button>
                </form>
            </div>

            <!-- Lista de reservas -->
            <div class="col-md-6">
                <h2>Lista de Reservas</h2>
                <ul class="list-group">
                    <?php foreach ($reservas as $reserva): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $reserva['usuario_nombre']; ?> - <?php echo $reserva['habitacion']; ?> - <?php echo $reserva['fecha_reserva']; ?>
                            <a href="delete_reserva.php?reserva_id=<?php echo $reserva['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
