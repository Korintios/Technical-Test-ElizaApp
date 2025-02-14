<?php
/**
 * Endpoint para actualizar el título de una tarea.
 * 
 * Recibe un ID de tarea y un nuevo título en formato JSON, 
 * y actualiza la información en la base de datos.
 */

header("Content-Type: application/json");
require_once '../app/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Capturar el body en JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!isset($data['id']) || !isset($data['title'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Task ID and new title are required']);
        exit();
    }

    $id = $data['id'];
    $title = $data['title'];

    // Verificar si la tarea existe antes de actualizarla
    $stmt = $pdo->prepare("SELECT id FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch();

    if (!$task) {
        http_response_code(404);
        echo json_encode(['error' => 'Task Not Found']);
        exit();
    }

    // Actualizar el título de la tarea
    $stmt = $pdo->prepare("UPDATE tasks SET title = ? WHERE id = ?");
    $result = $stmt->execute([$title, $id]);

    if ($result) {
        http_response_code(200);
        echo json_encode(['message' => 'Task updated successfully', 'id' => $id, 'title' => $title]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Internal Server Error']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
