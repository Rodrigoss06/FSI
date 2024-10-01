<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
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
    .loading-animation {
        display: none;
        margin-top: 10px;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>Crear Nuevo Usuario</h2>
        </div>
        <div class="form-container">
            <!-- Formulario de creación de usuario -->
            <form id="usuarioForm" action="crear_usuario.php" method="POST" onsubmit="return validarFormulario()">
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                    <small id="nombresError" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    <small id="apellidosError" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <input type="text" class="form-control" id="dni" name="dni" maxlength="8" required>
                    <small id="dniError" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input type="text" class="form-control" id="celular" name="celular" maxlength="20" required>
                    <small id="celularError" class="text-danger"></small>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
                <div class="text-center loading-animation">
                    <img src="loading.gif" alt="Cargando..." width="50">
                </div>
            </form>
        </div>
    </div>

    <script>
        function validarFormulario() {
            var valido = true;

            // Validar nombres (solo letras)
            var nombres = document.getElementById('nombres');
            var nombresRegex = /^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/;
            if (!nombresRegex.test(nombres.value)) {
                nombres.style.borderColor = 'red';
                document.getElementById('nombresError').innerText = 'Por favor, ingrese nombres válidos.';
                valido = false;
            } else {
                nombres.style.borderColor = 'green';
                document.getElementById('nombresError').innerText = '';
            }

            // Validar apellidos (solo letras)
            var apellidos = document.getElementById('apellidos');
            if (!nombresRegex.test(apellidos.value)) {
                apellidos.style.borderColor = 'red';
                document.getElementById('apellidosError').innerText = 'Por favor, ingrese apellidos válidos.';
                valido = false;
            } else {
                apellidos.style.borderColor = 'green';
                document.getElementById('apellidosError').innerText = '';
            }

            // Validar DNI (8 dígitos)
            var dni = document.getElementById('dni');
            var dniRegex = /^[0-9]{8}$/;
            if (!dniRegex.test(dni.value)) {
                dni.style.borderColor = 'red';
                document.getElementById('dniError').innerText = 'Por favor, ingrese un DNI válido de 8 dígitos.';
                valido = false;
            } else {
                dni.style.borderColor = 'green';
                document.getElementById('dniError').innerText = '';
            }

            // Validar celular (mínimo 9 dígitos, solo números)
            var celular = document.getElementById('celular');
            var celularRegex = /^[0-9]{9,20}$/;
            if (!celularRegex.test(celular.value)) {
                celular.style.borderColor = 'red';
                document.getElementById('celularError').innerText = 'Por favor, ingrese un número de celular válido (mínimo 9 dígitos).';
                valido = false;
            } else {
                celular.style.borderColor = 'green';
                document.getElementById('celularError').innerText = '';
            }

            // Si el formulario es válido, mostrar animación de carga
            if (valido) {
                document.querySelector('.loading-animation').style.display = 'block';
            }
            return valido;
        }

        // Validación en tiempo real
        document.getElementById('nombres').addEventListener('input', function() {
            validarFormulario();
        });
        document.getElementById('apellidos').addEventListener('input', function() {
            validarFormulario();
        });
        document.getElementById('dni').addEventListener('input', function() {
            validarFormulario();
        });
        document.getElementById('celular').addEventListener('input', function() {
            validarFormulario();
        });
    </script>
</body>
</html>
