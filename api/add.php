<?php
/**
 * Endpoint para agregar una nueva tarea.
 * 
 * Recibe datos en formato JSON con el título de la tarea.
 * Inserta la tarea en la base de datos y devuelve su ID.
 */
header("Content-Type: application/json");
require_once '../app/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar el body en JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!isset($data['title'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Title is required']);
        exit();
    }

    $title = $data['title'];

    // Insertar tarea en la base de datos
    $stmt = $pdo->prepare("INSERT INTO tasks (title, completed) VALUES (?, 0)");
    $result = $stmt->execute([$title]);

    if ($result) {
        http_response_code(201);
        echo json_encode([
            'id' => (int) $pdo->lastInsertId(),
            'title' => $title,
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Internal Server Error']);
    }
} else {
    // Método no permitido
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
