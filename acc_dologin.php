<?php
error_reporting(E_ALL);  // Muestra todos los errores
ini_set('display_errors', 1);  // Muestra los errores en la página
session_start(); // Inicia la sesión o reanuda la sesión existente
include 'utils.php';
// Verifica si ya hay una sesión activa (el usuario está ya logueado)
if (isset($_SESSION['username'])) {//echo 'ya logueado';
    //header('Location: index.php');
   // exit; // Termina el script para evitar procesamiento adicional
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos (cambia estos valores según tu configuración)
    include "acc_connect.php";

    // Escapa los valores para prevenir inyecciones de SQL
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Consulta para verificar el usuario y contraseña
    $sql = "SELECT * FROM responsables WHERE nombre='$username' AND password='$password'";
    $result = con()->query($sql);    

    // Verifica si se encontró un usuario con esa combinación
    if (hay1($sql)) {
        $_SESSION['username'] = $username; // Guarda el nombre de usuario en la sesión
        header('Location: index.php');
    } else {
        // Inicio de sesión fallido
        header('Location: login.php');
    }    
}
?>
