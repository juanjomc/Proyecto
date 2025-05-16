<?php
require '../app/models/ContactModel.php';

class MainController {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Depuración: Verificar los datos recibidos
            error_log("Datos recibidos: " . print_r($_POST, true));

            $datos = [
                'nombre' => $_POST['name'],
                'email' => $_POST['email'],
                'telefono' => $_POST['phone'],
                'fecha_entrada' => $_POST['checkin'],
                'fecha_salida' => $_POST['checkout'],
                'mensaje' => $_POST['message'],
                'ip' => $_SERVER['REMOTE_ADDR']
            ];

            // Depuración: Verificar los datos procesados
            error_log("Datos procesados: " . print_r($datos, true));

            $model = new ContactModel();
            try {
                $model->guardarContacto($datos);
                error_log("Contacto guardado correctamente.");
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                // Depuración: Registrar el error
                error_log("Error al guardar el contacto: " . $e->getMessage());
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;
        }

        require '../app/views/main.php';
    }
}
?>