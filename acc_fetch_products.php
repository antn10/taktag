<?php error_reporting(E_ALL);  // Muestra todos los errores
// Get the selected inventory ID
if (isset($_GET['alm'])) { $inventoryId = $_GET['alm'];} 
else {$inventoryId = 'all';}
// Construct the SQL query to fetch product details including product name by joining productos table
$sql = "SELECT p.id, p.nombre AS producto, SUM(cd.cantidad) AS cantidad
        FROM articulos p 
        INNER JOIN elementos ele ON p.id = ele.art";
if ($inventoryId != 'all') { $sql .= " WHERE cd.responsable = $inventoryId"; }
$sql .= " GROUP BY p.id, p.nombre";
$htmlButton = "<button class='btn btn-info' style='font-size:10px' 
                onclick=\"editarProducto(%id%,'$inventoryId','$tit','%producto%',%cantidad%)\">
                Mover <i class='fas fa-sign-out-alt'></i></button>

                <button class='btn btn-secondary' style='font-size:10px' 
                onclick=\"comprarProducto(%id%,'$inventoryId','$tit','%producto%',%cantidad%)\">
                Comprar <i class='fas fa-file-import'></i></button>";
QryTabla($sql,['id','producto','cantidad'],$htmlButton,'');

// Close the database connection
$conn->close();
?>
