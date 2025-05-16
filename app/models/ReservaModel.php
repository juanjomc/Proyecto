<?php
class ReservaModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=proyecto', 'root', 'juanj0xm'); // Cambia los valores según tu configuración
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

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