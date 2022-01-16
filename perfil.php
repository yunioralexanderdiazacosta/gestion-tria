<?php
session_start();
include('conexion.php');
if (isset($_SESSION['usuario'])) {
    $page_name = 'perfil';
    $usuario = $_SESSION['usuario'];
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Perfil - Control TRIA IUPSM Maturín</title>
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Perfil</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="card">
                                    <div class="card header">

                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Nombre de usuario</label>
                                            <input type="text" onchange="validate()" class="form-control" id="usuario"  value="<?php echo $usuario; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nueva contraseña</label>
                                            <input type="password" class="form-control" id="nueva_clave" autocomplete="false">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirmar nueva contraseña</label>
                                            <input type="password" class="form-control" id="confirmacion_clave">
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
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
        <script src="js/sweetalert2.all.min.js"></script>
        <script>
            var encontrado = '0';

            function validate()
            {
                var usuario = $('#usuario').val();
                $.ajax({
                    data: { usuario: usuario },
                    url:    'acciones/v_usuario.php',
                    type:   'post',
                    success:  function (response) {
                        encontrado = response
                        console.log(encontrado)
                        if(encontrado == '1'){
                            msg_error('El nombre de usuario ya existe')
                        }
                    },
                    error: function (error) {
                        msg_error('Ocurrio un error interno')
                    }
                });
            }

            $('#guardar').click(function () {
            var usuario             = $('#usuario').val();
            var nueva_clave         = $('#nueva_clave').val();
            var confirmacion_clave  = $('#confirmacion_clave').val();
            if(usuario.trim() == ''){
                msg_error('Ingresa el titulo');
            }else if(nueva_clave.trim() != '' && (nueva_clave.trim() != confirmacion_clave.trim())){
                msg_error('Las claves no coinciden');
            }else{
                console.log(encontrado);
                if(encontrado == '1'){
                    msg_error('El nombre de usuario ya existe')
                }else{
                    var data = {
                        usuario: usuario,
                    }
                    if(nueva_clave != ''){
                        data.clave =  nueva_clave
                    }
                    $.ajax({
                        data: data,
                        url:    'acciones/v_perfil.php',
                        type:   'post',
                        success:  function (response) {
                            msg_success('Datos actualizados correctamente')
                        },
                        error: function (error) {
                            msg_error('Ocurrio un error interno')
                        }
                    });
                }
            }
        })

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
                window.location = 'perfil.php';
            })
        }
        </script>
    </body>
    </html>
<?php
} else {
    header("Location: login.php");
    exit();
}
?>