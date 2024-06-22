<?php
require_once './../auth/important/sqlconnect.php';

// Validate input
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $fileId = intval($_GET['id']);

    try {
        // Fetch file details from the database using a prepared statement
        $stmt = $pdo->prepare("SELECT * FROM files WHERE id = :id");
        $stmt->bindParam(':id', $fileId, PDO::PARAM_INT);
        $stmt->execute();
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($file) {
            $filename = $file['filename'];
            $filepath = 'uploads/' . $filename; // Adjust the path according to your file storage

            // Check if the file exists
            if (file_exists($filepath)) {
                // Set headers for file download
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary");
                header("Content-disposition: attachment; filename=\"" . basename($filename) . "\"");

                // Read the file and output it to the browser
                readfile($filepath);
                exit();
            } else {
                echo "File not found.";
            }
        } else {
            echo "File not found in the database.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid file id.";
}
