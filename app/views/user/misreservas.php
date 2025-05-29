<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<?php require_once __DIR__ . '/../menu.php'; ?>
<div class="container mt-5">
    <h1>Mis Reservas</h1>
    <?php if (empty($reservas)): ?>
        <div class="alert alert-info">No tienes reservas.</div>
    <?php else: ?>
        <?php foreach ($reservas as $reserva): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Reserva #<?php echo $reserva['id']; ?></strong>
                    <?php if (isset($reserva['fecha_reserva'])): ?>
                        <span class="text-secondary" style="font-size:0.95em;">
                            <i class="bi bi-clock-history"></i>
                            <?php echo date('d-m-Y H:i', strtotime($reserva['fecha_reserva'])); ?>
                        </span>
                    <?php endif; ?>
                    <i class="bi bi-calendar-event text-primary"></i> Entrada: <?php echo $reserva['entrada']; ?>
                    <i class="bi bi-calendar-event text-danger"></i> Salida: <?php echo $reserva['salida']; ?>
                    Estado: <?php echo $reserva['estado']; ?>
                    <?php if (strtolower($reserva['estado']) === 'pagado'): ?>
                        <i class="bi bi-check-circle-fill text-success ms-1"></i>
                    <?php endif; ?>
                    <a href="/user/comprobante?id=<?php echo $reserva['id']; ?>" class="btn btn-sm btn-outline-primary ms-2" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i> Descargar comprobante PDF
                    </a>
                </div>
                <div class="card-body">
                    <p><strong>Total:</strong> <?php echo $reserva['total']; ?> €</p>
                    <p><strong>Limpieza:</strong> <?php echo $reserva['limpieza']; ?> €</p>
                    <h5>Detalles por día:</h5>
                    <ul>
                        <?php foreach ($reserva['detalles'] as $detalle): ?>
                            <li>
                                <?php echo $detalle['fecha']; ?> - <?php echo $detalle['precio']; ?> € (<?php echo $detalle['estado']; ?>)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>