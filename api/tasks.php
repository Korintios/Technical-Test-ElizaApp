<?php
/**
 * Endpoint para obtener la lista de tareas.
 * 
 * Devuelve todas las tareas almacenadas en la base de datos en formato JSON.
 */

header("Content-Type: application/json");
require_once '../app/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener todas las tareas
    $stmt = $pdo->prepare("SELECT id, title, completed FROM tasks ORDER BY id DESC");
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver respuesta en JSON
    http_response_code(200);
    echo json_encode($tasks);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
