<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validation (you'll likely want to expand this)
    $errors = []; 
    if (empty($name)) { $errors[] = "Name is required"; }
    if (empty($email)) { $errors[] = 'Email is required'; }
    // ... Add more validation as needed

    if (empty($errors)) {
        // Save to Database or Send Email:

        // Option 1: Save to Database 
        $stmt = $pdo->prepare("INSERT INTO support_requests (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);

        // Option 2: Send Email (You'll need a mail setup) 
        $to = "support@yourdomain.com"; 
        $headers = "From: " . $email; 
        mail($to, $subject, $message, $headers);

        // Display success message 
        $successMessage = "Your support request has been submitted";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Raise Support Request</title>
    <link rel="stylesheet" href="support_request.css">
</head>
<body>
    <h1>Submit a Support Request</h1>

    <?php if (isset($successMessage)): ?>
        <p class="success"><?= $successMessage ?></p>
    <?php endif; ?>

    <?php if (isset($errors) && count($errors) > 0): ?>
        <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li> 
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>"><br><br>

        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" value="<?= htmlspecialchars($subject) ?>"><br><br>

        <label for="message">Message:</label>
        <textarea name="message" id="message"><?= htmlspecialchars($message) ?></textarea><br><br>

        <button type="submit">Submit Request</button>
    </form>
</body>
</html>
