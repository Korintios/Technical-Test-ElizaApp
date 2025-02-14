<?php
/**
 * Endpoint para marcar una tarea como completada o pendiente.
 * 
 * Recibe un ID de tarea en formato JSON y cambia su estado en la base de datos.
 */

header("Content-Type: application/json");
require_once '../app/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Capturar el body en JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Task ID is required']);
        exit();
    }

    $id = $data['id'];

    // Verificar si la tarea existe y obtener su estado actual
    $stmt = $pdo->prepare("SELECT completed FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch();

    if (!$task) {
        http_response_code(404);
        echo json_encode(['error' => 'Task Not Found']);
        exit();
    }

    // Alternar estado de la tarea
    $newStatus = $task['completed'] == 1 ? 0 : 1;
    $stmt = $pdo->prepare("UPDATE tasks SET completed = ? WHERE id = ?");
    $result = $stmt->execute([$newStatus, $id]);

    if ($result) {
        http_response_code(200);
        echo json_encode(['id' => $id, 'completed' => $newStatus]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Internal Server Error']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
