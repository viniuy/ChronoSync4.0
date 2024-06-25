<?php

header('Content-Type: application/json');

// Include your database connection file here
require_once '../important/sqlconnect.php'; // Adjust the file path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $calendar_name = $_POST['calendar_name'];

    try {
        $deleteCalendar = "DELETE FROM `calendar` WHERE `calendar_name` = :calendar_name AND `user_id` = :user_id";

        // Prepare the statement
        $stmt = $pdo->prepare($deleteCalendar);

        // Bind parameters
        $stmt->bindParam(':calendar_name', $calendar_name);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            $data = array(
                'status' => true,
                'msg' => 'Calendar deleted successfully!'
            );
        } else {
            $data = array(
                'status' => false,
                'msg' => 'Sorry, calendar not deleted.'
            );
        }
    } catch (PDOException $e) {
        $data = array(
            'status' => false,
            'msg' => 'Database error: ' . $e->getMessage()
        );
    }
} else {
    $data = array(
        'status' => false,
        'msg' => 'Invalid request method'
    );
}

echo json_encode($data);

// Close the database connection
$pdo = null;
