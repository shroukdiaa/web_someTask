<?php
$host = 'localhost';
$dbname = 'task_manager';
$username = 'root';
$password = '';

// Create connection
$conn = new PDO("mysql:host=localhost;port=3306;dbname=task_manager", "root", "");

// Fetch all tasks
$sql = "SELECT * FROM tasks";
$stmt = $conn->query($sql);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0 auto;
    padding: 20px;
    max-width: 600px;
}

form {
    margin-bottom: 20px;
}

input, textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
}

button {
    padding: 10px 15px;
    background-color: #28a745;
    color: white;
    border: none;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 10px;
    text-align: left;
}

    </style>
</head>
<body>
    <h1>Task Manager</h1>
    
    <form action="Addtask_manage.php" method="POST">
        <label for="title">Task Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="description">Task Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <button type="submit">Add Task</button>
    </form>

    <h2>All Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= $task['id']; ?></td>
                    <td><?= $task['title']; ?></td>
                    <td><?= $task['description']; ?></td>
                    <td>
                        <a href="edit_task.php?id=<?= $task['id']; ?>">Edit</a>
                        <a href="delete_task.php?id=<?= $task['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
