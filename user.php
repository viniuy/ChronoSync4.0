<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https://fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    
    <!-- PAGE TITLE HERE -->
    <title>ChronoSync</title>
    
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!-- Datatable -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<!-- Modal for editing position -->
<div class="modal fade" id="editPositionModal" tabindex="-1" aria-labelledby="editPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPositionForm" action="update_position.php" method="POST"> <!-- Replace action with your update position endpoint -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editPositionModalLabel">Edit Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <div class="mb-3">
                        <label for="currentPosition" class="form-label">Current Position</label>
                        <input type="text" class="form-control" id="currentPosition" name="currentPosition" readonly>
                    </div>
                    <div class="mb-3">
                    <select name="newPosition" class="form-control" id="newPosition" name="newPosition" required>
                            <option value="" >Select Group</option>
                            <option value="" >teacher</option>
                            <option value="" >student</option>
                            <option value="" >admin</option>


                               
                        </select>
                    </div>
                </div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<body>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile Datatable</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Group</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // PHP code to fetch data from database and populate the table
                            // Replace with your database connection details
                            $host = 'localhost'; // or your database host
                            $servername = "localhost";
$username = "root";
$password = "";
$dbname = "ChronoSync";

                            

                            try {
                                // Connect to the database
                                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                // Prepare SQL query to fetch data
                                $sql = "SELECT id, email, name, position, group_name FROM accounts";
                                $stmt = $pdo->query($sql);

                                // Iterate over fetched rows and display in table rows
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['email']}</td>";
                                    echo "<td>{$row['name']}</td>";
                                    echo "<td>{$row['position']}</td>";
                                    echo "<td>{$row['group_name']}</td>";
                                    echo '<td>
                                            <div class="d-flex">
                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 edit-position" data-id="' . $row['id'] . '" data-position="' . htmlspecialchars($row['position']) . '"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                                          </td>';
                                    echo "</tr>";
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <a href="#" class="btn btn-danger shadow btn-xs sharp delete-account" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i></a> -->

    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>
    
    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>

    <script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <!-- JavaScript code, place this before </body> -->
<script>
    // Function to handle editing position using modal
    $(document).ready(function () {
        // Open edit modal on edit button click
        $('.edit-position').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var currentPosition = $(this).data('position');

            // Populate modal fields
            $('#editPositionModal input[name="id"]').val(id);
            $('#editPositionModal input[name="currentPosition"]').val(currentPosition);

            // Show the modal
            $('#editPositionModal').modal('show');
        });

        // Handle delete account action
        $('.delete-account').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            // You can confirm the deletion if needed, then proceed with AJAX call or form submission
            if (confirm('Are you sure you want to delete this account?')) {
                // Perform AJAX request or form submission to delete the account
                $.ajax({
                    url: 'delete_account.php', // Replace with your backend endpoint for deleting accounts
                    method: 'POST',
                    data: { id: id },
                    success: function (response) {
                        // Handle success response if needed
                        console.log('Account deleted successfully');
                        // Optionally reload or update the table after deletion
                    },
                    error: function (xhr, status, error) {
                        // Handle error response if needed
                        console.error('Error deleting account:', error);
                    }
                });
            }
        });
    });
</script>


</body>

</html>
