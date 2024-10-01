<?php
// admin.php

include 'db.php';

// Obtener usuarios
$sqlUsuarios = "SELECT * FROM Usuarios";
$resultUsuarios = $pdo->query($sqlUsuarios);

// Obtener reservas
$sqlReservas = "SELECT r.*, CONCAT(u.nombres, ' ', u.apellidos) AS nombre_completo 
                FROM Reservas r
                JOIN Usuarios u ON r.usuario_id = u.id";
$resultReservas = $pdo->query($sqlReservas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Visualización de Usuarios y Reservas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Usuarios</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Celular</th>
                </tr>
            </thead>
            <tbody>
                <?php while($usuario = $resultUsuarios->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nombres']; ?></td>
                    <td><?php echo $usuario['apellidos']; ?></td>
                    <td><?php echo $usuario['dni']; ?></td>
                    <td><?php echo $usuario['celular']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Reservas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Reserva</th>
                    <th>Usuario</th>
                    <th>Fecha Ingreso</th>
                    <th>Noches</th>
                    <th>Habitación</th>
                    <th>Huéspedes</th>
                </tr>
            </thead>
            <tbody>
                <?php while($reserva = $resultReservas->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $reserva['id']; ?></td>
                    <td><?php echo $reserva['nombre_completo']; ?></td>
                    <td><?php echo $reserva['fechaingreso']; ?></td>
                    <td><?php echo $reserva['noches']; ?></td>
                    <td><?php echo $reserva['habitacion']; ?></td>
                    <td><?php echo $reserva['huespedes']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
