<?php
session_start();
require_once '../important/sqlconnect.php';
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['user_id'])) {

    $query = "SELECT * FROM resources WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $resourcesData = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $resourcesData[] = array(
            'title' => $row['resource_name'],
            'url' => $row['resource_url']
        );
    }

    // Output resources data as JSON
    header('Content-Type: application/json'); // Set response header to indicate JSON content
    echo json_encode($resourcesData);
} else {
    header("Location: ../login.php");
    exit();
}
