  <!-- Modal para editar producto -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Transferir</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editForm">
            <div class="form-group">
              <label for="editProducto">Pasar a:</label>
<select class="form-select" id="enviarA">
  <option selected>Inventario taller</option>
</select>
            </div>
            <div class="form-group">
              <label for="editCantidad">Cantidad:</label>
              <input type="number" class="form-control" id="editCantidad" name="editCantidad" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="guardarEdicion()">Guardar</button>
        </div>
      </div>
    </div>
</div>
