<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resetear contraseña - Control TRIA IUPSM Maturín</title>

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
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Resetear contraseña</h1>
                                        <p class="mb-4">Genera una nueva contraseña con la cual podras ingresar, para ello debes propocionar el nombre de usuario!</p>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" onchange="validate()" class="form-control form-control-user"
                                                id="usuario" aria-describedby="usuario"
                                                placeholder="Ingresa el nombre de usuario">
                                        </div>
                                        <button type="button" id="procesar" class="btn btn-primary btn-user btn-block">
                                            Resetear contraseña
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="alert alert-success" id="nueva_clave" style="display: none">
                                        Nueva clave: <span class="" id="clave"></span>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Iniciar sesión</a>
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
    <script src="js/sb-admin-2.min.js"></script>
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
                    encontrado = response;
                    if(encontrado == '0'){
                        msg_error('El nombre de usuario no existe')
                        if($('#nueva_clave').length > 0){
                            $("#nueva_clave").hide()
                        }
                    }
                },
                error: function (error) {
                    msg_error('Ocurrio un error interno')
                }
            });
        }

         $('#procesar').click(function () {
            var usuario = $('#usuario').val();
            if(usuario.trim() == ''){
                msg_error('Ingresa el nombre de usuario');
            }else{
                if(encontrado == '0'){
                    msg_error('El nombre de usuario no existe')
                    if($('#nueva_clave').length > 0){
                        $("#nueva_clave").hide()
                    }
                }else{
                    var caracteres  = '0123456789abcdefghijklmnñopqrstuvwxyz';
                    var total       = 8;
                    var clave       = "";
                    for(var i =0; i <= total; i++){
                        var aleatorio   = Math.floor(Math.random() * caracteres.length);
                        clave           += caracteres.substring(aleatorio, aleatorio + 1);
                    }
                    $.ajax({
                        data: {usuario, clave },
                        url:    'acciones/v_resetear_clave.php',
                        type:   'post',
                        success:  function (response) {
                            $("#nueva_clave").show()
                            $("#clave").text(clave);
                            msg_success('Contraseña generada satifactoriamente')
                        },
                        error: function (error) {
                            msg_error('Ocurrio un error interno')
                        }
                    });
                }
            }
        });

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
            })
        }
    </script>
</body>
</html>