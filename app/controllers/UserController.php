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

// require '../../app/models/UserModel.php'; 

class UserController {
    public function showForm() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 2) {
            header('Location: /');
            exit;
        }
        $userId = $_SESSION['user']['id'];
        $model = new UserModel();
        $usuario = $model->obtenerPorId($userId);
        $mensaje = '';
        require __DIR__ . '/../views/dashboard_user.php';
    }

    public function update() {
        session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 2) {
        header('Location: /');
        exit;
    }
    $userId = $_SESSION['user']['id'];
    $model = new UserModel();
    $mensaje = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datos = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellidos' => $_POST['apellidos'] ?? '',
            'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? ''
        ];

        // Comprobar si se quiere cambiar la contraseña
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';
        if (!empty($password) || !empty($password2)) {
            if ($password === $password2) {
                $datos['password'] = password_hash($password, PASSWORD_BCRYPT);
            } else {
                $mensaje = "Las contraseñas no coinciden.";
            }
        }

        if (empty($mensaje)) {
            if ($model->actualizarUsuario($userId, $datos)) {
                $mensaje = "Datos actualizados correctamente.";
            } else {
                $mensaje = "Error al actualizar los datos.";
            }
        }
    }
    $usuario = $model->obtenerPorId($userId);
    require __DIR__ . '/../views/dashboard_user.php';
    }
}
?>