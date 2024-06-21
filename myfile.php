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

        <style>
    /* Additional CSS for styling */
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif; /* Adjust font family as needed */
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%; /* Make the container fill the viewport height */
        background-image: url('images/BG-ChronoSync.png'); /* Adjust background image path */
        background-size: cover;
        background-position: center;
        padding: 20px; /* Add padding for spacing */
    }

    .login__form {
        max-width: 400px; /* Adjust maximum width of the form */
        width: 100%;
        background-color: #fff; /* Adjust background color of the form */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        height: 100%; /* Set form height to 100% of its container */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login__title {
        text-align: center;
        margin-bottom: 20px;
    }

    .login__content {
        flex: 1; /* Allow content to expand within the form */
    }

    .login__box {
        position: relative;
        margin-bottom: 20px;
    }

    .login__icon {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .login__box-input {
        margin-left: 35px;
    }

    .login__input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .login__label {
        position: absolute;
        top: 12px;
        left: 35px;
        font-size: 16px;
        color: #999;
        transition: all 0.2s ease;
    }

    .login__input:focus + .login__label,
    .login__input:valid + .login__label {
        top: -10px;
        left: 10px;
        font-size: 12px;
        color: #333;
    }

    .login__button {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .links {
        text-align: center;
        margin-top: 10px;
    }

    .links a {
        color: #4CAF50;
        text-decoration: none;
    }

    .links a:hover {
        text-decoration: underline;
    }
</style>


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
                
                <iframe src="testmyfile/index.php"  ></iframe>

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