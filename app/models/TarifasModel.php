<?php

require_once '../app/config/db.php'; // Incluye el archivo de configuración y conexión


class TarifasModel {
    private $pdo;

    public function __construct() {
        global $pdo; // Usa la conexión global definida en db.php
        $this->pdo = $pdo;

        if (!$this->pdo) {
            die("Error: No se pudo establecer la conexión a la base de datos.");
        }
    }


    public function getTarifas() {
        $sql = "SELECT opcion, valor FROM opciones where opcion in ('laborables', 'sabados','domingos','limpieza');"; // Ajusta el ID según tu lógica
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>