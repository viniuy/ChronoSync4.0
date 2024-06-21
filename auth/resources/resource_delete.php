<?php
header('Content-Type: application/json');

require_once '../important/sqlconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['title'], $data['url'], $data['user_id'])) {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        exit();
    }

    $title = $data["title"];
    $url = $data['url'];
    $user_id = $data['user_id'];

    try {
        $query = "DELETE FROM resources WHERE resource_name = :resource_name AND resource_url = :resource_url AND user_id = :user_id";
        $stmt = $pdo->prepare($query);

        $stmt->bindValue(":resource_name", $title);
        $stmt->bindValue(":resource_url", $url);
        $stmt->bindValue(":user_id", $user_id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete data"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
