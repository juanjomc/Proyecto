<?php
class TarifasModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=proyecto', 'juanjo', 'juanj0xm'); // Cambia los valores según tu configuración
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getTarifas() {
        $sql = "SELECT Domingo, Lunes, Martes, Miercoles, Jueves, Viernes, Sabado FROM tarifas WHERE id = 1"; // Ajusta el ID según tu lógica
        $stmt = $this->pdo->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>