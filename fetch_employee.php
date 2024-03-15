<?php
header('Content-Type: application/json'); 
require_once('config.php'); 

try {
    // Adjust the query based on your employee table structure
    $stmt = $pdo->query("SELECT id, name FROM employees"); 
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($employees);

} catch (PDOException $e) {
    error_log("Error fetching employees: " . $e->getMessage()); 
    http_response_code(500); 
    echo json_encode(['error' => 'Failed to fetch employees']);
}
