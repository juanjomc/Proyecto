<?php
require_once __DIR__ . '/../config/db.php';

class Contacto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function guardar($nombre, $correo, $telefono, $mensaje) {
        $sql = "INSERT INTO contactos (nombre, correo, telefono, mensaje) VALUES (:nombre, :correo, :telefono, :mensaje)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':telefono' => $telefono,
            ':mensaje' => $mensaje
        ]);
    }
}
?>