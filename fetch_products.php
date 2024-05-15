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

// Fetch products associated with the selected inventory
$sql = "SELECT * FROM cantidades_detallada WHERE responsable = $inventoryId"; // Assuming the column name is responsable_id
if ($inventoryId == 'all') {
    // If "General" is selected, fetch all products
    $sql = "SELECT * FROM cantidades_detallada";
} else {
    // Fetch products associated with the selected inventory
    $sql = "SELECT * FROM cantidades_detallada WHERE responsable = $inventoryId";
}
$result = $conn->query($sql);

// Check if the query was executed successfully
if ($result) {
    // Generate HTML markup for table rows
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['cantidad'] . "</td>";
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
    echo "<tr><td colspan='5'>Error fetching products: " . $conn->error . "</td></tr>";
}

// Close the database connection
$conn->close();
?>
