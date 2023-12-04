<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ETIC | Log in </title>
    <link rel="shortcut icon" href="img/sistema/favicon.ico">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="adminLTE-3.1.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminLTE-3.1.0/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="img/sistema/ETIC_logo.jpg" alt="ETIC" class="img-fluid">
            </div>
            <div class="card-body">
                <p class="login-box-msg">Ingresa tus credenciales para iniciar sesión</p>
                <form action="/login/acceso" method="POST">
                    <div class="input-group mb-3">                        
                        <input type="text" class="form-control" id="Usuario" name="Usuario" placeholder="Usuario" value="<?php echo (isset($_COOKIE['usuario'])) ? $_COOKIE['usuario'] : ''; ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Contraseña" value="<?php echo (isset($_COOKIE['password'])) ? $_COOKIE['password'] : ''; ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php if(session()->getFlashdata('msg')):?>
                            <div class="alert alert-danger text-center"><?= session()->getFlashdata('msg') ?></div>
                        <?php endif;?>
                    </div>
                    <div class="row">
                        <!-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div> -->
                        <!-- /.col -->
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <p class="mb-1">
                    <a href="#">Olvide mi contraseña</a>
                </p> -->

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="adminLTE-3.1.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="adminLTE-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="adminLTE-3.1.0/dist/js/adminlte.min.js"></script>
</body>

</html>