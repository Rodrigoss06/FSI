<?php
// resumen_reserva.php

// Incluir la conexión a la base de datos
include 'db.php';

// Recibir los datos del formulario
$usuario_id = $_POST['usuario'];
$habitacion = $_POST['habitacion'];
$huespedes = $_POST['huespedes'];
$fechaingreso = $_POST['fechaingreso'];
$noches = $_POST['noches'];

// Obtener los datos del usuario
$sql = "SELECT CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM Usuarios WHERE id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Reserva</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('fondo.png'); /* Imagen de fondo personalizada */
            background-position: center;
            background-size: cover;
            color: white;
        }
        .card {
            background-color: rgba(0, 0, 0, 0.7); /* Fondo semi-transparente para la tarjeta */
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            transition: opacity 1s ease-in-out;
            opacity: 0;
        }
        .btn-primary {
            background-color: #368fb2;
            border-color: #368fb2;
        }

    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card" id="resumenCard">
            <div class="card-header">
                Resumen de Reserva
            </div>
            <div class="card-body">
                <p><strong>Usuario:</strong> <?php echo $usuario['nombre_completo']; ?></p>
                <p><strong>Habitación:</strong> <?php echo $habitacion; ?></p>
                <p><strong>Número de Huéspedes:</strong> <?php echo $huespedes; ?></p>
                <p><strong>Fecha de Entrada:</strong> <?php echo $fechaingreso; ?></p>
                <p><strong>Noches:</strong> <?php echo $noches; ?></p>

                <form id="reservaForm" action="crear_reserva.php" method="POST">
                    <input type="hidden" name="usuario" value="<?php echo $usuario_id; ?>">
                    <input type="hidden" name="habitacion" value="<?php echo $habitacion; ?>">
                    <input type="hidden" name="huespedes" value="<?php echo $huespedes; ?>">
                    <input type="hidden" name="fechaingreso" value="<?php echo $fechaingreso; ?>">
                    <input type="hidden" name="noches" value="<?php echo $noches; ?>">

                    <button type="submit" class="btn btn-primary" onclick="return confirmarReserva()">Confirmar Reserva</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar la tarjeta con una animación suave
        window.onload = function() {
            var resumenCard = document.getElementById('resumenCard');
            resumenCard.style.opacity = 1;
        };

        // Función para confirmar antes de enviar la reserva
        function confirmarReserva() {
            return confirm("¿Estás seguro de que deseas confirmar esta reserva?");
        }
    </script>
</body>
</html>
