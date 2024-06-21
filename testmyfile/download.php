<?php
require_once('db.php');

// Validate input
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetch file details from the database
    $sql = "SELECT * FROM files WHERE id = $fileId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $filename = $file['filename'];
        $filepath = 'uploads/' . $filename; // Adjust the path according to your file storage

        // Set headers for file download
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"$filename\"");

        // Read the file and output it to the browser
        readfile($filepath);
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid file id.";
}
