<?php
header('Content-Type: application/json');

// Include your database connection file here
require_once '../important/sqlconnect.php'; // Adjust the file path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $calendar_name = $input['calendar_name'];
    $user_id = $input['user_id'];

    try {
        // Check if the calendar_name already exists for the same user_id
        $check_query = "SELECT COUNT(*) FROM `chronosync`.`calendar` WHERE calendar_name = :calendar_name AND user_id = :user_id";
        $stmt = $pdo->prepare($check_query);
        $stmt->bindParam(':calendar_name', $calendar_name);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $data = array(
                'status' => false,
                'msg' => 'A calendar with this name already exists for this user.'
            );
        } else {
            // Insert the new calendar
            $insert_query = "INSERT INTO `chronosync`.`calendar` (calendar_name, user_id) VALUES (:calendar_name, :user_id)";
            $stmt = $pdo->prepare($insert_query);
            $stmt->bindParam(':calendar_name', $calendar_name);
            $stmt->bindParam(':user_id', $user_id);

            if ($stmt->execute()) {
                $data = array(
                    'status' => true,
                    'msg' => 'Calendar added successfully!'
                );
            } else {
                $data = array(
                    'status' => false,
                    'msg' => 'Sorry, calendar not added.'
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

$pdo = null;
