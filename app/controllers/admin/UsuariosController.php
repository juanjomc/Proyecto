<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 1) {
    header('Location: /'); // Redirigir al inicio si no tiene acceso
    exit;
}

// Incluir la conexión a la base de datos
require_once __DIR__ . '/../../config/db.php';

class UsuariosController
{
    public function index()
    {
        global $pdo;

        try {
            // Consultar los usuarios registrados
            $stmt = $pdo->query("SELECT id, nombre, correo, fecha_nacimiento, created_at, level FROM users");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Incluir la vista
            require_once __DIR__ . '/../../views/admin/usuarios_admin.php';
        } catch (PDOException $e) {
            die("Error al obtener los usuarios: " . $e->getMessage());
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

            // Redirigir con un mensaje de éxito
            header('Location: /admin/opciones?success=1');
            exit;
        } catch (PDOException $e) {
            die("Error al actualizar las opciones: " . $e->getMessage());
        }
    }
}