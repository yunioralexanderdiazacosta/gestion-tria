<?php
session_start();
include('conexion.php');
if(isset($_SESSION['usuario']))
{
    $page_name      = 'trabajos';
    $trabajo_id     = $_GET['id'];
    $sql_trabajo    = $con->query("SELECT profesor_id, titulo FROM trabajos WHERE id = $trabajo_id");
    $row1           = mysqli_fetch_assoc($sql_trabajo);
    $profesor_id    = $row1['profesor_id'];
    $titulo_trabajo = $row1['titulo'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jurados para el trabajo - Control TRIA IUPSM Maturín</title>
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
                    <h1 class="h3 mb-5 text-gray-800"><i class="fas fa-fw fa-users"></i> Trabajos <span class="badge badge-secondary"><small>Jurados</small></span></h1>
                    <div class="row">
                        <div class="col-lg-12">
                             <!-- Titulo del trabajo -->
                             <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Titulo del trabajo</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <?php echo $titulo_trabajo; ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="trabajo_id" id="trabajo_id" value="<?php echo $_GET['id']; ?>">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Jurados</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select class="form-control selectpicker" id="profesor_id" data-live-search="true">
                                                    <option value="">Seleccione</option>
                                                    <?php
                                                    $sql_profesores = $con->query("SELECT * FROM profesores WHERE id NOT IN (SELECT profesor_id FROM trabajos WHERE profesor_id = '$profesor_id') AND id NOT IN (SELECT profesor_id FROM trabajos_jurados WHERE trabajo_id = '$trabajo_id') ORDER BY nombres ASC, apellidos ASC");
                                                    while($row = mysqli_fetch_assoc($sql_profesores)){
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['cedula']; ?> - <?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="button" onclick="guardar()" class="btn btn-primary btn-icon-split mb-2">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus-circle"></i>
                                                </span>
                                                <span class="text">Agregar</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Cedula</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql_trabajos_jurados = $con->query("SELECT tj.id, p.cedula, p.nombres, p.apellidos FROM profesores p INNER JOIN trabajos_jurados tj ON p.id = tj.profesor_id WHERE tj.trabajo_id = $trabajo_id");
                                                while($row2 = mysqli_fetch_assoc($sql_trabajos_jurados))
                                                {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row2['cedula']; ?></td>
                                                    <td><?php echo $row2['nombres']; ?></td>
                                                    <td><?php echo $row2['apellidos']; ?></td>
                                                    <td>
                                                        <button type="button" data-toggle="tooltip" title="eliminar" onclick="eliminar(<?php echo $row2['id']; ?>)" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash"></i></button>
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
        $(document).ready(function() {
            $('#dataTable').DataTable({
                language:{sProcessing:"Procesando...",sLengthMenu:"Mostrar _MENU_ registros",sZeroRecords:"No se encontraron resultados",sEmptyTable:"Ningún dato disponible en esta tabla",sInfo:"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",sInfoEmpty:"Mostrando registros del 0 al 0 de un total de 0 registros",sInfoFiltered:"(filtrado de un total de _MAX_ registros)",sInfoPostFix:"",sSearch:"Buscar:",sUrl:"",sInfoThousands:",",sLoadingRecords:"Cargando...",oPaginate:{sFirst:"Primero",sLast:"Último",sNext:"Siguiente",sPrevious:"Anterior"},oAria:{sSortAscending:": Activar para ordenar la columna de manera ascendente",sSortDescending:": Activar para ordenar la columna de manera descendente"},buttons:{print:"Imprimir"}},
                "drawCallback": function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
            $('.selectpicker').selectpicker();

        });

        function guardar() {
            var profesor_id = $('#profesor_id').val();
            var trabajo_id  = $('#trabajo_id').val();
            if(profesor_id == ''){
                msg_error('Seleccione el profesor');
            }else if(trabajo_id.trim() == ''){
                msg_error('No se paso el identificador del trabajo');
            }else{
                var data = {
                    profesor_id, trabajo_id
                };
                $.ajax({
                    data: data,
                    url:    'acciones/v_trabajos_jurados_add.php',
                    type:   'post',
                    success:  function (response) {
                        msg_success('Registro almacenado correctamente')
                    },
                    error: function (error) {
                        msg_error('Ocurrio un error interno')
                    }
                });
            }
        }

        function eliminar(id)
        {
            Swal.fire({
                title: '¿Esta seguro de que desea eliminar el profesor?',
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
                        url:   'acciones/v_trabajos_jurados_delete.php',
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
                window.location = 'trabajos_jurados.php?id=<?php echo $_GET['id']; ?>';
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