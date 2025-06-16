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
        <!--  Evitar que el navegador guarde páginas anteriores -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Perfil</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css_sesion/style.css" rel="stylesheet">
    <!-- Iconos de font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <a href="../Menu_recep/index.php">
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
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <i class="fas fa-user-circle fa-2x text-black" style="font-size: 40px;"></i>
                            </div>

                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.php"><i class="icon-user"></i> <span>Perfil</span></a>
                                        </li>
                                          
                                        <hr class="my-2">
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-4">
                <center><h3 class="mb-4">Información personal</h3></center>    
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nombre</label>
                            <input type="text" class="form-control" value="<?= $row['nom_cecep']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido</label>
                            <input type="text" class="form-control" value="<?= $row['apellido']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Edad</label>
                            <input type="text" class="form-control" value="<?= $row['edad_recep']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" value="<?= $row['tel_recep']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Identificación</label>
                            <input type="text" class="form-control" value="<?= $row['ident_recep']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" value="<?= $row['email_recep']; ?>" readonly>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalEditarPerfil">
                        Editar Información
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

            <!-- #/ container -->
        </div>
       <!-- Modal para editar perfil -->
        
<div class="modal fade" id="modalEditarPerfil" tabindex="-1" role="dialog" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="acciones_IN/actualizar-perfil.php" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar perfil</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idemple_recep" value="<?= $row['idemple_recep']; ?>">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nom_cecep" value="<?= $row['nom_cecep']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" class="form-control" name="apellido" value="<?= $row['apellido']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Edad</label>
                    <input type="number" class="form-control" name="edad_recep" value="<?= $row['edad_recep']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" class="form-control" name="tel_recep" value="<?= $row['tel_recep']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Identificación</label>
                    <input type="text" class="form-control" name="ident_recep" value="<?= $row['ident_recep']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email_recep" value="<?= $row['email_recep']; ?>" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

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
    <script src="js_IS/custom.min.js"></script>
    <script src="js_IS/settings.js"></script>
    <script src="js_IS/gleek.js"></script>
    <script src="js_IS/styleSwitcher.js"></script>
    <?php include("alertas_IN/alerta-exito-perfil.php"); ?>
    
        <!-- Script para evitar que el usuario vuelva a la página anterior -->
    <script>
    window.history.forward();
    window.onunload = function () {};
</script>>


    
</body>

</html>