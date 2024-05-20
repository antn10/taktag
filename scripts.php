<script src="lib/jquery.js"></script>
<script src="lib/popper.min.js"></script>
<script src="lib/bootstrap.min.js"></script>   
<script>
    // Handle inventory selection change
    $("#inventorySelect").change(function () {
        var selectedInventory = $(this).val();
        fetchProducts(selectedInventory);
    });

    // Function to fetch products
    function fetchProducts(inventoryId) {
        $.ajax({
            type: "POST",
            url: "actions/fetch_products.php", // Replace with your PHP script to fetch products
            data: { inventory_id: inventoryId },
            success: function (response) {
                $("#productBody").html(response);
            }
        });
    }
    $("#nuevoModal").on("show.bs.modal", function (event) {
        var modal = $(this);
        modal.find(".modal-body input").val(""); // Clear the input field on modal open
    });

    $("#nuevoModal").on("click", ".btn-primary", function () {
    var productName = $("#nuevoModal").find(".modal-body input").val().trim();
    if (productName !== "") {
        // Check if product name already exists
        $.ajax({
            type: "POST",
            url: "actions/check_product.php", // PHP script to handle both checking for duplicates and adding a product
            data: { productName: productName },
            success: function (response) {
                if (response === "exists") {
                } else if (response === "success") {
                    // Product added successfully, close modal and update inventory
                    $("#nuevoModal").modal("hide");
                    fetchProducts('all');
                } else {
                }
                alert(response);
            }
        });
    } else {
        alert("Ingresa un nombre de producto válido.");
    }
});

               function editarProducto(id) {
      // Simulación de carga de datos del producto
      var nombreProducto = "Producto " + id;
      var cantidadProducto = 1;
      // Llenar el formulario con los datos del producto
      document.getElementById('enviarA').value = nombreProducto;
      document.getElementById('editCantidad').value = cantidadProducto;
      // Mostrar el modal
      $('#editModal').modal('show');
    }

    function guardarEdicion() {
      // Aquí puedes obtener los valores del formulario y realizar las acciones necesarias
      var nombreProducto = document.getElementById('enviarA').value;
      var cantidadProducto = document.getElementById('editCantidad').value;

      // Simplemente alertamos los valores para este ejemplo
      //alert("Producto editado:\nNombre: " + nombreProducto + "\nCantidad: " + cantidadProducto);

      // Aquí podrías enviar los datos del formulario a tu backend mediante una petición AJAX
      // Y actualizar la tabla o realizar otras acciones según sea necesario

      // Cerrar el modal
      $('#editModal').modal('hide');
    }
</script>