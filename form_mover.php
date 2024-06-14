  <!-- Modal para mover producto -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Mover</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editForm">
            <div class="input-group mb-3">                        
              <span class="input-group-text">Producto</span>              
              <span class="input-group-text" id="nombreProducto"></span>            
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Desde</span>
              <span class="input-group-text" id="enviarDesde"></span>

              <span class="input-group-text">pasar a</span>              
              <select class="form-select" id="enviarA">
                <?php QryOptions('SELECT id,nombre FROM almacenes',0);?>
              </select>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">cantidad</span>              
              <input type="number" class="form-control" id="editCantidad" name="editCantidad" min="1" max="1" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">          
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="MoverArticulo()">Guardar</button>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function(){ 
    $('#daterange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "Desde",
            toLabel: "Hasta",
            customRangeLabel: "Personalizado",
            daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            firstDay: 1
        }
      });
  },false);
</script>