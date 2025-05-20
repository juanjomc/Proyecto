<?php
session_start();
if (!isset($_SESSION['user'])) {
    // Mostrar mensaje y redirigir a registro después de 5 segundos
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reservas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script>
            setTimeout(function() {
                window.location.href = "/registro";
            }, 5000);
        </script>
    </head>
    <body>
        <div class="container mt-3">
            <div class="alert alert-success fade-out">
                Debes estar registrado para hacer una reserva.<br>
            </div>
        </div>
    </body>
    </html>
    ';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css"> <!-- Tu CSS personalizado -->

    <!-- Litepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css">
</head>
<body>
    <?php require_once "menu.php";?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Realizar una Reserva</h2>
        <form id="reservaForm" method="POST" class="p-4 rounded shadow bg-light">
            <input type="hidden" id="usuario_id" name="usuario_id" value="1"> <!-- ID del usuario (puedes cambiarlo dinámicamente) -->
            <div class="mb-3">
                <label for="dateRange" class="form-label">Selecciona un rango de fechas</label>
                <input type="text" class="form-control" id="dateRange" name="dateRange" placeholder="Selecciona un rango de fechas" required>
            </div>
            <div id="desglose" class="mt-4"></div> <!-- Contenedor para el desglose -->
            <div id="total" class="mt-4"></div> <!-- Contenedor para el total -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Reservar</button>
            </div>
        </form>
        <div id="reservaResponse" class="mt-3"></div>
    </div>

    <!-- Litepicker y Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let tarifas = {};

        // Obtener las tarifas desde la base de datos
        fetch('/tarifas/obtener')
            .then(response => response.json())
            .then(data => {
                tarifas = data; // Guardar las tarifas en una variable global
            })
            .catch(error => {
                console.error('Error al obtener las tarifas:', error);
            });

        const picker = new Litepicker({
            element: document.getElementById('dateRange'),
            singleMode: false, // Habilitar selección de rango
            format: 'YYYY-MM-DD', // Formato de la fecha
            autoApply: true, // Aplicar automáticamente el rango seleccionado
            lang: 'es', // Idioma del calendario
            minDate: new Date().toISOString().split('T')[0], // Deshabilitar fechas anteriores al día de hoy
            tooltipText: {
                one: 'día',
                other: 'días'
            },
            tooltipNumber: (totalDays) => {
                return totalDays;
            },
            setup: (picker) => {
                picker.on('selected', (start, end) => {
                    console.log('📅 selected ejecutado');
                    calcularDesglose(start.dateInstance, end.dateInstance);
                });
            }
        });

        function calcularDesglose(start, end) {
            const diasSemana = [
                'domingo',     // 0
                'laborables',  // 1
                'laborables',  // 2
                'laborables',  // 3
                'laborables',  // 4
                'laborables',  // 5
                'sabados'      // 6
            ];
            const limpieza = tarifas['limpieza'] ? parseFloat(tarifas['limpieza']) : 0;

            let desgloseHTML = '';
            let total = 0;

            // Clonar las fechas para evitar modificar los objetos originales
            const fechaInicio = new Date(start.getTime());
            const fechaFin = new Date(end.getTime());

            // Crear un array con todas las fechas del rango
            const dias = [];
            while (fechaInicio <= fechaFin) {
                dias.push(new Date(fechaInicio));
                fechaInicio.setDate(fechaInicio.getDate() + 1);
            }

            // Generar el desglose día por día
            desgloseHTML += '<h5>Desglose de días:</h5><ul>';
            dias.forEach(dia => {
                const grupo = diasSemana[dia.getDay()];
                const fechaFormateada = dia.toISOString().split('T')[0];
                const tarifa = tarifas[grupo] ? parseFloat(tarifas[grupo]) : 0;

            desgloseHTML += `<li>${fechaFormateada} (${grupo}) - ${tarifa}€</li>`;
            total += tarifa;
            });
            desgloseHTML += '</ul>';

            // Agregar tarifa de limpieza como concepto aparte
            desgloseHTML += `<h5>Limpieza:</h5><p>${limpieza}€</p>`;
            total += limpieza;

            // Mostrar el desglose y el total
            document.getElementById('desglose').innerHTML = desgloseHTML;
            document.getElementById('total').innerHTML = `<h4>Total: ${total}€</h4>`;
        }

        document.getElementById('reservaForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const dateRange = document.getElementById('dateRange').value.split(' - ');
            formData.append('fecha_inicio', dateRange[0]);
            formData.append('fecha_fin', dateRange[1]);

            fetch('/reservas/store', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    const responseDiv = document.getElementById('reservaResponse');
                    if (data.success) {
                        responseDiv.innerHTML = '<div class="alert alert-success">Reserva realizada correctamente.</div>';
                        this.reset(); // Limpiar el formulario
                    } else {
                        responseDiv.innerHTML = '<div class="alert alert-danger">Error: ' + (data.error || 'Error desconocido') + '</div>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('reservaResponse').innerHTML = '<div class="alert alert-danger">Error al procesar la solicitud.</div>';
                });
        });
    </script>
</body>
</html>