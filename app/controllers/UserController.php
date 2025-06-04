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

    public function misReservas()
    {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 2) {
            header('Location: /');
            exit;
        }
        global $pdo;
        $usuario_id = $_SESSION['user']['id'];


        // Obtener reservas del usuario
        // echo "SELECT * FROM reservas WHERE id_usuario = ".$usuario_id." ORDER BY entrada DESC";
        $stmt = $pdo->prepare("SELECT * FROM reservas WHERE id_usuario = :usuario_id ORDER BY fecha_reserva DESC");
        $stmt->execute(['usuario_id' => $usuario_id]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Para cada reserva, obtener los detalles
        foreach ($reservas as $index => $reserva) {
            $stmt2 = $pdo->prepare("SELECT * FROM detalles_reserva WHERE id_reserva = :id_reserva ORDER BY fecha ASC");
            $stmt2->execute(['id_reserva' => $reserva['id']]);
            $reservas[$index]['detalles'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        }
        require '../app/views/user/misreservas.php';
    }
    public function comprobante()
{
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 2) {
        header('Location: /');
        exit;
    }
    global $pdo;
    $usuario_id = $_SESSION['user']['id'];
    $reserva_id = $_GET['id'] ?? 0;

    // Verifica que la reserva pertenece al usuario
    $stmt = $pdo->prepare("SELECT * FROM reservas WHERE id = :id AND id_usuario = :usuario_id");
    $stmt->execute(['id' => $reserva_id, 'usuario_id' => $usuario_id]);
    $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reserva) {
        echo "Reserva no encontrada o no autorizada.";
        exit;
    }

    // Obtener detalles de la reserva
    $stmt2 = $pdo->prepare("SELECT * FROM detalles_reserva WHERE id_reserva = :id_reserva ORDER BY fecha ASC");
    $stmt2->execute(['id_reserva' => $reserva_id]);
    $detalles = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Obtener datos del usuario
    $model = new UserModel();
    $usuario = $model->obtenerPorId($usuario_id);

    // Codifica el logo en base64 para el PDF
    $logo_path = __DIR__ . '/../../public/img/logo/Logo.png';
    $logo_base64 = '';
    if (file_exists($logo_path)) {
        $logo_data = file_get_contents($logo_path);
        $logo_base64 = 'data:image/png;base64,' . base64_encode($logo_data);
    }

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Comprobante de Reserva</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
        .a4-sheet {
                background: #fff;
                width: 210mm;
                min-height: auto;
                margin: 10mm auto;
                padding: 15mm 10mm;
                box-shadow: 0 0 10px rgba(0,0,0,0.15);
                border-radius: 8px;
        }
        .logo { width: 300px; height: auto; }
        @media (max-width: 800px) {
            .a4-sheet { width: 100%; min-width: unset; padding: 10px; }
        }
        </style>
    </head>
    <body>
        <div class="a4-sheet">
            <div class="cabecera d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <div>
                    <?php if ($logo_base64): ?>
                        <img src="<?php echo $logo_base64; ?>" class="logo" alt="Logo">
                    <?php endif; ?>
                </div>
                <div class="text-end">
                    <div class="fw-bold" style="font-size:1.1em;"><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidos']); ?></div>
                    <div style="font-size:0.95em; color:#555;"><?php echo htmlspecialchars($usuario['correo']); ?></div>
                </div>
            </div>
            <h1 class="mb-4 text-primary">Comprobante de Reserva</h1>
            <div class="datos mb-4">
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidos']); ?></p>
                <p><strong>Reserva #:</strong> <?php echo $reserva['id']; ?></p>
                <p><strong>Fecha de reserva:</strong> <?php echo isset($reserva['fecha_reserva']) ? date('d-m-Y H:i', strtotime($reserva['fecha_reserva'])) : '-'; ?></p>
                <p><strong>Estado:</strong> <?php echo ucfirst($reserva['estado']); ?></p>
                <p><strong>Fecha de entrada:</strong> <?php echo date('d-m-Y', strtotime($reserva['entrada'])); ?></p>
                <p><strong>Fecha de salida:</strong> <?php echo date('d-m-Y', strtotime($reserva['salida'])); ?></p>
            </div>
            <div class="desglose mb-4">
                <h3 class="text-primary">Desglose de noches:</h3>
                <ul>
                    <?php foreach ($detalles as $detalle): ?>
                        <li>
                            <?php echo date('d-m-Y', strtotime($detalle['fecha'])); ?> -
                            <?php echo number_format($detalle['precio'], 2); ?> €
                            (<?php echo $detalle['estado']; ?>)
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Limpieza:</strong> <?php echo number_format($reserva['limpieza'], 2); ?> €</p>
            </div>
            <div class="total fs-4 fw-bold text-primary">
                <strong> Total: </strong> <?php echo number_format($reserva['total'], 2); ?> €
            </div>
        </div>
    </body>
    </html>
    <?php
    $html = ob_get_clean();

    // Cargar DOMPDF
    require_once __DIR__ . '/../../vendor/autoload.php';
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("comprobante_reserva_{$reserva['id']}.pdf", ["Attachment" => true]);
    exit;
}
}
?>