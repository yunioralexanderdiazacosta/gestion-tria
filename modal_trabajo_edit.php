<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar trabajo</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_edit">
                <div class="form-group">
                    <label>Titulo</label>
                    <textarea id="titulo_edit" class="form-control" placeholder="Ingresa el titulo" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Empresa</label>
                            <input type="text" id="empresa_edit" class="form-control" placeholder="Ingresa la empresa">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>Periodo</label>
                        <select class="form-control selectpicker" id="periodo_id_edit" onchange="obtener_estudiantes(this.value)" data-live-search="true">
                            <?php
                            $sql_periodos = $con->query("SELECT * FROM periodos ORDER BY actual DESC");
                            while($row = mysqli_fetch_assoc($sql_periodos)){
                            ?>
                            <option value="<?php echo $row['id']; ?>" <?php if($row['actual'] == "1") echo "selected"; ?>><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Estudiante</label>
                            <select class="form-control selectpicker" id="estudiante_id_edit" data-live-search="true">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Asesor</label>
                            <select class="form-control selectpicker" id="profesor_id_edit" data-live-search="true">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Fecha de entrega</label>
                            <input type="date" id="fecha_entrega_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Estatus</label>
                            <select class="form-control" id="estatus_edit">
                                <option value="0">No entregado</option>
                                <option value="1">Aprobado</option>
                                <option value="2">Reprobado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea id="observaciones_edit" class="form-control" placeholder="Observaciones..." rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" id="actualizar">Guardar</a>
            </div>
        </div>
    </div>
</div>