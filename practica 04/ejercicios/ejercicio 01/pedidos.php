<?php
require 'db.php';

// Obtener el ID del cliente de la URL
$cliente_id = isset($_GET['cliente_id']) ? $_GET['cliente_id'] : null;

if ($cliente_id === null) {
    die('Cliente no especificado.');
}

// Obtener la información del cliente
$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$cliente_id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die('Cliente no encontrado.');
}

// Obtener los pedidos del cliente
$stmt = $pdo->prepare("SELECT * FROM pedidos WHERE cliente_id = ?");
$stmt->execute([$cliente_id]);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mensajes de éxito/error
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos del Cliente</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Pedidos de <?php echo htmlspecialchars($cliente['nombre']); ?></h1>
        <p>Email: <?php echo htmlspecialchars($cliente['email']); ?></p>

        <!-- Mensajes de éxito/error -->
        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulario para crear un nuevo pedido -->
        <div class="card mt-4 mb-4">
            <div class="card-header">Crear Pedido</div>
            <div class="card-body">
                <form method="post" action="create_pedido.php">
                    <input type="hidden" name="cliente_id" value="<?php echo $cliente_id; ?>">
                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input type="text" name="producto" id="producto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                    </div>
                    <button type="submit" name="crear_pedido" class="btn btn-primary">Crear Pedido</button>
                </form>
            </div>
        </div>

        <!-- Tabla de pedidos -->
        <div class="card">
            <div class="card-header">Lista de Pedidos</div>
            <div class="card-body">
                <?php if (count($pedidos) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pedidos as $pedido): ?>
                                    <tr>
                                        <td><?php echo $pedido['id']; ?></td>
                                        <td><?php echo htmlspecialchars($pedido['producto']); ?></td>
                                        <td><?php echo $pedido['cantidad']; ?></td>
                                        <td>
                                            <a href="delete_pedido.php?pedido_id=<?php echo $pedido['id']; ?>&cliente_id=<?php echo $cliente_id; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>No hay pedidos para este cliente.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Botón para regresar al índice -->
        <a href="index.php" class="btn btn-primary mt-3">Regresar</a>
    </div>

    <!-- Enlace a Bootstrap JS (Opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
