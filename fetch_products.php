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

// Get the selected inventory ID
$inventoryId = $_POST['inventory_id'];

// Construct the SQL query to fetch product details including product name by joining productos table
$sql = "SELECT p.id, p.nombre AS product_name, 
               SUM(cd.cantidad) AS total_quantity
        FROM articulos p 
        INNER JOIN cantidades_detallada cd ON p.id = cd.articulo";

// If a specific inventory is selected, add a WHERE clause to filter products by inventory
if ($inventoryId != 'all') {
    $sql .= " WHERE cd.responsable = $inventoryId";
}

// Group by product ID and name to aggregate quantities
$sql .= " GROUP BY p.id, p.nombre";

// Execute the query
$result = $conn->query($sql);

// Check if the query was executed successfully
if ($result) {
    // Generate HTML markup for table rows
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['total_quantity'] . "</td>";
            echo "<td></td>"; // Assuming photo column
            echo "<td>";
            echo "<button class='btn btn-warning btn-sm' onclick='editarProducto(" . $row['id'] . ")'>transferir</button>";
            echo "<button class='btn btn-info btn-sm'>editar</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No products found for the selected inventory.</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Error executing query: " . $conn->error . "</td></tr>";
}

// Close the database connection
$conn->close();
?>
