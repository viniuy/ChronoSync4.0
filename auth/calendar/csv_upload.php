<?php
header('Content-Type: application/json');

require_once '../important/sqlconnect.php'; // Adjust the file path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calendar_id = isset($_POST['calendar_id']) ? $_POST['calendar_id'] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

    if (!isset($_FILES['csv_file']) || empty($calendar_id) || empty($user_id)) {
        echo json_encode(['status' => false, 'msg' => 'Missing required fields.']);
        exit;
    }

    $csv_file = $_FILES['csv_file'];

    if ($csv_file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['status' => false, 'msg' => 'File upload error.']);
        exit;
    }

    $file_type = pathinfo($csv_file['name'], PATHINFO_EXTENSION);
    if ($file_type !== 'csv') {
        echo json_encode(['status' => false, 'msg' => 'Invalid file type. Only CSV files are allowed.']);
        exit;
    }

    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = uniqid() . '_' . basename($csv_file['name']);
    $file_path = $upload_dir . $file_name;

    if (!move_uploaded_file($csv_file['tmp_name'], $file_path)) {
        echo json_encode(['status' => false, 'msg' => 'Error saving the uploaded file.']);
        exit;
    }

    try {
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
            $data = array(
                'status' => false,
                'msg' => 'You do not have permission to add events to this calendar.'
            );
            echo json_encode($data);
            exit;
        }

        $file = fopen($file_path, 'r');
        $row_count = 0;

        while (($row = fgetcsv($file)) !== FALSE) {
            if ($row_count === 0) {
                $row_count++;
                continue; // Skip header row
            }

            $event_name = $row[0];
            $event_start_date = $row[1];
            $event_end_date = $row[2];

            $insert_query = "
                INSERT INTO `calendar_event_master` (`event_name`, `event_start_date`, `event_end_date`, `calendar_id`, `user_id`) 
                VALUES (:event_name, :event_start_date, :event_end_date, :calendar_id, :user_id)";
            $stmt_insert_event = $pdo->prepare($insert_query);
            $stmt_insert_event->bindParam(':event_name', $event_name);
            $stmt_insert_event->bindParam(':event_start_date', $event_start_date);
            $stmt_insert_event->bindParam(':event_end_date', $event_end_date);
            $stmt_insert_event->bindParam(':calendar_id', $calendar_id);
            $stmt_insert_event->bindParam(':user_id', $user_id);

            if (!$stmt_insert_event->execute()) {
                $data = array(
                    'status' => false,
                    'msg' => 'Error inserting event data.'
                );
                echo json_encode($data);
                fclose($file);
                exit;
            }
        }

        fclose($file);

        $data = array(
            'status' => true,
            'msg' => 'CSV uploaded and events added successfully!'
        );
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
