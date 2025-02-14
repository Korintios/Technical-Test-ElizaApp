<?php
/**
 * Endpoint para eliminar una tarea.
 * 
 * Recibe un ID de tarea en formato JSON y la elimina de la base de datos.
 */

header("Content-Type: application/json");
require_once '../app/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Capturar el body en JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Task ID is required']);
        exit();
    }

    $id = $data['id'];

    // Verificar si la tarea existe antes de eliminarla
    $stmt = $pdo->prepare("SELECT id FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch();

    if (!$task) {
        http_response_code(404);
        echo json_encode(['error' => 'Task Not Found']);
        exit();
    }

    // Eliminar la tarea
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $result = $stmt->execute([$id]);

    if ($result) {
        http_response_code(200);
        echo json_encode(['message' => 'Task deleted successfully', 'id' => $id]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Internal Server Error']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>