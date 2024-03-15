<?php
require_once('config.php');

$projectId = $_GET['id'] ?? null;

if (!$projectId) {
  header('Location: view_projects.php'); 
  exit;
}

// Fetch project details
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$projectId]);
$project = $stmt->fetch(PDO::FETCH_OBJ);

if (!$project) {
  echo "<p>Project not found</p>";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>View Project</title></head>
<body>
  <h1><?= $project->name ?></h1> 

  <p><strong>Description:</strong> <?= $project->description ?></p>
  <p><strong>Start Date:</strong> <?= $project->start_date ?></p>
  <p><strong>End Date:</strong> <?= $project->end_date ?></p>
  <p><strong>Status:</strong> <?= $project->status ?></p>

  <a href="edit_project.php?id=<?= $project->id ?>">Edit</a>
  <a href="delete_project.php?id=<?= $project->id ?>">Delete</a> 
  
  <h2>Tasks</h2>
  </body>
</html>
