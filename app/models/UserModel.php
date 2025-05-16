<?php

require_once '../app/config/db.php'; // Incluye el archivo de configuración y conexión
class UserModel {
    private $pdo;

    public function __construct() {
        global $pdo; // Usa la conexión global definida en db.php
        $this->pdo = $pdo;

        if (!$this->pdo) {
            die("Error: No se pudo establecer la conexión a la base de datos.");
        }
    }

    public function registrarUsuario($datos) {
        $sql = "INSERT INTO users (nombre, apellidos, correo, password, fecha_nacimiento, level) 
                VALUES (:nombre, :apellidos, :correo, :password, :fecha_nacimiento, :level)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($datos);
    }

    public function correoExiste($correo) {
        $sql = "SELECT COUNT(*) FROM users WHERE LOWER(TRIM(correo)) = :correo";
        $stmt = $this->pdo->prepare($sql);
    
        // Asegúrate de normalizar el valor antes de pasarlo
        $correoParam = trim(strtolower($correo));
    
        // Depuración
        error_log("Correo recibido: '$correo'");
        error_log("Correo usado en bind: '$correoParam'");
    
        $stmt->bindValue(':correo', $correoParam, PDO::PARAM_STR);
        $stmt->execute();
    
        $count = $stmt->fetchColumn();
    
        // Depuración en caso de fallo
        if ($count === false) {
            $errorInfo = $stmt->errorInfo();
            error_log("Error en la consulta: " . print_r($errorInfo, true));
        }
    
        error_log("Resultado COUNT: $count");
    
        return $count > 0;
    }
}
?>