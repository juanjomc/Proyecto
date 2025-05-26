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

    // Recoge los datos del formulario
    $usuario_id = $_POST['usuario_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $total = $_POST['total'] ?? 0;
    $limpieza = $_POST['limpieza'] ?? 0;
    $precios = isset($_POST['precios']) ? json_decode($_POST['precios'], true) : []; // ¡Solo esta línea!


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
        $end->modify('+1 day'); // Para incluir el último día

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
}
?>