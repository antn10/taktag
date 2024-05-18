<?php
// Database configuration
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

// Check if the product name is provided via POST request
if(isset($_POST['productName']) && !empty($_POST['productName'])) {
    $productName = $_POST['productName'];

    // Escape the product name to prevent SQL injection
    $productName = $conn->real_escape_string($productName);

    // Check if the product already exists
    $sql = "SELECT p.id, p.nombre AS product_name
        FROM articulos p 
        INNER JOIN cantidades_detallada cd ON p.id = cd.articulo 
        WHERE p.nombre = '$productName'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        // Product already exists, return error
        echo "exists";
    } else {
        // Product doesn't exist, proceed to add it
        $sql = "INSERT INTO cantidades_detallada (nombre, cantidad) VALUES ('$productName', 10)";
        if($conn->query($sql) === TRUE) {
            // Product added successfully
            echo "success";
        } else {
            // Error while adding product
            echo "error";
        }
    }
} else {
    // Product name not provided in the request
    echo "invalid";
}

// Close the database connection
$conn->close();
?>
