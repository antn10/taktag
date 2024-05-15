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

// Check if the product name exists in the database
$productName = $_POST['productName'];

$sql = "SELECT * FROM products WHERE nombre = '$productName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Product with the same name already exists
    echo "exists";
} else {
    // Product doesn't exist
    echo "success";
}

// Close the database connection
$conn->close();
?>
