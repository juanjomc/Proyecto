<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 2) {
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
<?php require_once __DIR__ . '/menu.php'; ?>

    
    
    <main class="container mt-5">
        <h1 class="mb-4">Editar Perfil</h1>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>
        <form method="POST" id="perfilForm">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre"
               value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos"
           value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
           value="<?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Nueva contraseña</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
        <label for="password2" class="form-label">Repite la nueva contraseña</label>
        <input type="password" class="form-control" id="password2" name="password2">
        <div id="passwordHelp" class="form-text text-danger d-none">Las contraseñas no coinciden.</div>
    </div>
    <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar Cambios</button>
</form>

<script>
// Primero obtengo los elementos del DOM que necesito:
const pass1 = document.getElementById('password');
const pass2 = document.getElementById('password2');
const help = document.getElementById('passwordHelp');
const btn = document.getElementById('guardarBtn');

// Defino una función para comprobar las contraseñas cada vez que el usuario escribe en los campos
function checkPasswords() {
    // Si ambos campos están vacíos, no muestro ningún mensaje y permito guardar
    if (pass1.value === "" && pass2.value === "") {
        help.textContent = ""; // No muestro nada
        help.classList.add("d-none"); // Oculto el mensaje
        btn.disabled = false; // Habilito el botón
    // Si las contraseñas coinciden (puedes añadir aquí también la comprobación de longitud mínima)
    } else if (pass1.value === pass2.value) {
        help.textContent = "Las contraseñas coinciden."; // Muestro mensaje de éxito
        help.classList.remove("text-danger", "d-none"); // Quito estilos de error y muestro el mensaje
        help.classList.add("text-success"); // Añado estilo de éxito
        btn.disabled = false; // Habilito el botón
    // Si no coinciden, muestro error y deshabilito el botón
    } else {
        help.textContent = "Las contraseñas no coinciden o son demasiado cortas."; // Muestro mensaje de error
        help.classList.remove("text-success", "d-none"); // Quito estilo de éxito y muestro el mensaje
        help.classList.add("text-danger"); // Añado estilo de error
        btn.disabled = true; // Deshabilito el botón
    }
}

// Añado el evento 'input' a ambos campos para que la comprobación se haga en tiempo real
pass1.addEventListener('input', checkPasswords);
pass2.addEventListener('input', checkPasswords);
</script>
</main>
<?php require __DIR__ . '/footer.php'; ?>
<!-- Bootstrap JS desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>