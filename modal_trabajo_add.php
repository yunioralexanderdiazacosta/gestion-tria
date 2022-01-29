<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar trabajo</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tema</label>
                    <textarea id="titulo" class="form-control" placeholder="Ingresa el tema" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Empresa</label>
                            <input type="text" id="empresa" class="form-control" placeholder="Ingresa la empresa">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>Periodo</label>
                        <select class="form-control selectpicker" id="periodo_id" onchange="obtener_estudiantes(this.value)" data-live-search="true">
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
                            <select class="form-control selectpicker" id="estudiante_id" data-live-search="true">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Asesor</label>
                            <select class="form-control selectpicker" id="profesor_id" data-live-search="true">
                                <option value="">Seleccione</option>
                                <?php
                                $sql_profesores = $con->query("SELECT * FROM profesores WHERE estatus = 1 ORDER BY nombres ASC, apellidos ASC");
                                while($row = mysqli_fetch_assoc($sql_profesores)){
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['cedula']; ?> - <?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Fecha de entrega</label>
                            <input type="date" id="fecha_entrega" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Estatus</label>
                            <select class="form-control" id="estatus">
                                <option value="0">No entregado</option>
                                <option value="1">Aprobado</option>
                                <option value="2">Reprobado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea id="observaciones" class="form-control" placeholder="Observaciones..." rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" id="guardar">Guardar</a>
            </div>
        </div>
    </div>
</div>