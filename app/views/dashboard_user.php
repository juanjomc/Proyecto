<?php
session_start();
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
    <title>Dashboard Usuario</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user']['correo']); ?> (Usuario Regular)</h1>
    <nav>
        <ul>
            <li><a href="/user/perfil">Mi Perfil</a></li>
            <li><a href="/user/reservas">Mis Reservas</a></li>
            <li><a href="/logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</body>
</html>