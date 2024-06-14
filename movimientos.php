<?php 
//error_reporting(E_ALL); 
include 'form_head.php';
//obtiene el nombre del almacen
$alm=0; if (isset($_GET['alm'])) { if (is_numeric($_GET['alm'])) {
    $alm=$_GET['alm'];
    $tit = trae('select nombre from almacenes where id=' . $_GET['alm']);
} else $tit='general';} else {$tit = 'general';}

$sql = "SELECT id,nombre FROM almacenes a ORDER BY id";
$htmlButton = "<button class='btn btn-info' style='font-size:10px' 
                onclick=\"editarProducto(%id%,'%nombre%)\">
                usuario <i class='fas fa-sign-out-alt'></i></button>";
echo "<h1 id=\"productTitle\">Movimientos</h1>";
QryTabla($sql,['id','nombre'],$htmlButton,'');
?>
<div class="form-check form-switch">
<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
<label class="form-check-label" for="flexSwitchCheckChecked">ver vacíos</label>
</div>
<div class="input-group mb-3" >
    <button class="btn btn-primary" type="button"
    data-bs-toggle="modal" 
    data-bs-target="#modalAdd">nuevo +</button>&nbsp;
    <!--<div class="btn-group" role="group" aria-label="Basic radio toggle button group">-->
      <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked="">
      <label class="btn btn-outline-warning" for="btnradio1">almacenes</label>
      <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" checked="">
      <label class="btn btn-outline-warning" for="btnradio2">usuarios</label>
      <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" checked="">
      <label class="btn btn-outline-warning" for="btnradio3">clientes</label>    
</div>

<?php include 'form_add_producto.php';?>
<?php include 'form_mover.php';?>
</div> 

</div>
<?php include 'scripts.php';?>
<?php include 'form_foot.php';?>