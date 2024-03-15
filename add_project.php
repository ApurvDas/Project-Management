<?php
require_once 'config1.php'; // Your database connection details

// Error reporting (useful for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to fetch departments
function fetch_departments($conn) {
    $sql = "SELECT id, name FROM departments";
    $result = $conn->query($sql);

    $departments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departments[$row['id']] = $row['name'];
        }
    }
    return $departments;
}

// Function to fetch employees
function fetch_employees($conn) {
    $sql = "SELECT id, name FROM employees";
    $result = $conn->query($sql);

    $employees = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employees[$row['id']] = $row['name'];
        }
    }
    return $employees;
}

// Fetch dropdown data
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
$departments = fetch_departments($conn);
$employees = fetch_employees($conn);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title> 
    <link rel="stylesheet" href="add_project.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="add-project-container">
            <form method="post" id="addProjectForm">
                <?php require_once 'config1.php'; ?>
                <h2>Add Project</h2> 

                <div class="form-group">
                    <label for="project_name">Project Name:</label>
                    <input type="text" name="project_name" id="project_name" required>
                </div>

                <div class="form-group">
                    <label for="description">Project Description:</label>
                    <textarea name="description" id="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="project_id">Project ID:</label>
                    <input type="text" name="project_id" id="project_id" required>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" required>
                </div>

                <div class="form-group">
                    <label for="end_time">End Time:</label>
                    <input type="time" name="end_time" id="end_time" required>
                </div>

                <div class="form-group"> 
                    <label for="department">Department:</label>
                    <select name="department" id="department">
                        <?php foreach ($departments as $id => $name): ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> 

                <div class="form-group"> 
                    <label for="employee">Employee:</label>
                    <select name="employee" id="employee">
                        <?php foreach ($employees as $id => $name): ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> 

                <div class="form-group button-container"> 
                    <button type="submit">Add Project</button>
                </div>
            </form>
        </div>
    </div>
    <script src="add_project.js"></script>
</body>
</html>
