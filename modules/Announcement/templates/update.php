<?php
include '../config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM announcements WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $target = "../images/".basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "UPDATE announcements SET title='$title', content='$content', image='$image' WHERE id=$id";
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
    <title>Update Announcement</title>
</head>
<body>
    <h1>Update Announcement</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" required><?php echo $row['content']; ?></textarea><br><br>
        <label>Image:</label><br>
        <input type="file" name="image" ><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
