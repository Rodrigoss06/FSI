<?php
require 'db.php';

if (isset($_GET['pedido_id']) && isset($_GET['cliente_id'])) {
    $pedido_id = $_GET['pedido_id'];
    $cliente_id = $_GET['cliente_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM pedidos WHERE id = ?");
        $stmt->execute([$pedido_id]);
        header('Location: pedidos.php?cliente_id=' . $cliente_id . '&mensaje=Pedido eliminado con éxito');
    } catch (PDOException $e) {
        header('Location: pedidos.php?cliente_id=' . $cliente_id . '&error=Error al eliminar el pedido: ' . $e->getMessage());
    }
}
