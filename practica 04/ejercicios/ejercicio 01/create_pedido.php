<?php
require 'db.php';

if (isset($_POST['crear_pedido'])) {
    $cliente_id = $_POST['cliente_id'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO pedidos (cliente_id, producto, cantidad) VALUES (?, ?, ?)");
        $stmt->execute([$cliente_id, $producto, $cantidad]);
        header('Location: pedidos.php?cliente_id=' . $cliente_id . '&mensaje=Pedido creado con éxito');
    } catch (PDOException $e) {
        header('Location: pedidos.php?cliente_id=' . $cliente_id . '&error=Error al crear el pedido: ' . $e->getMessage());
    }
}
