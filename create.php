<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form data is set
    $title = isset($_POST['Titre']) ? $_POST['Titre'] : '';
    $description = isset($_POST['Description']) ? $_POST['Description'] : '';
    $due_date = isset($_POST['Due_date']) ? $_POST['Due_date'] : '';
    $status = isset($_POST['Status']) ? $_POST['Status'] : '';

    // Check if all fields are filled
    if ($title && $description && $due_date && $status) {
        // Prepare the SQL query to insert the data
        $sql = "INSERT INTO tasks (Titre, Description, Due_date, Status) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $description, $due_date, $status]);

        // Redirect to index.php after insertion
        header('Location: index.php');
        exit;
    } else {
        echo "Please fill all fields.";
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Créer une tache</title>
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <h1>Créer une tache</h1>
        <form method="POST" action="">
            <label for="Titre">Titre</label>
            <input type="text" id="Titre" name="Titre" required><br><br>

            <label for="Description">Description</label>
            <textarea id="Description" name="Description" required></textarea><br><br>

            <label for="Due_date">Due_date</label>
            <input type="date" id="Due_date" name="Due_date" required><br><br>

            <label for="Status">Status</label>
            <select id="Status" name="Status">
                <option value="En attente">En attente</option>
                <option value="Complété">Complété</option>
            </select><br><br>
            <button type="submit">ajouter tache</button>
        </form>
    </body>
</html>

