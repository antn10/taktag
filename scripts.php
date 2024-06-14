<script src="lib/jquery.js"></script>
<script src="lib/popper.min.js"></script>
<script src="lib/bootstrap.min.js"></script>   
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    // Handle inventory selection change
    $("#inventorySelect").change(function () {
        var selectedInventory = $(this).val();
        fetchProducts(selectedInventory);
    });

    $("#modalAdd").on("show.bs.modal", function (event) {
        var modal = $(this);
        modal.find(".modal-body input").val(""); // Clear the input field on modal open
    });


    $("#modalAdd").on("click", ".btn-primary", function () {
    var productName  = document.getElementById('editNombre').value;
    var productDesc  = document.getElementById('editDesc').value;
    var productSerie = document.getElementById('editSerie').value;
    var productMarca = document.getElementById('editMarca').value;
    var productModelo= document.getElementById('editModelo').value;
    var productClase = document.getElementById('editClase').value;
    var cant         = document.getElementById('editCant').value;
    var ingresarEn   = document.getElementById('ingresarEn').value;
    
    if (productName !== "") {
        $.ajax({
            type: "POST",
            url: "acc_add_producto.php", // PHP script to handle both checking for duplicates and adding a product
            data: { productName: productName,productDesc: productDesc,productSerie: productSerie, productMarca: productMarca,
                    productModelo: productModelo,productClase:productClase, cant:cant, ingresarEn:ingresarEn},
            success: function (response) {
                if (response === "success") {
                    window.location.reload();
                } else {
                    alert(response);
                }
            }
        });
    } 
});

function editarProducto(id,almacen,almtitulo,nomprod,maximo) {
      // Simulación de carga de datos del producto
      var nombreProducto = nomprod;
      var cantidadProducto = 1;
      // Llenar el formulario con los datos del producto
      //console.log(id,almacen,nomprod);
      document.getElementById('nombreProducto').innerText = nomprod;
      document.getElementById('enviarDesde').innerText = almtitulo;
      document.getElementById('enviarA').value = 2;
      document.getElementById('editCantidad').value = cantidadProducto;
      document.getElementById('editCantidad').max = maximo;
      //document.getElementById('enviarDesde').value=enviarDesde;
      // Mostrar el modalenviarDesde
      $('#editModal').modal('show');
}

function MoverArticulo() {
// esto es cuando le da aceptar en el dialogo de mover o transferir
    var nombreProducto = document.getElementById('enviarA').value;
    var cantidadProducto = document.getElementById('editCantidad').value;
    // Cerrar el modal
    $('#editModal').modal('hide');
}

function verifnuevo(){    
    var txtCli=document.getElementById('txtCliente');
    if (document.getElementById('selCliente').value=='-nuevo-'){
        txtCli.disabled=false;
        document.getElementById('txtCliente').focus();
    } else {
        txtCli.disabled=true;
    }
}
</script>