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
                            <hr>
                            <h3 class="text-center">Jurados</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control selectpicker" id="jurado" data-live-search="true">
                                            <option value="">Seleccione</option>
                                            <?php
                                            $sql_profesores = $con->query("SELECT * FROM profesores ORDER BY nombres ASC, apellidos ASC");
                                            while($row = mysqli_fetch_assoc($sql_profesores)){
                                            ?>
                                            <option value="<?php echo $row['id']; ?>_<?php echo $row['cedula']; ?>_<?php echo $row['nombres']; ?>_<?php echo $row['apellidos']; ?>"><?php echo $row['cedula']; ?> - <?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <button type="button" id="add" onclick="agregar_jurado()" class="btn btn-warning mb-2"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Cedula</td>
                                        <td>Nombres</td>
                                        <td>Apellidos</td>
                                    </tr>
                                </thead>
                                <tbody id="rows"></tbody>
                            </table>
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
            $('.selectpicker').selectpicker();
        });

        function agregar()
        {
            var jurado      = $('#jurado').val();
            var array       = jurado.split('_');
            var cedula      = array[1] ? array[1] : '';
            var nombres     = array[2] ? array[2] : '';
            var apellidos   = array[3] ? array[3] : '';
            asesores.push(array[0]);
            info += `
                <tr>
                    <td>${cedula}</td>
                    <td>${nombres}</td>
                    <td>${apellidos}</td>
                </tr>`;
                $('#rows').append(info);
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
                window.location = 'profesores.php';
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