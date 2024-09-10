<?php
$servername = "localhost";
$username = "root12";
$password = "root";
$dbname = "fsi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Preparar la sentencia SQL para eliminar el libro
        $sql = "DELETE FROM libros WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt->execute([$id])) {
            echo "Libro eliminado exitosamente";
        } else {
            echo "Error al eliminar el libro";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

