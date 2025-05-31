(function ($) {
    "use strict";

   document.addEventListener("DOMContentLoaded", function () {
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
                   "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    $.ajax({
        url: "acciones_MR/datos-graficas.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            const reservas = data.reservas;
            const ganancias = data.ganancias;

          // Gráfico de Reservas por tipo (ahora en barras agrupadas)
const ctxReservas = document.getElementById("graficaReservasMes").getContext("2d");
new Chart(ctxReservas, {
    type: 'bar',
    data: {
        labels: meses,
        datasets: [
            {
                label: 'Estándar',
                data: reservas.estandar,
                backgroundColor: '#4d7cff'
            },
            {
                label: 'Junior',
                data: reservas.junior,
                backgroundColor: '#66c00b'
            },
            {
                label: 'Presidencial',
                data: reservas.presidencial,
                backgroundColor: '#ffc107'
            }
        ]
    },
    options: {
        responsive: true,
        title: { display: true, text: 'Reservas por Mes (por tipo)' },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize: 1,
                    precision: 0
                }
            }]
        }
    }
});


            // Gráfico de Ganancias
            const ctxGanancias = document.getElementById("graficaGananciasMes").getContext("2d");
            new Chart(ctxGanancias, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Ganancias (COP)',
                        data: ganancias,
                        borderColor: '#650099',
                        fill: false,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    title: { display: true, text: 'Ganancias por Mes' },
                    scales: {
                        yAxes: [{ ticks: { beginAtZero: true,
                              stepSize: 500000, // 👈 Incrementos de 500 mil
                                callback: function(value) {
                                return '$ ' + new Intl.NumberFormat('es-CO').format(value);
                                }
                        } }]
                    }
                }
            });
        },
        error: function (err) {
            console.error("Error al cargar datos de gráficas:", err);
        }
    });
});


})(jQuery);

// Función para descargar el canvas como PDF
function descargarPDF(idCanvas, nombreArchivo) {
    const canvasContainer = document.getElementById(idCanvas).parentElement;

    html2canvas(canvasContainer, {
        scale: 5, // 📸 Mejora la calidad (más pixeles)
        useCORS: true
    }).then(canvasImg => {
        const imgData = canvasImg.toDataURL("image/png");
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF("landscape", "mm", "a4");

        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        // 🕒 Fecha y hora actual
        const ahora = new Date();
        const fechaHora = ahora.toLocaleString("es-CO", {
            dateStyle: "short",
            timeStyle: "short"
        });

        // 🖊️ Dibujar imagen
        pdf.addImage(imgData, "PNG", 10, 25, pdfWidth - 20, pdfHeight - 30);

        // 📝 Agregar texto de fecha en la esquina superior derecha
        pdf.setFontSize(10);
        pdf.text(`Generado: ${fechaHora}`, pdfWidth - 60, 15);

        // 💾 Guardar PDF
        pdf.save(nombreArchivo);
    });
}

