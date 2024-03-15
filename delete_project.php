<?php
require_once('config.php');

$projectId = $_GET['id'] ?? null;

if (!$projectId) { 
  header('Location: view_projects.php'); // Redirect if no project ID is found
  exit;
}

// Confirmation (Optional):
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Display a confirmation form before deleting 
    ?>
    <h1>Delete Project</h1>
    <p>Are you sure you want to delete this project?</p>
    <form method="POST">
        <input type="hidden" name="project_id" value="<?= $projectId ?>">
        <button type="submit">Delete</button>
        <a href="view_projects.php">Cancel</a> 
    </form>
    <?php
    exit; // Stop further execution if not a POST request
}

// Handle Deletion
$stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
$stmt->execute([$projectId]);

// Redirect or Display Success Message
header('Location: view_projects.php?delete_success=true'); 
exit;
