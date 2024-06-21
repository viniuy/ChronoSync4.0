<?php
// Include database connection
include '../auth/important/sqlconnect.php';

// Check if task_id is provided via GET request
if (isset($_GET['id'])) {
    try {
        // Sanitize input to ensure task_id is an integer
        $task_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        // Prepare SQL statement with placeholders
        $sql = "SELECT * FROM tasks WHERE id = :task_id";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();

        // Fetch the result as associative array
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if task exists
        if ($task) {
            // Return task data as JSON
            echo json_encode($task);
        } else {
            // Return empty array if task is not found
            echo json_encode([]);
        }
    } catch (PDOException $e) {
        // Handle any errors
        echo json_encode(['error' => 'Error fetching task data: ' . $e->getMessage()]);
    }

    // Close the connection (PDO does this automatically at the end of the script)
    $pdo = null;
} else {
    echo json_encode(['error' => 'Task ID not provided']);
}
