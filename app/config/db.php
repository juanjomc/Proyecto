<?php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'juanjo';
$password = '12345';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo; // Retorna el objeto PDO para que pueda ser usado en otros archivos
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    // Si quieres, puedes usar die() aquí
}
?>