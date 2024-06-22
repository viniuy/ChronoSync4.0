
<?php
require_once './../auth/important/session.php';

require_once './../auth/important/sqlconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    // Validate file upload
    if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
        $_SESSION['upload_error'] = "Error uploading file.";
        header("Location: index.php");
        exit();
    }

    // Validate file type (e.g., only allow certain file types)
    $allowed_file_types = ['image/jpeg', 'image/png', 'application/pdf']; // Adjust as needed
    if (!in_array($_FILES["file"]["type"], $allowed_file_types)) {
        $_SESSION['upload_error'] = "Invalid file type.";
        header("Location: index.php");
        exit();
    }

    // Validate file size (e.g., max 2MB)
    $max_file_size = 2 * 1024 * 1024; // 2MB
    if ($_FILES["file"]["size"] > $max_file_size) {
        $_SESSION['upload_error'] = "File size exceeds the limit of 2MB.";
        header("Location: index.php");
        exit();
    }

    $user_id = $_SESSION["user_id"];
    $file_name = basename($_FILES["file"]["name"]);
    $file_size = $_FILES["file"]["size"];

    try {
        // Insert file details into the database using a prepared statement
        $stmt = $pdo->prepare("INSERT INTO files (filename, filesize, created_at, user_id) VALUES (?, ?, NOW(), ?)");
        $stmt->execute([$file_name, $file_size, $user_id]);

        // Move uploaded file to the uploads directory
        $target_dir = "uploads/";
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // Set success message in session variable
            $_SESSION['upload_success'] = "File uploaded successfully.";
        } else {
            $_SESSION['upload_error'] = "Error moving file to destination.";
        }
    } catch (PDOException $e) {
        $_SESSION['upload_error'] = "Database error: " . $e->getMessage();
    }

    // Redirect back to index.php
    header("Location: index.php");
    exit();
}
