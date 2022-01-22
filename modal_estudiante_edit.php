<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar estudiante</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                <div class="form-group">
                    <label>Nº de Cédula</label>
                    <input type="number" class="form-control" id="cedula_edit">
                </div>
                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" class="form-control" id="nombres_edit">
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" id="apellidos_edit">
                </div>
                <div class="form-group">
                    <label>Carrera</label>
                    <select class="form-control" id="carrera_edit">
                        <option value="">Seleccione</option>
                        <?php
                        $sql_carrera = $con->query("SELECT * FROM carreras ORDER BY codigo");
                        while($row_carrera = mysqli_fetch_assoc($sql_carrera)){
                        ?>
                            <option value="<?php echo $row_carrera['id'] ?>"><?php echo $row_carrera['codigo']; ?> - <?php echo $row_carrera['nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" id="actualizar">Guardar</a>
            </div>
        </div>
    </div>
</div>