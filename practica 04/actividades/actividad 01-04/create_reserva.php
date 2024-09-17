<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear_reserva'])) {
        $usuario_id = $_POST['usuario_id'];
        $fecha_reserva = $_POST['fecha_reserva'];
        $habitacion = $_POST['habitacion'];

        try {
            $stmt = $pdo->prepare("INSERT INTO reservas (usuario_id, fecha_reserva, habitacion) VALUES (?, ?, ?)");
            $stmt->execute([$usuario_id, $fecha_reserva, $habitacion]);
            header('Location: index.php?mensaje=Reserva creada con éxito');
        } catch (PDOException $e) {
            header('Location: index.php?error=Error al crear la reserva: ' . $e->getMessage());
        }
    }
}
