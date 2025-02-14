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

$host = "127.0.0.1";
$dbname = "tasks";
$user = "root";
$pass = "P@ssw0rd123!";

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Modo de errores excepciones
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Modo de obtención de datos
    ]);
} catch (PDOException $e) {
    // Manejo de errores de conexión
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed', 'message' => $e->getMessage()]);
    exit();
}
?>
