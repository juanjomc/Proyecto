<?php
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
<main class="container mt-5">
    <h1 class="mb-4">Cambiar Contraseña</h1>
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($mensaje); ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="password_actual" class="form-label">Contraseña actual</label>
            <input type="password" class="form-control" id="password_actual" name="password_actual" required>
        </div>
        <div class="mb-3">
            <label for="password_nueva" class="form-label">Nueva contraseña</label>
            <input type="password" class="form-control" id="password_nueva" name="password_nueva">
        </div>
        <div class="mb-3">
            <label for="password_nueva2" class="form-label">Repite la nueva contraseña</label>
            <input type="password" class="form-control" id="password_nueva2" name="password_nueva2">
        </div>
        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
    </form>
</main>
</body>
</html>