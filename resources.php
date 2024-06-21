<?php
require_once 'auth/important/session.php';
if (!isset($_SESSION["user_email"])) {
	header("Location: login.php?Logged-in=?");
	exit();
}
$user_id = $_SESSION["user_id"];
require_once 'global/head.php'
?>

<body>

	<!--**********************************
	Main wrapper start
***********************************-->
	<div id="main-wrapper">
		<?php
		require_once 'global/nav_header.php';
		require_once 'global/chatbox.php';
		require_once 'global/header.php';
		require_once 'global/sidebar.php';
		?>
		<!--**********************************
            Content body start
        ***********************************-->

		<div class="content-body">
			<!-- row -->

			<!-- CALENDAR -->
			<!-- <div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<div id="calendar" class="fullcalendar"></div>
					</div>
				</div>
			</div> -->


			<style>
				.container {
					position: relative;
				}

				.circle {
					width: 200px;
					height: 130px;
					background-color: #89c7f2;
					color: #fff;
					text-align: center;
					line-height: 140px;
					cursor: pointer;
					margin: 10px;
					border-radius: 5%;
					display: flex;
					justify-content: center;
					align-items: center;
					word-wrap: break-word;
					/* Ensure long words are wrapped */
					overflow: hidden;
					/* Ensure content doesn't overflow */
				}




				.row {
					display: flex;
					flex-wrap: wrap;
				}

				.context-menu {
					position: absolute;
					display: none;
					background-color: #f8f9fa;
					border: 1px solid #ced4da;
					border-radius: 4px;
					padding: 5px 0;
					z-index: 1;
				}

				.context-menu-item {
					padding: 8px 15px;
					cursor: pointer;
				}

				.context-menu-item:hover {
					background-color: #e9ecef;
				}

				.bookmark-card {
					width: 200px;
					height: 130px;
					background-color: #89c7f2;
					color: #fff;
					text-align: center;
					cursor: pointer;
					margin: 10px;
					border-radius: 8px;
					display: flex;
					justify-content: center;
					align-items: center;
					word-wrap: break-word;
					/* Ensure long words are wrapped */
					overflow: hidden;
					/* Ensure content doesn't overflow */
				}

				.bookmark-title {
					font-size: 18px;
					line-height: 1.2;
					/* Adjust line height to fit text better */
					white-space: pre-line;
					/* Preserve line breaks */
					padding: 5px;
					/* Add padding for better spacing */
					box-sizing: border-box;
					/* Ensure padding is included in the total height/width */
					max-height: 100%;
					/* Ensure the text does not overflow */
				}
			</style>
			</head>

			<body>




				<div class="container mt-5">
					<div class="row" id="bookmarkContainer">
						<!-- Add circular icons dynamically here -->
					</div>
				</div>

				<div class="context-menu" id="contextMenu">
					<div class="context-menu-item" id="editOption">Edit</div>
					<div class="context-menu-item" id="deleteOption">Delete</div>
				</div>

				<script>
					function nameLong(title) {
						if (title.length > 15) {
							let cutIndex = title.lastIndexOf(' ', 15);
							if (cutIndex === -1) {
								cutIndex = 15;
							}
							title = title.slice(0, cutIndex) + '\n' + title.slice(cutIndex + 1);
							console.log(title);
						}
						return title;
					}
					document.addEventListener("DOMContentLoaded", function() {
						var user_id = <?php echo json_encode($user_id); ?>;
						var bookmarkContainer = document.getElementById('bookmarkContainer');

						function renderBookmarks(bookmarks) {
							if (!bookmarkContainer) {
								console.error("Bookmark container not found.");
								return;
							}

							bookmarkContainer.innerHTML = '';
							bookmarks.forEach(function(bookmark, index) {
								bookmark.title = nameLong(bookmark.title);
								var icon = createCircleIcon(bookmark, index);
								bookmarkContainer.appendChild(icon);
							});
							var addIcon = createAddIcon(user_id);
							bookmarkContainer.appendChild(addIcon);
						}

						var bookmarks = []; // Initialize bookmarks array

						var xhr = new XMLHttpRequest();
						xhr.onreadystatechange = function() {
							if (xhr.readyState === XMLHttpRequest.DONE) {
								if (xhr.status === 200) {
									var responseData = JSON.parse(xhr.responseText); // Parse JSON response
									bookmarks = responseData; // Assign parsed data to bookmarks array
									renderBookmarks(bookmarks); // Call the function to render bookmarks
								} else {
									console.error('Failed to fetch bookmarks data. Status code: ' + xhr.status);
								}
							}
						};
						xhr.open('GET', 'auth/resources/resource_get.php', true);
						xhr.send();



						function createCircleIcon(bookmark, index) {
							var icon = document.createElement('div');
							icon.classList.add('circle');
							icon.innerHTML = '<div class="bookmark-title">' + bookmark.title + '</div>';
							icon.addEventListener('click', function() {
								window.open(bookmark.url, '_blank');
							});
							icon.addEventListener('contextmenu', function(event) {
								event.preventDefault();
								var contextMenu = document.getElementById('contextMenu');
								contextMenu.style.display = 'block';
								contextMenu.style.left = event.clientX + 'px';
								contextMenu.style.top = event.clientY + 'px';

								// Update context menu with current bookmark index
								editOption.dataset.index = index;
								deleteOption.dataset.index = index;
								console.log('Context menu shown for index:', index);
							});
							return icon;
						}



						function createAddIcon(user_id) {
							var addIcon = document.createElement('div');
							addIcon.classList.add('circle');
							addIcon.innerHTML = '<i class="fas fa-plus"></i>';
							addIcon.addEventListener('click', function() {
								Swal.fire({
									title: "Enter Title",
									input: "text",
									inputAttributes: {
										autocapitalize: "off"
									},
									showCancelButton: true,
									confirmButtonText: "Add",
									showLoaderOnConfirm: true,
								}).then((result) => {
									if (result.isConfirmed) {
										var newTitle = result.value;
										Swal.fire({
											title: "Enter URL",
											input: "text",
											inputAttributes: {
												autocapitalize: "off"
											},
											showCancelButton: true,
											confirmButtonText: "Add",
											showLoaderOnConfirm: true,
										}).then((result) => {
											if (result.isConfirmed) {
												var newUrl = result.value;
												if (newTitle && newUrl) {
													var newBookmark = {
														title: newTitle,
														url: newUrl,
														user_id: user_id
													};
													console.log(newBookmark);

													fetch('/auth/resources/resource.php', {
															method: 'POST',
															headers: {
																'Content-Type': 'application/json'
															},
															body: JSON.stringify(newBookmark)
														})
														.then(response => response.json())
														.then(data => {
															if (data.status === 'success') {
																const Toast = Swal.mixin({
																	toast: true,
																	position: "top-end",
																	showConfirmButton: false,
																	timer: 3000,
																	timerProgressBar: true,
																	didOpen: (toast) => {
																		toast.onmouseenter = Swal.stopTimer;
																		toast.onmouseleave = Swal.resumeTimer;
																	}
																});
																Toast.fire({
																	icon: "success",
																	title: "Added Successfully"
																});
																bookmarks.push(newBookmark);
																renderBookmarks(bookmarks);
															} else {
																Swal.fire({
																	icon: 'error',
																	title: 'Oops...',
																	text: 'Something went wrong!'
																});
															}
														})
														.catch((error) => {
															Swal.fire({
																icon: 'error',
																title: 'Oops...',
																text: 'Network error!'
															});
															console.error('Error:', error);
														});
												}
											}
										});
									}
								});
							});
							return addIcon;
						}

						function deleteBookmark(index) {
							bookmarks.splice(index, 1);
							renderBookmarks(bookmarks);
						}

						function editListener(oldData, newData) {
							fetch('/auth/resources/resource.php', {
									method: 'POST',
									headers: {
										'Content-Type': 'application/json'
									},
									body: JSON.stringify({
										oldData: oldData,
										newData: newData
									})
								})
								.then(response => {
									if (!response.ok) {
										throw new Error('Network response was not ok');
									}
									return response.json();
								})
								.then(data => {
									console.log(data); // Handle response from the server
								})
								.catch(error => {
									console.error('There was a problem with the fetch operation:', error);
								});
						}

						function getOldData(index, user_id) {
							if (index >= 0 && index < bookmarks.length) {
								var title = bookmarks[index].title;
								var url = bookmarks[index].url;
								return {
									title: title,
									url: url,
									user_id: user_id
								};
							} else {
								console.error('Invalid index');
								return null;
							}
						}
						// Edit and Delete event listeners outside the context menu event to prevent stacking
						document.getElementById('editOption').addEventListener('click', function() {
							var index = parseInt(this.dataset.index);
							var oldData = getOldData(index, user_id);
							console.log(oldData);
							if (!isNaN(index)) {
								Swal.fire({
									title: "Enter Title",
									input: "text",
									inputAttributes: {
										autocapitalize: "off"
									},
									showCancelButton: true,
									confirmButtonText: "Add",
									showLoaderOnConfirm: true,
								}).then((result) => {
									if (result.isConfirmed) {
										var newTitle = result.value;
										Swal.fire({
											title: "Enter URL",
											input: "text",
											inputAttributes: {
												autocapitalize: "off"
											},
											showCancelButton: true,
											confirmButtonText: "Add",
											showLoaderOnConfirm: true,
										}).then((result) => {
											if (result.isConfirmed) {
												var newUrl = result.value;
												if (newTitle && newUrl) {
													var newData = {
														title: newTitle,
														url: newUrl,
														user_id: user_id
													};

													fetch('/auth/resources/resource_edit.php', {
															method: 'POST',
															headers: {
																'Content-Type': 'application/json'
															},
															body: JSON.stringify({
																oldData: oldData,
																newData: newData
															})
														})
														.then(response => response.json())
														.then(data => {
															if (data.status === 'success') {
																const Toast = Swal.mixin({
																	toast: true,
																	position: "top-end",
																	showConfirmButton: false,
																	timer: 3000,
																	timerProgressBar: true,
																	didOpen: (toast) => {
																		toast.onmouseenter = Swal.stopTimer;
																		toast.onmouseleave = Swal.resumeTimer;
																	}
																});
																Toast.fire({
																	icon: "success",
																	title: "Edited Successfully"
																});
																bookmarks[index] = newData;
																renderBookmarks(bookmarks);
															} else {
																Swal.fire({
																	icon: 'error',
																	title: 'Oops...',
																	text: 'Something went wrong!'
																});
															}
														})
														.catch((error) => {
															Swal.fire({
																icon: 'error',
																title: 'Oops...',
																text: 'Network error!'
															});
															console.error('Error:', error);
														});
												}
											}
										});
									}
								});
							}
							var contextMenu = document.getElementById('contextMenu');
							contextMenu.style.display = 'none';
						});

						document.getElementById('deleteOption').addEventListener('click', function() {
							var index = parseInt(this.dataset.index);
							console.log('Delete option clicked for index:', index);
							var oldData = getOldData(index, user_id);

							if (!isNaN(index)) {
								Swal.fire({
									title: "Are you sure?",
									text: "You won't be able to revert this!",
									icon: "warning",
									showCancelButton: true,
									confirmButtonColor: "#3085d6",
									cancelButtonColor: "#d33",
									confirmButtonText: "Yes, delete it!"

								}).then((result) => {
									if (result.isConfirmed) {
										Swal.fire({
											title: "Please wait...",
											allowOutsideClick: false,
											onBeforeOpen: () => {
												Swal.showLoading();
											}
										});
										fetch('/auth/resources/resource_delete.php', {
												method: 'POST',
												headers: {
													'Content-Type': 'application/json'
												},
												body: JSON.stringify(oldData)
											})
											.then(response => {
												Swal.close(); // Close loading Swal
												deleteBookmark(index);
												if (response.ok) {
													return response.json();
												} else {
													throw new Error('Network response was not ok.');
												}
											})
											.then(data => {
												Swal.fire({
													title: "Deleted!",
													text: "Your file has been deleted.",
													icon: "success"
												});
												console.log(data); // Handle response from the server
											})
											.catch(error => {
												Swal.close(); // Close loading Swal on error
												console.error('There was a problem with the fetch operation:', error);
												Swal.fire({
													icon: 'error',
													title: 'Oops...',
													text: 'Something went wrong!'
												});
											});
									}
								});
							}
							var contextMenu = document.getElementById('contextMenu');
							contextMenu.style.display = 'none';
						});

						// Hide context menu when clicking outside
						document.addEventListener('click', function(event) {
							var contextMenu = document.getElementById('contextMenu');
							if (contextMenu && !contextMenu.contains(event.target)) {
								contextMenu.style.display = 'none';
							}
						});

					});
				</script>

				<!--**********************************
            Content body end
        ***********************************-->




				<!--**********************************
            Footer start
        ***********************************-->
				<div class="footer">
					<div class="copyright">

					</div>
				</div>
				<!--**********************************
            Footer end
        ***********************************-->

				<!--**********************************
           Support ticket button start
        ***********************************-->

				<!--**********************************
           Support ticket button end
        ***********************************-->


		</div>
		<!--**********************************
        Main wrapper end
    ***********************************-->

		<!--**********************************
        Scripts
    ***********************************-->
		<!-- Required vendors -->
		<script src="vendor/global/global.min.js"></script>
		<script src="vendor/chart.js/Chart.bundle.min.js"></script>
		<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

		<!-- Apex Chart -->
		<script src="vendor/apexchart/apexchart.js"></script>

		<script src="vendor/chart.js/Chart.bundle.min.js"></script>

		<!-- Chart piety plugin files -->
		<script src="vendor/peity/jquery.peity.min.js"></script>
		<!-- Dashboard 1 -->
		<script src="js/dashboard/dashboard-1.js"></script>

		<script src="vendor/owl-carousel/owl.carousel.js"></script>

		<script src="js/custom.min.js"></script>
		<script src="js/dlabnav-init.js"></script>
		<script src="js/demo.js"></script>
		<script src="js/styleSwitcher.js"></script>

		<script src="vendor/fullcalendar/js/main.min.js"></script>
		<script src="js/plugins-init/calendar.js"></script>


		<script>
			function cardsCenter() {

				/*  testimonial one function by = owl.carousel.js */



				jQuery('.card-slider').owlCarousel({
					loop: true,
					margin: 0,
					nav: true,
					//center:true,
					slideSpeed: 3000,
					paginationSpeed: 3000,
					dots: true,
					navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
					responsive: {
						0: {
							items: 1
						},
						576: {
							items: 1
						},
						800: {
							items: 1
						},
						991: {
							items: 1
						},
						1200: {
							items: 1
						},
						1600: {
							items: 1
						}
					}
				})
			}

			jQuery(window).on('load', function() {
				setTimeout(function() {
					cardsCenter();
				}, 1000);
			});

			const daysTag = document.querySelector(".days"),
				currentDate = document.querySelector(".current-date"),
				prevNextIcon = document.querySelectorAll(".icons span");

			// getting new date, current year and month
			let date = new Date(),
				currYear = date.getFullYear(),
				currMonth = date.getMonth();

			// storing full name of all months in array
			const months = ["January", "February", "March", "April", "May", "June", "July",
				"August", "September", "October", "November", "December"
			];

			const renderCalendar = () => {
				let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
					lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
					lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
					lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
				let liTag = "";

				for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
					liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
				}

				for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
					// adding active class to li if the current day, month, and year matched
					let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
						currYear === new Date().getFullYear() ? "active" : "";
					liTag += `<li class="${isToday}">${i}</li>`;
				}

				for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
					liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
				}
				currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
				daysTag.innerHTML = liTag;
			}
			renderCalendar();

			prevNextIcon.forEach(icon => { // getting prev and next icons
				icon.addEventListener("click", () => { // adding click event on both icons
					// if clicked icon is previous icon then decrement current month by 1 else increment it by 1
					currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

					if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
						// creating a new date of current year & month and pass it as date value
						date = new Date(currYear, currMonth, new Date().getDate());
						currYear = date.getFullYear(); // updating current year with new date year
						currMonth = date.getMonth(); // updating current month with new date month
					} else {
						date = new Date(); // pass the current date as date value
					}
					renderCalendar(); // calling renderCalendar function
				});
			});

			// script for widget calendar
		</script>

</body>

</html>