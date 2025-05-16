<?php
$host = 'localhost'; // Cambia esto si tu base de datos está en otro servidor
$dbname = 'proyecto'; // Cambia esto por el nombre de tu base de datos
$username = ''; // Cambia esto por tu usuario de la base de datos
$password = ''; // Cambia esto por tu contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>