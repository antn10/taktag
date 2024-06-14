<?php 
error_reporting(E_ALL);  // Muestra todos los errores
ini_set('display_errors', 1);  // Muestra los errores en la página
session_start(); // Inicia la sesión o reanuda la sesión existente

$_SESSION = array();// Unset all session variables
// include "utils.php";
 include "form_login.php";
 include "form_foot.php";
 //echo "</div>";
?>