<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar estudiante</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nº de Cédula</label>
                    <input type="number" class="form-control" id="cedula">
                </div>
                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" class="form-control" id="nombres">
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" id="apellidos">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" id="guardar">Guardar</a>
            </div>
        </div>
    </div>
</div>