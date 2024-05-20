<?php 
//error_reporting(E_ALL); 
include 'form_head.php';
$tit = trae('select nombre from responsables where id=1');
?>
<h1 id="productTitle">Inventario <?php echo $tit;?></h1>
<table id="productTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>#</th><th>Producto</th><th>Cantidad</th>
            <th>Foto</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody id="productBody">
<?php include 'acc_fetch_products.php';?>        
    </tbody>
</table>

<div class="input-group mb-3" >
    <button class="btn btn-primary" type="button"
    data-bs-toggle="modal" 
    data-bs-target="#nuevoModal">Agregar</button>
    <button class="btn btn-danger" type="button">-</button>
    <button class="btn btn-info" type="button">o</button>
</div>
<?php include 'form_add_producto.php';?>                
<?php include 'form_transferir.php';?>
</div>
</div>
<?php include 'scripts.php';?>        
<?php include 'form_foot.php';?>