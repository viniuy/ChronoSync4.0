<?php
session_start();
require_once '../important/sqlconnect.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    // Perform input validation
    if (!isset($data['oldData'], $data['newData'])) {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        exit();
    }

    $oldData = $data['oldData'];
    $newData = $data['newData'];

    try {
        // Ensure $oldData is an array before accessing
        if (!is_array($oldData)) {
            echo json_encode(["status" => "error", "message" => "Invalid oldData format"]);
            exit();
        }

        // If there's only one item in $oldData, directly access it
        if (count($oldData) === 1) {
            $oldItem = $oldData[0];
            $title = $oldItem['title'];
            $url = $oldItem['url'];
            $user_id = $oldItem['user_id'];

            // Prepare the SQL query to search for oldData
            $query = "SELECT * FROM resources WHERE resource_name = :title AND resource_url = :url AND user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":title", $title);
            $stmt->bindValue(":url", $url);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->execute();

            // If oldData found, update it with newData
            if ($stmt->rowCount() > 0) {
                $query = "UPDATE resources SET resource_name = :new_title, resource_url = :new_url WHERE resource_name = :title AND resource_url = :url AND user_id = :user_id";
                $stmt = $pdo->prepare($query);
                $stmt->bindValue(":new_title", $newData['title']);
                $stmt->bindValue(":new_url", $newData['url']);
                $stmt->bindValue(":title", $title);
                $stmt->bindValue(":url", $url);
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
            }
        }

        // Return success response
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        // Handle errors
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} else {
    // Invalid request method
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
