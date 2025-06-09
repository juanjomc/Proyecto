<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css"> <!-- CSS personalizado -->
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registro de Usuario</h2>
        <form id="registerForm" method="POST" action="/register/store" class="p-4 rounded shadow bg-light">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce tu nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Introduce tus apellidos" required>
            </div>
            <div class="mb-3">
    <label for="correo" class="form-label">Correo</label>
    <input type="email" class="form-control" id="correo" name="correo" placeholder="Introduce tu correo" required>
    <small id="emailValidationMessage" class="form-text"></small> <!-- Mensaje de validación del correo -->
</div>
            <div class="mb-3">
    <label for="password" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Introduce tu contraseña" required>
</div>
<div class="mb-3">
    <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirma tu contraseña" required>
    <small id="passwordMatchMessage" class="form-text"></small>
</div>
<div class="mb-3">
    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
    <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
    <small id="ageValidationMessage" class="form-text"></small> <!-- Mensaje de validación de la edad -->
</div>
<div class="text-center">
    <button type="submit" class="btn btn-primary btn-lg" id="registerButton" disabled>Registrar</button>
</div>
 <!-- Contenedor para mostrar mensajes -->
        <div id="registerResponse" class="mt-3"></div>
        </form>
       
    </div>

        <?php require __DIR__ . '/footer.php'; ?>

    <!-- Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/register.js"></script> <!-- Tu JavaScript personalizado -->
</body>
</html>