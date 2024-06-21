<?php
// Include your database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the task ID from the POST request
    $taskId = $_POST['id'];

    // Prepare and execute the SQL statement to update the task's archived status
    $sql = "UPDATE tasks SET archived = '0' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);

    if ($stmt->execute()) {
        echo "Task retrieved successfully.";
    } else {
        echo "Error retrieving task: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
