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
    <title>Detalles del trabajo - Control TRIA IUPSM Maturín</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.min.css" rel="stylesheet">
    <style>
        .avatar-sm {
            width: 2.5rem;
            height: 2.5rem;
            font-size: .8333333333rem;
        }

        .avatar {
            position: relative;
            display: inline-block;
            width: 3rem;
            height: 3rem;
            font-size: 1rem;
        }

        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            line-height: 0;
            background-color: #fd7e14;
            color: #fff;
        }

        .avatar-group{display:inline-flex}.avatar-group .avatar+.avatar{margin-left:-.75rem}.avatar-group .avatar-xs+.avatar-xs{margin-left:-.40625rem}.avatar-group .avatar-sm+.avatar-sm{margin-left:-.625rem}.avatar-group .avatar-lg+.avatar-lg{margin-left:-1rem}.avatar-group .avatar-xl+.avatar-xl{margin-left:-1.28125rem}.avatar-group .avatar-xxl+.avatar-xxl{margin-left:-2rem}
    </style>
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
                    <h1 class="h3 text-gray-800"><i class="fas fa-fw fa-book"></i> Trabajos <span class="badge badge-secondary"><small>Detalles</small></h1>
                    <div class="row">
                        <div class="col-lg-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="trabajos.php">Trabajos</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Jurados</li>
                                </ol>
                            </nav>
                            <!-- Detalles del trabajo -->
                            <div class="card shadow my-3">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Detalles del trabajo</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                    <?php
                                    $id = $_GET['id'];
                                    $sql = $con->query("SELECT * FROM trabajos WHERE id = '$id'");
                                    while($row = mysqli_fetch_assoc($sql)){
                                        $periodo_id     = $row['periodo_id'];
                                        $estudiante_id  = $row['estudiante_id'];
                                        $profesor_id    = $row['profesor_id'];
                                        $sql2 = $con->query("SELECT nombre FROM periodos WHERE id = $periodo_id");
                                        $row2 = mysqli_fetch_assoc($sql2);
                                        $periodo_nombre = $row2['nombre'];
                                        $sql3 = $con->query("SELECT cedula, nombres, apellidos, carrera_id FROM estudiantes WHERE id = $estudiante_id");
                                        $row3 = mysqli_fetch_assoc($sql3);
                                        $estudiante_cedula      = $row3['cedula'];
                                        $estudiante_nombres     = $row3['nombres'];
                                        $estudiante_apellidos   = $row3['apellidos'];
                                        $carrera_id             = $row3['carrera_id'];
                                        $sql4 = $con->query("SELECT cedula, nombres, apellidos FROM profesores WHERE id = '$profesor_id'");
                                        $row4 = mysqli_fetch_assoc($sql4);
                                        $asesor_cedula          = $row4['cedula'];
                                        $asesor_nombres         = $row4['nombres'];
                                        $asesor_apellidos       = $row4['apellidos'];
                                        $sql5 = $con->query("SELECT * FROM carreras WHERE id = '$carrera_id'");
                                        $row5 = mysqli_fetch_assoc($sql5);
                                        $carrera_codigo = $row5['codigo'];
                                        $carrera_nombre = $row5['nombre'];
                                    ?>
                                        <tr>
                                            <th width="15%">Carrera</th>
                                            <td><?php echo $carrera_codigo; ?> - <?php echo $carrera_nombre; ?></td>
                                        </tr>
                                        <tr>
                                            <th width="15%">Estudiante</th>
                                            <td><?php echo $estudiante_cedula; ?> - <?php echo $estudiante_nombres; ?> <?php echo $estudiante_apellidos; ?></td>
                                        </tr>
                                        <tr>
                                            <th width="15%">Periodo</th>
                                            <td><?php echo $periodo_nombre; ?></td>
                                        </tr>
                                        <tr>
                                            <th width="15%">Tema</th>
                                            <td><?php echo $row['titulo']; ?></td>
                                        </tr>

                                        <tr>
                                            <th width="15%">Empresa</th>
                                            <td><?php echo $row['empresa']; ?></td>
                                        </tr>

                                        <tr>
                                            <th width="15%">Asesor</th>
                                            <td><?php echo $asesor_cedula; ?> - <?php echo $asesor_nombres; ?> <?php echo $asesor_apellidos; ?></td>
                                        </tr>

                                        <tr>
                                            <th width="15%">Estatus</th>
                                            <td>
                                                <?php if($row['estatus'] == 0){ ?>
                                                    <span class="badge badge-light">No entregado</span>
                                                <?php }else if($row['estatus'] == 1){ ?>
                                                    <span class="badge badge-success">Aprobado</span>
                                                <?php }else if($row['estatus'] == 2){ ?>
                                                    <span class="badge badge-danger">Reprobado</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php if($row['fecha_entrega'] != '' || $row['fecha_entrega'] != null){ ?>
                                        <tr>
                                            <th>Fecha de entrega</th>
                                            <th><?php echo $row['fecha_entrega']; ?></th>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <th width="15%">Observaciones</th>
                                            <td><?php echo $row['observaciones']; ?></td>
                                        </tr>
                                        <tr>
                                            <th width="15%">Jurados</th>
                                            <td>
                                                <?php
                                                $sql_jurados = $con->query("SELECT p.cedula, p.nombres, p.apellidos FROM trabajos_jurados tj INNER JOIN profesores p ON p.id = tj.profesor_id  WHERE tj.trabajo_id = '$id'");
                                                if(mysqli_num_rows($sql_jurados) > 0)
                                                {
                                                    while($row5 = mysqli_fetch_assoc($sql_jurados))
                                                    {
                                                        $iniciales          = strtoupper($row5['nombres'][0] . $row5['apellidos'][0]);
                                                        $jurado             = $row5['cedula'] . " - " . $row5['nombres'] . " " . $row5['apellidos'];
                                                ?>
                                                        <div class="avatar-group d-md-inline-flex">
                                                            <div role="button" class="avatar avatar-sm avatar-online" data-toggle="tooltip" title="<?php echo $jurado; ?>"><div class="avatar-title rounded-circle"><?php echo $iniciales; ?></div></div>
                                                        </div>
                                                <?php
                                                    }
                                                }else{
                                                ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </table>
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
            $('[data-toggle="tooltip"]').tooltip();
        });
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