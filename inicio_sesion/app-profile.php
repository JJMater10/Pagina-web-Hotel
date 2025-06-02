<?php
session_start();

// 🔥 Muy importante: NO permitir caché
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 🔒 Verificar si la sesión está activa
if (!isset($_SESSION['nom_cecep'])) {
    header('Location: page-login.php');
    exit();
}

// Aquí ya puedes incluir tus archivos
include("consultas_IN/consultar_perfil.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Perfil</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css_sesion/style.css" rel="stylesheet">



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
                <a href="index.html">
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
                        
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2 badge-primary">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Reservaciones</span>  
                                    
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="img_IN/usuario.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span>Perfil</span></a>
                                        </li>
                                          
                                        <hr class="my-2">
                                        <li>
                                            <a href="page-lock.php"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li>
                                        <li><a href="acciones_IN/cerrar_sesion.php"><i class="icon-key"></i> <span>Cerrar Sesión</span></a></li>
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
                            <li><a href="../Menu_recep/index.php">Administrar</a></li>
                            <!-- <li><a href="./index-2.html">Home 2</a></li> -->
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

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Perfil</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Usuario</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media align-items-center mb-4">                                     
                                        <div class="media-body">
                                        <h3 class="mb-0"><?php echo htmlspecialchars($datos['nom_cecep']); ?></h3>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-5">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-danger px-5">Eliminar Cuenta</button>
                                        </div>
                                    </div>
    
                                    
                                    <ul class="card-profile__info">
                                        <li class="mb-1">
                                            <strong class="text-dark mr-4">Teléfono</strong> 
                                            <span><?php echo htmlspecialchars($datos['tel_recep']); ?></span>
                                        </li>
                                        <li>
                                            <strong class="text-dark mr-4">Correo</strong> 
                                            <span><?php echo htmlspecialchars($datos['email_recep']); ?></span>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>  
                        </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <form action="#" id="step-form-horizontal" class="step-form-horizontal">
                                    <div>
                                        <h4>Información del usuario</h4>
                                        <section>
                                            <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($datos['nom_cecep']); ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="edad">Edad</label>
                                                    <input type="text" name="edad" id="edad" class="form-control" value="<?php echo htmlspecialchars($datos['edad_recep']); ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="telefono">Teléfono</label>
                                                    <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo htmlspecialchars($datos['tel_recep']); ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="identificacion">Identificación</label>
                                                    <input type="text" name="identificacion" id="identificacion" class="form-control" value="<?php echo htmlspecialchars($datos['ident_recep']); ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="correo">Correo</label>
                                                    <input type="email" name="correo" id="correo" class="form-control" value="<?php echo htmlspecialchars($datos['email_recep']); ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="password">Contraseña</label>
                                                    <input type="password" name="Password" id="password" class="form-control" value="********" disabled>
                                                </div>
                                            </div>

                                            <div class="bootstrap-modal">
                                            <!-- Botón para abrir el modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditarPerfil">
                                                Editar Perfil
                                            </button>
                                            </div>
                                        </section>
                            </div>
                            
                        </div>
                        </div>
                        
                        boton modal
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Contenido de la ventana modal
        ***********************************-->
        <!-- Modal Editar Perfil -->
<div class="modal fade" id="modalEditarPerfil" tabindex="-1" role="dialog" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-editar-perfil" method="POST" action="acciones_IN/actualizar-perfil.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarPerfilLabel">Editar Información del Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Campo oculto para enviar el ID del recepcionista -->
                    <input type="hidden" name="idemple_recep" id="idemple_recep" value="<?php echo htmlspecialchars($datos['idemple_recep']); ?>">

                    <div class="form-group">
                        <label for="nom_cecep">Nombre</label>
                        <input type="text" class="form-control" name="nom_cecep" id="nom_cecep" value="<?php echo htmlspecialchars($datos['nom_cecep']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="edad_recep">Edad</label>
                        <input type="text" class="form-control" name="edad_recep" id="edad_recep" value="<?php echo htmlspecialchars($datos['edad_recep']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="tel_recep">Teléfono</label>
                        <input type="text" class="form-control" name="tel_recep" id="tel_recep" value="<?php echo htmlspecialchars($datos['tel_recep']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email_recep">Correo</label>
                        <input type="email" class="form-control" name="email_recep" id="email_recep" value="<?php echo htmlspecialchars($datos['email_recep']); ?>">
                    </div>
                </div> <!-- Fin modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Realizar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
        
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
    <script src="plugins/common/common.min.js"></script>
    <script src="js_IS/custom.min.js"></script>
    <script src="js_IS/settings.js"></script>
    <script src="js_IS/gleek.js"></script>
    <script src="js_IS/styleSwitcher.js"></script>
    


    
</body>

</html>