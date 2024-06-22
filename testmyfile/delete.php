<head>
    ...
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    ...
</head>


<?php
require_once './../auth/important/sqlconnect.php';

if (isset($_GET['id'])) {
    $fileId = intval($_GET['id']);

    try {
        // Fetch file details from the database
        $stmt = $pdo->prepare("SELECT * FROM files WHERE id = :id");
        $stmt->bindParam(':id', $fileId, PDO::PARAM_INT);
        $stmt->execute();
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($file) {
            $filename = $file['filename'];
            $filepath = 'uploads/' . $filename; // Adjust the path according to your file storage

            // Delete file from the server
            if (unlink($filepath)) {
                // Delete file record from the database
                $deleteStmt = $pdo->prepare("DELETE FROM files WHERE id = :id");
                $deleteStmt->bindParam(':id', $fileId, PDO::PARAM_INT);
                if ($deleteStmt->execute()) {
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
                                text: 'Error deleting file: " . $deleteStmt->errorInfo()[2] . "'
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
    } catch (PDOException $e) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Database error: " . $e->getMessage() . "'
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
                text: 'Invalid file id.'
            }).then(function() {
                window.location.href = 'index.php'; // Redirect to a specific page after error
            });
        });
    </script>";
}
?>

?>