<?php 
//error_reporting(E_ALL); 
include 'form_head.php';
//obtiene el nombre del almacen
$prod=0; if (isset($_GET['prod'])) { if (is_numeric($_GET['prod'])) {
    $prod=$_GET['prod'];
    $tit = trae('select nombre from articulos where id=' . $_GET['prod']);
} else $tit='general';} else {$tit = 'general';}

$sql = "select a.id, a.nombre, count(ele.serie) cant
            from elementos ele 
            inner join almacenes a on ele.almacen=a.id
            where ele.art=$prod 
            group by a.id, a.nombre
        union 
            select 'all','general', count(ccd.id) from elementos ccd
            where ccd.art=$prod";

$htmlButton = "<button class='btn btn-info' style='font-size:10px' 
                onclick=\"editarProducto(%id%,'%nombre%)\">
                usuario <i class='fas fa-sign-out-alt'></i></button>";
?>    
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
      <?php echo $tit;?>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" 
        data-bs-parent="#accordionExample" style="">
        <div class="accordion-body">
            <div class="input-group mb-3 disabled"><span class="input-group-text">Nombre</span>
                <input type="text" class="form-control" name="editNombre" id="editNombre" required>
            </div>
            <div class="input-group mb-3 disabled"><span class="input-group-text">Descripción</span>
                <textarea class="form-control" id="editDesc" rows="3" ></textarea>
            </div>
            <div><input class="form-control" type="file" id="formFile" ></div>
            <br>
            <div class="input-group mb-3 disabled">
                <span class="input-group-text">Serie</span>
                <input type="text" class="form-control" id="editSerie" required >
                <button class="btn btn-primary" type="button" id="button-addon2">...</button>

                <span class="input-group-text">Marca</span>
                <input type="text" class="form-control" id="editMarca" required >
                <button class="btn btn-primary" type="button" id="button-addon2">...</button>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Modelo</span>
                <input type="text" class="form-control" id="editModelo" required >
                <button class="btn btn-primary" type="button" id="button-addon2">...</button>

                <span class="input-group-text">Clase</span>
                <select class="form-select" id="editClase" >
                    <?php QryOptions('SELECT id,titulo nombre FROM clasificacion ORDER BY id',$alm);?>
                </select>
            </div>        
            <div class="input-group mb-3" >
                <button class="btn btn-primary" type="button">guardar</button>&nbsp;
            </div>
        </div>
    </div>
</div>
</div>
<BR>
<?php
echo "<h4>cant de $tit por almacen</h4>";
QryTabla($sql,['id','nombre'],$htmlButton,'inventario.php?alm=%id%');
?>
<h4>lista de artículos</h4>
<form method="GET">
<?php $sql = "select al.id, serie, descripcion, al.nombre almacen from elementos ele 
                inner join almacenes al on ele.almacen=al.id 
              where art=$prod ";
    $htmlButton = "<input class=\"form-check-input\" type=\"checkbox\" name=\"chkart%id%\">";
    QryTabla($sql,['id','serie','descripcion'],$htmlButton,'');
    
    include 'form_add_producto.php';
    include 'form_mover.php';
?>
    <div class="input-group mb-3" >
        <label class="form-label">mover hacia </label>
        <select class="form-select" name="ubic">
            <?php QryOptions('SELECT id,nombre FROM almacenes ORDER BY id',$alm);?>
        </select>&nbsp;
        <button class="btn btn-primary" type="submit" >mover</button>
    </div>
    </form>
</div>
</div>
<?php 
include 'scripts.php';
include 'form_foot.php';
?>