<?php
require_once('db.php');

if (isset($_GET['id'])) {
    $fileId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch file details from the database
    $sql = "SELECT * FROM files WHERE id = $fileId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
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
}
