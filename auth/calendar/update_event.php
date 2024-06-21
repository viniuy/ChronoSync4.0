<?php
header('Content-Type: application/json');

// Include your database connection file here
require_once '../important/sqlconnect.php'; // Adjust the file path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id']; // Get the event ID from the POST request
    $event_name = $_POST['event_name']; // Get the event name from the POST request
    $event_start_datetime = $_POST['start_datetime']; // Get the start date and time from the POST request
    $event_end_datetime = $_POST['end_datetime']; // Get the end date and time from the POST request

    try {
        $update_query = "UPDATE `calendar_event_master` 
                         SET `event_name` = :event_name, 
                             `event_start_date` = :event_start_date, 
                             `event_end_date` = :event_end_date
                         WHERE `event_id` = :event_id";
        $stmt = $pdo->prepare($update_query);
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':event_start_date', $event_start_datetime);
        $stmt->bindParam(':event_end_date', $event_end_datetime);
        $stmt->bindParam(':event_id', $event_id);

        if ($stmt->execute()) {
            $data = array(
                'status' => true,
                'msg' => 'Event updated successfully!'
            );
        } else {
            $data = array(
                'status' => false,
                'msg' => 'Sorry, event not updated.'
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
