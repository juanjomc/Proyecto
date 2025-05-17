<?php

session_start();
require_once '../app/config/db.php'; // Conexión a la base de datos

class LoginController
{
    public function authenticate()
    {
        header('Content-Type: application/json');

        // Obtener datos del formulario
        $data = json_decode(file_get_contents('php://input'), true);
        $correo = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        error_log("Correo recibido: $correo");
        error_log("Contraseña recibida: $password");

        // Validar que los campos no estén vacíos
        if (empty($correo) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos.']);
            return;
        }

        try {
            global $pdo;
            $stmt = $pdo->prepare("SELECT correo, password, level,id FROM users WHERE correo = :correo");
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            error_log("Resultado de la consulta: " . print_r($user, true));

            // Verificar si el usuario existe y la contraseña es correcta
            if ($user && password_verify($password, $user['password'])) {
                error_log("Contraseña verificada correctamente.");
                $_SESSION['user'] = [
                    'correo' => $user['correo'],
                    'level' => $user['level'],
                    'id' => $user['id']
                ];
                echo json_encode(['success' => true, 'level' => $user['level']]);
            } else {
                error_log("Error en la verificación de la contraseña.");
                echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al procesar la solicitud.']);
        }
    }
}
?>