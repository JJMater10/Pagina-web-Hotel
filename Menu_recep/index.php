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
    <!--  Evitar que el navegador guarde páginas anteriores -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
    <title>Inicio</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="css_MR/style.css" rel="stylesheet">
    <!-- Custom Stylesheet para el modal de editar -->
    <link href="css_MR/modal-editar.css" rel="stylesheet" />
      <!-- script de las alertas sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Iconos de font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- alertas de toastr -->
    <link href="./plugins/toastr/css/toastr.min.css" rel="stylesheet">



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
                
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2" id="cantidad-notificaciones">0</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">Nuevas Notificaciones</span>
                                </div>
                                <div class="dropdown-content-body">
                                <ul id="lista-notificaciones">
                                    <li><span class="notification-text">Cargando...</span></li>
                                </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span class="badge badge-pill gradient-2" id="cantidad-notificaciones-finalizadas">0</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">Reservas Finalizadas</span>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul id="lista-notificaciones-finalizadas">
                                        <li><span class="notification-text">Cargando...</span></li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <i class="fas fa-user-circle fa-2x text-dark" style="font-size: 40px;"></i>
                            </div>

                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
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
                    <li><a href="./historial-reservas.php">Historial De Reservas</a></li>
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
<!-- Aca se colocara lo recaudado en todo el año -->
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total Recuadado</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white total-recaudado">$ 0</h2>
                                    <p class="text-white mb-0">Enero - Diciembre 2025</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    
<!-- Aca se colocara la cantidad de reservas hechas -->
                    <div class="col-lg-6 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total reservas</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white total-reservas">0</h2>
                                    <p class="text-white mb-0">Enero - Deciembre 2025</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Cantidad de habitaciones y habitaciones que hay y porcentaje de cada una -->
            <div class="col-lg-12">
                <div class="card card-widget">
                    <div class="card-body">
                        
                        <!-- Bloque centrado -->
                        <div class="text-center mb-4">
                            <h5 class="fw-bold">Total habitaciones</h5>
                            <h2 id="total-habitaciones">0</h2>
                        </div>

                        <!-- Bloque alineado a la izquierda -->
                        <p class="fw-bold">Tipo de habitaciones</p>
                        <div id="habitaciones-tipo" class="mt-3">
                            <!-- contenido generado por JS -->
                        </div>

                    </div>
                </div>
            </div>

                <!-- Aca se pondria la información de las reservas -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center card-title">Información de reservaciones</h4>
                                <div class="mb-3 d-flex justify-content-start">
                                </div>
                                <button id="btnActualizarReservas" class="btn btn-primary">
                                    Actualizar Reservas
                                </button>
                                <div class="table-responsive"> 
                                    <table id="tablaReservas" class="table table-bordered table-striped verticle-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">Primer Nombre</th>
                                                <th scope="col">Primer Apellido</th>
                                                <th scope="col">Identificación</th>
                                                <th scope="col">Teléfono</th>
                                                <th scope="col">Fecha Llegada</th>
                                                <th scope="col">Fecha Salida</th>
                                                <th scope="col">Habitación</th>
                                                <th>Estado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Información de la base de datos -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>    

             



<!-- Modal Editar Reservación -->
            <div class="modal fade" id="modalEditarReserva" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-xl-ancho-personalizado" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Reservación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body modal-editar-contenido">
                            
                            <!-- Bloque Datos Huésped -->
                            <div class="bloque-editar">
                            <h5>Datos Huésped</h5>
                            <label>Primer Nombre:</label>
                            <input type="text" id="edit-prim-nombre" >
                            <label>Segundo Nombre:</label>
                            <input type="text" id="edit-seg-nombre" >
                            <label>Primer Apellido:</label>
                            <input type="text" id="edit-prim-apellido" >
                            <label>Segundo Apellido:</label>
                            <input type="text" id="edit-seg-apellido" >
                            <label>Edad:</label>
                            <input type="text" id="edit-edad" >
                            </div>

                            <!-- Bloque Contacto -->
                            <div class="bloque-editar">
                            <h5>Contacto</h5>
                            <label>Identificación:</label>
                            <input type="text" id="edit-identificacion" readonly>
                            <label>Teléfono:</label>
                            <input type="text" id="edit-telefono">
                            <label>Correo:</label>
                            <input type="email" id="edit-correo" >
                            </div>

                            <!-- Bloque Fechas -->
                            <div class="bloque-editar">
                            <h5>Fechas</h5>
                            <label>Fecha Llegada:</label>
                            <input type="date" id="edit-fecha-entrada" readonly>
                            <label>Fecha Salida:</label>
                            <input type="date" id="edit-fecha-salida">
                            <label>Cantidad Personas:</label>
                            <input type="number" id="edit-cantidad" >
                            </div>

                            <!-- Bloque Habitación y Estado -->
                            <div class="bloque-editar">
                            <h5>Habitación y Estado</h5>
                            <label>Habitación:</label>
                            <select id="edit-habitacion"></select>
                            <label>Estado de Reserva:</label>
                            <select id="edit-estado"></select>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="guardarCambios">Guardar Cambios</button>
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
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- MetisMenu JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>

    <script src="plugins/common/common.min.js"></script>
    <script src="js_MR/custom.min.js"></script>
    <script src="js_MR/settings.js"></script>
    <script src="js_MR/gleek.js"></script>
    <script src="js_MR/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="plugins/d3v3/index.js"></script>
    <script src="plugins/topojson/topojson.min.js"></script>
    <script src="plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="plugins/chartist/js/chartist.min.js"></script>
    <script src="plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>

    <!-- DataTables core -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


    <!-- Toastr -->
    <script src="./plugins/toastr/js/toastr.min.js"></script>
    <script src="./plugins/toastr/js/toastr.init.js"></script>
<script src="../js/validacion-fechas.js"></script>
    <script src="js_MR/dashboard/dashboard-1.js"></script>
    <script src="js_MR/dashboard-metricas.js"></script>
    <script src="js_MR/reservas-tabla.js"></script>
    <script src="js_MR/dashboard-hab.js"></script>
    <script src="js_MR/notificaciones.js"></script>
    <script src="js_MR/alertas-vencidas.js"></script>
   
    

    <!-- Script para evitar que el usuario vuelva a la página anterior -->
    <script>
    window.history.forward();
    window.onunload = function () {};
</script>>

    <script>
    toastr.info("Prueba de Toastr desde index.php", "Test Notificación");
</script>
</body>

</html>
