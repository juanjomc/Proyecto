<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 1) {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Opciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css"> <!--CSS personalizado -->
</head>
<body>
<?php require_once __DIR__ . '/../menu.php'; ?>
<div class="container mt-4">
    <h2>Reservas desde hoy (<?php echo date('d/m/Y'); ?>)</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Email</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Realizada</th>
                <th>Total (€)</th>
                <th>Limpieza (€)</th>
                <th>Estado</th>
                <th>Desglose</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $i => $reserva): ?>
            <tr>
                <td><?php echo htmlspecialchars($reserva['nombre']); ?></td>
                <td><?php echo htmlspecialchars($reserva['correo']); ?></td>
                <td><?php echo date('d-m-Y', strtotime($reserva['entrada'])); ?></td>
                <td><?php echo date('d-m-Y', strtotime($reserva['salida'])); ?></td>
                <td><?php echo htmlspecialchars($reserva['fecha_reserva']); ?></td>
                <td><?php echo htmlspecialchars($reserva['total']); ?></td>
                <td><?php echo htmlspecialchars($reserva['limpieza']); ?></td>
                <td><?php echo htmlspecialchars($reserva['estado']); ?></td>
                <td>
                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#desglose<?php echo $i; ?>" aria-expanded="false" aria-controls="desglose<?php echo $i; ?>">
                        Ver
                    </button>
                </td>
            </tr>
            <tr class="collapse" id="desglose<?php echo $i; ?>">
                <td colspan="9">
                    <strong>Desglose por día:</strong>
                    <table class="table table-sm table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Precio (€)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reserva['detalles'] as $detalle): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($detalle['fecha']); ?></td>
                                    <td><?php echo htmlspecialchars($detalle['precio']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($reservas)): ?>
            <tr>
                <td colspan="9" class="text-center">No hay reservas futuras.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>