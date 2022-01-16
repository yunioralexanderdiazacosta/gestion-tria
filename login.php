<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Iniciar Sesión - Control TRIA IUPSM Maturín</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-6 d-none d-lg-block text-dark">
                                <img src="img/logo.png" class="img-fluid mx-auto d-block" style="margin-left: auto; margin-right: auto" width="420">
                                <h3 class="text-center mt-3"><span class="badge badge-warning">CONTROL TRIA</span></h3>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mt-3">
                                        <h1 class="h4 text-primary mb-4"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="usuario" aria-describedby="emailHelp"
                                                placeholder="Nombre de usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="clave" placeholder="Contraseña">
                                        </div>
                                        <button type="button" id="enviar" class="btn btn-outline-primary btn-user btn-block">
                                            Ingresar
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="resetear_clave.php">¿Olvidó su contraseña?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sweetalert2.all.min.js"></script>
    <script>
        $('#enviar').click(function () {
            var usuario = $('#usuario').val();
            var clave = $('#clave').val();
            if(usuario == '' || clave == ''){
                Swal.fire({
                    title: 'Error!',
                    text: 'Debes completar todos los campos',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })
            }else{
                $.ajax({
                    data:  {
                        usuario,
                        clave
                    },
                    url:   'acciones/v_login.php',
                    dataType: 'json',
                    type:  'post',
                    success:  function (response) {
                        window.location = 'index.php';
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: error.responseJSON,
                            icon: 'error',
                            confirmButtonText: 'Cerrar'
                        })
                    }
                 });
            }
        })
    </script>
</body>
</html>