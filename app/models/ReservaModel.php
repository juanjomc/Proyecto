<?php

require_once '../app/config/db.php'; // Incluye el archivo de configuración y conexión

class ReservaModel {
    private $pdo;

    public function registrarReserva($datos) {
        $sql = "INSERT INTO reservas (usuario_id, fecha_inicio, fecha_fin) 
                VALUES (:usuario_id, :fecha_inicio, :fecha_fin)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($datos);
    }

    public function obtenerReservas() {
        $sql = "SELECT * FROM reservas";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>