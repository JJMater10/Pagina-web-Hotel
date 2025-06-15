<?php
session_start();
if (!isset($_SESSION['nom_cecep'])) {
    header("Location: ../inicio_sesion/app-profile.php");
    exit();
}

// ❗ Desactivar caché del navegador para evitar "volver atrás"
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Evitar que el navegador guarde páginas anteriores -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css_MR/style.css" rel="stylesheet">
    <!-- PDF's -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


</head>

<body>

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

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.php">
                    <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="../inicio_sesion/app-profile.php"><i class="icon-user"></i> <span>Perfil</span></a>
                                        </li>
                                        
                                        <hr class="my-2">
                                        <li><a href="../inicio_sesion/page-login.php"><i class="icon-key"></i> <span>Cerrar Sesión</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Menú</li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Principal</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="./index.php">Inicio</a></li>
                                <li><a href="./historial-reservas.html">Historial De Reservas</a></li>
                                <li><a href="./grafica-reservas.php">Gráficas Reservas</a></li>
                            </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container mt-5">
                <h2 class="text-center mb-4 font-weight-bold">Gráficas de Reservas</h2>

                <!-- Gráfico de Reservas por Mes -->
                <div class="mb-5">
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title text-center">Reservas por Mes (por tipo de habitación)</h5>
                                <button class="btn mb-1 btn-rounded btn-primary mb-2" onclick="descargarPDF('graficaReservasMes', 'informe_reservas.pdf')">
                                    Descargar gráfico de reservas
                                </button>
                            <canvas id="graficaReservasMes" class="w-100" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de Ganancias por Mes -->
                <div>
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title text-center">Ganancias por Mes</h5>
                                <button class="btn mb-1 btn-rounded btn-secondary mb-4" onclick="descargarPDF('graficaGananciasMes', 'informe_ganancias.pdf')">
                                    Descargar gráfico de ganancias
                                </button>
                            <canvas id="graficaGananciasMes" class="w-100" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js_MR/custom.min.js"></script>
    <script src="js_MR/settings.js"></script>
    <script src="js_MR/gleek.js"></script>
    <script src="js_MR/styleSwitcher.js"></script>
    <script src="./plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="./js_MR/plugins-init/chartjs-init.js"></script>

    <!-- Script para evitar que el usuario vuelva a la página anterior -->
    <script>
    window.history.forward();
    window.onunload = function () {};
</script>


</body>

</html>