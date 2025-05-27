<!DOCTYPE html>
<html class="h-100" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cambio de Contraseña</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
                                <a class="text-center" href="#"> <h4>Cambio de Contraseña</h4></a>
                                <!-- Mostrar mensaje de error -->
                                <?php include("alertas_IN/alertas-contra.php"); ?>
                                <form class="mt-5 mb-3 login-input" method="POST" action="acciones_IN/actualizar_contra.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Identificación" name="ident_recep" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Nueva Contraseña" name="new_password" required>
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Actualizar Contraseña</button>
                                </form>
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
</body>
</html>
