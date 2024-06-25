<?php

header('Content-Type: application/json');

// Include your database connection file here
require_once '../important/sqlconnect.php'; // Adjust the file path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_calendar_name = $_POST['calendar_namer'];
    $old_calendar_name = $_POST['old_name'];
    $user_id = $_POST['user_id']; // Retrieving user_id from POST data

    try {
        // Check if the new calendar name already exists for the user
        $checkQuery = "SELECT COUNT(*) FROM `calendar` WHERE `calendar_name` = :new_calendar_name AND `user_id` = :user_id";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->bindParam(':new_calendar_name', $new_calendar_name);
        $checkStmt->bindParam(':user_id', $user_id);
        $checkStmt->execute();
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            // Calendar name already exists
            $data = array(
                'status' => false,
                'msg' => 'A calendar with this name already exists.'
            );
        } else {
            // Proceed with the update
            $updateCalendar = ("UPDATE `calendar` 
                                SET `calendar_name` = :new_calendar_name
                                WHERE `calendar_name` = :old_calendar_name AND `user_id` = :user_id
            ");

            // Prepare the statement
            $stmt = $pdo->prepare($updateCalendar);

            // Bind parameters
            $stmt->bindParam(':new_calendar_name', $new_calendar_name);
            $stmt->bindParam(':old_calendar_name', $old_calendar_name);
            $stmt->bindParam(':user_id', $user_id);

            if ($stmt->execute()) {
                $data = array(
                    'status' => true,
                    'msg' => 'Calendar Edited Successfully!'
                );
            } else {
                $data = array(
                    'status' => false,
                    'msg' => 'Sorry, Calendar Not Edited.'
                );
            }
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
