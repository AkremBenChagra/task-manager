<?php
require_once 'database.php';

// Fetch tasks from the database
$stmt = $pdo->query("SELECT * FROM tasks");
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Task Manager</h1>
</header>

<div class="container">
    <a href="create.php" class="add-task-btn">Add New Task</a>
    <ul class="task-list">
    <?php foreach ($tasks as $task): ?>
        <li>
            <div class="task-info">
                <h3><?php echo htmlspecialchars($task['Titre']); ?></h3>
                <p><?php echo htmlspecialchars($task['Description']); ?></p>
                <p>Due: <?php echo htmlspecialchars($task['Due_date']); ?></p>
            </div>
            <span class="task-status <?php echo $task['Status']; ?>"><?php echo $task['Status']; ?></span>
            
            <!-- Add Edit Link -->
            <a href="update.php?id=<?php echo $task['Id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $task['Id']; ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>

        </li>
    <?php endforeach; ?>
</ul>

</div>

</body>
</html>
