<?php

header('Content-Type: application/json');
// Include your database connection file here
require_once '../important/sqlconnect.php'; // Adjust the file path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calendar_name = $_POST['calendar_name'];


    try {
        $updateCalendar = ("UPDATE `calendar` 
                                SET `calendar_name` = :event_name
                                WHERE 'calendar_name' = :event_name,
                                        'user_id' = :user_id,
        ");
        $stmt = $pdo->prepare($updateCalendar);
        $stmt->bindParam('event_name', $calendar_name);

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

$pdo = null;
