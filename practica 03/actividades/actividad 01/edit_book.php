<?php
$servername = "localhost";
$username = "root12";
$password = "root";
$dbname = "fsi";

try {
    // Conectar a la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Obtener los detalles del libro
        $stmt = $conn->prepare("SELECT * FROM libros WHERE id = ?");
        $stmt->execute([$id]);
        $book = $stmt->fetch();

        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre_libro = $_POST['nombre_libro'] ?? '';
            $autor = $_POST['autor'] ?? '';
            $isbn = $_POST['isbn'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';

            // Asegurarse de que los datos no estén vacíos
            if (!empty($nombre_libro) && !empty($autor) && !empty($isbn) && !empty($descripcion)) {
                // Actualizar el libro
                $update_stmt = $conn->prepare("UPDATE libros SET nombre_libro = ?, autor = ?, isbn = ?, descripcion = ? WHERE id = ?");
                $update_stmt->execute([$nombre_libro, $autor, $isbn, $descripcion, $id]);

                echo "<script>window.location.href = 'index.php';</script>"; // Redirigir a la página principal
                exit();
            } else {
                echo "Por favor, completa todos los campos.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<h1 class="form-title">Editar Libro</h1>
<form method="POST" class="edit-form" action="edit_book.php?id=<?php echo $id; ?>">
    <label for="nombre_libro" class="form-label">Nombre del Libro</label><br>
    <input type="text" name="nombre_libro" id="nombre_libro" class="form-input" value="<?php echo htmlspecialchars($book['nombre_libro']); ?>"><br><br>
    
    <label for="autor" class="form-label">Autor</label><br>
    <input type="text" name="autor" id="autor" class="form-input" value="<?php echo htmlspecialchars($book['autor']); ?>"><br><br>
    
    <label for="isbn" class="form-label">ISBN</label><br>
    <input type="text" name="isbn" id="isbn" class="form-input" value="<?php echo htmlspecialchars($book['isbn']); ?>"><br><br>
    
    <label for="descripcion" class="form-label">Descripción</label><br>
    <textarea name="descripcion" id="descripcion" class="form-textarea"><?php echo htmlspecialchars($book['descripcion']); ?></textarea><br><br>
    
    <button type="submit" class="edit-button">Guardar Cambios</button>
</form>
