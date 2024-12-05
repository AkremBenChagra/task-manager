<?php
require_once 'database.php';

// Check if the id is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the task from the database based on the id
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE Id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch();

    // Check if the task exists
    if (!$task) {
        die('Task not found');
    }
}

// Handle form submission to update the task
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['Titre'];
    $description = $_POST['Description'];
    $due_date = $_POST['Due_date'];
    $status = $_POST['Status'];

    // Update the task in the database
    $stmt = $pdo->prepare("UPDATE tasks SET Titre = ?, Description = ?, Due_date = ?, Status = ? WHERE Id = ?");
    $stmt->execute([$title, $description, $due_date, $status, $id]);

    // Redirect to the main page
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Edit Task</h1>
</header>

<div class="container">
    <!-- Form to edit the task -->
    <form action="update.php?id=<?php echo $task['Id']; ?>" method="POST">
        <label for="Titre">Task Title</label>
        <input type="text" name="Titre" id="Titre" value="<?php echo htmlspecialchars($task['Titre']); ?>" required>

        <label for="Description">Description</label>
        <textarea name="Description" id="Description" required><?php echo htmlspecialchars($task['Description']); ?></textarea>

        <label for="Due_date">Due Date</label>
        <input type="date" name="Due_date" id="Due_date" value="<?php echo $task['Due_date']; ?>" required>

        <label for="Status">Status</label>
        <select name="Status" id="Status" required>
            <option value="Pending" <?php echo ($task['Status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Completed" <?php echo ($task['Status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
        </select>

        <button type="submit">Update Task</button>
    </form>
</div>

</body>
</html>
