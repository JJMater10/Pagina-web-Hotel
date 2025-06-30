
<?php
session_start(); // Iniciar la sesión para verificar alertas
require_once 'Conexión_BD/conexion.php'; // Incluir la conexión a la base de datos

// Verificar si hay una reserva exitosa y mostrar la alerta
if (isset($_SESSION['reserva_exitosa']) && $_SESSION['reserva_exitosa']) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Reserva Exitosa!',
                text: 'Su reservación ha sido registrada con éxito.',
                icon: 'success'
            });
        });
    </script>";

    // Eliminar la variable de sesión para que no se repita la alerta al recargar
    unset($_SESSION['reserva_exitosa']);
}
// Obtener habitaciones desde la base de datos
$sql_habitaciones = "SELECT idhabitacion, nom_hab FROM habitacion WHERE hab_dispo > 0";
$result_habitaciones = $conn->query($sql_habitaciones);

// Obtener medios de pago desde la base de datos
$sql_medios_pago = "SELECT idmedio_pag, tipo_pag FROM medio_pag";
$result_medios_pago = $conn->query($sql_medios_pago);
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
    <div class="container">
        <form action="Acciones/guardar_formulario.php" method="POST" class="form-register">
            <h4>Formulario Registro</h4>

            <!-- Fila para primer y segundo nombre -->
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="prim_nom_client" class="controls" placeholder="Primer Nombre" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="seg_nom_client" class="controls" placeholder="Segundo Nombre">
                </div>
            </div>

            <!-- Fila para primer y segundo apellido -->
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="prim_apelli_client" class="controls" placeholder="Primer Apellido" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="seg_apelli_client" class="controls" placeholder="Segundo Apellido">
                </div>
            </div>

            <!-- Fila para edad y identificación -->
            <div class="row">
                <div class="col-md-6">
                    <input type="number" name="edad_client" class="controls" placeholder="Edad" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="iden_client" class="controls" placeholder="Identificación" required>
                </div>
            </div>

            <!-- Fila para teléfono y correo -->
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="tel_client" class="controls" placeholder="Teléfono" pattern="[0-9]{10}" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email_client" class="controls" placeholder="Correo Electrónico" required>
                </div>
            </div>

            <!-- Fila para fechas -->
            <div class="row">
                <div class="col-md-6">
                    <label>Fecha de Entrada:</label>
                    <input type="date" class="controls" name="fecha_entrada" id="fecha_entrada" required>
                </div>
                <div class="col-md-6">
                    <label>Fecha de Salida:</label>
                    <input type="date" class="controls" name="fecha_salida" id="fecha_salida" required>
                </div>
            </div>

            <!-- Fila para cantidad de personas -->
            <div class="row">
                <div class="col-md-6">
                    <label>Cantidad de Personas:</label>
                    <input type="number" class="controls" name="cant_person" pattern="[0-9]{10}" required>
                </div>
            </div>

            <!-- Fila para seleccionar habitación y medio de pago -->
            <div class="row">
                <div class="col-md-6">
                    <label>Selecciona la Habitación:</label>
                    <select name="habitacion_id" class="controls" required>
                        <option value="">Seleccione una habitación</option>
                        <?php while ($row = $result_habitaciones->fetch_assoc()): ?>
                            <option value="<?php echo $row['idhabitacion']; ?>">
                                <?php echo $row['nom_hab']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Selecciona Medio de Pago:</label>
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

            <!-- Botón de reserva -->
            <button type="submit" class="botons">Reservar</button>
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