<head>
    ...
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    ...
</head>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chronosync";

$conn = mysqli_connect($servername, $username, $password, $dbname);



if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetch file details from the database
    $sql = "SELECT * FROM files WHERE id = $fileId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $filename = $file['filename'];
        $filepath = 'uploads/' . $filename; // Adjust the path according to your file storage

        // Delete file from the server
        if (unlink($filepath)) {
            // Delete file record from the database
            $deleteSql = "DELETE FROM files WHERE id = $fileId";
            if (mysqli_query($conn, $deleteSql)) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'File deleted successfully.'
                        }).then(function() {
                            window.location.href = 'index.php'; // Redirect to a specific page after deletion
                        });
                    });
                </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error deleting file: " . mysqli_error($conn) . "'
                        }).then(function() {
                            window.location.href = 'index.php'; // Redirect to a specific page after error
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error deleting file from server.'
                    }).then(function() {
                        window.location.href = 'index.php'; // Redirect to a specific page after error
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'File not found.'
                }).then(function() {
                    window.location.href = 'index.php'; // Redirect to a specific page after error
                });
            });
        </script>";
    }
}
?>
