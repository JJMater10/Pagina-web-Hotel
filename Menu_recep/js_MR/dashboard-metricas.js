$(document).ready(function() {
    $.ajax({
        url: "acciones_MR/dashboard-metricas.php",
        method: "GET",
        dataType: "json",
        success: function(data) {
            let recaudadoFormateado = new Intl.NumberFormat('es-CO').format(data.recaudado);
$('.total-recaudado').text(`$ ${recaudadoFormateado}`);
            $('.total-reservas').text(data.reservas);
        },
        error: function(err) {
            console.error("Error al cargar métricas:", err);
        }
    });
});


