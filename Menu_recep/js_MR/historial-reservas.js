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

            $("#tablaHistorial").DataTable({
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
                },
                dom: 'Bfrtip', // Esta línea activa el área de botones arriba de la tabla
                buttons: [
                        {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
                        className: 'btn mb-1 btn-success', // ✅ clase personalizada
                        title: null, // ← Esto evita la fila combinada arriba de tus datos
                        filename: 'Historial_Reservas_HotelXYZ',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function (xlsx) {
                            const sheet = xlsx.xl.worksheets['sheet1.xml'];
                            const fecha = new Date().toLocaleString('es-CO');
                            const empresa = 'Hotel XYZ';

                            // ⚠️ Obtiene el XML en bruto
                            const sheetData = sheet.getElementsByTagName('sheetData')[0];
                            const firstRow = sheetData.getElementsByTagName('row')[0];

                            // Crea el bloque XML con empresa y fecha (usando innerHTML directo)
                            const encabezado = `
                                <row r="1">
                                    <c t="inlineStr" r="A1">
                                        <is><t>${empresa}</t></is>
                                    </c>
                                    <c t="inlineStr" r="B1">
                                        <is><t>Fecha: ${fecha}</t></is>
                                    </c>
                                </row>
                            `;

                            // Inserta la nueva fila al inicio del <sheetData>
                            sheetData.innerHTML = encabezado + sheetData.innerHTML;

                            // ✅ Actualiza los índices de todas las demás filas (r=2 en adelante)
                            const rows = sheetData.getElementsByTagName('row');
                            for (let i = 1; i < rows.length; i++) {
                                const rIndex = i + 1;
                                rows[i].setAttribute('r', rIndex);
                                const cells = rows[i].getElementsByTagName('c');
                                for (let j = 0; j < cells.length; j++) {
                                    const cellRef = cells[j].getAttribute('r');
                                    if (cellRef) {
                                        const col = cellRef.replace(/\d+/, ''); // Solo letra A, B...
                                        cells[j].setAttribute('r', col + rIndex);
                                    }
                                }
                            }
                        }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
                            className: 'btn mb-1 btn-danger', // ✅ clase personalizada
                            title: 'Historial Reservas',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: ':visible'
                            },
                            customize: function (doc) {
                                const ahora = new Date();
                                const fecha = ahora.toLocaleDateString('es-CO');
                                const hora = ahora.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit' });

                                doc.content.unshift({
                                    columns: [
                                        //{ image: '', width: 50 },
                                        {
                                            text: 'Hotel XYZ\nHistorial de Reservas',
                                            alignment: 'center',
                                            fontSize: 14,
                                            margin: [0, 0, 0, 5]
                                        },
                                        {
                                            text: `Fecha: ${fecha}\nHora: ${hora}`,
                                            alignment: 'right',
                                            fontSize: 10
                                        }
                                    ],
                                    margin: [0, 0, 0, 10]
                                });

                                doc.styles.tableHeader.fontSize = 10;
                                doc.defaultStyle.fontSize = 9;
                            }
                        }
                    ]
            });
        },
        error: function (err) {
            console.error("Error al obtener reservas finalizadas:", err);
        }       
    });
});
