<?php
session_start();
require_once('../important/sqlconnect.php');

try {
    $stmt = $pdo->prepare("SELECT group_id, group_name FROM groups");
    $stmt->execute();
    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = array(
        'status' => true,
        'groups' => $groups
    );
} catch (PDOException $e) {
    $data = array(
        'status' => false,
        'msg' => 'Database error: ' . $e->getMessage()
    );
}

echo json_encode($data);
