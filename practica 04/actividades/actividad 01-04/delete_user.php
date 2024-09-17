<?php
require 'db.php';

if (isset($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        header('Location: index.php?mensaje=Usuario eliminado con éxito');
    } catch (PDOException $e) {
        header('Location: index.php?error=Error al eliminar el usuario: ' . $e->getMessage());
    }
}
