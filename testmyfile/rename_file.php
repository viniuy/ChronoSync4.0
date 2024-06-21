<?php
require_once('db.php');
require_once './../auth/important/session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["file_id"]) && isset($_POST["new_name"])) {
    // Retrieve and sanitize inputs
    $file_id = intval($_POST["file_id"]);
    $new_name = basename($_POST["new_name"]); // Only allow the base name for security reasons

    // Validate new file name
    if (empty($new_name) || !preg_match('/^[a-zA-Z0-9._-]+$/', $new_name)) {
        $_SESSION['rename_error'] = "Invalid file name.";
        header("Location: index.php");
        exit();
    }

    $user_id = $_SESSION["user_id"];

    // Fetch the current file details from the database including created_at
    $stmt = $conn->prepare("SELECT filename, created_at FROM files WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $file_id, $user_id);
    $stmt->execute();
    $stmt->bind_result($current_file_name, $created_at);
    $stmt->fetch();
    $stmt->close();

    if (!$current_file_name) {
        $_SESSION['rename_error'] = "File not found or access denied.";
        header("Location: index.php");
        exit();
    }

    // Set the target directory and paths
    $target_dir = "uploads/";
    $current_file_path = $target_dir . $current_file_name;
    $new_file_path = $target_dir . $new_name;

    // Check if the new file name already exists
    if (file_exists($new_file_path)) {
        $_SESSION['rename_error'] = "A file with the new name already exists.";
        header("Location: index.php");
        exit();
    }

    // Attempt to rename the file
    if (rename($current_file_path, $new_file_path)) {
        // Update the file name and created_at in the database
        $stmt = $conn->prepare("UPDATE files SET filename = ?, created_at = NOW() WHERE id = ?");
        $stmt->bind_param("si", $new_name, $file_id);

        if ($stmt->execute()) {
            $_SESSION['rename_success'] = "File renamed successfully.";
        } else {
            // Rollback the file rename if database update fails
            rename($new_file_path, $current_file_path);
            $_SESSION['rename_error'] = "Database error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['rename_error'] = "Error renaming the file.";
    }

    header("Location: index.php");
    exit();
} else {
    $_SESSION['rename_error'] = "Invalid request.";
    header("Location: index.php");
    exit();
}
?>
