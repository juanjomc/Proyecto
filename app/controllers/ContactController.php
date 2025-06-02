<?php

require_once '../app/models/ContactModel.php';

class ContactController {
    public function store() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datos = [
            'nombre' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'telefono' => $_POST['phone'] ?? '',
            'fecha_entrada' => $_POST['checkin'] ?? '',
            'fecha_salida' => $_POST['checkout'] ?? '',
            'mensaje' => $_POST['message'] ?? '',
            'ip' => $_SERVER['REMOTE_ADDR']
        ];

        try {
            $model = new ContactModel();
            $model->guardarContacto($datos);

            // Cargar variables de entorno
            require_once __DIR__ . '/../../vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            // Obtener el email de notificaciones desde la tabla opciones
            global $pdo;
            $stmt = $pdo->prepare("SELECT valor FROM opciones WHERE opcion = 'email_notificaciones' LIMIT 1");
            $stmt->execute();
            $emailDestino = $stmt->fetchColumn();

            if ($emailDestino) {
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);

                // Configuración SMTP usando variables del .env
                $mail->isSMTP();
                $mail->Host = $_ENV['MAIL_HOST'];
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['MAIL_USERNAME'];
                $mail->Password = $_ENV['MAIL_PASSWORD'];
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = $_ENV['MAIL_PORT'];

                $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
                $mail->addAddress($emailDestino);
                $mail->Subject = 'Nuevo formulario de contacto recibido';

                // Cuerpo del mensaje
                $body = "Hola, acaba de recibir un formulario con estos campos:<br><br>";
                foreach ($datos as $campo => $valor) {
                    $body .= "<strong>" . ucfirst(str_replace('_', ' ', $campo)) . ":</strong> " . htmlspecialchars($valor) . "<br>";
                }
                $mail->isHTML(true);
                $mail->Body = $body;

                $mail->send();
            }

            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }
}
    public function listarContactos()
    {
        try {
            global $pdo;

            // Consulta para obtener los contactos ordenados por fecha de entrada (más reciente primero)
            $stmt = $pdo->prepare("SELECT nombre, email, telefono, mensaje, fecha_entrada, fecha_salida, ip, leido, id, fecha_hora FROM contactos ORDER BY fecha_hora DESC");
            $stmt->execute();
            $contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $contactos;
        } catch (PDOException $e) {
            die("Error al obtener los contactos: " . $e->getMessage());
        }
    }

    public function acciones()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ids = $_POST['contactos'] ?? [];
        $accion = $_POST['accion'] ?? '';

        if (empty($ids) || empty($accion)) {
            header('Location: /admin/contactos');
            exit;
        }

        global $pdo;

        try {
            if ($accion === 'marcar_leido') {
                $stmt = $pdo->prepare("UPDATE contactos SET leido = 0 WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")");
                $stmt->execute();
            } elseif ($accion === 'marcar_no_leido') {
                $stmt = $pdo->prepare("UPDATE contactos SET leido = 1 WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")");
                $stmt->execute();
            } elseif ($accion === 'borrar') {
                $stmt = $pdo->prepare("DELETE FROM contactos WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")");
                $stmt->execute();
            }
        } catch (PDOException $e) {
            die("Error al ejecutar la acción: " . $e->getMessage());
        }

        header('Location: /admin/contactos');
        exit;
    }
}

}


?>