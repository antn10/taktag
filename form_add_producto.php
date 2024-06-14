<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddlbl"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddlbl">añadir nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>            
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" class="form-control" name="editNombre" id="editNombre" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Descripción</span>
                    <textarea class="form-control" id="editDesc" rows="3"></textarea>
                </div>
                <div><input class="form-control" type="file" id="formFile" ></div>
                <br>
                <div class="input-group mb-3">
                    <span class="input-group-text">Serie</span>
                    <input type="text" class="form-control" id="editSerie" required>
                    <button class="btn btn-primary" type="button" id="button-addon2">...</button>

                    <span class="input-group-text">Marca</span>
                    <input type="text" class="form-control" id="editMarca" required>
                    <button class="btn btn-primary" type="button" id="button-addon2">...</button>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Modelo</span>
                    <input type="text" class="form-control" id="editModelo" required>
                    <button class="btn btn-primary" type="button" id="button-addon2">...</button>

                    <span class="input-group-text">Clase</span>
                    <select class="form-select" id="editClase">
                        <?php QryOptions('SELECT id,titulo nombre FROM clasificacion ORDER BY id',$alm);?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">cantidad</span>
                    <input type="number" class="form-control" id="editCant" required>
                    <span class="input-group-text">ingresar en</span>
                    <select class="form-select" id="ingresarEn">
                        <?php QryOptions('SELECT id,nombre FROM almacenes WHERE tipo="A"',$alm);?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>
