<?php
header('Content-Type: application/json');
require_once '../important/sqlconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calendar_ids = isset($_POST['calendar_id']) ? $_POST['calendar_id'] : [];

    $data_arr = [];

    foreach ($calendar_ids as $calendar_id) {
        // Check if calendar_id is a positive integer
        if (intval($calendar_id) > 0) {
            // Query to fetch events from a specific calendar
            $query = "
                SELECT calendar_event_master.event_id, calendar_event_master.event_name, 
                    calendar_event_master.event_start_date, calendar_event_master.event_end_date, 
                    calendar.calendar_name
                FROM calendar_event_master
                INNER JOIN calendar ON calendar_event_master.calendar_id = calendar.calendar_id
                WHERE calendar_event_master.calendar_id = :calendar_id
            ";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':calendar_id', $calendar_id, PDO::PARAM_INT);
            $stmt->execute();

            // Fetch all rows for the current calendar_id
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
                foreach ($rows as $data_row) {
                    $data_arr[] = array(
                        'event_id' => $data_row['event_id'],
                        'title' => $data_row['event_name'],
                        'start' => $data_row['event_start_date'], // Assume it's already in DATETIME format
                        'end' => $data_row['event_end_date'],     // Assume it's already in DATETIME format
                        'color' => '#' . substr(uniqid(), -6),    // Generate a random color (optional)
                        'url' => '',
                        'calendar_name' => $data_row['calendar_name']
                    );
                }
            } else {
                // No events found for this calendar_id, or it may be an invalid ID
                // You can log this or handle it as needed
            }
        } else {
            // Invalid calendar ID, log or handle as needed
        }
    }

    if (!empty($data_arr)) {
        $data = array(
            'status' => true,
            'msg' => 'Successfully fetched events for selected calendars',
            'data' => $data_arr
        );
    } else {
        $data = array(
            'status' => false,
            'msg' => 'No valid calendar IDs provided or no events found',
            'data' => [] // Empty array to signify no events
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
?>
