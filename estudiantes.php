<?php
session_start();
include('conexion.php');
if(isset($_SESSION['usuario']))
{
    $page_name = 'estudiantes';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Estudiantes - Control TRIA IUPSM Maturín</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('layouts/sidebar.php'); ?>
        <?php include('modal_estudiante_add.php'); ?>
        <?php include('modal_estudiante_edit.php'); ?>
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
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-user-graduate"></i> Estudiantes</h1>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="text-right my-3">
                            <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-circle"></i>
                                </span>
                                <span class="text">Agregar</span>
                            </button>
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
                                                    <th width="10%">Cód. Carrera</th>
                                                    <th>Cedula</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Estatus</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = $con->query("SELECT * FROM estudiantes ORDER BY estatus DESC, cedula ASC");
                                                while($row = mysqli_fetch_assoc($sql)){
                                                    $carrera_id = $row['carrera_id'];
                                                    $sql2 = $con->query("SELECT codigo FROM carreras WHERE id = '$carrera_id'");
                                                    $row2 = mysqli_fetch_assoc($sql2);
                                                    $codigo = $row2['codigo'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $codigo; ?></td>
                                                    <td><?php echo $row['cedula']; ?></td>
                                                    <td><?php echo $row['nombres']; ?></td>
                                                    <td><?php echo $row['apellidos']; ?></td>
                                                    <td>
                                                        <?php if($row['estatus'] == 1){ ?>
                                                            <span class="badge badge-success">Activo</span>
                                                        <?php }else{ ?>
                                                            <span class="badge badge-danger">Desactivado</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" data-toggle="tooltip" title="editar" onclick="editar(<?php echo $row['id']; ?>)" class="btn btn-circle btn-outline-primary"><i class="fas fa-edit"></i></i></button>
                                                            <?php if($row['estatus'] == 1){ ?>
                                                                <button type="button" data-toggle="tooltip" title="eliminar" onclick="eliminar(<?php echo $row['id']; ?>)" class="btn btn-circle btn-outline-primary"><i class="fas fa-trash"></i></i></button>
                                                            <?php }else{ ?>
                                                                <button type="button" data-toggle="tooltip" title="activar" onclick="activar(<?php echo $row['id']; ?>)" class="btn btn-circle btn-outline-primary"><i class="fas fa-check-circle"></i></i></button>
                                                            <?php } ?>
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
    <script src="js/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "ordering": false,
                language:{sProcessing:"Procesando...",sLengthMenu:"Mostrar _MENU_ registros",sZeroRecords:"No se encontraron resultados",sEmptyTable:"Ningún dato disponible en esta tabla",sInfo:"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",sInfoEmpty:"Mostrando registros del 0 al 0 de un total de 0 registros",sInfoFiltered:"(filtrado de un total de _MAX_ registros)",sInfoPostFix:"",sSearch:"Buscar:",sUrl:"",sInfoThousands:",",sLoadingRecords:"Cargando...",oPaginate:{sFirst:"Primero",sLast:"Último",sNext:"Siguiente",sPrevious:"Anterior"},oAria:{sSortAscending:": Activar para ordenar la columna de manera ascendente",sSortDescending:": Activar para ordenar la columna de manera descendente"},buttons:{print:"Imprimir"}},
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });

        $('#guardar').click(function () {
            var cedula      = $('#cedula').val();
            var nombres     = $('#nombres').val();
            var apellidos   = $('#apellidos').val();
            var carrera     = $('#carrera').val();
            if(cedula.trim() == ''){
                msg_error('Ingresa el número de cedula');
            }else if(nombres.trim() == ''){
                msg_error('Ingresa nombres');
            }else if(apellidos.trim() == ''){
                msg_error('Ingresa apellidos');
            }else if(carrera == ''){
                msg_error('Selecciona la carrera');
            }else{
                $.ajax({
                    data:  {
                        cedula, nombres, apellidos, carrera
                    },
                    url:   'acciones/v_estudiantes_add.php',
                    type:  'post',
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
            var cedula      = $('#cedula_edit').val();
            var nombres     = $('#nombres_edit').val();
            var apellidos   = $('#apellidos_edit').val();
            var carrera     = $('#carrera_edit').val();
            var id          = $('#id').val();
            if(cedula.trim() == ''){
                msg_error('Ingresa el número de cedula');
            }else if(nombres.trim() == ''){
                msg_error('Ingresa nombres');
            }else if(apellidos.trim() == ''){
                msg_error('Ingresa apellidos');
            }else if(carrera == ''){
                msg_error('Selecciona la carrera');
            }else{
                $.ajax({
                    data:  {
                        cedula, nombres, apellidos, carrera, id
                    },
                    url:   'acciones/v_estudiantes_update.php',
                    type:  'post',
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
                url:  'acciones/v_estudiantes_edit.php',
                type: 'post',
                success:  function (response) {
                    $('#editModal').modal('show');
                    $('#id').val(response.id);
                    $('#cedula_edit').val(response.cedula);
                    $('#nombres_edit').val(response.nombres);
                    $('#apellidos_edit').val(response.apellidos);
                    $('#carrera_edit').val(response.carrera_id);
                },
                error: function (error) {
                    msg_error('Ocurrio un error interno')
                }
            });
        }

        function eliminar(id)
        {
            Swal.fire({
                title: '¿Esta seguro de que desea eliminar el estudiante?',
                text: "¡Esta acción eliminará o dará de baja el estudiante!",
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
                        url:   'acciones/v_estudiantes_delete.php',
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

        function activar(id)
        {
            Swal.fire({
                title: '¿Esta seguro de que desea activar el estudiante?',
                text: "¡Esta acción dará de alta al estudiante!",
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
                        url:   'acciones/v_estudiantes_activate.php',
                        type:  'post',
                        success:  function (response) {
                            msg_success('Registro activado correctamente')
                        },
                        error: function (error) {
                            msg_error('Ocurrio un error interno')
                        }
                    });
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
                window.location = 'estudiantes.php';
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