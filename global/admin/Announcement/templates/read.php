<?php
include '../config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM announcements WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No announcement found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Announcement</title>
</head>
<body>
    <h1>View Announcement</h1>
    <h2><?php echo $row['title']; ?></h2>
    <p><?php echo $row['content']; ?></p>
    <img src="../images/<?php echo $row['image']; ?>" width="300" />
    <br><br>
    <a href="../index.php">Back to Announcements</a>
</body>
</html>
