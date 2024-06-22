<?php
require_once './../auth/important/session.php';
if (!isset($_SESSION["user_email"])) {
    header("Location: login.php?Logged-in=?");
    exit();
}
$user_id = $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyFile</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="uploader.css">

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body>

    <div class="container mt-4">
        <!-- Quick Access Section -->
        <div class="row align-items-center mb-3">
            <div class="col">
                <h2 class="mt-1">Quick Access</h2>
            </div>
            <div class="col text-right">
                <div class="mt-4 mt-sm-0 d-flex align-items-center justify-content-sm-end">
                    <div class="mb-2 me-2">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                                Upload File
                            </button>


                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i class="mdi mdi-folder-outline me-1"></i> Folder</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-file-outline me-1"></i> File</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="dropArea" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                            <p>Drag and drop files here or <span class="browse-file" onclick="document.getElementById('file').click()">click here</span> to browse</p>
                        </div>
                        <h5 class="mt-3">Recently Uploaded</h5>
                        <div id="recentlyUploadedFiles"></div>

                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="file" id="file" class="form-control-file d-none" onchange="getImageData(event)">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Upload File</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rename Modal -->
        <div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="renameModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="renameModalLabel">Rename File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="renameForm" action="rename_file.php" method="post">
                            <input type="hidden" name="file_id" id="renameFileId">
                            <div class="form-group">
                                <label for="newName">New File Name</label>
                                <input type="text" name="new_name" id="newName" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Rename</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Quick Access Section -->
        <div class="row">
            <div class="col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6 text-center mb-4">
                <div class="card-body"><a href="https://drive.google.com/" target="_blank">
                        <div class="d-flex justify-content-center">
                            <div class="avatar align-self-center">
                                <!-- Set background color to white -->
                                <div class="avatar-title rounded bg-white text-primary font-size-24">
                                    <!-- Set icon color to a different color -->
                                    <i class="mdi mdi-google-drive text-warning"></i>
                                </div>
                            </div>
                        </div>
                </div>
                </a>
                <h6 class="custom-text">Google Drive</h6>
            </div>



            <div class="col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6 text-center mb-4">
                <div class="card-body"><a href="https://onedrive.com/" target="_blank">
                        <div class="d-flex justify-content-center">
                            <div class="avatar align-self-center">
                                <!-- Set background color to white -->
                                <div class="avatar-title rounded bg-white text-primary font-size-24">
                                    <!-- Set icon color to a different color -->
                                    <i class="mdi mdi-cloud"></i>
                                </div>
                            </div>
                        </div>
                </div> </a>
                <h6 class="custom-text">OneDrive</h6>
            </div>

            <div class="col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6 text-center mb-4">
                <div class="card-body"><a href="https://onedrive.live.com/login/" target="_blank">
                        <div class="d-flex justify-content-center">
                            <div class="avatar align-self-center">
                                <!-- Set background color to white -->
                                <div class="avatar-title rounded bg-white text-primary font-size-24">
                                    <!-- Set icon color to a different color -->
                                    <i class="mdi mdi-dropbox"></i>
                                </div>
                            </div>
                        </div>
                </div></a>
                <h6 class="custom-text">Dropbox</h6>

            </div>

            <div class="col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6 text-center mb-4">
                <div class="card-body"><a href="https://www.grammarly.com/" target="_blank">

                        <div class="d-flex justify-content-center">
                            <div class="avatar align-self-center">
                                <!-- Set background color to white -->
                                <div class="avatar-title rounded bg-white text-primary font-size-24">
                                    <!-- Set icon color to a different color -->
                                    <i class="mdi mdi-alpha-g-circle" style="color:#12C199;font-size: 27px;"></i>
                                </div>
                            </div>
                        </div>
                </div></a>
                <h6 class="custom-text">Grammarly</h6>
            </div>

            <div class="col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6 text-center mb-4">
                <div class="card-body"><a href="https://canva.com" target="_blank">
                        <div class="d-flex justify-content-center">
                            <div class="avatar align-self-center">
                                <!-- Set background color to white -->
                                <div class="avatar-title rounded bg-white text-primary font-size-24">
                                    <!-- Set icon color to a different color -->

                                    <style>
                                        .avatar-title1 {
                                            /* Set the size, font, and other styles as needed */
                                            width: 20px;
                                            height: 20px;
                                            font-size: 10px;
                                            text-align: center;
                                            line-height: 20px;
                                            /* Center content vertically */
                                            color: white;
                                            /* Text color */
                                            border-radius: 50%;
                                            /* Rounded shape */
                                            background: linear-gradient(to bottom, #30B5CE, #46A4D4, #5785E3);
                                            /* Gradient colors */
                                            position: relative;
                                            /* Enable positioning */
                                            overflow: hidden;
                                            /* Ensure the icon is clipped within the rounded border */
                                        }

                                        .avatar-title1 i {
                                            position: absolute;
                                            /* Position the icon absolutely */
                                            top: 50%;
                                            /* Align at the top */
                                            left: 50%;
                                            /* Align at the left */
                                            transform: translate(-50%, -50%);
                                            /* Center the icon */
                                            width: 60%;
                                            /* Set the width of the icon */
                                            height: 60%;
                                            /* Set the height of the icon */
                                            font-size: 18px;
                                            /* Increase the font size of the icon */
                                            display: flex;
                                            /* Flexbox for centering icon */
                                            justify-content: center;
                                            /* Center horizontally */
                                            align-items: center;
                                            /* Center vertically */
                                            color: white;
                                            /* Icon color */
                                        }
                                    </style>

                                    <div class="avatar-title1 ">
                                        <i class="mdi mdi-language-c "></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div></a>
                <h6 class="custom-text">Canva</h6>
            </div>

            <div class="col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6 text-center mb-4">
                <div class="card-body"><a href="https://www.notion.so/" target="_blank">

                        <div class="d-flex justify-content-center">
                            <div class="avatar align-self-center">
                                <!-- Set background color to white -->
                                <div class="avatar-title rounded bg-white text-primary font-size-24">
                                    <!-- Set icon color to a different color -->
                                    <i class="mdi mdi-alpha-n-box-outline text-info"></i>
                                </div>
                            </div>
                        </div>
                </div></a>
                <h6 class="custom-text">Notion</h6>
            </div>
        </div>
        <!-- end quick access -->

        <!-- My Files Section -->
        <h2 class="mt-2">My Files</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Filesize</th>
                    <th>Date Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection
                require_once './../auth/important/sqlconnect.php';

                // Assuming $user_id is defined somewhere in your session or application logic
                $user_id = $_SESSION['user_id']; // or however you retrieve the logged-in user ID

                try {
                    // Fetch files for the logged-in user
                    $sql = "SELECT * FROM files WHERE user_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$user_id]);
                    $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Function to format filesize in human-readable format
                    function formatSizeUnits($bytes)
                    {
                        $units = array('B', 'KB', 'MB', 'GB', 'TB');
                        $i = 0;
                        while ($bytes >= 1024 && $i < count($units) - 1) {
                            $bytes /= 1024;
                            $i++;
                        }
                        return round($bytes, 2) . ' ' . $units[$i];
                    }

                    // Display files in an HTML table
                    if ($files) {
                        foreach ($files as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['filename']) . "</td>";
                            echo "<td>" . formatSizeUnits($row['filesize']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                            echo "<td>
                                    <div class='dropdown'>
                                        <button class='btn btn-link dropdown-toggle' type='button' id='dropdownMenuButton{$row['id']}' onclick='toggleDropdown({$row['id']})'>
                                            <i class='fas fa-ellipsis-h'></i>
                                        </button>
                                        <div class='dropdown-menu' id='dropdownMenu{$row['id']}' style='display: none;'>
                                            <a class='dropdown-item' href='#' onclick='confirmAction(\"view.php?id={$row['id']}\", \"View\")'>View</a>
                                            <a class='dropdown-item' href='#' onclick='confirmActionWithModal({$row['id']}, \"{$row['filename']}\", \"Rename\")'>Rename</a>
                                            <a class='dropdown-item' href='#' onclick='confirmAction(\"download.php?id={$row['id']}\", \"Download\")'>Download</a>
                                            <a class='dropdown-item' href='#' onclick='confirmAction(\"delete.php?id={$row['id']}\", \"Delete\")'>Delete</a>
                                        </div>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No files found for the user.";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to handle dropdown toggle
        function toggleDropdown(id) {
            var dropdown = document.getElementById(`dropdownMenu${id}`);
            if (dropdown.style.display === 'none') {
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }
        }

        function handleDrop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            document.getElementById('file').files = files;
            getImageData({
                target: {
                    files: files
                }
            });
        }

        function handleDragOver(event) {
            event.preventDefault();
        }

        function getImageData(event) {
            const files = event.target.files;
            const recentlyUploadedFiles = document.getElementById('recentlyUploadedFiles');
            recentlyUploadedFiles.innerHTML = '';

            for (const file of files) {
                const listItem = document.createElement('p');
                listItem.textContent = file.name;
                recentlyUploadedFiles.appendChild(listItem);
            }
        }

        function confirmAction(url, action) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to ${action.toLowerCase()} this file?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        function confirmActionWithModal(id, filename, action) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to ${action.toLowerCase()} this file?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (action.toLowerCase() === 'rename') {
                        openRenameModal(id, filename);
                    } else {
                        window.location.href = url;
                    }
                }
            });
        }

        function openRenameModal(id, filename) {
            document.getElementById('renameFileId').value = id;
            document.getElementById('newName').value = filename;
            $('#renameModal').modal('show');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>