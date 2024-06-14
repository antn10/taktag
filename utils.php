<?php
error_reporting(E_ALL);  // Muestra todos los errores
ini_set('display_errors', 1);  // Muestra los errores en la página
session_start(); // Inicia la sesión o reanuda la sesión existente
if (!isset($_SESSION['username'])) {     
    echo "ir a login";
    exit;
    //header('Location: login.php');
} 

function conectar() {
    $servername = "192.168.0.20"; $username = "taktag";
    $password = "taktag";         $dbname = "taktag";
    // Create connection
    global $conn;
    $conn= new mysqli($servername, $username, $password, $dbname);    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }    
}
function con(){
    global $conn; // si está cerrada abre de nuevo    
    return $conn;
}

function qry($sql){
    // si la conexión está cerrada, vuelve a abrir
    $c=con(); if(!isset($c->server_info)) {conectar();}
    $result = con()->query($sql);
    return $result;  
}

function hay1($sql){ return (qry($sql)->num_rows == 1);}
function trae($sql){ 
    $row = mysqli_fetch_array(qry($sql));
    if ($row)
        return $row[0];
    else   
        return '';
}

function obtener($conexion, $query, $params) {
    $c=con(); if(!isset($c->server_info)) {conectar();}
    // Preparar la declaración
    $stmt = $c->prepare($query);
    if ($stmt === false) {
        die("Error en la preparación de la declaración: " . $c->error);
    }
    // Construir los tipos de datos para bind_param
    $types = "";
    $values = [];
    foreach ($params as $param) {
        if (is_int($param)) {
            $types .= "i";
        } elseif (is_double($param)) {
            $types .= "d";
        } elseif (is_string($param)) {
            $types .= "s";
        } else {
            $types .= "b";
        }
        $values[] = $param;
    }

    // Obtener el resultado
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $stmt->close();
    // Retornar las filas
    return $resultado;
}

function AddOptions($result,$selected){
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($selected==$row['id']){
        echo "<option selected value='" . $row['id'] . "'>". 
        $row['nombre'] . "</option>";
      } else {
        echo "<option value='" . $row['id'] . "'>". 
        $row['nombre'] . "</option>";
      }
    }
  }
}

function QryOptions($qry,$selected){
// hace una query y carga un select con el contenido
    $result = qry($qry);
    AddOptions($result,$selected);
}

function QryTabla($qry,$valores,$htmlbuttons,$link) {
// generar una tabla en base al resultado
    // Iniciar la tabla
    $result = qry($qry); 
    $tablaHTML = "<table class='table table-striped table-bordered'>";
    $columnas = $result->fetch_fields(); 
    $tablaHTML .= "<tr>";
    foreach ($columnas as $columna) {
        $tablaHTML .= "<th>" . htmlspecialchars($columna->name) . "</th>";
    }
    if ($htmlbuttons!="")
        $tablaHTML .= "<th></th>";

    $tablaHTML .= "</tr>";
    // Obtener las filas de resultados
    while ($fila = $result->fetch_assoc()) {
        $tablaHTML .= "<tr>";        
        $htmlbuttonsCopy = $htmlbuttons;
        $linkcopy=$link;
        if ($link=='') { foreach ($fila as $valor)
            $tablaHTML .= "<td>" . htmlspecialchars($valor) . "</a></td>";
        } else {
            foreach ($fila as $valor) {
                foreach ($valores as $value) 
                    $linkcopy = str_replace("%$value%",$fila[$value],$linkcopy);
                $tablaHTML .= "<td><a href=" . $linkcopy . ">" . htmlspecialchars($valor) . "</a></td>";
        }}
        if ($htmlbuttons!=""){
            foreach ($valores as $value) {                
                $htmlbuttonsCopy = str_replace('%' . $value . '%',$fila[$value],$htmlbuttonsCopy);
            }
            $tablaHTML .= "<td>" . $htmlbuttonsCopy . "</td>";
        }

        $tablaHTML .= "</tr>";
    }
    // Cerrar la tabla
    $tablaHTML .= "</table>";
    echo $tablaHTML;
}

conectar();
?>