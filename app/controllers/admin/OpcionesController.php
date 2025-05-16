<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 1) {
    header('Location: /'); // Redirigir al inicio si no tiene acceso
    exit;
}

// Incluir la conexión a la base de datos
require_once __DIR__ . '/../../config/db.php';

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
}