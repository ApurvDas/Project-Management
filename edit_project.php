<?php
require_once('config.php');

$projectId = $_GET['id'] ?? null;

if (!$projectId) { 
  // Handle the case where no project ID is provided
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Process form submission (Similar structure to add_project.php)
} else {
    // Fetch project details:
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$projectId]);
    $project = $stmt->fetch(PDO::FETCH_OBJ); 
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Project</title></head>
<body>
  <?php if ($project): ?> 
  <form method="POST">
    </form>
  <?php else: ?>
    <p>Project not found</p>
  <?php endif; ?>
</body>
</html>
