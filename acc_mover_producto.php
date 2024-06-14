<?php
include_once "utils.php";

// Check if the product name is provided via POST request
if(isset($_POST['productName']) && !empty($_POST['productName'])) {
    $productName  = $_POST['productName'];
    $productDesc  = $_POST['productDesc'];
    $productSerie = $_POST['productSerie'];
    $productMarca = $_POST['productMarca'];
    $productModelo= $_POST['productModelo'];
    $productClase = $_POST['productClase'];
    $cant         = $_POST['cant'];
    $ingresarEn   = $_POST['ingresarEn'];
    // Escape the product name to prevent SQL injection
    $productName = $conn->real_escape_string($productName);
    $conn->beginTransaction();

    // Check if the product already exists
    $sql = "SELECT p.id, p.nombre AS product_name
        FROM articulos p 
        WHERE p.nombre = '$productName'";

    $result =qry($sql);
    if($result->num_rows > 0) {        
        echo "ya existe con ese nombre";
    } else {
        // Product doesn't exist, proceed to add it
        $sql = "INSERT INTO articulos (nombre,descripcion,serie,marca,modelo,clase)  
                VALUES ('$productName','$productDesc','$productSerie','$productMarca','$productModelo','$productClase')";
        if($conn->query($sql) === TRUE) {
            // Product added successfully
            $ultimo_id = $conn->insert_id;            
            if(is_numeric($cant) && is_numeric($ingresarEn)) {                
                if ($cant>0) {
                    $sql = "INSERT INTO cantidades_detallada (articulo,responsable,cantidad) 
                            VALUES ($ultimo_id,$ingresarEn,$cant)";
                    if($conn->query($sql)===TRUE){
                        $conn->commit();
                        echo "success";
                    } else {
                        $conn->rollBack();
                        echo "error no pudo insertar cantidades";
                    }
                }
            } else {
                $conn->commit();
                echo "success";
            }
        } else {
            // Error while adding product
            echo "error";
            $conn->rollBack();
        }
    }
} else {
    // Product name not provided in the request
    echo "invalid";    
}
// Close the database connection
$conn->close();
?>
