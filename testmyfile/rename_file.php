<?php

require_once './../auth/important/session.php';
require_once './../auth/important/sqlconnect.php';

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

    try {
        // Fetch the current file details from the database
        $stmt = $pdo->prepare("SELECT filename FROM files WHERE id = ? AND user_id = ?");
        $stmt->execute([$file_id, $user_id]);
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$file) {
            $_SESSION['rename_error'] = "File not found or access denied.";
            header("Location: index.php");
            exit();
        }

        $current_file_name = $file['filename'];

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
            // Update the file name in the database
            $stmt = $pdo->prepare("UPDATE files SET filename = ?, created_at = NOW() WHERE id = ?");
            if ($stmt->execute([$new_name, $file_id])) {
                $_SESSION['rename_success'] = "File renamed successfully.";
            } else {
                // Rollback the file rename if database update fails
                rename($new_file_path, $current_file_path);
                $_SESSION['rename_error'] = "Database error: " . $stmt->errorInfo()[2];
            }
        } else {
            $_SESSION['rename_error'] = "Error renaming the file.";
        }
    } catch (PDOException $e) {
        $_SESSION['rename_error'] = "Database error: " . $e->getMessage();
    }

    header("Location: index.php");
    exit();
} else {
    $_SESSION['rename_error'] = "Invalid request.";
    header("Location: index.php");
    exit();
}
