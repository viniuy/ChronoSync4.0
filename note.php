<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Notes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cards {
            margin-bottom: 15px;
            position: relative;
        }
        .container {
            position: relative;
        }
        .add-note-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .delete-icon {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div id="stickyNotes">
                    <!-- Sticky notes will be appended here -->
                </div>
            </div>
        </div>
        <!-- Button positioned in upper right corner -->
        <button onclick="openColorAndTextModal()" class="btn btn-primary add-note-btn">Add Sticky Note</button>
    </div>

    <!-- Color and Text Modal -->
    <div class="modal fade" id="colorAndTextModal" tabindex="-1" role="dialog" aria-labelledby="colorAndTextModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="colorAndTextModalLabel">Add Sticky Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="noteText">Note Text:</label>
                        <input type="text" class="form-control" id="noteText" placeholder="Enter note text">
                    </div>
                    <div class="form-group">
                        <label for="noteColor">Note Color:</label>
                        <select class="form-control" id="noteColor">
                            <option value="bg-yellow">Yellow</option>
                            <option value="bg-primary">Blue</option>
                            <option value="bg-success">Green</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addStickyNote()">Add Note</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        var noteCount = 0;

        function openColorAndTextModal() {
            $('#colorAndTextModal').modal('show');
        }

        function addStickyNote() {
            if (noteCount < 3) {
                var stickyNotesDiv = document.getElementById('stickyNotes');

                // Get input values
                var noteText = document.getElementById('noteText').value;
                var noteColor = document.getElementById('noteColor').value;

                // Create new note element
                var newNote = document.createElement('div');
                newNote.className = 'card';

                // Set note content with selected color
                newNote.innerHTML = '<div class="cards-body ' + noteColor + '">' + noteText +
                                    '<span class="delete-icon" onclick="deleteNote(this.parentElement)">...</span></div>';
                stickyNotesDiv.appendChild(newNote);
                noteCount++;
                // Close modal after adding note
                $('#colorAndTextModal').modal('hide');
            } else {
                alert('You can only add up to 3 sticky notes.');
            }
        }

        function deleteNote(note) {
            if (confirm('Are you sure you want to delete this note?')) {
                note.remove();
                noteCount--;
            }
        }
    </script>
</body>
</html>
