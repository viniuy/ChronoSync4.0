<?php
// update_position.php

// Include the file containing database connection details
require_once('auth/important/session.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized the input for security
    $id = $_POST['id'];
    $newPosition = $_POST['newPosition'];

    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare update SQL query
        $sql = "UPDATE your_table_name SET position = :position WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['position' => $newPosition, 'id' => $id]);

        // Optionally, you can handle success response
        echo json_encode(['success' => true, 'message' => 'Position updated successfully']);

    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(['success' => false, 'message' => 'Error updating position: ' . $e->getMessage()]);
    }
} else {
    // Handle invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
