<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chronosync";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to get folders
function getFolders($parentFolder)
{
    global $conn;
    $parentFolder = mysqli_real_escape_string($conn, $parentFolder); // Escape input for security
    $query = "SELECT * FROM folders WHERE parent_folder = '$parentFolder'";
    $result = mysqli_query($conn, $query);
    $folders = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $folders[] = $row;
    }

    return $folders;
}

// Function to get folder name
function getFolderName($folderId)
{
    global $conn;
    $folderId = mysqli_real_escape_string($conn, $folderId); // Escape input for security
    $query = "SELECT name FROM folders WHERE id = '$folderId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['name'];
}

// Function to get files in a folder
function getFiles($folderId)
{
    global $conn;
    $folderId = mysqli_real_escape_string($conn, $folderId); // Escape input for security
    $query = "SELECT * FROM files WHERE folder_id = '$folderId'";
    $result = mysqli_query($conn, $query);
    $files = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $files[] = $row;
    }

    return $files;
}
