<?php
require_once './../auth/important/session.php';
require_once './../auth/important/sqlconnect.php';

if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    try {
        // Fetch file details from the database using a prepared statement
        $stmt = $pdo->prepare("SELECT * FROM files WHERE id = ?");
        $stmt->execute([$fileId]);
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($file) {
            $filename = $file['filename'];
            $filepath = 'uploads/' . $filename; // Adjust the path according to your file storage

            // Check if the file exists in the specified path
            if (file_exists($filepath)) {
                // Determine file type and display accordingly
                $file_extension = pathinfo($filepath, PATHINFO_EXTENSION);
                if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    echo "<img src='$filepath' alt='$filename'>";
                } else {
                    // For non-image files, provide appropriate handling (e.g., download link or embed for PDF)
                    echo "File type not supported for direct display. <a href='$filepath' download>Download File</a>";
                }
            } else {
                echo "File not found.";
            }
        } else {
            echo "File not found in database.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
