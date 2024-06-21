<div class="dlabnav">
	<div class="dlabnav-scroll">
		<ul class="metismenu" id="menu">
			<li><a href="index.php" aria-expanded="false">
					<i class="bi bi-house"></i>
					<span class="nav-text">Dashboard</span>
				</a>
			</li>

			<li><a href="calendar.php" aria-expanded="false">
					<i class="bi bi-calendar-check"></i>

					<span class="nav-text">Calendar</a></span>

			</li>

			<li><a href="Anouncement.php" aria-expanded="false">
					<i class="bi bi-chat"></i>

					<span class="nav-text">Announcement</a></span>

			</li>



			<li><a href="todolist.php" aria-expanded="false">
					<i class="bi bi-check2-square"></i>
					<span class="nav-text">Todo list</a></span>

			</li>

			<li><a href="myfile.php" aria-expanded="false">
					<i class="bi bi-file-earmark"></i>
					<span class="nav-text">MyFile</span>
				</a>
			</li>

			<li><a href="resources.php" aria-expanded="false">
					<i class="bi bi-folder-symlink"></i>
					<span class="nav-text">Resources</span>
				</a>
			</li>
			<div class="col-xl-12 col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <div>
                <h4 class="fs-20 font-w700">Notes</h4>
            </div>
            <div>
                <button class="btn btn-primary btn-rounded" id="add-sticky-note"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body px-0" id="message-container">
            <!-- Existing message cards go here -->
        </div>
    </div>
</div>

<!-- Sticky Note Modal -->
<div class="modal fade" id="stickyNoteModal" tabindex="-1" role="dialog" aria-labelledby="stickyNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stickyNoteModalLabel">Add Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="stickyNoteTextarea" class="form-control" rows="3" placeholder="Enter your sticky note here"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveStickyNote">Save Note</button>
            </div>
        </div>
    </div>
</div>
										
										
										<!-- Sticky Note Modal -->
										<div class="modal fade" id="stickyNoteModal" tabindex="-1" role="dialog" aria-labelledby="stickyNoteModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="stickyNoteModalLabel">Add Note</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<textarea id="stickyNoteTextarea" class="form-control" rows="3" placeholder="Enter your sticky note here"></textarea>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary" id="saveStickyNote">Save Note</button>
													</div>
												</div>
											</div>
										</div>
										
										<script>
										document.addEventListener("DOMContentLoaded", function() {
    // Handle "Add Sticky Note" button click to show modal
    document.getElementById("add-sticky-note").addEventListener("click", function() {
        $('#stickyNoteModal').modal('show');
    });

    // Handle "Save Note" button click to add note to message container
    document.getElementById("saveStickyNote").addEventListener("click", function() {
        const noteText = document.getElementById("stickyNoteTextarea").value;
        if (noteText.trim() !== "") {
            const parsedNoteText = parseURLs(noteText); // Parse URLs in the note text
            const messageContainer = document.getElementById("message-container");
            const noteHTML = `
			
                <div class="msg-bx d-flex justify-content-between align-items-center">

					

                    <div class="msg d-flex align-items-center w-100">
						 
                    </div>

					
                        <div class="sticky-note">
							<div class="dropdownn justify-content-end">
                        <div class="btn-link" data-bs-toggle="dropdown">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="2" fill="#A5A5A5"/>
                                <circle cx="19" cy="12" r="2" fill="#A5A5A5"/>
                                <circle cx="5" cy="12" r="2" fill="#A5A5A5"/>
                            </svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item delete-note" href="javascript:void(0)">Delete</a>
                            <a class="dropdown-item edit-note" href="javascript:void(0)">Edit</a>
                        </div>

                        </div>
                            ${parsedNoteText}
							
							
							
                    </div>
                   
                </div>`;
            messageContainer.insertAdjacentHTML("beforeend", noteHTML);
            $('#stickyNoteModal').modal('hide');
            document.getElementById("stickyNoteTextarea").value = ""; // Clear textarea after saving
        } else {
            alert("Please enter a note text!");
        }
    });

    // Function to parse URLs and convert them into clickable links
    function parseURLs(text) {
        const urlRegex = /(https?:\/\/[^\s]+)/g;
        return text.replace(urlRegex, function(url) {
            return `<a href="${url}" target="_blank">${url}</a>`;
        });
    }

    // Handle delete note button click
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("delete-note")) {
            event.target.closest(".msg-bx").remove();
        }
    });

    // Handle edit note button click
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("edit-note")) {
            const noteContainer = event.target.closest(".msg-bx").querySelector(".sticky-note");
            const noteText = noteContainer.innerText.trim(); // Get text content
            const newText = prompt("Edit Note:", noteText);
            if (newText !== null) {
                noteContainer.innerHTML = parseURLs(newText); // Update note content
            }
        }
    });
});

										</script>

		</ul>
	</div>
</div>