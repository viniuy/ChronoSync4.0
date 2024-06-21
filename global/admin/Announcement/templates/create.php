<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $url = $_POST['url']; // New URL field
    $target = "../images/".basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO announcements (title, content, image, url) VALUES ('$title', '$content', '$image', '$url')";
        if ($conn->query($sql) === TRUE) {
            header('Location: ../index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Announcement</title>
</head>
<body>
    <h1>Create Announcement</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" required></textarea><br><br>
        <label>Image:</label><br>
        <input type="file" name="image" required><br><br>
        <label>URL:</label><br> 
        <input type="text" name="url"><br><br>
        <input type="submit" value="Create">
    </form>
</body>
</html>
