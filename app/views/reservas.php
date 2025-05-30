<?php

session_start();
require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

if (!isset($_SESSION['user'])) {?>
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
    <?php exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <?php require_once "menu.php";?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Realizar una Reserva</h2>
        <form id="reservaForm" method="POST" class="p-4 rounded shadow bg-light">
            <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $_SESSION['user']['id']; ?>">
            <div class="mb-3">
                <label for="dateRange" class="form-label">Selecciona un rango de fechas</label>
                <input type="text" class="form-control" id="dateRange" name="dateRange" placeholder="Selecciona un rango de fechas" required>
            </div>
            <div id="desglose" class="mt-4"></div>
            <div id="total" class="mt-4"></div>
        </form>

    <!-- Stripe Elements -->
    <form id="payment-form" class="mb-4" style="display:none;">
    <h5 class="mb-3">Introduce los datos de tu tarjeta</h5>
    <div id="card-element" class="mb-2"></div>
    <small class="text-muted mb-2 d-block">Tus datos están seguros y no se almacenan en nuestro servidor.</small>
    <button id="submit" class="btn btn-primary mt-3">
    <span id="spinner" class="spinner-border spinner-border-sm d-none"></span>
    Pagar y reservar
    </button>
    <div id="card-errors" role="alert" class="mt-2 text-danger" aria-live="polite"></div>
    </form>

    <div id="reservaResponse" class="mt-3"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let tarifas = {};
        let preciosPorDia = {};
        let totalReserva = 0;

        // Obtener las tarifas desde la base de datos
        fetch('/tarifas/obtener')
            .then(response => response.json())
            .then(data => {
                tarifas = data;
            })
            .catch(error => {
                console.error('Error al obtener las tarifas:', error);
            });

        const picker = new Litepicker({
            element: document.getElementById('dateRange'),
            singleMode: false,
            format: 'YYYY-MM-DD',
            autoApply: true,
            lang: 'es',
            minDate: new Date().toISOString().split('T')[0],
            tooltipText: { one: 'día', other: 'días' },
            tooltipNumber: (totalDays) => totalDays,
            setup: (picker) => {
                picker.on('selected', (start, end) => {
                    calcularDesglose(start.dateInstance, end.dateInstance);
                });
            }
        });

        function calcularDesglose(start, end) {
            const diasSemana = [
                'domingo', 'laborables', 'laborables', 'laborables', 'laborables', 'laborables', 'sabados'
            ];
            const limpieza = tarifas['limpieza'] ? parseFloat(tarifas['limpieza']) : 0;

            let desgloseHTML = '';
            let total = 0;
            const fechaInicio = new Date(start.getTime());
            fechaInicio.setDate(fechaInicio.getDate() + 1);
            const fechaFin = new Date(end.getTime());
            fechaFin.setDate(fechaFin.getDate() + 1);

            const dias = [];
            while (fechaInicio < fechaFin) {
                dias.push(new Date(fechaInicio));
                fechaInicio.setDate(fechaInicio.getDate() + 1);
            }

            preciosPorDia = {};
            desgloseHTML += '<h5>Desglose de días:</h5><ul>';
            dias.forEach(dia => {
                const grupo = diasSemana[dia.getDay()];
                const fechaFormateada = dia.toISOString().split('T')[0];
                const tarifa = tarifas[grupo] ? parseFloat(tarifas[grupo]) : 0;
                desgloseHTML += `<li>${fechaFormateada} (${grupo}) - ${tarifa}€</li>`;
                total += tarifa;
                preciosPorDia[fechaFormateada] = tarifa;
            });
            desgloseHTML += '</ul>';
            desgloseHTML += `<h5>Limpieza:</h5><p>${limpieza}€</p>`;
            total += limpieza;

            totalReserva = total;
            document.getElementById('desglose').innerHTML = desgloseHTML;
            document.getElementById('total').innerHTML = `<h4>Total: ${total}€</h4>`;

            // Mostrar Stripe Elements solo si hay total
            if (total > 0) {
                document.getElementById('payment-form').style.display = 'block';
            } else {
                document.getElementById('payment-form').style.display = 'none';
            }
        }

        // Stripe
        const stripe = Stripe('<?php echo $_ENV['STRIPE_PUBLIC_KEY']; ?>');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        document.getElementById('payment-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            // 1. Solicita el PaymentIntent al backend
            let res = await fetch('/reserva/crearPagoStripe', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'total=' + encodeURIComponent(totalReserva)
            });
            let data = await res.json();

            // 2. Confirma el pago con Stripe
            const result = await stripe.confirmCardPayment(data.clientSecret, {
                payment_method: { card: card }
            });

            if (result.error) {
                document.getElementById('card-errors').textContent = result.error.message;
            } else {
                if (result.paymentIntent.status === 'succeeded') {
                    // 3. Si el pago es correcto, guarda la reserva en el backend
                    const formData = new FormData();
                    const dateRange = document.getElementById('dateRange').value.split(' - ');
                    formData.append('fecha_inicio', dateRange[0]);
                    formData.append('fecha_fin', dateRange[1]);
                    formData.append('precios', JSON.stringify(preciosPorDia));
                    formData.append('stripe_payment_id', result.paymentIntent.id);

                    fetch('/reservas/store', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        const responseDiv = document.getElementById('reservaResponse');
                        if (data.success) {
                            responseDiv.innerHTML = '<div class="alert alert-success">Reserva realizada correctamente.</div>';
                            document.getElementById('reservaForm').reset();
                            document.getElementById('payment-form').reset();
                        } else {
                            responseDiv.innerHTML = '<div class="alert alert-danger">Error: ' + (data.error || 'Error desconocido') + '</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('reservaResponse').innerHTML = '<div class="alert alert-danger">Error al procesar la solicitud.</div>';
                    });
                }
            }
        });
    </script>
</body>
</html>