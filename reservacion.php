<?php
include 'Acciones/cargar_datos_reservacion.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pagina Web Hotel</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles_formu.css" rel="stylesheet" />
        <link href="css/formulario.css"  type="text/css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.html">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#reserva">Reservación</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contactanos</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">¡Bienvenido al registro de la reservación de tu habitación</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#reserva">Continuemos</a>
            </div>
        </header>
        <!-- Reservación = Aqui poner el formulario de reservacion -->
        <section id="reserva">
                <div class="container-fluid"> <!-- Cambiamos a fluid -->
                <form action="Acciones/guardar_formulario.php" method="POST" class="form-register">
                        <h4>Formulario Registro</h4>

                        <div class="row">
                            <!-- Bloque DATOS HUESPED -->
                            <div class="col-md-3 bloque-form">
                                <h5 class="titulo-bloque">Datos Huésped</h5>
                                <label>* Primer Nombre:</label>
                                <input type="text" name="prim_nom_client" class="controls" placeholder="Digite su primer nombre" required>
                                <label>Segundo Nombre:</label>
                                <input type="text" name="seg_nom_client" class="controls" placeholder="Digite su segundo nombre">
                                <label>* Primer Apellido:</label>
                                <input type="text" name="prim_apelli_client" class="controls" placeholder="Digite su primer apellido" required>
                                <label>Segundo Apellido:</label>
                                <input type="text" name="seg_apelli_client" class="controls" placeholder="Digite su segundo apellido">
                                <label>* Edad:</label>
                                <input type="number" name="edad_client" class="controls" placeholder="Digite su edad" required>
                            </div>

                            <!-- Bloque SALIDA - ENTRADA -->
                            <div class="col-md-3 bloque-form">
                                <h5 class="titulo-bloque">Entrada / Salida</h5>
                                <label>* Fecha de Entrada:</label>
                                <input type="date" class="controls" name="fecha_entrada" id="fecha_entrada" required>
                                <label>* Fecha de Salida:</label>
                                <input type="date" class="controls" name="fecha_salida" id="fecha_salida" required>
                                <label>* Cantidad de Personas:</label>
                                <input type="number" class="controls" name="cant_person" required>
                            </div>

                            <!-- Bloque CONTACTO -->
                            <div class="col-md-3 bloque-form">
                                <h5 class="titulo-bloque">Contacto</h5>
                                <label>* Identificación:</label>
                                <input type="text" name="iden_client" class="controls" placeholder="Digite su identificación" required>
                                <label>* Teléfono:</label>
                                <input type="text" name="tel_client" class="controls" placeholder="Digite su teléfono" pattern="[0-9]{10}" required>
                                <label>* Correo Electrónico:</label>
                                <input type="email" name="email_client" class="controls" placeholder="Digite su correo electrónico" required>
                            </div>

                            <!-- Bloque HABITACIÓN / MEDIO DE PAGO -->
                            <div class="col-md-3 bloque-form">
                                <h5 class="titulo-bloque">Habitación y Pago</h5>
                                <label>* Selecciona la Habitación:</label>
                                <select name="habitacion_id" class="controls" required>
                                    <option value="">Seleccione una habitación</option>
                                    <?php while ($row = $result_habitaciones->fetch_assoc()): ?>
                                        <option value="<?php echo $row['idhabitacion']; ?>">
                                            <?php echo $row['nom_hab']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <label>* Selecciona Medio de Pago:</label>
                                <select name="medio_pago" class="controls" required>
                                    <option value="">Seleccione un método de pago</option>
                                    <?php while ($row = $result_medios_pago->fetch_assoc()): ?>
                                        <option value="<?php echo $row['idmedio_pag']; ?>">
                                            <?php echo $row['tipo_pag']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <label>Las casillas marcadas con un asterisco (*) son obligatorias.</label>
                        <!-- Botón de reserva centrado -->
                        <div class="row mt-4">
                            <div class="col text-center">
                                <button type="submit" class="botons">Reservar</button>
                            </div>
                        </div>
                    </form>

            </div>

</section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contactanos</h2>
                    <h3 class="section-subheading text-muted-r">Numero: 31311352469</h3>
                    <h3 class="section-subheading text-muted-r">Dirección: Cra 5 #40-42</h3>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start text-muted-r">Copyright &copy; Your Website 2025</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3 text-muted-r" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none text-muted-r" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts_form.js"></script>
        <script src="js/validacion.js"></script>
        <script src="js/validacion-fechas.js"></script>

        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->
    </body>
</html>

<?php
$conn->close();
?>