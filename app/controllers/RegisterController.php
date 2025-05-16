<?php
require '../app/models/UserModel.php';

class RegisterController {
    public function showForm() {
        // Cargar la vista del formulario de registro
        require '../app/views/register.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña
            $fechaNacimiento = $_POST['fechaNacimiento'];

            $model = new UserModel();
            try {
                $model->registrarUsuario([
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'correo' => $correo,
                    'password' => $password,
                    'fecha_nacimiento' => $fechaNacimiento,
                    'level' => 2 // Nivel por defecto
                ]);
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        }
    }

    public function checkEmail() {
        if (isset($_GET['correo'])) {
            $correo = trim(strtolower($_GET['correo']));
            $model = new UserModel();
            $exists = $model->correoExiste($correo);

            error_log($correo);
    
            // Depuración en el log de errores
            error_log("Correo recibido: $correo, Existe: " . ($exists ? 'true' : 'false'));
    
            header('Content-Type: application/json');
            echo json_encode(['exists' => $exists]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Correo no proporcionado']);
        }
    }
}
?>