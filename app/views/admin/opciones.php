<?php
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success">Opciones actualizadas correctamente.</div>';
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
    <?php require_once __DIR__ . '/menu_admin.php'; ?>

    <main class="container mt-5">
        <h1 class="text-center mb-4">Modificar Opciones</h1>

        <!-- Contenedor para mensajes -->
        <div id="message" class="mb-3"></div>

        <form id="opcionesForm">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($opciones as $opcion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($opcion['opcion']); ?></td>
                            <td>
                                <input type="text" name="opciones[<?php echo $opcion['id']; ?>]" 
                                       value="<?php echo htmlspecialchars($opcion['valor']); ?>" 
                                       class="form-control">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date("Y"); ?> Mi Proyecto Web. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('opcionesForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Evitar el envío tradicional del formulario

            const formData = new FormData(this); // Crear un objeto FormData con los datos del formulario

            fetch('/admin/opciones/update', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Leer la respuesta como JSON
            .then(data => {
                const message = document.getElementById('message');
                if (data.success) {
                    message.innerHTML = '<div class="alert alert-success">Opciones actualizadas correctamente.</div>';
                } else {
                    message.innerHTML = '<div class="alert alert-danger">Error al actualizar las opciones.</div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const message = document.getElementById('message');
                message.innerHTML = '<div class="alert alert-danger">Error al enviar la solicitud. Inténtalo de nuevo.</div>';
            });
        });
    </script>
</body>
</html>