<?php
header('Content-Type: application/json');

// Include your database connection file here
require_once '../important/sqlconnect.php'; // Adjust the file path as necessary

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $user_id = $_Files['user_id'];
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $uploadDir = 'uploads/';
        $dest_path = $uploadDir . $fileName;

        // Move the file to the specified directory
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Insert file info into the database
            $sql = "INSERT INTO myfile (name, size, type, path, upload_date) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siss", $fileName, $dest_path, $user_id);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "File uploaded successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to save file info to database"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to move the file"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No file uploaded or there was an upload error"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

$conn->close();
