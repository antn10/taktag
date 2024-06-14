<?php 
//error_reporting(E_ALL); 
include 'form_head.php';
//obtiene el nombre del almacen
$alm=0; if (isset($_GET['alm'])) { if (is_numeric($_GET['alm'])) {
    $alm=$_GET['alm'];
    $tit = trae('select nombre from almacenes where id=' . $_GET['alm']);
} else $tit='general';} else {$tit = 'general';}
if (isset($_GET['alm'])) { $inventoryId = $_GET['alm'];} 
else {$inventoryId = 'all';}
// Construct the SQL query to fetch product details including product name by joining productos table
$sql = "SELECT p.id, p.nombre AS producto, cl.titulo, count(ele.id) AS cantidad
        FROM articulos p 
        INNER JOIN elementos ele ON p.id = ele.art
        inner join clasificacion cl on ele.clase = cl.id";
if ($inventoryId != 'all') { $sql .= " WHERE ele.almacen = $inventoryId"; }
$sql .= " GROUP BY p.id, p.nombre, cl.titulo";
$htmlButton = "<button class='btn btn-info' style='font-size:10px' 
                onclick=\"editarProducto(%id%,'$inventoryId','$tit','%producto%',%cantidad%)\">
                Mover <i class='fas fa-sign-out-alt'></i></button>

                <button class='btn btn-secondary' style='font-size:10px' 
                onclick=\"comprarProducto(%id%,'$inventoryId','$tit','%producto%',%cantidad%)\">
                Comprar <i class='fas fa-file-import'></i></button>";
echo "<h1 id=\"productTitle\">Inventario $tit</h1>";
QryTabla($sql,['id','producto','cantidad'],$htmlButton,'articulo.php?prod=%id%');

if($alm<>0){
    echo "<h4 id=\"productTitle\">items $tit</h4>";
    $sql = "select ele.id, ar.nombre, ele.serie, ele.descripcion  
            from elementos ele inner join articulos ar on ele.art = ar.id
            where ele.almacen=$alm ";
    $htmlButton = "<input class=\"form-check-input\" type=\"checkbox\" name=\"chkart%id%\">";
    QryTabla($sql,['id','nombre','serie'],$htmlButton,'');
}
?>
<!-- botones de accion -->
<div class="input-group mb-3" >
    <button class="btn btn-primary" type="button"
    data-bs-toggle="modal" 
    data-bs-target="#modalAdd">Agregar +</button>
    <button class="btn btn-danger" type="button">-</button>
    <button class="btn btn-info" type="button">o</button>
</div>
<?php include 'form_add_producto.php';?>
<?php include 'form_mover.php';?>
</div> 

</div>
<?php include 'scripts.php';?>
<?php include 'form_foot.php';?>