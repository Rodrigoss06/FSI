<?php
$servername = "localhost";
$username = "root12";
$password = "root"; // Cambia según tu configuración
$dbname = "fsi"; // Cambia según tu configuración

try {
    // Conexión a la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la tabla "usuarios" si no existe
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";
    $conn->exec($sql);

    // Verificar si la tabla está vacía
    $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios");
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();

    // Si no hay registros en la tabla, insertar datos iniciales
    if ($rowCount == 0) {
        $password1 = password_hash("123456", PASSWORD_DEFAULT);
        $password2 = password_hash("password", PASSWORD_DEFAULT);

        $sqlInsert = "INSERT INTO usuarios (nombre, email, password) VALUES
            ('Usuario 1', 'usuario1@example.com', :password1),
            ('Usuario 2', 'usuario2@example.com', :password2)";

        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->execute([
            ':password1' => $password1,
            ':password2' => $password2
        ]);

        echo "Datos iniciales insertados.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
