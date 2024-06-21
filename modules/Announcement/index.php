<?php
include 'config.php';

// Initialize $rows as an empty array
$rows = [];

// Fetch all rows from the database where archived is FALSE
$result = $conn->query("SELECT * FROM announcements WHERE archived = 0");

// Check if $result is valid and contains rows
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row; // Store each row in the $rows array
    }
    $result->close(); // Close the result set
} else {
    // Handle case where no announcements are found or $result is not valid
    echo "";
}

// Handle form submission for adding new announcement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $url = $_POST['url'];

    // File upload handling
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageError = $image['error'];

    // Validate and sanitize inputs
    $title = htmlspecialchars(strip_tags(trim($title)), ENT_QUOTES);
    $content = htmlspecialchars(strip_tags(trim($content)), ENT_QUOTES);
    $url = htmlspecialchars(strip_tags(trim($url)), ENT_QUOTES);

    // Check if file upload is successful
    if ($imageError === 0) {
        $imagePath = 'images/' . $imageName; // Path to store the uploaded image
        move_uploaded_file($imageTmpName, $imagePath); // Move the uploaded file to the images folder
    } else {
        echo "Error uploading image.";
        exit();
    }

    // Insert announcement into database
    $insertQuery = "INSERT INTO announcements (title, content, image, url, archived) 
                    VALUES ('$title', '$content', '$imageName', '$url', FALSE)";
    
    if ($conn->query($insertQuery) === TRUE) {
        // Success message or redirect to avoid resubmission
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .custom-context-menu {
            display: none;
            position: absolute;
            z-index: 1000;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.5);
        }
        .custom-context-menu a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: black;
        }
        .custom-context-menu a:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    

    <!-- Add Announcement Button -->
    <!-- <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
        Add Announcement
    </button> -->

    <!-- Modal for Adding Announcement -->
    <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="addAnnouncementForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnnouncementModalLabel">Add New Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">URL (Optional)</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Announcement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
    <!-- Display Existing Announcements -->
    <div class="row">
    <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
            <div class="col-6 col-md-4 mb-4">
                <div class="card">
                    <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        <!-- <p class="card-text"><?php echo $row['content']; ?></p> -->
                        <?php if (!empty($row['url'])): ?>
                            <a href="<?php echo $row['url']; ?>" class="btn btn-primary">Read more</a>
                        <?php else: ?>
                            <a href="templates/read.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read more</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No announcements found.</p>
    <?php endif; ?>
</div>


</div>

<!-- Bootstrap JS and custom script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlZJGYBZHoBMLjILlpTYU7x1hdQz5iZ7R6R7uLg0GAiOXq8rRs7H4ck/u8K" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGxrYjK0gYlZO6Vib9LO7AO9oLA5CxH9sP3Z1z6jS8eD8Q5D5Fv5jGtt7g" crossorigin="anonymous"></script>
<script src="app.js" charset="utf-8"></script>
<script>
    // Function to show add announcement modal
    function showAddAnnouncementModal() {
        $('#addAnnouncementModal').modal('show');
    }

    // Submit form using AJAX (optional, for better user experience)
    $('#addAnnouncementForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Serialize form data
        var formData = new FormData(this);

        // AJAX request to handle form submission
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response (if any)
                $('#addAnnouncementModal').modal('hide'); // Hide the modal after successful submission
                // Optionally, reload or update the announcements section
                location.reload(); // Reload the page to show new announcements
            },
            error: function(xhr, status, error) {
                // Handle error response (if any)
                console.error(xhr.responseText); // Log error message
                // Optionally, display an error message to the user
                alert('Error adding announcement. Please try again.');
            }
        });
    });
</script>

</body>
</html>
