<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App de Inventario</title>
  <!-- Agrega el enlace al CSS de Bootswatch -->
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<style>
    /* Estilos adicionales para el select */
    .custom-select {
      appearance: none;
      -moz-appearance: none;
      -webkit-appearance: none;
      background-color: ; /* Color de fondo */
      border: 1px solid #ced4da; /* Borde */
      padding: 0.375rem 1.75rem 0.375rem 0.75rem; /* Espaciado interno */
      font-size: 1rem; /* Tamaño de fuente */
      line-height: 1.5; /* Altura de línea */
      border-radius: 0.25rem; /* Bordes redondeados */
    }
    /* Estilos adicionales para el botón desplegable */
    .custom-select::-ms-expand {
      display: none;
    }
    /* Estilo cuando se enfoca */
    .custom-select:focus {
      border-color: #80bdff; /* Color del borde al enfocar */
      outline: 0; /* Elimina el resaltado predeterminado */
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Sombra al enfocar */
    }
  </style>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Inventario</h1>
    <div id="login-form">
    <p class="text-success">Inicio de sesión</p>
      <form id="loginForm">
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
    <div id="login-success" style="display: none;">
      <p class="text-success">Inventario general</p>
      <div class="input-group mb-3">
      <select class="form-select"><option>Inventario General</option>
      <option>Inventario Pepe</option>
      <option>Inventario taller</option>
      </select>
      <button class="btn btn-primary" type="button">+</button>
      <button class="btn btn-danger" type="button">-</button>
      <button class="btn btn-info" type="button">o</button>
    </div>
        
      <div class="container mt-5">
    <table class="table table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Foto</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td><td>Producto 1</td>
          <td>10</td><td></td>
          <td><button class="btn btn-warning btn-sm" onclick="editarProducto(1)">transferir</button>
              <button class="btn btn-info btn-sm">editar</button></td>
        </tr>
        <tr>
          <td>2</td><td>Producto 2</td>
          <td>20</td><td></td>
          <td><button class="btn btn-warning btn-sm" onclick="editarProducto(2)">transferir</button>
              <button class="btn btn-info btn-sm">editar</button></td>
        </tr>
        <!-- Agrega más filas según sea necesario -->
      </tbody>
    </table>

    <button class="btn btn-primary">Nuevo Producto</button>  
    <?php
      include 'editproducto.php';
    ?>
  </div>

  <!-- Agrega los scripts de Bootstrap y jQuery -->
  <script src="jquery.js"></script>
  <script src="bootstrap.min.js"></script>

  <!-- Script de JavaScript para el manejo del formulario de login -->
  <script>
    $(document).ready(function() {
      $("#loginForm").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "login.php", // Cambia esto a tu archivo PHP de login
          data: formData,
          success: function(response) {
            if (response === "success") {
              $("#login-form").hide();
              $("#login-success").show();
            } else {
              //alert("Inicio de sesión fallido. Verifica tu usuario y contraseña.");
            }
          }
        });
      });
    });

    function editarProducto(id) {
      // Simulación de carga de datos del producto
      var nombreProducto = "Producto " + id;
      var cantidadProducto = 1;
      // Llenar el formulario con los datos del producto
      document.getElementById('enviarA').value = nombreProducto;
      document.getElementById('editCantidad').value = cantidadProducto;
      // Mostrar el modal
      $('#editModal').modal('show');
    }

    function guardarEdicion() {
      // Aquí puedes obtener los valores del formulario y realizar las acciones necesarias
      var nombreProducto = document.getElementById('enviarA').value;
      var cantidadProducto = document.getElementById('editCantidad').value;

      // Simplemente alertamos los valores para este ejemplo
      //alert("Producto editado:\nNombre: " + nombreProducto + "\nCantidad: " + cantidadProducto);

      // Aquí podrías enviar los datos del formulario a tu backend mediante una petición AJAX
      // Y actualizar la tabla o realizar otras acciones según sea necesario

      // Cerrar el modal
      $('#editModal').modal('hide');
    }

  </script>
</body>
</html>
