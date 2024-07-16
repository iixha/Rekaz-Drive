<?php

/*Retrieves metadata (id , size, created_at ) from the blob_metadata 
  table using the id parameter in a GET request. **/

require_once __DIR__ . '/db_connection.php';

// Read the data id from the request
$id = htmlspecialchars(strip_tags($_GET['id']));

// Check if the data id exists
if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required parameter: id']);
    exit;
}

// Query to retrieve data information from blob metadata table
$stmt = $pdo->prepare('SELECT id, size, created_at FROM blob_metadata WHERE id = ?');
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    http_response_code(404);
    echo json_encode(['error' => 'Data not found']);
    exit;
}

// Response with the retrieved data
echo json_encode($data);
?>
