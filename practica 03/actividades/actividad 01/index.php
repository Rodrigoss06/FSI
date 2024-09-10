<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <h1 class="title">Biblioteca Virtual</h1>
        <div class="headTable">
            <p class="headTableElement">Nombre del Libro</p>
            <p class="headTableElement">Autor</p>
            <p class="headTableElement">ISBN</p>
            <p class="headTableElement">Descripcion</p>
            <p class="headTableElement">Opciones</p>
        </div>
        <div class="bodyTable">
            <?php
            $servername = "localhost";
            $username = "root12";
            $password = "root";
            $dbname = "fsi";

            try {
                // Conectar a la base de datos
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Consulta para obtener todos los libros
                $stmt = $conn->prepare("SELECT COUNT(*) FROM libros");
                $stmt->execute();
                $count = $stmt->fetchColumn();

                if ($count == 0) {
                    // Insertar datos iniciales
                    $sql = "INSERT INTO libros (nombre_libro, autor, isbn, descripcion) VALUES
                            ('Padre Rico Padre Pobre', 'Autor 1', '111111', 'Libro interesante'),
                            ('El secreto', 'Autor 2', '222222', 'Poder de la atracción'),
                            ('Tu empresa', 'Autor 3', '333333', 'Genera ingresos')";
                    $conn->exec($sql);
                    echo "Datos iniciales insertados exitosamente.<br>";
                }
                $stmt = $conn->prepare("SELECT * FROM libros");
                $stmt->execute();
                $result = $stmt->fetchAll();
                

                // Mostrar cada libro en una fila de la tabla
                foreach ($result as $row) {
                    echo "<article class='rowTable'>";
                    echo "<p class='bodyTableElement'>" . htmlspecialchars($row['nombre_libro']) . "</p>";
                    echo "<p class='bodyTableElement'>" . htmlspecialchars($row['autor']) . "</p>";
                    echo "<p class='bodyTableElement'>" . htmlspecialchars($row['isbn']) . "</p>";
                    echo "<p class='bodyTableElement'>" . htmlspecialchars($row['descripcion']) . "</p>";
                    echo "<div class='bodyTableElement'>";
                    echo "<button class='buttonDelete' data-id='" . $row['id'] . "'>Eliminar</button>";
                    echo "<button class='buttonEdit' data-id='" . $row['id'] . "'>Editar</button>";
                    echo "</div>";
                    echo "</article>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </div>
    </main>

    <!-- Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body">
                <!-- Aquí se cargará el contenido de edit_book.php -->
            </div>
        </div>
    </div>

    <script>
        // Obtener el modal y el span de cerrar
        const modal = document.getElementById("editModal");
        const closeModal = document.querySelector(".close");

        // Función para cerrar el modal
        closeModal.onclick = function() {
            modal.style.display = "none";
        }

        // Cuando el usuario hace clic fuera del modal, lo cierra
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Añadir evento de click para eliminar libros
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.buttonDelete');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bookId = this.getAttribute('data-id');
                    
                    // Enviar petición DELETE a PHP
                    if (confirm('¿Estás seguro de eliminar este libro?')) {
                        fetch(`delete_book.php?id=${bookId}`, {
                            method: 'GET'
                        })
                        .then(response => response.text())
                        .then(data => {
                            alert(data); // Mensaje de respuesta
                            window.location.reload(); // Recargar la página
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });

            // Código para el botón "Editar" usando un modal
            const editButtons = document.querySelectorAll('.buttonEdit');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bookId = this.getAttribute('data-id');
                    
                    // Abrir el modal
                    modal.style.display = "flex";

                    // Cargar el contenido de edit_book.php en el modal
                    fetch(`edit_book.php?id=${bookId}`)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById("modal-body").innerHTML = data;
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</body>
</html>
