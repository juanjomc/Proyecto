<?php
require '../app/models/ReservaModel.php';

class ReservaController {
    public function showForm() {
        // Cargar la vista del formulario de reservas
        require '../app/views/reservas.php';
    }

    public function store()
{
    global $pdo;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Recoge los datos del formulario
    $usuario_id = $_SESSION['user']['id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $precios = isset($_POST['precios']) ? json_decode($_POST['precios'], true) : [];

    // Consultar el precio de limpieza desde la base de datos (tabla opciones)
    $stmt = $pdo->prepare("SELECT valor FROM opciones WHERE opcion = 'limpieza' LIMIT 1");
    $stmt->execute();
    $limpieza = $stmt->fetchColumn();
    $limpieza = $limpieza !== false ? floatval($limpieza) : 0;

    // Calcular el total sumando todos los días y la limpieza
    $total = array_sum($precios) + $limpieza;

    try {
        // 1. Insertar la reserva principal
        $stmt = $pdo->prepare("INSERT INTO reservas (id_usuario, entrada, salida, total, limpieza, estado) VALUES (:usuario_id, :fecha_entrada, :fecha_salida, :total, :limpieza, 'pagado')");
        $stmt->execute([
            'usuario_id' => $usuario_id,
            'fecha_entrada' => $fecha_inicio,
            'fecha_salida' => $fecha_fin,
            'total' => $total,
            'limpieza' => $limpieza
        ]);
        $reserva_id = $pdo->lastInsertId();

        // 2. Insertar los detalles día a día
        $start = new DateTime($fecha_inicio);
        $end = new DateTime($fecha_fin);

        for ($date = clone $start; $date < $end; $date->modify('+1 day')) {
            $fecha = $date->format('Y-m-d');
            $precio = $precios[$fecha] ?? 0;

            $stmt = $pdo->prepare("INSERT INTO detalles_reserva (id_reserva, fecha, precio, estado) VALUES (:id_reserva, :fecha, :precio, 'reservado')");
            $stmt->execute([
                'id_reserva' => $reserva_id,
                'fecha' => $fecha,
                'precio' => $precio
            ]);
        }

        // ENVIAR EMAILS
        require_once __DIR__ . '/../../vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        // Obtener email de notificaciones
        $stmt = $pdo->prepare("SELECT valor FROM opciones WHERE opcion = 'email_notificaciones' LIMIT 1");
        $stmt->execute();
        $emailDestino = $stmt->fetchColumn();

        // ----------- EMAIL AL ADMINISTRADOR -----------
        if ($emailDestino) {
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = $_ENV['MAIL_HOST'];
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['MAIL_USERNAME'];
                $mail->Password = $_ENV['MAIL_PASSWORD'];
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = $_ENV['MAIL_PORT'];

                $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
                $mail->addAddress($emailDestino);
                $mail->Subject = 'Nueva reserva realizada';

                $body = "Hola, se ha realizado una nueva reserva:<br><br>";
                $body .= "<strong>Usuario:</strong> " . htmlspecialchars($_SESSION['user']['correo']) . "<br>";
                $body .= "<strong>Entrada:</strong> " . htmlspecialchars($fecha_inicio) . "<br>";
                $body .= "<strong>Salida:</strong> " . htmlspecialchars($fecha_fin) . "<br>";
                $body .= "<strong>Total:</strong> " . htmlspecialchars($total) . " €<br>";
                $body .= "<strong>Limpieza:</strong> " . htmlspecialchars($limpieza) . " €<br>";
                $body .= "<br><strong>Desglose por día:</strong><br>";
                foreach ($precios as $fecha => $precio) {
                    $body .= $fecha . ": " . $precio . " €<br>";
                }
                $mail->isHTML(true);
                $mail->Body = $body;

                $mail->send();
            } catch (Exception $e) {
                // Puedes loguear el error si quieres
            }
        }

        // ----------- EMAIL AL USUARIO FINAL -----------
        if (!empty($_SESSION['user']['correo'])) {
            $mailUser = new PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mailUser->isSMTP();
                $mailUser->Host = $_ENV['MAIL_HOST'];
                $mailUser->SMTPAuth = true;
                $mailUser->Username = $_ENV['MAIL_USERNAME'];
                $mailUser->Password = $_ENV['MAIL_PASSWORD'];
                $mailUser->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mailUser->Port = $_ENV['MAIL_PORT'];

                $mailUser->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
                $mailUser->addAddress($_SESSION['user']['correo']);
                $mailUser->Subject = 'Gracias por tu reserva';

                $bodyUser = "¡Hola!<br><br>Gracias por realizar tu reserva.<br>";
                $bodyUser .= "Estos son los detalles de tu reserva:<br><br>";
                $bodyUser .= "<strong>Entrada:</strong> " . htmlspecialchars($fecha_inicio) . "<br>";
                $bodyUser .= "<strong>Salida:</strong> " . htmlspecialchars($fecha_fin) . "<br>";
                $bodyUser .= "<strong>Total:</strong> " . htmlspecialchars($total) . " €<br>";
                $bodyUser .= "<strong>Limpieza:</strong> " . htmlspecialchars($limpieza) . " €<br>";
                $bodyUser .= "<br><strong>Desglose por día:</strong><br>";
                foreach ($precios as $fecha => $precio) {
                    $bodyUser .= $fecha . ": " . $precio . " €<br>";
                }
                $bodyUser .= "<br>Un saludo y gracias por confiar en nosotros.<br>";

                $mailUser->isHTML(true);
                $mailUser->Body = $bodyUser;

                $mailUser->send();
            } catch (Exception $e) {
                // Puedes loguear el error si quieres
            }
        }

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

public function crearPagoStripe()
    {
        require_once '../vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

        session_start();
        $total = $_POST['total'] ?? 0;
        $correo = $_SESSION['user']['correo']; // Asegúrate de que el correo está en la sesión

        // 1. Buscar o crear el cliente en Stripe
        $customer = \Stripe\Customer::create([
            'email' => $correo,
        ]);

        // 2. Crear el PaymentIntent asociado al cliente
        $intent = \Stripe\PaymentIntent::create([
            'amount' => intval($total * 100), // en céntimos
            'currency' => 'eur',
            'customer' => $customer->id,
            'metadata' => [
                'email' => $correo
            ]
        ]);

        echo json_encode(['clientSecret' => $intent->client_secret]);
        exit;
    }

public function listarReservasFuturas()
{
    global $pdo;
    $hoy = date('Y-m-d');
    $stmt = $pdo->prepare("SELECT r.*, u.nombre, u.correo 
                           FROM reservas r 
                           JOIN users u ON r.id_usuario = u.id 
                           WHERE r.entrada >= :hoy 
                           ORDER BY r.entrada ASC");
    $stmt->execute(['hoy' => $hoy]);
    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtener detalles para cada reserva
    foreach ($reservas as &$reserva) {
        $stmt2 = $pdo->prepare("SELECT fecha, precio FROM detalles_reserva WHERE id_reserva = :id_reserva ORDER BY fecha ASC");
        $stmt2->execute(['id_reserva' => $reserva['id']]);
        $reserva['detalles'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }

    require '../app/views/admin/admin_reservas.php';
}
}
?>