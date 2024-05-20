<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TakTag</title>
    <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">

<div id="login-form">
    <h1>Inicio de sesión</h1>
    <form id="loginForm" method="post" action="acc_dologin.php">
        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
</div>