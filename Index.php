<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'todo_app');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add task
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $conn->real_escape_string($_POST['task']);
    $conn->query("INSERT INTO tasks (task) VALUES ('$task')");
}

// Fetch tasks
$result = $conn->query("SELECT * FROM tasks");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>To-Do List</title>
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="POST">
            <input type="text" name="task" placeholder="Enter a new task" required>
            <button type="submit">Add Task</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['task']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>
                            <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="delete">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
