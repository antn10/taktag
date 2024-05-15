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
            <button id="logoutButton" class="btn btn-danger">Cerrar sesión</button>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal">
                    +
                </button>

                <!-- Modal -->
                <div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="nuevoModalLabel">añadir nuevo producto</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input></input>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                // Check if the user is already logged in
                $.ajax({
                    type: "POST",
                    url: "login.php", // Replace with your PHP script to check login status
                    success: function (response) {
                        if (response === "success") {
                            // If the user is logged in, hide the login form and show the inventory
                            $("#login-form").hide();
                            $("#login-success").show();

                            // Fetch products for 'all' inventory
                            fetchProducts('all');
                        }
                    }
                });

                // Handle form submission
                $("#loginForm").submit(function (event) {
                    event.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: "login.php",
                        data: formData,
                        success: function (response) {
                            if (response === "success") {
                                // If login is successful, hide the login form and show the inventory
                                $("#login-form").hide();
                                $("#login-success").show();

                                // Store the username in local storage
                                localStorage.setItem('username', $("#username").val());

                                // Fetch products for 'all' inventory
                                fetchProducts('all');
                            } else {
                                alert("Inicio de sesión fallido. Verifica tu usuario y contraseña.");
                            }
                        }
                    });
                });
                $("#logoutButton").click(function () {
                    // Perform logout operation
                    $.ajax({
                        type: "POST",
                        url: "logout.php", // Replace with your PHP script to handle logout
                        success: function (response) {
                            if (response === "success") {
                                // If logout is successful, reload the page to show the login form
                                location.reload();
                            } else {
                                alert("Error al cerrar sesión.");
                            }
                        }
                    });
                });

                // Handle inventory selection change
                $("#inventorySelect").change(function () {
                    var selectedInventory = $(this).val();
                    fetchProducts(selectedInventory);
                });

                // Function to fetch products
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
                $("#nuevoModal").on("show.bs.modal", function (event) {
                    var modal = $(this);
                    modal.find(".modal-body input").val(""); // Clear the input field on modal open
                });

                $("#nuevoModal").on("click", ".btn-primary", function () {
    var productName = $("#nuevoModal").find(".modal-body input").val().trim();
    if (productName !== "") {
        // Check if product name already exists
        $.ajax({
            type: "POST",
            url: "add_producto.php", // PHP script to handle both checking for duplicates and adding a product
            data: { productName: productName },
            success: function (response) {
                if (response === "exists") {
                } else if (response === "success") {
                    // Product added successfully, close modal and update inventory
                    $("#nuevoModal").modal("hide");
                    fetchProducts('all');
                } else {
                }
                alert(response);
            }
        });
    } else {
        alert("Ingresa un nombre de producto válido.");
    }
});

            });
        </script>
</body>

</html>