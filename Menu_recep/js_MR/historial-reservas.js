$(document).ready(function () {
    $.ajax({
        url: "acciones_MR/obtener-reservas-finalizadas.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            const tbody = $("table.table tbody");
            tbody.empty(); // limpia por si acaso

            data.forEach(function (reserva) {
                const fila = `
                    <tr>
                        <td>${reserva.prim_nom_client}</td>
                        <td>${reserva.seg_nom_client || ''}</td>
                        <td>${reserva.prim_apelli_client}</td>
                        <td>${reserva.seg_apelli_client || ''}</td>
                        <td>${reserva.edad_client}</td>
                        <td>${reserva.iden_client}</td>
                        <td>${reserva.tel_client}</td>
                        <td>${reserva.email_client}</td>
                        <td>${reserva.fecha_entra}</td>
                        <td>${reserva.fecha_sal}</td>
                        <td>${reserva.cant_person}</td>
                        <td>${reserva.habitacion}</td>
                        <td>${reserva.medio_pago}</td>
                    </tr>
                `;
                tbody.append(fila);
            });

            $("table.table").DataTable({
                responsive: true,
                language: {
                    decimal: ",",
                    thousands: ".",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 a 0 de 0 entradas",
                    infoFiltered: "(filtrado de _MAX_ entradas totales)",
                    search: "Buscar:",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    emptyTable: "No hay datos disponibles en la tabla"
                }
            });
        },
        error: function (err) {
            console.error("Error al obtener reservas finalizadas:", err);
        }
    });
});
