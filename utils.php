<?php
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
    return $row[0];
}
conectar();


?>