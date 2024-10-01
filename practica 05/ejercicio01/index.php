<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Hotel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    body {
        background-image: url('fondo.png');
        background-position: center;
        background-size: cover;
        color: white;
    }
    .form-control {
        background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente */
        color: #333; /* Color de texto */
    }
    .form-container {
        background-color: rgba(0, 0, 0, 0.5); /* Fondo negro semi-transparente */
        padding: 20px;
        border-radius: 10px;
    }
    .btn-primary {
        background-color: #368fb2;
        border-color: #368fb2;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <img src="logo.png" alt="Logo" style="max-width: 400px;">
        </div>
        <div class="form-container">
            <!-- Formulario de reserva -->
            <form id="reservaForm" action="resumen_reserva.php" method="POST" onsubmit="return validarFormulario()">
                <div class="form-row align-items-center">
                    <div class="col-md-3 mb-3">
                        <label for="usuario">Elige usuario:</label>
                        <select name="usuario" id="usuario" class="form-control" required>
                            <?php
                            include 'db.php';  // Reutilizamos la conexión a la base de datos

                            // Obtener los usuarios
                            $sql = "SELECT id, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM Usuarios";
                            $result = $pdo->query($sql);

                            if ($result->rowCount() > 0) {
                                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="'.$row['id'].'">'.$row['nombre_completo'].'</option>';
                                }
                            } else {
                                echo '<option value="">No hay usuarios disponibles</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="habitacion">Habitación:</label>
                        <select name="habitacion" id="habitacion" class="form-control" required>
                            <option value="Clasico VIP">Clásico VIP</option>
                            <option value="Business VIP">Business VIP</option>
                            <option value="Executive VIP">Executive VIP</option>
                            <option value="International VIP">International VIP</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="huespedes">N° de Huéspedes:</label>
                        <input type="number" name="huespedes" id="huespedes" class="form-control" max="7" min="1" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="fechaingreso">Fecha de Entrada:</label>
                        <input type="date" name="fechaingreso" id="fechaingreso" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="noches">Noches:</label>
                        <input type="number" name="noches" id="noches" class="form-control" max="30" min="1" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Reservar</button>
                </div>
            </form>
            <hr>
            <!-- Botón para redirigir a la página de creación de usuario -->
            <div class="text-center mt-3">
                <a href="crear_usuario.php" class="btn btn-secondary">Crear usuario</a>
            </div>
        </div>
    </div>

    <script>
        // Establecer la fecha mínima para el campo de fecha de ingreso
        document.addEventListener('DOMContentLoaded', function() {
            var fechaInput = document.getElementById('fechaingreso');
            var today = new Date().toISOString().split('T')[0];
            fechaInput.setAttribute('min', today);
        });

        // Función para validar el formulario antes de enviarlo
        function validarFormulario() {
            // Validar número de huéspedes
            var huespedes = document.getElementById('huespedes').value;
            if (huespedes < 1 || huespedes > 7) {
                alert('El número de huéspedes debe estar entre 1 y 7.');
                return false;
            }

            // Validar noches de estadía
            var noches = document.getElementById('noches').value;
            if (noches < 1 || noches > 30) {
                alert('El número de noches debe estar entre 1 y 30.');
                return false;
            }

            // Validar que la fecha de ingreso no sea anterior a la fecha actual
            var fechaIngreso = document.getElementById('fechaingreso').value;
            var today = new Date().toISOString().split('T')[0];
            if (fechaIngreso < today) {
                alert('La fecha de ingreso no puede ser anterior a la fecha actual.');
                return false;
            }

            return true;  // Si todo es válido, se envía el formulario
        }
    </script>
</body>
</html>
