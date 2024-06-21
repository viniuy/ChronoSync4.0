<?php
require_once 'auth/important/session.php';
if (!isset($_SESSION["user_email"])) {
	header("Location: login.php?Logged-in=?");
	exit();
}
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
                .iframe-container {
                    position: relative;
                    width: 100%;
                    height: 0;
                    padding-bottom: 83.33%;
                    /* Adjust this value according to the aspect ratio of your iframe content */
                }

                .iframe-container iframe {
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    border: none;
                }
            </style>
           

        <div class="iframe-container">
                
                <iframe src="test_todo/index.php"  ></iframe>

            </div>
									
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

	<!-- to do list script -->
	<script>
    $(document).ready(function() {
        $('#addTaskBtn').click(function() {
            $('#myModal').modal('show');
        });

        $('#saveTaskBtn').click(function() {
            var taskText = $('#taskInput').val();

            if (taskText.trim() !== '') {
                var taskCard = $('<div class="col-md-2 task-card"></div>');
                var card = $('<div class="card"></div>');
                var cardBody = $('<div class="card-body"></div>');
                var taskSpan = $('<span></span>').text(taskText);
                var editIcon = $('<i class="fas fa-edit text-primary mr-2"></i>');
                var deleteIcon = $('<i class="fas fa-trash-alt text-danger"></i>');

                cardBody.append(taskSpan);
                cardBody.append(editIcon);
                cardBody.append(deleteIcon);

                card.append(cardBody);
                taskCard.append(card);

                $('#taskList').append(taskCard);
                $('#myModal').modal('hide');
                $('#taskInput').val('');
            }
        });

        $('#taskList').on('click', '.task-card .fa-trash-alt', function() {
            var taskCard = $(this).closest('.task-card');
            if (confirm('Are you sure you want to delete this task?')) {
                taskCard.remove();
            }
        });

        $('#taskList').on('click', '.task-card .fa-edit', function() {
            var taskCard = $(this).closest('.task-card');
            var taskSpan = taskCard.find('span');
            var newText = prompt('Edit task:', taskSpan.text().trim());
            if (newText !== null && newText.trim() !== '') {
                taskSpan.text(newText.trim());
            }
        });
    });
</script>

</body>
</html>