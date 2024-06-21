<?php
// Include database connection
include '../auth/important/sqlconnect.php';

try {
    // Check if POST data is set
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        // Sanitize and retrieve task ID
        $task_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        // Prepare the SQL statement
        $sql = "DELETE FROM tasks WHERE id = :task_id";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the task ID parameter
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Task deleted successfully";
        } else {
            echo "Error deleting task";
        }
    } else {
        throw new Exception("Invalid request");
    }
} catch (Exception $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}

// Close the connection (PDO does this automatically at the end of the script, but it's good practice to close it explicitly)
$pdo = null;
