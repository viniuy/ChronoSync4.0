<?php
session_start();
require_once('../important/sqlconnect.php');

$user_id = $_SESSION['user_id']; // Assuming you retrieve user_id from session

try {
    // Query to fetch both personal and shared calendars
    $stmt = $pdo->prepare("
        SELECT calendar.calendar_id, calendar.calendar_name, 
               CASE 
                   WHEN calendar.user_id = :user_id THEN 0
                   ELSE 1
               END AS is_shared
        FROM calendar
        LEFT JOIN shared_calendars ON calendar.calendar_id = shared_calendars.calendar_id
        WHERE calendar.user_id = :user_id OR shared_calendars.user_id = :user_id
    ");
    $stmt->execute(['user_id' => $user_id]);

    $calendars = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Check if calendar with the same id and name already exists in $calendars array
        $exists = false;
        foreach ($calendars as $calendar) {
            if ($calendar['calendar_id'] == $row['calendar_id'] && $calendar['calendar_name'] == $row['calendar_name']) {
                $exists = true;
                break;
            }
        }
        if (!$exists) {
            $calendars[] = $row;
        }
    }

    $data = array(
        'status' => true,
        'calendars' => $calendars
    );
} catch (PDOException $e) {
    $data = array(
        'status' => false,
        'msg' => 'Database error: ' . $e->getMessage()
    );
}

echo json_encode($data);
