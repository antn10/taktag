<?php
error_reporting(E_ALL);  // Muestra todos los errores
ini_set('display_errors', 1);  // Muestra los errores en la página

// Verifica si se ha enviado el formulario
    // Conexión a la base de datos (cambia estos valores según tu configuración)
    $servername = "192.168.0.20";
    $username = "taktag";
    $password = "taktag";
    $dbname = "taktag";

    // Crea la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Escapa los valores para prevenir inyecciones de SQL
    $username = "pepe";
    $password = "papa";

    // Consulta para verificar el usuario y contraseña
    $sql = "SELECT * FROM responsables WHERE nombre='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Verifica si se encontró un usuario con esa combinación
    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        echo "success";
    } else {
        // Inicio de sesión fallido
        echo "error " . $result->num_rows;
    }

    // Cierra la conexión
    $conn->close();
?>
