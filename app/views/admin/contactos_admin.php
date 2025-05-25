<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 1) {
    header('Location: /'); // Redirigir al inicio si no tiene acceso
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="/css/styles.css"> <!-- Asegúrate de que este archivo sea el mismo que usas en main.php -->
</head>
<body>
    <?php require_once __DIR__ . '/../menu.php'; ?>


    <!-- Contenido principal -->
    <main class="container mt-5">
        <h1 class="text-center mb-4">Listado de Contactos</h1>
        <form id="contactosForm" method="POST" action="/admin/contactos/acciones">
        
        <div class="d-flex justify-content-center">
            <table class="table table-striped w-100 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="col text-center"><input type="checkbox" id="selectAll"></th>
                            <th class="col text-center">Nombre</th>
                            <th class="col text-center">Email</th>
                            <th class="col text-center">Teléfono</th>
                            <th class="col text-center">Mensaje</th>
                            <th class="col text-center">Dirección IP</th>
                            <th class="col text-center">Fecha de Entrada</th>
                            <th class="col text-center">Fecha de Salida</th>
                            <th class="col text-center">Fecha de Recepción</th>
                            <th class="col text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($contactos)): ?>
                            <?php foreach ($contactos as $contacto): ?>
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="contactos[]" value="<?php echo htmlspecialchars($contacto['id']); ?>">
                                    </td>
                                    <td class="text-nowrap"><?php echo htmlspecialchars($contacto['nombre']); ?></td>
                                    <td class="text-nowrap"><?php echo htmlspecialchars($contacto['email']); ?></td>
                                    <td class="text-nowrap"><?php echo htmlspecialchars($contacto['telefono']); ?></td>
                                    <td class="text-truncate" style="max-width: 500px;"><?php echo htmlspecialchars($contacto['mensaje']); ?></td>
                                    <td class="text-nowrap"><?php echo htmlspecialchars($contacto['ip']); ?></td>
                                    <td class="text-nowrap"><?php echo htmlspecialchars($contacto['fecha_entrada']); ?></td>
                                    <td class="text-nowrap"><?php echo htmlspecialchars($contacto['fecha_salida']); ?></td>
                                    <td class="text-nowrap"><?php echo htmlspecialchars($contacto['fecha_hora']); ?></td>
                                    <td class="text-center">
                                        <?php if ($contacto['leido'] == 1): ?>
                                            <span class="badge bg-success">New</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">No hay contactos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        

            <!-- Opciones de acciones -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <select name="accion" class="form-select w-auto" required>
                    <option value="" disabled selected>Selecciona una acción</option>
                    <option value="marcar_leido">Marcar como leído</option>
                    <option value="marcar_no_leido">Marcar como no leído</option>
                    <option value="borrar">Borrar</option>
                </select>
                <button type="submit" class="btn btn-primary">Ejecutar</button>
            </div>
        </form>
    </main>

    <?php require __DIR__ . '/../footer.php'; ?>

    <!-- Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Seleccionar todos los checkboxes
        document.getElementById('selectAll').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('input[name="contactos[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>
</body>
</html>