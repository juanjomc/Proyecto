<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 1) {
    header('Location: /'); // Redirigir al inicio si no tiene acceso
    exit;
}

// Incluir la conexión a la base de datos
require_once __DIR__ . '/../../config/db.php';

// Obtener información de la base de datos
try {
    // Número de tablas
    $tablesQuery = $pdo->query("SHOW TABLES");
    $tables = $tablesQuery->fetchAll(PDO::FETCH_COLUMN);
    $numTables = count($tables);

    // Tamaño total de la base de datos
    $sizeQuery = $pdo->query("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb FROM information_schema.tables WHERE table_schema = '$dbname'");
    $sizeResult = $sizeQuery->fetch(PDO::FETCH_ASSOC);
    $dbSize = $sizeResult['size_mb'];

    // Número de registros por tabla
    $tableInfo = [];
    foreach ($tables as $table) {
        $countQuery = $pdo->query("SELECT COUNT(*) AS count FROM $table");
        $countResult = $countQuery->fetch(PDO::FETCH_ASSOC);
        $tableInfo[] = [
            'name' => $table,
            'count' => $countResult['count']
        ];
    }
} catch (PDOException $e) {
    die("Error al obtener información de la base de datos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de Datos - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
   <?php require_once __DIR__ . '/../menu.php'; ?>

    <!-- Contenido principal -->
    <main class="container mt-5">
        <h1 class="text-center mb-4">Gestión de Base de Datos</h1>

        <!-- Información General -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-database"></i> Número de Tablas</h5>
                        <p class="card-text"><?php echo $numTables; ?> tablas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-weight"></i> Tamaño Total</h5>
                        <p class="card-text"><?php echo $dbSize; ?> MB</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información por Tabla -->
        <h2 class="text-center mb-4">Información por Tabla</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th><i class="fas fa-table"></i> Nombre de la Tabla</th>
                        <th><i class="fas fa-list-ol"></i> Número de Registros</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tableInfo as $table): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($table['name']); ?></td>
                            <td><?php echo $table['count']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Copia de Seguridad -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-save"></i> Copia de Seguridad</h5>
                        <p class="card-text">Realiza una copia de seguridad de la base de datos.</p>
                        <a href="/admin/utilidades/basedatos/backup" class="btn btn-primary">Hacer Copia de Seguridad</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Restaurar Base de Datos -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-upload"></i> Restaurar Base de Datos</h5>
                        <p class="card-text">Restaura la base de datos desde un archivo de copia de seguridad.</p>
                        <form id="restoreForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="file" name="backup_file" id="backupFile" class="form-control" accept=".sql" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Restaurar Base de Datos</button>
                        </form>
                        <div id="restoreMessage" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require __DIR__ . '/../footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('restoreForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Evitar el envío tradicional del formulario

            const formData = new FormData(this);
            const restoreMessage = document.getElementById('restoreMessage');

            fetch('/admin/utilidades/basedatos/restore', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                restoreMessage.innerHTML = `<div class="alert ${data.includes('Error') ? 'alert-danger' : 'alert-success'}">${data}</div>`;
                document.getElementById('backupFile').value = ''; // Limpiar el formulario
            })
            .catch(error => {
                restoreMessage.innerHTML = '<div class="alert alert-danger">Error al enviar la solicitud. Inténtalo de nuevo.</div>';
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>