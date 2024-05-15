<?php
// Connect to the database
$servername = "192.168.0.20";
$username = "taktag";
$password = "taktag";
$dbname = "taktag";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch inventory data from the database
$sql = "SELECT * FROM responsables";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App de Inventario</title>
    <!-- Agrega el enlace al CSS de Bootswatch -->
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
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
                <select id="inventorySelect" class="form-select">
                    <option value="all">Inventario General</option>
                    <?php
                    // Generate options based on inventory data
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <button class="btn btn-primary" type="button">+</button>
                <button class="btn btn-danger" type="button">-</button>
                <button class="btn btn-info" type="button">o</button>
            </div>
            <div class="container mt-5">
                <table id="productTable" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Foto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productBody">
                        <!-- Product rows will be inserted here dynamically -->
                    </tbody>
                </table>
                <button class="btn btn-primary">Nuevo Producto</button>
                <?php
                include 'editproducto.php';
                ?>
            </div>
        </div>
        <!-- Agrega los scripts de Bootstrap y jQuery -->
        <script src="jquery.js"></script>
        <script src="bootstrap.min.js"></script>
        <!-- Script de JavaScript para el manejo del formulario de login -->
        <script>
            $(document).ready(function () {
                $("#loginForm").submit(function (event) {
                    event.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: "login.php", // Cambia esto a tu archivo PHP de login
                        data: formData,
                        success: function (response) {
                            if (response === "success") {
                                $("#login-form").hide();
                                $("#login-success").show();
                            } else {
                                //alert("Inicio de sesión fallido. Verifica tu usuario y contraseña.");
                            }
                        }
                    });
                });

                $("#inventorySelect").change(function () {
                    var selectedInventory = $(this).val();
                    fetchProducts(selectedInventory);
                });

                function fetchProducts(inventoryId) {
                    $.ajax({
                        type: "POST",
                        url: "fetch_products.php", // Replace with your PHP script to fetch products
                        data: { inventory_id: inventoryId },
                        success: function (response) {
                            $("#productBody").html(response);
                        }
                    });
                }
                fetchProducts('all')
            });
        </script>
    </body>
    </html>
