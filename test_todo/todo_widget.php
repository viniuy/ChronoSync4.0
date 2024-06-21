<?php
require_once '../auth/important/session.php';
require_once 'db_connect.php'; // Include your database connection file

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php?Logged-in=?");
    exit();
}
$user_id = $_SESSION["user_id"];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note_text = $_POST['note_text'];
    $note_color = $_POST['note_color'];
    
    // Upload image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["note_image"]["name"]);
    move_uploaded_file($_FILES["note_image"]["tmp_name"], $target_file);
    $note_image = $target_file;

    // Insert note into database
    $sql = "INSERT INTO sticky_notes (user_id, note_text, note_color, note_image) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $note_text, $note_color, $note_image]);
}

// Fetch user's notes
$sql = "SELECT * FROM sticky_notes WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Notes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Sticky Notes</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <textarea class="form-control" name="note_text" rows="3" placeholder="Enter your note"></textarea>
            </div>
            <div class="form-group">
                <label>Note Color:</label>
                <select class="form-control" name="note_color">
                    <option value="yellow">Yellow</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="pink">Pink</option>
                </select>
            </div>
            <div class="form-group">
                <label>Upload Image:</label>
                <input type="file" class="form-control-file" name="note_image">
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
        
        <div class="row mt-4">
            <?php foreach ($notes as $note): ?>
            <div class="col-md-3 mb-3">
                <div class="card" style="background-color: <?php echo $note['note_color']; ?>;">
                    <div class="card-body">
                        <?php if ($note['note_image']): ?>
                            <img src="<?php echo $note['note_image']; ?>" class="img-fluid mb-2" alt="Note Image">
                        <?php endif; ?>
                        <p class="card-text"><?php echo $note['note_text']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
