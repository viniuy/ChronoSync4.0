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
					alert('Calendar shared successfully.');
					$('#shareCalendarModal').modal('hide');
				} else {
					alert('Error: ' + data.message);
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
		let calendarSelects = document.querySelectorAll('#calendar_select');
		calendarSelects.forEach(calendarSelect => {
			calendarSelect.innerHTML = ''; // Clear existing options

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
			});

			// Enable/disable the select element based on checked calendars
			calendarSelect.disabled = checkedCalendars.length === 0;
		});
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
					let calendarSelect = document.getElementById('calendar_select');
					calendarNamesContainer.innerHTML = ''; // Clear existing content
					calendarSelect.innerHTML = '<option value="">Select Calendar</option>'; // Clear existing options and add default option
					data.calendars.forEach(calendar => {
						// Populate the list group with checkboxes
						let calendarItem = document.createElement('div');
						calendarItem.classList.add('list-group-item', 'd-flex', 'align-items-center');

						let checkbox = document.createElement('input');
						checkbox.type = 'checkbox';
						checkbox.classList.add('mr-2');
						checkbox.value = calendar.calendar_id;
						checkbox.dataset.calendarName = calendar.calendar_name; // Use data attribute for calendar name

						calendarItem.appendChild(checkbox);
						calendarItem.appendChild(document.createTextNode(calendar.calendar_name));
						calendarNamesContainer.appendChild(calendarItem);
					});

					// Call populateCalendarDropdown() after updating checkboxes
					populateCalendarDropdown();
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
		var user_id = <?php echo json_encode($user_id); ?>; // Assuming user_id is defined in your PHP script

		// Get selected calendar names
		var selectedCalendars = [];
		document.querySelectorAll('#calendar_names input[type="checkbox"]:checked').forEach(function(checkbox) {
			selectedCalendars.push(checkbox.value);
		});

		// Populate the calendar dropdown with selected calendar names
		populateCalendarDropdown();

		$.ajax({
			url: './auth/calendar/display_event.php',
			type: 'POST',
			data: {
				user_id: user_id,
				selected_calendars: selectedCalendars.length > 0 ? selectedCalendars : null // Send null if no calendars are selected
			},
			dataType: 'json',
			success: function(response) {
				console.log('Response from server:', response);

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
								// Assuming the calendar name is provided in the response
								extendedProps: {
									calendar_name: item.calendar_name
								}
							});
						});
					}

					// Filter events based on selected calendars
					var filteredEvents = events.filter(function(event) {
						return selectedCalendars.includes(event.extendedProps.calendar_name);
					});

					// Initialize the calendar with filtered events
					initializeCalendar(filteredEvents);
				} else {
					alert(response.msg);
					// Initialize the calendar without events
					initializeCalendar([]);
				}
			},
			error: function(xhr, status) {
				alert('Error fetching events: ' + status);
				// Initialize the calendar without events
				initializeCalendar([]);
			}
		});
	}

	// Function to initialize the calendar
	function initializeCalendar(events) {
		// Destroy any existing calendar to avoid re-initialization issues
		var calendarEl = document.getElementById('calendar');
		if (calendarEl.fullCalendarInstance) {
			calendarEl.fullCalendarInstance.destroy();
		}

		// Initialize the calendar
		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: ['interaction', 'dayGrid'],
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,dayGridWeek,dayGridDay'
			},
			events: events,
			eventClick: function(info) {
				if (info.event.url) {
					window.open(info.event.url);
					info.jsEvent.preventDefault(); // Prevent browser from following the link
				}
			}
		});

		// Save the calendar instance to the element
		calendarEl.fullCalendarInstance = calendar;

		// Render the calendar
		calendar.render();
	}
</script>
