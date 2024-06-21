<?php
// Include database connection
include '../auth/important/sqlconnect.php';

// Check if the request is POST and if 'id' parameter is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    try {
        // Sanitize input
        $taskId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        // Prepare the SQL statement
        $sql = "UPDATE tasks SET archived = 1 WHERE id = :taskId";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the task ID parameter
        $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Task archived successfully";
        } else {
            echo "Error archiving task";
        }
    } catch (PDOException $e) {
        // Handle PDO exceptions
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        // Handle other exceptions
        echo "Error: " . $e->getMessage();
    }
}
