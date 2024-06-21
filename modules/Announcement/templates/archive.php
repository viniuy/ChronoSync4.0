<?php
include '../config.php';

$id = $_GET['id'];
$sql = "UPDATE announcements SET archived=TRUE WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: ../index.php');
} else {
    echo "Error: " . $conn->error;
}
?>
