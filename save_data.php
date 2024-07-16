<?php

/*Handles storing data into two MySQL tables ( blob_metadata and blob_data ) based 
 on JSON input containing an id and data.**/

require_once __DIR__ . '/db_connection.php';

// Read data from request
$inputData = json_decode(file_get_contents('php://input'), true);

// Verify that the required data exists
if (!isset($inputData['id']) || !isset($inputData['data'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required parameters']);
    exit;
}

$id = htmlspecialchars(strip_tags($inputData['id']));
$data = htmlspecialchars(strip_tags($inputData['data']));

// Set up the query to save the data into the blob metadata table 
$stmtMeta = $pdo->prepare('INSERT INTO blob_metadata (id, size) VALUES (?, ?)');
$stmtMeta->execute([$id, strlen($data)]);

// Set up the query to save the data in the blob_data table
$stmtData = $pdo->prepare('INSERT INTO blob_data (id, data) VALUES (?, ?)');
$stmtData->execute([$id, $data]);

//Successful response
echo json_encode(['message' => 'Data stored successfully']);
?>
