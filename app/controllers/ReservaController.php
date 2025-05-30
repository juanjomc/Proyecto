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
    
    $limpieza = $_POST['limpieza'] ?? 0;
    $precios = isset($_POST['precios']) ? json_decode($_POST['precios'], true) : []; // ¡Solo esta línea!
    

     // Consultar el precio de limpieza desde la base de datos (tabla opciones)
    $stmt = $pdo->prepare("SELECT valor FROM opciones WHERE opcion = 'limpieza' LIMIT 1");
    $stmt->execute();
    $limpieza = $stmt->fetchColumn();
    $limpieza = $limpieza !== false ? floatval($limpieza) : 0;

    // Calcular el total sumando todos los días y la limpieza
    $total = array_sum($precios) + $limpieza;


    // Puedes calcular el total y limpieza en el backend si lo prefieres
    // $total = ...; $limpieza = ...;

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
        // $end->modify('+1 day'); // Para incluir el último día

        // Supón que recibes un array de precios por día desde el frontend o los calculas aquí
        // Ejemplo: $_POST['precios'] = ['2024-06-01' => 80, '2024-06-02' => 90, ...];
        // $precios = $_POST['precios']; // Debes enviar esto desde JS o calcularlo aquí

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
}
?>