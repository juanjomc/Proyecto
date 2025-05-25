<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 1) {
    header('Location: /'); // Redirigir al inicio si no tiene acceso
    exit;
}

// Incluir la conexión a la base de datos
if (!isset($pdo)) {
    require_once __DIR__ . '/../../config/db.php';
}
class OpcionesController
{
    public function index()
    {
        global $pdo;

        try {
            // Consultar todas las opciones
            $stmt = $pdo->query("SELECT * FROM opciones");
            $opciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Incluir la vista
            require_once __DIR__ . '/../../views/admin/opciones.php';
        } catch (PDOException $e) {
            die("Error al obtener las opciones: " . $e->getMessage());
        }
    }

    public function update()
    {
        global $pdo;

        try {
            // Actualizar cada opción enviada desde el formulario
            foreach ($_POST['opciones'] as $id => $valor) {
                $stmt = $pdo->prepare("UPDATE opciones SET valor = :valor WHERE id = :id");
                $stmt->execute(['valor' => $valor, 'id' => $id]);
            }

            // Responder con éxito en formato JSON
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            // Responder con error en formato JSON
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function cambiarPassword()
{
    global $pdo;
    $mensaje = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['user']['id'];
        $password_actual = $_POST['password_actual'] ?? '';
        $password_nueva = $_POST['password_nueva'] ?? '';
        $password_nueva2 = $_POST['password_nueva2'] ?? '';

        // Obtener el hash actual
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $hash = $stmt->fetchColumn();

        if (!$hash || !password_verify($password_actual, $hash)) {
            $mensaje = "La contraseña actual no es correcta.";
        } elseif ($password_nueva !== $password_nueva2) {
            $mensaje = "Las nuevas contraseñas no coinciden.";
        } else {
            $nuevo_hash = password_hash($password_nueva, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->execute(['password' => $nuevo_hash, 'id' => $id]);
            $mensaje = "Contraseña actualizada correctamente.";
        }
    }

    require __DIR__ . '/../../views/admin/cambiar_password_admin.php';
}
}