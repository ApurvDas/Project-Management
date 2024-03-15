<?php
require_once 'config.php'; 

if (isset($_POST['department_id'])) {
    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $departmentId = $_POST['department_id']; 

    $sql = "SELECT id, name FROM employees WHERE department_id = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $departmentId);
    $stmt->execute();
    $result = $stmt->get_result(); // Get prepared statement results 

    $teamData = array(
        'team_leaders' => array(),
        'team_members' => array()
    );

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // You might want logic to distinguish team leaders, but for now put all in both dropdowns
            $teamData['team_leaders'][$row['id']] = $row['name'];
            $teamData['team_members'][$row['id']] = $row['name'];
        }
    }
    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($teamData); 
}
?>
