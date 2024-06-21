<?php
header('Content-Type: application/json');

// Include your database connection file here
require_once '../important/sqlconnect.php'; // Adjust the file path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = isset($_POST['event_name']) ? $_POST['event_name'] : '';
    $event_start_date = isset($_POST['event_start_date']) ? $_POST['event_start_date'] : '';
    $event_start_time = isset($_POST['event_start_time']) ? $_POST['event_start_time'] : null;
    $event_end_date = isset($_POST['event_end_date']) ? $_POST['event_end_date'] : '';
    $event_end_time = isset($_POST['event_end_time']) ? $_POST['event_end_time'] : null;
    $calendar_id = isset($_POST['calendar_id']) ? $_POST['calendar_id'] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $check_role = isset($_POST['check_role']) && $_POST['check_role']; // Check if role check is requested

    // Combine date and time if time is provided
    $event_start = $event_start_date . ($event_start_time ? " $event_start_time:00" : '');
    $event_end = $event_end_date . ($event_end_time ? " $event_end_time:00" : '');

    try {
        // Check if role checking is requested and if the calendar is shared with the user
        if ($check_role) {
            // Query to check if the user is the owner of the calendar
            $stmt_check_owner = $pdo->prepare("
                SELECT COUNT(*) AS count
                FROM calendar
                WHERE calendar_id = :calendar_id
                  AND user_id = :user_id
            ");
            $stmt_check_owner->execute([
                'calendar_id' => $calendar_id,
                'user_id' => $user_id
            ]);
            $owner_row = $stmt_check_owner->fetch(PDO::FETCH_ASSOC);

            if (!$owner_row || $owner_row['count'] == 0) {
                // Check if the user is an admin in the shared calendar
                $stmt_check_role = $pdo->prepare("
                    SELECT role
                    FROM shared_calendars
                    WHERE calendar_id = :calendar_id
                      AND user_id = :user_id
                ");
                $stmt_check_role->execute([
                    'calendar_id' => $calendar_id,
                    'user_id' => $user_id
                ]);
                $role_row = $stmt_check_role->fetch(PDO::FETCH_ASSOC);

                if (!$role_row || $role_row['role'] !== 'admin') {
                    $data = array(
                        'status' => false,
                        'msg' => 'You do not have permission to add events to this calendar.'
                    );
                    echo json_encode($data);
                    exit; // Exit here if the user is neither the owner nor an admin
                }
            }
        }

        // Proceed to insert event into the database
        $insert_query = "
            INSERT INTO `calendar_event_master` (`event_name`, `event_start_date`, `event_end_date`, `calendar_id`, `user_id`) 
            VALUES (:event_name, :event_start_date, :event_end_date, :calendar_id, :user_id)";
        $stmt_insert_event = $pdo->prepare($insert_query);
        $stmt_insert_event->bindParam(':event_name', $event_name);
        $stmt_insert_event->bindParam(':event_start_date', $event_start);
        $stmt_insert_event->bindParam(':event_end_date', $event_end);
        $stmt_insert_event->bindParam(':calendar_id', $calendar_id);
        $stmt_insert_event->bindParam(':user_id', $user_id);

        if ($stmt_insert_event->execute()) {
            $data = array(
                'status' => true,
                'msg' => 'Event added successfully!'
            );
        } else {
            $data = array(
                'status' => false,
                'msg' => 'Sorry, event not added.'
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
