<?php
session_start();
require_once('../important/sqlconnect.php'); // Adjust path as per your setup

$user_id = $_SESSION['user_id']; // Assuming you retrieve user_id from session

try {
    // Query to fetch both personal and shared calendars with roles
    $stmt = $pdo->prepare("
        SELECT calendar.calendar_id, calendar.calendar_name, 
               shared_calendars.user_id AS shared_user_id, shared_calendars.role
        FROM calendar
        LEFT JOIN shared_calendars ON calendar.calendar_id = shared_calendars.calendar_id
        WHERE calendar.user_id = :user_id OR shared_calendars.user_id = :user_id
    ");
    $stmt->execute(['user_id' => $user_id]);
    $calendars = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

// Set response header to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode($data);
