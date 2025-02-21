<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'todo_app');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete task
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM tasks WHERE id=$id");
}

// Redirect to index.php
header("Location: index.php");
exit();
