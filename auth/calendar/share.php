<?php
require_once '../important/sqlconnect.php';

$response = array('status' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calendar_id = isset($_POST['calendar_id']) ? $_POST['calendar_id'] : '';
    $share_with = isset($_POST['share_with']) ? $_POST['share_with'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $user_id = isset($_POST['user_id_input']) ? $_POST['user_id_input'] : '';
    $group_id = isset($_POST['group']) ? $_POST['group'] : '';
    $current_user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

    try {
        // Fetch calendar_id based on calendar_name
        $stmt = $pdo->prepare("SELECT calendar_id, user_id FROM calendar WHERE calendar_id = :calendar_id");
        $stmt->execute(['calendar_id' => $calendar_id]);
        $calendar = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$calendar) {
            throw new Exception("Calendar not found.");
        }

        // Check ownership
        if ($calendar['user_id'] != $current_user_id) {
            throw new Exception("You are not the sole owner of this calendar.");
        }

        // Share with a user
        if ($share_with == 'user') {
            // Check if already shared with this user
            $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM shared_calendars WHERE calendar_id = :calendar_id AND user_id = :user_id");
            $stmt->execute(['calendar_id' => $calendar['calendar_id'], 'user_id' => $user_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] > 0) {
                throw new Exception("Calendar already shared with this user.");
            }

            // Share with the user
            $stmt = $pdo->prepare("INSERT INTO shared_calendars (calendar_id, user_id, role) VALUES (:calendar_id, :user_id, :role)");
            $stmt->execute(['calendar_id' => $calendar['calendar_id'], 'user_id' => $user_id, 'role' => $role]);
        }
        // Share with a group
        else if ($share_with == 'group') {
            // Fetch all users in the group
            $stmt = $pdo->prepare("SELECT id FROM accounts WHERE group_name = :group_name");
            $stmt->execute(['group_name' => $group_id]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $user) {
                // Check if already shared with this user
                $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM shared_calendars WHERE calendar_id = :calendar_id AND user_id = :user_id");
                $stmt->execute(['calendar_id' => $calendar['calendar_id'], 'user_id' => $user['id']]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result['count'] == 0 && $user['id'] != $current_user_id) {
                    // Share with the user
                    $stmt = $pdo->prepare("INSERT INTO shared_calendars (calendar_id, user_id, role) VALUES (:calendar_id, :user_id, :role)");
                    $stmt->execute(['calendar_id' => $calendar['calendar_id'], 'user_id' => $user['id'], 'role' => $role]);
                }
            }
        }

        $response['status'] = true;
        $response['message'] = "Calendar shared successfully.";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = "Invalid request method.";
}

echo json_encode($response);
