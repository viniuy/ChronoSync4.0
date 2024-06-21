<?php
require_once('important/sqlconnect.php');

try {
    $stmt = $pdo->prepare("SELECT group_name FROM groups");
    $stmt->execute();
    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($groups);
} catch (PDOException $e) {
    echo json_encode(array('status' => false, 'msg' => 'Database error: ' . $e->getMessage()));
}
