<?php
require_once __DIR__ . '../../config/db.php';

class ContactModel {
    public function guardarContacto($datos) {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO contactos (nombre, email, telefono, fecha_entrada, fecha_salida, mensaje, ip) 
                               VALUES (:nombre, :email, :telefono, :fecha_entrada, :fecha_salida, :mensaje, :ip)");

        $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':email' => $datos['email'],
            ':telefono' => $datos['telefono'],
            ':fecha_entrada' => $datos['fecha_entrada'],
            ':fecha_salida' => $datos['fecha_salida'],
            ':mensaje' => $datos['mensaje'],
            ':ip' => $datos['ip']
        ]);
    }
}
?>