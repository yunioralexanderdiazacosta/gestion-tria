<?php
session_start();
include('conexion.php');
if(isset($_SESSION['usuario']))
{
    $page_name = 'trabajos';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Trabajos - Control TRIA IUPSM Maturín</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.min.css" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('layouts/sidebar.php'); ?>
        <?php include('modal_trabajo_add.php'); ?>
        <?php include('modal_trabajo_edit.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('layouts/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Trabajos</h1>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="text-right my-3">
                            <button type="button" class="btn btn-primary text-right" data-toggle="modal" data-target="#addModal">Agregar</button>
                        </div>
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Titulo</th>
                                                    <th>Periodo</th>
                                                    <th>Estudiante</th>
                                                    <th>Estatus</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = $con->query("SELECT * FROM trabajos");
                                                while($row = mysqli_fetch_assoc($sql)){
                                                    $periodo_id     = $row['periodo_id'];
                                                    $estudiante_id  = $row['estudiante_id'];
                                                    $sql2 = $con->query("SELECT nombre FROM periodos WHERE id = $periodo_id");
                                                    $row2 = mysqli_fetch_assoc($sql2);
                                                    $periodo_nombre = $row2['nombre'];
                                                    $sql3 = $con->query("SELECT cedula, nombres, apellidos FROM estudiantes WHERE id = $estudiante_id");
                                                    $row3 = mysqli_fetch_assoc($sql3);
                                                    $estudiante_cedula      = $row3['cedula'];
                                                    $estudiante_nombres     = $row3['nombres'];
                                                    $estudiante_apellidos   = $row3['apellidos'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['titulo']; ?></td>
                                                    <td><?php echo $periodo_nombre; ?></td>
                                                    <td><?php echo $estudiante_cedula; ?> - <?php echo  $estudiante_nombres; ?> <?php echo $estudiante_apellidos; ?></php></td>
                                                    <td>
                                                        <?php if($row['estatus'] == 0){ ?>
                                                            <span class="badge badge-light">No entregado</span>
                                                        <?php }else if($row['estatus'] == 1){ ?>
                                                            <span class="badge badge-success">Aprobado</span>
                                                        <?php }else if($row['estatus'] == 2){ ?>
                                                            <span class="badge badge-danger">Reprobado</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="trabajos_jurados.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-users"></i></a>
                                                            <button type="button" onclick="editar(<?php echo $row['id']; ?>)" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></i></button>
                                                            <button type="button" onclick="eliminar(<?php echo $row['id']; ?>)" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash"></i></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/i18n/defaults-es_ES.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script>
        var asesores = [];
        $(document).ready(function() {
            $('#dataTable').DataTable();
            obtener_estudiantes();
            $('.selectpicker').selectpicker();
        });

        $('#guardar').click(function () {
            var titulo          = $('#titulo').val();
            var empresa         = $('#empresa').val();
            var periodo_id      = $('#periodo_id').val();
            var estudiante_id   = $('#estudiante_id').val();
            var profesor_id     = $('#profesor_id').val();
            var fecha_entrega   = $('#fecha_entrega').val();
            var estatus         = $('#estatus').val()
            if(titulo.trim() == ''){
                msg_error('Ingresa el titulo');
            }else if(empresa.trim() == ''){
                msg_error('Ingresa la empresa');
            }else if(periodo_id == ''){
                msg_error('Seleccione el periodo');
            }else if(estudiante_id == ''){
                msg_error('Seleccione el estudiante');
            }else if(profesor_id == ''){
                msg_error('Seleccione el asesor');
            }else{
                var data = {
                    titulo:     titulo,
                    empresa:    empresa,
                    periodo_id:     periodo_id,
                    estudiante_id:  estudiante_id,
                    profesor_id: profesor_id,
                    estatus: estatus
                };
                if(fecha_entrega != ""){
                    data.fecha_entrega = fecha_entrega;
                }
                $.ajax({
                    data: data,
                    url:    'acciones/v_trabajos_add.php',
                    type:   'post',
                    success:  function (response) {
                        msg_success('Registro almacenado correctamente')
                    },
                    error: function (error) {
                        msg_error('Ocurrio un error interno')
                    }
                });
            }
        });

        $('#actualizar').click(function () {
            var titulo          = $('#titulo_edit').val();
            var empresa         = $('#empresa_edit').val();
            var periodo_id      = $('#periodo_id_edit').val();
            var estudiante_id   = $('#estudiante_id_edit').val();
            var profesor_id     = $('#profesor_id_edit').val();
            var fecha_entrega   = $('#fecha_entrega_edit').val();
            var estatus         = $('#estatus_edit').val()
            if(titulo.trim() == ''){
                msg_error('Ingresa el titulo');
            }else if(empresa.trim() == ''){
                msg_error('Ingresa la empresa');
            }else if(periodo_id == ''){
                msg_error('Seleccione el periodo');
            }else if(estudiante_id == ''){
                msg_error('Seleccione el estudiante');
            }else if(profesor_id == ''){
                msg_error('Seleccione el asesor');
            }else{
                var data = {
                    titulo:     titulo,
                    empresa:    empresa,
                    periodo_id:     periodo_id,
                    estudiante_id:  estudiante_id,
                    profesor_id: profesor_id,
                    estatus: estatus
                };
                if(fecha_entrega != ""){
                    data.fecha_entrega = fecha_entrega;
                }
                $.ajax({
                    data: data,
                    url:    'acciones/v_trabajos_update.php',
                    type:   'post',
                    success:  function (response) {
                        msg_success('Registro actualizado correctamente')
                    },
                    error: function (error) {
                        msg_error('Ocurrio un error interno')
                    }
                });
            }
        });

        function editar(id)
        {
            $.ajax({
                data: {id},
                url:  'acciones/v_trabajos_edit.php',
                type: 'post',
                success:  function (response) {
                    $('#editModal').modal('show');
                    obtener_estudiantes_editar(response.estudiante_id, response.periodo_id);
                    obtener_profesores_editar(response.id, response.profesor_id);
                    $('#id').val(response.id);
                    $('#titulo_edit').val(response.titulo);
                    $('#empresa_edit').val(response.empresa);
                    $('#periodo_id_edit').val(response.periodo_id);
                    $('#estudiante_id_edit').val(response.estudiante_id);
                    $('#profesor_id_edit').val(response.profesor_id);
                    $('#fecha_entrega_edit').val(response.fecha_entrega);
                    $('#estatus_edit').val(response.estatus);
                },
                error: function (error) {
                    msg_error('Ocurrio un error interno')
                }
            });
        }

        function eliminar(id)
        {
            Swal.fire({
                title: '¿Esta seguro de que desea eliminar el trabajo?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirmar'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        data:  {
                            id
                        },
                        url:   'acciones/v_trabajos_delete.php',
                        type:  'post',
                        success:  function (response) {
                            msg_success('Registro eliminado correctamente')
                        },
                        error: function (error) {
                            msg_error('Ocurrio un error interno')
                        }
                    });
                }
            });
        }

        function obtener_estudiantes(id = '')
        {
            if(id != ''){
                var data = { periodo: id  }
            }else{
                var data = '';
            }
            $.ajax({
                data: data,
                url:   'acciones/v_estudiantes_get_1.php',
                type:  'post',
                success:  function (response) {
                    $('#estudiante_id').html(response);
                    $('.selectpicker').selectpicker('refresh')
                },
                error: function (error) {
                    msg_error('Ocurrio un error interno')
                }
            });
        }

        function obtener_estudiantes_editar(estudiante_id, periodo_id)
        {
            $.ajax({
                data: { estudiante_id, periodo_id },
                url:   'acciones/v_estudiantes_get_2.php',
                type:  'post',
                success:  function (response) {
                    $('#estudiante_id_edit').html(response);
                    $('.selectpicker').selectpicker('refresh')
                },
                error: function (error) {
                    msg_error('Ocurrio un error interno')
                }
            });
        }

        function obtener_profesores_editar(trabajo_id, profesor_id)
        {
            $.ajax({
                data: { trabajo_id, profesor_id },
                url:   'acciones/v_profesores_get_1.php',
                type:  'post',
                success:  function (response) {
                    $('#profesor_id_edit').html(response);
                    $('.selectpicker').selectpicker('refresh')
                },
                error: function (error) {
                    msg_error('Ocurrio un error interno')
                }
            });
        }

        function msg_error(title)
        {
            Swal.fire({
                title: 'Error!',
                text: title,
                icon: 'error',
                confirmButtonText: 'Cerrar'
            })
        }

        function msg_success(title)
        {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: title,
                showConfirmButton: false,
                timer: 1000
            }).then(function(){
                window.location = 'trabajos.php';
            })
        }
    </script>
</body>
</html>
<?php
}
else
{
    header("Location: login.php");
    exit();
}
?>