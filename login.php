<?php
error_reporting(E_ALL);  // Muestra todos los errores
ini_set('display_errors', 1);  // Muestra los errores en la página

session_start(); // Inicia la sesión o reanuda la sesión existente

// Verifica si ya hay una sesión activa (el usuario está ya logueado)
if (isset($_SESSION['username'])) {
    echo "success"; // El usuario ya está logueado
    exit; // Termina el script para evitar procesamiento adicional
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Consulta para verificar el usuario y contraseña
    $sql = "SELECT * FROM responsables WHERE nombre='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Verifica si se encontró un usuario con esa combinación
    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        $_SESSION['username'] = $username; // Guarda el nombre de usuario en la sesión
        echo "success";
    } else {
        // Inicio de sesión fallido
        echo "error";
    }

    // Cierra la conexión
    $conn->close();
}
?>
