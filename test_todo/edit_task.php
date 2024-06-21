<?php
// Include database connection
include '../auth/important/sqlconnect.php';

try {
    // Check if POST data is set
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'])) {
        // Sanitize and retrieve POST data
        $task_id = filter_var($_POST['task_id'], FILTER_SANITIZE_NUMBER_INT);
        $task_name = $_POST['task_name']; // Assuming task_name is already sanitized if needed
        $task_due = $_POST['task_due']; // Assuming task_due is already sanitized if needed
        $task_priority = $_POST['task_priority']; // Assuming task_priority is already sanitized if needed
        $task_label = $_POST['task_label']; // Assuming task_label is already sanitized if needed

        // Prepare SQL statement with placeholders
        $sql = "UPDATE tasks SET task_name = :task_name, task_due = :task_due, task_priority = :task_priority, task_label = :task_label WHERE id = :task_id";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
        $stmt->bindParam(':task_due', $task_due, PDO::PARAM_STR);
        $stmt->bindParam(':task_priority', $task_priority, PDO::PARAM_STR);
        $stmt->bindParam(':task_label', $task_label, PDO::PARAM_STR);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to index.php after successful update
            header('Location: index.php');
            exit(); // Ensure script execution stops after redirection
        } else {
            echo "Error updating task";
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
