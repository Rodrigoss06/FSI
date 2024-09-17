<?php
require 'db.php';

if (isset($_GET['eliminar_cliente'])) {
    $id = $_GET['eliminar_cliente'];

    try {
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: index.php?mensaje=Cliente eliminado con éxito');
    } catch (PDOException $e) {
        header('Location: index.php?error=Error al eliminar el cliente: ' . $e->getMessage());
    }
}
