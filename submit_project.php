<?php
header('Content-Type: application/json'); // Return JSON 
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed 
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit; 
}

// ... Your validation code from add_project.php ...

if (empty($errors)) {
    // ... Your code to perform database insertion ...
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'errors' => $errors]); 
}
