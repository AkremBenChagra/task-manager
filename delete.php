<?php
require_once 'database.php';

// Check if the id is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the task from the database
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE Id = ?");
    $stmt->execute([$id]);

    // Redirect to index.php after deletion
    header('Location: index.php');
    exit;
} else {
    echo "No task ID provided!";
}
?>
