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
    <title>Dashboard Administrador</title>
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<?php require_once __DIR__ . 'menu.php'; ?>

    <!-- Contenido principal -->
    <main class="container mt-5">
        <h1 class="text-center mb-4">Bienvenido, <?php echo htmlspecialchars($_SESSION['user']['correo']); ?> (Administrador)</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Usuarios</h5>
                        <p class="card-text">Administra los usuarios registrados en el sistema.</p>
                        <a href="/admin/usuarios" class="btn btn-primary">Ir a Gestión de Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Consulta y genera reportes administrativos.</p>
                        <a href="/admin/reportes" class="btn btn-primary">Ir a Reportes</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require __DIR__ . '/footer.php'; ?>


    <!-- Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>