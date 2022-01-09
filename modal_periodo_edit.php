<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar periodo</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre_edit">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="actual" id="actual_edit">
                    <label class="form-check-label" for="actual">
                        Actual
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" id="actualizar">Guardar</a>
            </div>
        </div>
    </div>
</div>