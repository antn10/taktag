<?php
include "utils.php";

// Check if the product name exists in the database
$productName = $_POST['productName'];

$sql = "SELECT * FROM articulos WHERE nombre = '$productName'";
$result = qry($sql);

if ($result->num_rows > 0) {
    // Product with the same name already exists
    echo "exists";
} else {
    // Product doesn't exist
    echo "success";
}
?>
