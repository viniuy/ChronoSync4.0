<?php
// Include database connection
include '../auth/important/sqlconnect.php';

try {
    // Check if POST data is set
    if (isset($_POST['task_name'], $_POST['task_due'], $_POST['task_priority'], $_POST['task_label'])) {
        // Retrieve POST data
        $task_name = $_POST['task_name'];
        $task_due = $_POST['task_due'];
        $task_priority = $_POST['task_priority'];
        $task_label = $_POST['task_label'];

        // Validate and sanitize input data (assuming these are safe for simplicity)
        // You may want to implement further validation and sanitization as needed

        // Prepare the SQL statement
        $sql = "INSERT INTO tasks (task_name, task_due, task_priority, task_label, archived, user_id) VALUES (:task_name, :task_due, :task_priority, :task_label, '0', :user_id)";

        // Assuming you have a way to get the user_id, for example, from a session
        session_start();
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            throw new Exception("User ID not found in session");
        }

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
        $stmt->bindParam(':task_due', $task_due, PDO::PARAM_STR);
        $stmt->bindParam(':task_priority', $task_priority, PDO::PARAM_STR);
        $stmt->bindParam(':task_label', $task_label, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to index.php on success
            header('Location: index.php');
            exit();
        } else {
            throw new Exception("Error inserting task");
        }
    } else {
        throw new Exception("Required POST data not set");
    }
} catch (Exception $e) {
    // Handle exceptions and errors
    echo "Error: " . $e->getMessage();
}
