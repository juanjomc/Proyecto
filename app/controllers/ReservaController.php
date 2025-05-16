<?php
require '../app/models/ReservaModel.php';

class ReservaController {
    public function showForm() {
        // Cargar la vista del formulario de reservas
        require '../app/views/reservas.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioId = $_POST['usuario_id']; // ID del usuario que realiza la reserva
            $fechaInicio = $_POST['fecha_inicio'];
            $fechaFin = $_POST['fecha_fin'];

            $model = new ReservaModel();
            try {
                $model->registrarReserva([
                    'usuario_id' => $usuarioId,
                    'fecha_inicio' => $fechaInicio,
                    'fecha_fin' => $fechaFin
                ]);
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        }
    }

    public function obtenerReservas() {
        $model = new ReservaModel();
        $reservas = $model->obtenerReservas();
        echo json_encode($reservas);
    }
}
?>