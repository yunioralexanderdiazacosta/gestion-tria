<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar profesor</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                <input type="hidden" id="actual">
                <div class="form-group">
                    <label>Nº de Cédula</label>
                    <input type="number" class="form-control" id="cedula_edit" onchange="validate_edit(this.value)">
                </div>
                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" class="form-control" id="nombres_edit">
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" id="apellidos_edit">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" id="actualizar">Guardar</a>
            </div>
        </div>
    </div>
</div>