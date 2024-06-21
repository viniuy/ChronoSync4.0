<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https:/fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Chronosync</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
    <link href="vendor/fullcalendar/css/main.min.css" rel="stylesheet">

    <!-- Style css -->
    <link href="style.css" rel="stylesheet">

    <script src="calendar_w/script.js" defer></script>
    <link rel="stylesheet" href="calendar_w/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<div class="card-body">
    <style>
        .task-card {
            margin-bottom: 20px;
        }

        .task-card .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-card .card-body span {
            word-wrap: break-word;
        }

        .task-actions i {
            cursor: pointer;
            margin-right: 10px;
        }
    </style>


    </head>

    <body>
        <div class="container-fluid">

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="email-left-box">
                            <div class="mail-list rounded mt-4" style="background: #ffffff;">
                                <a href="index.php" class="list-group-item active"><i class="fa fa-inbox font-18 align-middle me-2"></i> Inbox <span class="badge badge-primary badge-sm float-end">198</span></a>
                                <a href="index.php" class="list-group-item"><i class="fa fa-paper-plane font-18 align-middle me-2"></i> All Tasks</a>
                                <a href="index.php?filter=important" class="list-group-item"><i class="fa fa-star font-18 align-middle me-2"></i> Important</a>
                                <a href="index.php?filter=today" class="list-group-item"><i class="mdi mdi-file-document-box font-18 align-middle me-2"></i> Today</a>
                                <a href="index.php?filter=archived" class="list-group-item"><i class="fa fa-archive font-18 align-middle me-2"></i> Archived</a>
                            </div>
                            <div class="mail-list rounded overflow-hidden mt-4" style="background: #ffffff;">

                                <a href="index.php" class="list-group-item active"><i class="fa fa-inbox font-18 align-middle me-2"></i> List </a>
                                <a href="index.php?filter=work" class="list-group-item"><span class="icon-warning"><i class="fa fa-circle" aria-hidden="true"></i></span> Work</a>
                                <a href="index.php?filter=school" class="list-group-item"><span class="icon-primary"><i class="fa fa-circle" aria-hidden="true"></i></span> School</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">

                        <button id="addTaskBtn" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-plus"></i> Add Task
                        </button>
                        <div id="taskList" class="mt-3">


                            <div class="mb-3">
                                <div class="card task-card">

                                    <?php
                                    // Include database connection
                                    include '../auth/important/sqlconnect.php';

                                    // Initialize filter variable from GET request or default to empty string
                                    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

                                    // Base SQL query to fetch tasks that are not archived
                                    $sql = "SELECT * FROM tasks WHERE archived = '0'";

                                    // Apply filters based on the value of $filter
                                    if ($filter) {
                                        if ($filter == 'important') {
                                            // Filter for tasks marked as 'high' priority
                                            $sql .= " AND task_priority = 'high'";
                                        } elseif ($filter == 'today') {
                                            // Filter for tasks due today
                                            $sql .= " AND task_due = CURDATE()";
                                        } elseif ($filter == 'archived') {
                                            // Retrieve archived tasks instead of active ones
                                            $sql = "SELECT * FROM tasks WHERE archived = '1'";
                                        } else {
                                            // Filter by task label (assuming $filter contains the label value)
                                            $sql .= " AND task_label = ?";
                                        }
                                    }

                                    // Prepare the SQL statement
                                    $stmt = $pdo->prepare($sql);

                                    // Bind parameters for label filter if necessary
                                    if ($filter && !in_array($filter, ['important', 'today', 'archived'])) {
                                        $stmt->bindParam(1, $filter, PDO::PARAM_STR);
                                    }

                                    // Execute the statement
                                    $stmt->execute();

                                    // Fetch all results as associative array
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    // Limit the number of rows to print
                                    $max_rows = 10;
                                    $row_count = 0;

                                    // Output HTML for each task card
                                    if (count($result) > 0) {
                                        foreach ($result as $row) {
                                            if ($row_count >= $max_rows) {
                                                break; // Exit the loop if the maximum number of rows is reached
                                            }

                                            // Start card HTML
                                            echo '<div class="card task-card mx-2" style="margin-top: 10px;">';
                                            echo '<div class="card-body">';
                                            echo '<p class="card-title">' . htmlspecialchars($row["task_name"]) . '</p>';
                                            echo '<p class="card-text"><strong>Due Date:</strong> ' . htmlspecialchars($row["task_due"]) . '</p>';

                                            // Dropdown menu for actions (Edit, Archive, Delete)
                                            echo '<div class="dropdown">';
                                            echo '<i class="fas fa-ellipsis-h" style="color: rgba(0, 0, 0, 0.5); cursor: pointer;" id="dropdownMenuButton' . $row["id"] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>';
                                            echo '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton' . $row["id"] . '">';
                                            echo '<a class="dropdown-item" href="#" onclick="editTask(' . $row["id"] . ')">Edit</a>';
                                            echo '<a class="dropdown-item" href="#" onclick="archiveTask(' . $row["id"] . ')">Archive</a>';
                                            echo '<a class="dropdown-item" href="#" onclick="deleteTask(' . $row["id"] . ')">Delete</a>';
                                            echo '</div>';
                                            echo '</div>';

                                            // End card HTML
                                            echo '</div>';
                                            echo '</div>';

                                            $row_count++; // Increment the counter
                                        }
                                    } else {
                                        // Display message if no tasks are found
                                        echo "<p>No tasks found</p>";
                                    }

                                    // Close the statement cursor and PDO connection
                                    $stmt->closeCursor();
                                    $pdo = null;
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Modal for adding tasks -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="taskForm" method="POST" action="add_task.php">
                                        <div class="form-group">
                                            <label for="taskInput">Task:</label>
                                            <input type="text" id="taskInput" name="task_name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="dueDateInput">Due Date:</label>
                                            <input type="date" id="dueDateInput" name="task_due" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="prioritySelect">Priority:</label>
                                            <select id="prioritySelect" name="task_priority" class="form-control" required>
                                                <option value="low">Low</option>
                                                <option value="medium">Medium</option>
                                                <option value="high">High</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="labelSelect">Label:</label>
                                            <select id="labelSelect" name="task_label" class="form-control" required>
                                                <option value="work">Work</option>
                                                <option value="school">School</option>
                                                <option value="personal">Personal</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for editing tasks -->
                    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editTaskForm" method="POST" action="edit_task.php">
                                        <input type="hidden" id="editTaskId" name="task_id">
                                        <div class="form-group">
                                            <label for="editTaskInput">Task:</label>
                                            <input type="text" id="editTaskInput" name="task_name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDueDateInput">Due Date:</label>
                                            <input type="date" id="editDueDateInput" name="task_due" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editPrioritySelect">Priority:</label>
                                            <select id="editPrioritySelect" name="task_priority" class="form-control" required>
                                                <option value="low">Low</option>
                                                <option value="medium">Medium</option>
                                                <option value="high">High</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editLabelSelect">Label:</label>
                                            <select id="editLabelSelect" name="task_label" class="form-control" required>
                                                <option value="work">Work</option>
                                                <option value="school">School</option>
                                                <option value="personal">Personal</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function editTask(taskId) {
                    // Fetch task data and populate the edit form
                    $.ajax({
                        url: 'fetch_task.php',
                        type: 'GET',
                        data: {
                            id: taskId
                        },
                        success: function(data) {
                            const task = JSON.parse(data);
                            $('#editTaskId').val(task.id);
                            $('#editTaskInput').val(task.task_name);
                            $('#editDueDateInput').val(task.task_due);
                            $('#editPrioritySelect').val(task.task_priority);
                            $('#editLabelSelect').val(task.task_label);
                            $('#editModal').modal('show');
                        }
                    });
                }

                function deleteTask(taskId) {
                    if (confirm('Are you sure you want to delete this task?')) {
                        $.ajax({
                            url: 'delete_task.php',
                            type: 'POST',
                            data: {
                                id: taskId
                            },
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                }

                function archiveTask(taskId) {
                    if (confirm('Are you sure you want to archive this task?')) {
                        $.ajax({
                            url: 'archive_task.php',
                            type: 'POST',
                            data: {
                                id: taskId
                            },
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                }
            </script>


    </body>

</html>