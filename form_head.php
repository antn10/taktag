<?php 
error_reporting(E_ALL);  // Muestra todos los errores
ini_set('display_errors', 1);  // Muestra los errores en la página
session_start(); // Inicia la sesión o reanuda la sesión existente
if (!isset($_SESSION['username'])) {     
    //echo 'no logueada redirigir';
    header('Location: login.php');
} 
include 'utils.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TakTag</title>
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include 'form_navbar.php';?>
    <div class="container mt-5">