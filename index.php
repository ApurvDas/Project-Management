<?php
require_once('config.php');

// Handle module loading with better structure
function loadModule($moduleName) {
    $moduleFile = $moduleName . '.php';

    if (file_exists($moduleFile)) {
        include($moduleFile);
    } else {
        echo "<p class='error'>Module not found.</p>";  // Use descriptive class
    }
}

// Default module
$currentModule = $_GET['module'] ?? 'dashboard';

// Validate user input to prevent potential security issues
if (!in_array($currentModule, ['dashboard', 'add_project', 'view_projects', 'edit_project', 'delete_project', 'support_request'])) {
    $currentModule = 'dashboard'; // Redirect to the dashboard if the module is invalid
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Project Management Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto Condensed&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="index.css"> 
</head>
<body>
    <header>
        <h1>Project Management Dashboard</h1>
    </header>

    <div class="dashboard-container">
        <nav id="sidebar">
        <button id="menu-toggle" class="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
            <h2>Modules</h2>
            <ul>
                <?php 
                    $modules = ['dashboard', 'add_project', 'view_projects', 'edit_project', 'delete_project', 'support_request'];

                    foreach ($modules as $mod) {
                        $activeClass = ($mod === $currentModule) ? 'class="active"' : '';
                        echo "<li><a href='?module=$mod' $activeClass >" . ucfirst($mod) . "</a></li>";
                    }
                ?>
            </ul>
        </nav>

        <main id="dashboard-content">
            <?php loadModule($currentModule); ?>
        </main>
    </div>

    <script src="index.js"></script>
</body>
</html>
