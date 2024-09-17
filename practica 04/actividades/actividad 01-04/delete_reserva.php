<?php
require 'db.php';

if (isset($_GET['reserva_id'])) {
    $reserva_id = $_GET['reserva_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM reservas WHERE id = ?");
        $stmt->execute([$reserva_id]);
        header('Location: index.php?mensaje=Reserva eliminada con éxito');
    } catch (PDOException $e) {
        header('Location: index.php?error=Error al eliminar la reserva: ' . $e->getMessage());
    }
}
