<?php
require_once 'auth/important/session.php';
if (!isset($_SESSION["user_email"])) {
	header("Location: login.php?Logged-in=?");
	exit();
}
$user_id = $_SESSION["user_id"];
?>


<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-o26qTkZlA7PASyqyf6hooTrkog5JbN0wZ2T+KD0Vc1W24rD0qzU0qzU+rRxyaPm+Dn8qhz7k6jB0N89Iu7uJrHwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		.calendar-container {
			display: flex;
		}

		.calendar {
			flex-grow: 1;
		}

		.icon-container {
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 10px;
		}

		.cursor-pointer {
			cursor: pointer;
		}
	</style>
	<!-- CSS for full calendar 
		-->
	<link href="./css/full_calendar.css" rel="stylesheet" />
	<!-- JS for jQuery -->

	<!-- bootstrap css and js -->
	<link rel="stylesheet" href="./css/bootstrap.css" />
	<script src="./js/ajax_fullcalendar.js"></script>
	<script src="./js/fullcalendar.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-o26qTkZlA7PASyqyf6hooTrkog5JbN0wZ2T+KD0Vc1W24rD0qzU0q+rRxyaPm+Dn8qhz7k6jB0N89Iu7uJrHwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<div class="container mt-3">
		<div class="row">
			<!-- Left column for the calendar -->

			<div class="col-lg-9">
				<div id="selected_calendar_container">
					<div id="calendar"></div>
				</div>
				<!-- List to display selected calendars -->
				<ul id="selected_calendar_list"></ul>
			</div>

			<!-- Right column for calendar names and buttons -->
			<div class="col-lg-3 ">
				<!-- <h5>Calendars</h5> -->
				<button class="btn btn-primary  mb-3" data-toggle="modal" data-target="#addCalendarModal">Add New Calendar</button>
<<<<<<< Updated upstream

				<div class="btn-group mb-3 btn-group-xss">
					<button class="btn btn-primary pl-3" data-toggle="modal" data-target="#shareCalendarModal" data-calendar-id="123">x</button>
					<button class="btn btn-primary " data-toggle="modal" data-target="#uploadCSVModal">s</button>
				</div>

				<div id="calendar_names" class="list-group">
					<!-- Calendar names will be populated here with checkboxes -->
				</div>
				<!-- Buttons -->
				<!-- <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addCalendarModal">Add New Calendar</button>
=======
				
                <div class="btn-group mb-3 btn-group-xss">
				<button class="btn btn-primary pl-3" data-toggle="modal" data-target="#shareCalendarModal" data-calendar-id="123">
				<i class="bi bi-send"></i>
				</button>
                <button class="btn btn-primary " data-toggle="modal" data-target="#uploadCSVModal">
				<i class="bi bi-filetype-csv"></i>
				</button>
                </div>
				
                <div id="calendar_names" class="list-group">
                    <!-- Calendar names will be populated here with checkboxes -->
                </div>
                <!-- Buttons -->
                <!-- <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addCalendarModal">Add New Calendar</button>
>>>>>>> Stashed changes
                <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#shareCalendarModal" data-calendar-id="123">Share Calendar</button>
                <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#uploadCSVModal">Batch Upload</button> -->
			</div>
		</div>
	</div>
	<!-- Event Detail Modal -->
	<div class="modal fade" id="event_detail_modals" tabindex="-1" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="event_detail_modals_title"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="
				$('#event_detail_modals').modal('hide');"></button>
				</div>
				<div class="modal-body">
					<p><strong>Start:</strong> <span id="event_detail_modals_start"></span></p>
					<p><strong>End:</strong> <span id="event_detail_modals_end"></span></p>
					<p><strong>Description:</strong> <span id="event_detail_modals_description"></span></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="
				$('#event_detail_modals').modal('hide');">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Add Calendar Modal -->
	<div class="modal fade" id="addCalendarModal" tabindex="-1" role="dialog" aria-labelledby="addCalendarModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addCalendarModalLabel">Add New Calendar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="calendar_name">Calendar Name</label>
						<input type="text" name="calendar_name" id="calendar_name" class="form-control" placeholder="Enter calendar name">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="addCalendar()">Add Calendar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Share Calendar Modal -->
	<div class="modal fade" id="shareCalendarModal" tabindex="-1" role="dialog" aria-labelledby="shareCalendarModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="shareCalendarModalLabel">Share Calendar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="shareCalendarForm">
						<input type="hidden" name="user_id" id="user_id" value="">
						<div class="form-group">
							<label for="calendar_select">Select Calendar:</label>
							<select name="calendar_id" id="calendar_select" class="form-control">
								<!-- Options will be populated dynamically -->
							</select>
						</div>
						<div class="form-group">
							<label for="share_with">Share with:</label>
							<select name="share_with" id="share_with" class="form-control">
								<option value="user">User</option>
								<option value="group">Group</option>
							</select>
						</div>
						<div class="form-group" id="user_id_group">
							<label for="user_id_input">User ID to Share With:</label>
							<input type="text" name="user_id_input" id="user_id_input" class="form-control">
						</div>
						<div class="form-group" id="group_group" style="display: none;">
							<label for="group">Group to Share With:</label>
							<select name="group" id="group" class="form-control">
								<!-- Populate options dynamically using JavaScript -->
							</select>
						</div>
						<div class="form-group">
							<label for="role">Role:</label>
							<select name="role" id="role" class="form-control">
								<option value="admin">Admin</option>
								<option value="viewer">Viewer</option>
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" id="submitShareCalendar" class="btn btn-primary">Share Calendar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- CSV Upload Modal -->
	<div class="modal fade" id="uploadCSVModal" tabindex="-1" role="dialog" aria-labelledby="uploadCSVModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="uploadCSVModalLabel">Upload CSV</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="uploadCSVForm" enctype="multipart/form-data">
						<div class="form-group">
							<label for="csv_file">Choose CSV File</label>
							<input type="file" name="csv_file" id="csv_file" accept=".csv" class="form-control">
						</div>
						<div class="form-group">
							<label for="calendar_select_upload">Select Calendar</label>
							<select name="calendar_id" id="calendar_select_upload" class="form-control">
								<!-- Calendar options will be populated dynamically -->
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="uploadCSV()">Upload CSV</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Start popup dialog box -->
	<div class="modal fade" id="event_entry_modaled" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel">Add New Event</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="img-container">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="event_name">Event name</label>
									<input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter your event name">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="event_start_date">Event start date</label>
									<input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="event_start_time">Event start time</label>
									<input type="time" name="event_start_time" id="event_start_time" class="form-control" placeholder="Event start time">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="event_end_date">Event end date</label>
									<input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="event_end_time">Event end time</label>
									<input type="time" name="event_end_time" id="event_end_time" class="form-control" placeholder="Event end time">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="calendar_select_options">Select Calendar</label>
									<select id="calendar_select_options" class="form-control">
										<!-- Calendar options will be populated here -->
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<!-- End popup dialog box -->


<script>
	$(document).ready(function() {
		fetchCalendarNames(<?php echo json_encode($user_id); ?>);
		fetchGroups();

		$('#submitShareCalendar').on('click', function() {
			shareCalendar();
		});

		$('#share_with').on('change', function() {
			if ($(this).val() === 'group') {
				$('#user_id_group').hide();
				$('#group_group').show();
			} else {
				$('#user_id_group').show();
				$('#group_group').hide();
			}
		});

		// Event listener for dynamically generated checkboxes
		$('#calendar_names').on('change', 'input[type="checkbox"]', function() {
			populateCalendarDropdown();
			display_events();
		});

		// Initially populate the dropdown and display events when the page loads
		populateCalendarDropdown();
		display_events();
	});

	function uploadCSV() {

		var user_id = <?php echo json_encode($user_id); ?>;
		const form = document.getElementById('uploadCSVForm');
		const formData = new FormData(form);

		const csvFile = document.getElementById('csv_file').files[0];
		const calendarId = document.getElementById('calendar_select_upload').value;
		formData.append('user_id', user_id);

		if (!csvFile) {
			Swal.fire({
				title: "Error!",
				text: "CSV file only!",
				icon: "error"
			});
			return;
		}

		if (!calendarId) {
			Swal.fire({
				title: "Error!",
				text: "Select a valid Calendar!",
				icon: "error"
			});
			return;
		}

		$.ajax({
			url: './auth/calendar/csv_upload.php',
			method: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				if (data.status) {
					Swal.fire({
						title: "Success!",
						text: 'Batch Upload Success!: ',
						icon: "success"
					});
					$('#uploadCSVModal').modal('hide');

					display_events(); // Reload events after saving
				} else {
					Swal.fire({
						title: "Error!",
						text: 'Error uploading CSV: ' + data.msg,
						icon: "error"
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.error('Error:', textStatus, errorThrown);
				Swal.fire({
					title: "Error!",
					text: 'Error uploading CSV: ' + data.msg,
					icon: "error"
				});
			}
		});
	}

	function shareCalendar() {
		var user_id = <?php echo json_encode($user_id); ?>;
		var formData = new FormData(document.getElementById('shareCalendarForm'));
		formData.append('user_id', user_id);

		$.ajax({
			url: './auth/calendar/share.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				var data = JSON.parse(response);
				if (data.status) {
					Swal.fire({
						title: "Sharing Done!",
						text: "Calendar Shared Successfully!",
						icon: "success"
					});
					$('#shareCalendarModal').modal('hide');
				} else {
					Swal.fire({
						title: "Error!",
						text: 'Error sharing calendar: ' + data.message,
						icon: "error"
					});
				}
			},
			error: function(xhr, status, error) {
				console.error('Error sharing calendar:', error);
			}
		});
	}

	function fetchGroups() {
		$.ajax({
			url: './auth/calendar/groups.php',
			type: 'GET',
			success: function(response) {
				var data = JSON.parse(response);
				if (data.status) {
					let groupSelect = document.getElementById('group');
					groupSelect.innerHTML = '<option value="">Select Group</option>';
					data.groups.forEach(group => {
						let option = document.createElement('option');
						option.value = group.group_name;
						option.textContent = group.group_name;
						groupSelect.appendChild(option);
					});
				} else {
					console.error('Error fetching groups:', data.msg);
				}
			},
			error: function(xhr, status, error) {
				console.error('Error fetching groups:', error);
			}
		});
	}

	// Function to populate the calendar dropdown based on checked checkboxes
	function populateCalendarDropdown() {
		let calendarSelect = document.getElementById('calendar_select_options');
		let calendarSelectShare = document.getElementById('calendar_select');
		let calendarUpload = document.getElementById('calendar_select_upload');
		calendarSelect.innerHTML = ''; // Clear existing options
		calendarSelectShare.innerHTML = ''; // Clear existing
		calendarUpload.innerHTML = ''; // Clear existing

		// Get all checked checkboxes
		let checkedCalendars = document.querySelectorAll('#calendar_names input[type="checkbox"]:checked');

		// Iterate over each checked checkbox
		checkedCalendars.forEach(calendar => {
			let calendarId = calendar.value;
			let calendarName = calendar.dataset.calendarName; // Use data attribute for calendar name

			// Create option element
			let option = document.createElement('option');
			option.value = calendarId;
			option.textContent = calendarName;
			calendarSelect.appendChild(option);

			let shareOption = document.createElement('option');
			shareOption.value = calendarId;
			shareOption.textContent = calendarName;
			calendarSelectShare.appendChild(shareOption);

			let uploadOption = document.createElement('option');
			uploadOption.value = calendarId;
			uploadOption.textContent = calendarName;
			calendarUpload.appendChild(uploadOption);
		});

		// Enable/disable the select element based on checked calendars
		calendarSelect.disabled = checkedCalendars.length === 0;
		calendarSelectShare.disable = checkedCalendars.length === 0;
		calendarUpload.disable = checkedCalendars.length === 0;
	}

	function handleShareWithSelection() {
		const shareWithSelect = document.getElementById('share_with');
		const userIdGroup = document.getElementById('user_id_group');
		const groupGroup = document.getElementById('group_group');

		// Add event listener to the share_with select element
		shareWithSelect.addEventListener('change', function() {
			const selectedOption = shareWithSelect.value;

			// Hide/show form fields based on selection
			if (selectedOption === 'user') {
				userIdGroup.style.display = 'block';
				groupGroup.style.display = 'none';
			} else if (selectedOption === 'group') {
				userIdGroup.style.display = 'none';
				groupGroup.style.display = 'block';
			}
		});
	}

	// Call the function to handle selection on page load
	handleShareWithSelection();
	// Fetch calendar names and populate checkboxes and dropdown select
	function fetchCalendarNames(user_id) {
		fetch('./auth/calendar/calendars.php', {
				method: 'POST', // Use POST method to send user_id
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					user_id: user_id,
				}),
			})
			.then(response => response.json())
			.then(data => {
				if (data.status) {
					let calendarNamesContainer = document.getElementById('calendar_names');
					let calendarSelect = document.getElementById('calendar_select_options');
					calendarNamesContainer.innerHTML = ''; // Clear existing content
					calendarSelect.innerHTML = '<option value="">Select Calendar</option>'; // Clear existing options and add default option

					let sharedCalendars = data.calendars.filter(calendar => calendar.is_shared);
					let personalCalendars = data.calendars.filter(calendar => !calendar.is_shared);

					// Function to create calendar items
					function createCalendarItem(calendar) {
						let calendarItem = document.createElement('div');
						calendarItem.classList.add('list-group-item', 'd-flex', 'align-items-center', 'justify-content-between');

						let checkboxContainer = document.createElement('div');
						checkboxContainer.classList.add('d-flex', 'align-items-center');

						let checkbox = document.createElement('input');
						checkbox.type = 'checkbox';
						checkbox.classList.add('mr-2');
						checkbox.value = calendar.calendar_id;
						checkbox.dataset.calendarName = calendar.calendar_name;

						checkboxContainer.appendChild(checkbox);
						checkboxContainer.appendChild(document.createTextNode(calendar.calendar_name));
						calendarItem.appendChild(checkboxContainer);

						// Create "..." button with dropdown menu
						let dropdownContainer = document.createElement('div');
						dropdownContainer.classList.add('dropdown');

						let dropdownButton = document.createElement('button');
						dropdownButton.classList.add('btn', 'btn-link', 'btn-sm', 'dropdown-toggle');
						dropdownButton.type = 'button';
						dropdownButton.id = `dropdownMenuButton${calendar.calendar_id}`;
						dropdownButton.setAttribute('data-toggle', 'dropdown');
						dropdownButton.setAttribute('aria-haspopup', 'true');
						dropdownButton.setAttribute('aria-expanded', 'false');
						// icon for 3 dots
						dropdownButton.textContent = '';


						let dropdownMenu = document.createElement('div');
						dropdownMenu.classList.add('dropdown-menu');
						dropdownMenu.setAttribute('aria-labelledby', `dropdownMenuButton${calendar.calendar_id}`);

						// Edit option
						let editOption = document.createElement('a');
						editOption.classList.add('dropdown-item');
						editOption.href = '#';
						editOption.textContent = 'Edit';
						dropdownMenu.appendChild(editOption);

						// Delete option
						let deleteOption = document.createElement('a');
						deleteOption.classList.add('dropdown-item');
						deleteOption.href = '#';
						deleteOption.textContent = 'Delete';
						dropdownMenu.appendChild(deleteOption);

						// Share option
						if (calendar.can_share) { // Assuming `can_share` is a boolean indicating permission to share
							let shareOption = document.createElement('a');
							shareOption.classList.add('dropdown-item');
							shareOption.href = '#';
							shareOption.textContent = 'Share';
							dropdownMenu.appendChild(shareOption);
						}

						dropdownContainer.appendChild(dropdownButton);
						dropdownContainer.appendChild(dropdownMenu);

						calendarItem.appendChild(dropdownContainer);
						calendarNamesContainer.appendChild(calendarItem);

						// Add to calendar select dropdown
						let option = document.createElement('option');
						option.value = calendar.calendar_id;
						option.text = calendar.calendar_name;
						calendarSelect.appendChild(option);
					}

					// Populate shared calendars
					if (sharedCalendars.length > 0) {
						let sharedHeader = document.createElement('div');
						sharedHeader.classList.add('list-group-item', 'active');
						sharedHeader.innerText = 'Shared Calendars';
						calendarNamesContainer.appendChild(sharedHeader);

						sharedCalendars.forEach(createCalendarItem);
					}

					// Populate personal calendars
					if (personalCalendars.length > 0) {
						let personalHeader = document.createElement('div');
						personalHeader.classList.add('list-group-item', 'active');
						personalHeader.innerText = 'Personal Calendars';
						calendarNamesContainer.appendChild(personalHeader);

						personalCalendars.forEach(createCalendarItem);
					}
				} else {
					console.error('Error fetching calendar names:', data.msg);
				}
			})
			.catch(error => console.error('Error fetching calendar names:', error));
	}




	// Function to filter events based on selected calendar names
	function selectCalendar() {
		let selectedCalendarList = document.getElementById('selected_calendar_list');
		if (!selectedCalendarList) {
			console.error('Selected calendar list container not found');
			return;
		}

		selectedCalendarList.innerHTML = ''; // Clear existing selected calendars
		let checkboxes = document.querySelectorAll('#calendar_names input[type="checkbox"]');

		// After selecting calendars, display events
		display_events();
	}

	function display_events() {
		var events = [];

		// Get selected calendar IDs
		var selectedCalendars = [];
		document.querySelectorAll('#calendar_names input[type="checkbox"]:checked').forEach(function(checkbox) {
			selectedCalendars.push(checkbox.value); // Assuming value contains calendar_id
		});

		// Populate the calendar dropdown with selected calendar names
		populateCalendarDropdown();

		if (selectedCalendars.length > 0) {
			$.ajax({
				url: './auth/calendar/display_event.php',
				type: 'POST',
				data: {
					calendar_id: selectedCalendars // Pass selected calendar IDs
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						var result = response.data;
						if (Array.isArray(result)) {
							result.forEach(function(item) {
								events.push({
									id: item.event_id,
									title: item.title,
									start: item.start,
									end: item.end,
									backgroundColor: item.color,
									url: item.url,
									extendedProps: {
										calendar_name: item.calendar_name
									}
								});
							});
						}

						console.log('Selected calendars:', selectedCalendars);
						console.log('Events:', events);

						// Initialize the calendar with fetched events
						initializeCalendar(events);
					} else {
						// Initialize the calendar without events
						initializeCalendar([]);
					}
				},
				error: function(xhr, status) {
					// Initialize the calendar without events
					initializeCalendar([]);
				}
			});
		} else {
			// No calendars selected, clear the calendar display
			initializeCalendar([]);
		}
	}

	function initializeCalendar(events) {
		// Destroy any existing calendar to avoid re-initialization issues
		var calendarEl = document.getElementById('calendar');
		if (calendarEl.fullCalendarInstance) {
			calendarEl.fullCalendarInstance.destroy();
		}

		// Initialize the calendar with events
		var calendar = new FullCalendar.Calendar(calendarEl, {
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			initialView: 'dayGridMonth',
			timeZone: 'local',
			editable: true,
			selectable: true,
			events: events,
			select: function(info) {
				var isAllDay = info.allDay;
				document.getElementById('event_start_date').value = info.startStr.split('T')[0];
				document.getElementById('event_start_time').value = isAllDay ? '' : info.startStr.split('T')[1]?.substring(0, 5);
				document.getElementById('event_end_date').value = info.endStr ? info.endStr.split('T')[0] : '';
				document.getElementById('event_end_time').value = info.endStr && !isAllDay ? info.endStr.split('T')[1]?.substring(0, 5) : '';
				$('#event_entry_modaled').modal('show');
			},
			eventClick: function(info) {
				$('#event_detail_modals_title').text(info.event.title);
				$('#event_detail_modals_start').text(info.event.startStr);
				$('#event_detail_modals_end').text(info.event.endStr || 'No end time');
				$('#event_detail_modals_description').text(info.event.extendedProps.description || 'No description');

				$('#event_detail_modals').modal('show');
			},
			eventDrop: function(info) {
				handleEventEdit(info.event);
			},
			eventResize: function(info) {
				handleEventEdit(info.event);
			},
			viewWillUnmount: function(view) {
				if (view.type === 'dayGridMonth') {
					document.getElementById('event_start_time').disabled = true;
					document.getElementById('event_end_time').disabled = true;
				} else {
					document.getElementById('event_start_time').disabled = false;
					document.getElementById('event_end_time').disabled = false;
				}
			}
		});

		calendar.render();
		calendarEl.fullCalendarInstance = calendar;
	}


	function addCalendar() {
		let calendarName = document.getElementById('calendar_name').value;
		var userId = <?php echo json_encode($user_id); ?>;
		if (calendarName && userId) {
			fetch('./auth/calendar/add_calendar.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						calendar_name: calendarName,
						user_id: userId
					})
				})
				.then(response => response.json())
				.then(data => {
					if (data.status) {
						// Close the modal
						$('#addCalendarModal').modal('hide');
						// Clear input fields
						document.getElementById('calendar_name').value = '';
						// Refresh the calendar names list
						fetchCalendarNames(userId); // Fetch calendar names after adding
					} else {
						Swal.fire({
							title: "Error adding calendar",
							text: "Calendar Already Exists",
							icon: "error"
						});

						$('#addCalendarModal').modal('hide');
					}
				})
				.catch(error => console.error('Error adding calendar:', error));
		} else {
			Swal.fire({
				title: "Missing Fields",
				text: "Please fill in all fields",
				icon: "error"
			});
		}
	}

	function handleEventEdit(event) {

		// Convert start and end dates to the local timezone
		var start = event.start;
		var end = event.end;

		// Format start and end dates in local timezone (YYYY-MM-DD HH:mm)
		var localStart = formatDate(start);
		var localEnd = end ? formatDate(end) : null;

		console.log('Local Start:', localStart);
		console.log('Local End:', localEnd);

		// Example: AJAX call to update event in the backend
		$.ajax({
			url: '../auth/calendar/update_event.php',
			method: 'POST',
			data: {
				event_id: event.id,
				event_name: event.title,
				start_datetime: localStart, // Send datetime in YYYY-MM-DD HH:mm format
				end_datetime: localEnd // Same format as start
			},
			success: function(response) {
				console.log('Event updated successfully');
			},
			error: function(xhr, status, error) {
				console.error('Error updating event:', error);
			}
		});
	}

	// Function to format date as YYYY-MM-DD HH:mm
	function formatDate(date) {
		var year = date.getFullYear();
		var month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are zero indexed
		var day = ('0' + date.getDate()).slice(-2);
		var hours = ('0' + date.getHours()).slice(-2);
		var minutes = ('0' + date.getMinutes()).slice(-2);
		return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes;
	}


	function save_event() {
		var user_id = <?php echo json_encode($user_id); ?>;
		var event_name = $("#event_name").val();
		var event_start_date = $("#event_start_date").val();
		var event_start_time = $("#event_start_time").val();
		var event_end_date = $("#event_end_date").val();
		var event_end_time = $("#event_end_time").val();
		var calendar_id = $("#calendar_select_options").val();

		// Check for required fields
		if (event_name === "" || event_start_date === "" || event_end_date === "" || calendar_id === "") {
			$('#event_entry_modaled').modal('hide');
			Swal.fire({
				title: "Missing Fields",
				text: "Please make sure of your details",
				icon: "error"
			});
			return false;

		}

		// Combine date and time for start and end if time is provided
		var event_start = event_start_date + (event_start_time ? " " + event_start_time + ":00" : '');
		var event_end = event_end_date + (event_end_time ? " " + event_end_time + ":00" : '');

		// AJAX request to check user role before saving the event
		$.ajax({
			url: "../auth/calendar/save_event.php",
			type: "POST",
			dataType: 'json',
			data: {
				event_name: event_name,
				event_start_date: event_start,
				event_end_date: event_end,
				calendar_id: calendar_id,
				user_id: user_id,
				check_role: true // Add this parameter to check user role
			},
			success: function(response) {
				console.log("Save event response: ", response);
				$('#event_entry_modaled').modal('hide');
				if (response.status) {
					Swal.fire({
						title: "Event Added!",
						text: "Event Added Successfully!",
						icon: "success"
					});
					display_events(); // Reload events after saving
				} else {
					Swal.fire({
						title: "Event Error",
						text: response.msg || "There was an error saving your event!",
						icon: "error"
					});
				}
			},
			error: function(xhr, status) {
				console.log('ajax error = ' + xhr.statusText);
				Swal.fire({
					title: "Event Not Added!",
					text: "Error adding event",
					icon: "error"
				});
			}
		});

		return false;
	}
</script>


</html>