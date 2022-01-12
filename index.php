<?php
session_start();
include('conexion.php');
if (isset($_SESSION['usuario'])) {
    $page_name = 'inicio';
    $sql_periodo    = $con->query("SELECT * FROM periodos WHERE actual = 1");
    $row            = mysqli_fetch_assoc($sql_periodo);
    $periodo_id     = $row['id'];
    $periodo_actual = $row['nombre'];

    $sql_count_no_entregados    = $con->query("SELECT count(id) as no_entregados FROM trabajos WHERE periodo_id = '$periodo_id' AND estatus = 0");
    $row1                       = mysqli_fetch_assoc($sql_count_no_entregados);
    $no_entregados              = $row1['no_entregados'];
    $sql_count_aprobados        = $con->query("SELECT count(id) as aprobados FROM trabajos WHERE periodo_id = '$periodo_id' AND estatus = 1");
    $row2                       = mysqli_fetch_assoc($sql_count_aprobados);
    $aprobados                  = $row2['aprobados'];
    $sql_count_reprobados       = $con->query("SELECT count(id) as reprobados FROM trabajos WHERE periodo_id = '$periodo_id' AND estatus = 2");
    $row3                       = mysqli_fetch_assoc($sql_count_reprobados);
    $reprobados                 = $row3['reprobados'];
    $total                      = $aprobados + $no_entregados + $reprobados;

    $entregados                 = $aprobados + $reprobados;
    $porcentaje                 = $total > 0 ? round($entregados / $total) * 100 : 0;
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Pagina principal - Control TRIA IUPSM Maturín</title>
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
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
    background-color: #b1c2d9;
    color: #fff;
}

.avatar-group{display:inline-flex}.avatar-group .avatar+.avatar{margin-left:-.75rem}.avatar-group .avatar-xs+.avatar-xs{margin-left:-.40625rem}.avatar-group .avatar-sm+.avatar-sm{margin-left:-.625rem}.avatar-group .avatar-lg+.avatar-lg{margin-left:-1rem}.avatar-group .avatar-xl+.avatar-xl{margin-left:-1.28125rem}.avatar-group .avatar-xxl+.avatar-xxl{margin-left:-2rem}
        </style>
    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php include('modal_trabajo_add.php'); ?>
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
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <!-- Periodo actual -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Periodo actual</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $periodo_actual; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cantidad de trabajos asignados -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Trabajos asignados</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Porcentaje de trabajos entregados -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Entregados
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $porcentaje; ?>%</div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $porcentaje; ?>%" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#trabajos" role="tab" aria-controls="nav-home" aria-selected="true">Trabajos</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#estadisticas" role="tab" aria-controls="nav-profile" aria-selected="false">Estadistica</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="trabajos" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="text-right my-3">
                                                    <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addModal">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </span>
                                                        <span class="text">Agregar</span>
                                                    </button>
                                                </div>
                                                <!-- Trabajos registrados en el periodo actual -->
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
                                                                        <th>Estudiante</th>
                                                                        <th>Estatus</th>
                                                                        <th>F. Entrega</th>
                                                                        <th>Jurados</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $sql = $con->query("SELECT * FROM trabajos WHERE periodo_id = '$periodo_id'");
                                                                    while($row4 = mysqli_fetch_assoc($sql)){
                                                                        $id             = $row4['id'];
                                                                        $titulo         = $row4['titulo'];
                                                                        $estudiante_id  = $row4['estudiante_id'];
                                                                        $fecha_entrega  = $row4['fecha_entrega'];
                                                                        $sql2                   = $con->query("SELECT cedula, nombres, apellidos FROM estudiantes WHERE id = $estudiante_id");
                                                                        $row5                   = mysqli_fetch_assoc($sql2);
                                                                        $estudiante_cedula      = $row5['cedula'];
                                                                        $estudiante_nombres     = $row5['nombres'];
                                                                        $estudiante_apellidos   = $row5['apellidos'];
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $titulo; ?></td>
                                                                        <td><?php echo $estudiante_cedula; ?> - <?php echo  $estudiante_nombres; ?> <?php echo $estudiante_apellidos; ?></php></td>
                                                                        <td>
                                                                            <?php if($row4['estatus'] == 0){ ?>
                                                                                <span class="badge badge-light">No entregado</span>
                                                                            <?php }else if($row4['estatus'] == 1){ ?>
                                                                                <span class="badge badge-success">Aprobado</span>
                                                                            <?php }else if($row4['estatus'] == 2){ ?>
                                                                                <span class="badge badge-danger">Reprobado</span>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td><?php if($fecha_entrega == NULL) echo '-'; else  echo date('d-m-Y', strtotime($fecha_entrega)); ?></td>
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
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" data-toggle="tooltip" title="editar" onclick="editar(<?php echo $row4['id']; ?>)" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></i></button>
                                                                                <button type="button" onclick="eliminar(<?php echo $row4['id']; ?>)" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash"></i></i></button>
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
                                    <div class="tab-pane fade" id="estadisticas" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Estadistica</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        <div class="chart-pie pt-4">
                                                            <canvas id="myPieChart"></canvas>
                                                        </div>
                                                        <hr>
                                                        Comparación de trabajos aprobados, reprobados y no entregados
                                                    </div>
                                                </div>
                                            </div>
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
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <script src="js/i18n/defaults-es_ES.min.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>

        <!-- Page level custom scripts -->
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
                $('.selectpicker').selectpicker();
                $('[data-toggle="tooltip"]').tooltip();
            });

            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Comparación de trabajos
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Aprobado", "No entregado", "Reprobado"],
                    datasets: [{
                        data: [<?php echo $aprobados; ?>, <?php echo $no_entregados; ?>, <?php echo $reprobados; ?>],
                        backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
    exit();
}
?>