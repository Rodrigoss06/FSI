<?php
require 'db.php';

// Inicializar datos en la tabla clientes si está vacía
$stmt = $pdo->query("SELECT COUNT(*) FROM clientes");
$count = $stmt->fetchColumn();

if ($count == 0) {
    $pdo->exec("
        INSERT INTO clientes (nombre, email) VALUES
        ('Cliente 1', 'cliente1@example.com'),
        ('Cliente 2', 'cliente2@example.com'),
        ('Cliente 3', 'cliente3@example.com')
    ");
}

// Inicializar datos en la tabla pedidos si está vacía
$stmt = $pdo->query("SELECT COUNT(*) FROM pedidos");
$count = $stmt->fetchColumn();

if ($count == 0) {
    $pdo->exec("
        INSERT INTO pedidos (cliente_id, producto, cantidad) VALUES
        (1, 'Producto A', 10),
        (1, 'Producto B', 5),
        (2, 'Producto C', 20),
        (3, 'Producto D', 15)
    ");
}
