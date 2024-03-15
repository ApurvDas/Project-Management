<?php
header('Content-Type: application/json');

// Database connection details (replace with your own)
$host = 'localhost'; 
$user = 'root';
$password = '';
$database = 'project_management';

// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    error_log("Connection failed: " . mysqli_connect_error());
    http_response_code(500);
    echo json_encode(['error' => 'Database connection error']);
    exit;
}

// Query the database
$query = "SELECT id, name FROM departments";
$result = mysqli_query($conn, $query);

// Handle query errors
if (!$result) {
    error_log("Error fetching departments: " . mysqli_error($conn)); 
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch departments']);
    exit; 
}

// Fetch departments
$departments = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free the result set 
mysqli_free_result($result);

// Close the connection 
mysqli_close($conn);

// Output JSON
echo json_encode($departments);
