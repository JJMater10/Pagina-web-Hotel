<!DOCTYPE html>
<html class="h-100" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Inicio de sesión</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/images/favicon.png">
    <link href="css_sesion/style.css" rel="stylesheet">
    <!-- script de las alertas sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="h-100">
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="#"> <h4>Inicio Sesión</h4></a>
                                <?php include("alertas_IN/alertas-login.php"); ?>
                                <form class="mt-5 mb-5 login-input" method="POST" action="acciones_IN/login.php" autocomplete="off">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Cédula" name="usuario_login" id="usuario_login" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Contraseña" name="password_login" id="password_login" autocomplete="new-password" required>
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Iniciar sesión</button>
                                </form>
                                <p class="mt-5 login-form__footer">Olvidaste tu contraseña<a href="page-lock.php" class="text-primary"> Click aqui</a> para recuperarla</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js_IS/custom.min.js"></script>
    <script src="js_IS/settings.js"></script>
    <script src="js_IS/gleek.js"></script>
    <script src="js_IS/styleSwitcher.js"></script>
</body>
</html>
