<?php
// Incluir la conexión a la base de datos
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaIngreso = $_POST['fechaingreso'];
    $noches = $_POST['noches'];
    $habitacion = $_POST['habitacion'];
    $huespedes = $_POST['huespedes'];
    $usuario_id = $_POST['usuario_id'];

    // Insertar los datos en la tabla Reservas
    $sql = "INSERT INTO Reservas (fechaingreso, noches, habitacion, huespedes, usuario_id) VALUES (:fechaingreso, :noches, :habitacion, :huespedes, :usuario_id)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':fechaingreso', $fechaIngreso);
    $stmt->bindParam(':noches', $noches);
    $stmt->bindParam(':habitacion', $habitacion);
    $stmt->bindParam(':huespedes', $huespedes);
    $stmt->bindParam(':usuario_id', $usuario_id);

    if ($stmt->execute()) {
        // Redirigir a la ruta raíz después de crear la reserva exitosamente
        header("Location: /");
        exit(); // Asegurarse de que se detiene la ejecución después de la redirección
    } else {
        echo "Error al crear la reserva.";
    }
}

