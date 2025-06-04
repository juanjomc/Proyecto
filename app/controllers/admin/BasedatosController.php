<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 1) {
    header('Location: /'); // Redirigir al inicio si no tiene acceso
    exit;
}

class BackupController
{
    public function generateBackup()
    {
        // Incluir el archivo de configuración
        require_once __DIR__ . '/../../config/db.php'; // Ruta al archivo db.php

        // Nombre del archivo de la copia de seguridad
        $backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

        // Comando para generar la copia de seguridad
        $mysqlPath = '/usr/local/mysql/bin/mysqldump'; // Asegúrate de que la ruta al comando mysqldump sea correcta
        $command = "$mysqlPath --no-tablespaces --user=$username --password=$password --host=$host $dbname > $backupFile";

        // Ejecutar el comando
        system($command, $output);

        // Verificar si se generó el archivo
        if (file_exists($backupFile)) {
            // Enviar el archivo al navegador para su descarga
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backupFile));
            readfile($backupFile);

            // Eliminar el archivo del servidor después de la descarga
            unlink($backupFile);
            exit;
        } else {
            echo "Error al generar la copia de seguridad.";
        }
    }

    public function restoreBackup()
    {
        // Verificar si se subió un archivo
        if (isset($_FILES['backup_file']) && $_FILES['backup_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['backup_file']['tmp_name'];
            $fileName = $_FILES['backup_file']['name'];

            // Verificar que el archivo tenga la extensión .sql
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            if ($fileExtension !== 'sql') {
                echo "Error: Solo se permiten archivos con extensión .sql.";
                return;
            }

            // Incluir el archivo de configuración
            require_once __DIR__ . '/../../config/db.php';

            try {
                // Desactivar claves foráneas
                $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

                // Obtener todas las tablas de la base de datos
                $tablesQuery = $pdo->query("SHOW TABLES");
                $tables = $tablesQuery->fetchAll(PDO::FETCH_COLUMN);

                // Eliminar todas las tablas
                foreach ($tables as $table) {
                    $pdo->exec("DROP TABLE IF EXISTS `$table`");
                }

                // Reactivar claves foráneas
                $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

                // Comando para restaurar la base de datos
                $mysqlPath = '/usr/local/mysql/bin/mysql';
                $command = "$mysqlPath --user=$username --password=$password --host=$host $dbname < $fileTmpPath";

                // Ejecutar el comando
                system($command, $output);

                // Verificar si hubo errores
                if ($output === 0) {
                    echo "La base de datos se ha restaurado correctamente.";
                } else {
                    echo "Error al restaurar la base de datos.";
                }
            } catch (PDOException $e) {
                echo "Error al eliminar las tablas: " . $e->getMessage();
            }
        } else {
            echo "Error: No se pudo subir el archivo.";
        }
    }
}