<?php
/**
 * Configuración de la conexión a la base de datos.
 * 
 * Este archivo establece la conexión con la base de datos mediante PDO.
 * 
 * @var string $host     Dirección del servidor de la base de datos.
 * @var string $dbname   Nombre de la base de datos.
 * @var string $user     Usuario de la base de datos.
 * @var string $pass     Contraseña de la base de datos.
 * @var PDO    $pdo      Objeto de conexión PDO.
 */

$host = "";
$dbname = "";
$user = "";
$pass = "";

try {
    // Conectar sin especificar base de datos para crearla si no existe
    $pdo = new PDO("mysql:host=$host;port=$port;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la base de datos si no existe
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");

    // Conectar a la base de datos recién creada
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la tabla si no existe
    $sql = "CREATE TABLE IF NOT EXISTS tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        completed BOOLEAN DEFAULT FALSE
    )";
    $pdo->exec($sql);
} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}
?>
