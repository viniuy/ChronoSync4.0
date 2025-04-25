<link rel="stylesheet" href="../css/index_home.css">

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <!-- MAIN CONTENT LEFT -->
            <div class="col-xl-9">
                <div class="row">
                    <!-- Weather Widget -->
                    <a class="weatherwidget-io mb-3" href="https://forecast7.com/en/14d42121d04/alabang/" data-label_1="ALABANG" data-label_2="WEATHER" data-theme="original" style="width: 100%; border-radius: 1.25rem; display: block; text-align: center;">
                        ALABANG WEATHER
                    </a>
                    <script>
                        !function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (!d.getElementById(id)) {
                                js = d.createElement(s);
                                js.id = id;
                                js.src = 'https://weatherwidget.io/js/widget.min.js';
                                fjs.parentNode.insertBefore(js, fjs);
                            }
                        }(document, 'script', 'weatherwidget-io-js');
                    </script>

                    <!-- Announcement Card -->
                    <div class="col-xl-12">
                        <div class="card tryal-gradient">
                            <div class="card-body tryal row">
                                <div class="col-xl-7 col-sm-6">
                                    <h2>ANNOUNCEMENT</h2>
                                    <h3>OFFICE 365 SERVICES SECURITY UPDATE</h3>
                                    <p>Starting April 23, 2024, all students and employees will be required to activate Multi-Factor Authentication to access Office 365 services.</p>
                                    <a href="https://play.google.com/store/apps/details?id=com.azure.authenticator&hl=en&gl=US&pli=1" class="btn btn-rounded fs-5 font-w200 btn-xxs">
                                        Click here to Activate MFA
                                    </a>
                                </div>
                                <div class="col-xl-5 col-sm-6">
                                    <img src="images/calendar.png" class="img-fluid sd-shape" alt="Calendar Image">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card overflow-hidden">
                                    <a href="https://www.facebook.com" target="_blank">
                                        <div class="social-graph-wrapper widget-facebook">
                                            <span class="s-icon"><i class="fab fa-facebook-f"></i></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card overflow-hidden">
                                    <a href="https://elms.sti.edu/site/not_logged_in?from=%2Fuser_dashboard&log_in_required=true" target="_blank">
                                        <div class="social-graph-wrapper widget-linkedin">
                                            <img src="images/card/images.png" class="social-icon" style="width: 28px; height: 28px;">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card overflow-hidden">
                                    <a href="https://mail.google.com/" target="_blank">
                                        <div class="social-graph-wrapper widget-googleplus">
                                            <span class="s-icon"><i class="fab fa-google-plus-g"></i></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card overflow-hidden">
                                    <a href="https://one.sti.edu/Login" target="_blank">
                                        <div class="social-graph-wrapper widget-twitter">
                                            <img src="images/card/onesti.png" class="social-icon mt-2" style="width: 33px; height: 15px;">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End inner row -->
            </div> <!-- End Left Column -->

            <!-- RIGHT SIDEBAR -->
            <div class="col-xl-3">
                <div class="row">
                    <!-- Calendar Card -->
					<div class="card">
						<div class="card-body">
							<div class="current-date text-center fw-bold" id="calendar-header">
								<!-- This gets filled by JS -->
							</div>
							<div class="calendar">
								<ul class="weeks d-grid text-center mb-2" style="grid-template-columns: repeat(7, 1fr); padding-left: 0;">
									<li class="fw-semibold text-secondary">Sun</li>
									<li class="fw-semibold text-secondary">Mon</li>
									<li class="fw-semibold text-secondary">Tue</li>
									<li class="fw-semibold text-secondary">Wed</li>
									<li class="fw-semibold text-secondary">Thu</li>
									<li class="fw-semibold text-secondary">Fri</li>
									<li class="fw-semibold text-secondary">Sat</li>
								</ul>
								<ul class="days d-grid text-center" id="calendar-days" style="grid-template-columns: repeat(7, 1fr); gap: 0.3rem; padding-left: 0;"></ul>
							</div>
						</div>
					</div>


                    <!-- Google Search -->
                    <div class="card mt-3" style="height: 5rem;">
                        <div id="search-container" class="p-2">
                            <script async src="https://cse.google.com/cse.js?cx=c741f31e9bba44cd3"></script>
                            <div class="gcse-search"></div>
                        </div>
                    </div>

                    <!-- To-Do Card -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="fs-20 font-w700">To-do</h4>
                            <span class="fs-14 font-w400 d-block">No current task to do</span>
                        </div>
                    </div>
                </div> <!-- End Right Sidebar Row -->
            </div> <!-- End Right Column -->
        </div> <!-- End Outer Row -->
    </div> <!-- End Container -->
</div> <!-- End content-body -->

<script>
    const daysContainer = document.getElementById("calendar-days");
    const header = document.getElementById("calendar-header");

    let date = new Date();
    let currentMonth = date.getMonth();
    let currentYear = date.getFullYear();

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    function renderCalendar() {
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();
        const prevLastDate = new Date(currentYear, currentMonth, 0).getDate();

        daysContainer.innerHTML = "";

        // Fill in previous month's tail
        for (let i = firstDay; i > 0; i--) {
            daysContainer.innerHTML += `<li class="text-muted small">${prevLastDate - i + 1}</li>`;
        }

        // Fill in current month's days
        for (let i = 1; i <= lastDate; i++) {
            const isToday = i === date.getDate() &&
                            currentMonth === date.getMonth() &&
                            currentYear === date.getFullYear();

            daysContainer.innerHTML += `
                <li class="rounded-circle p-2 ${isToday ? 'bg-primary text-white fw-bold' : 'text-dark'}" style="cursor:pointer;">
                    ${i}
                </li>`;
        }

        // Update header
        header.innerHTML = `
            <span id="prev" class="bi bi-chevron-left me-2" style="cursor:pointer;"></span>
            ${monthNames[currentMonth]} ${currentYear}
            <span id="next" class="bi bi-chevron-right ms-2" style="cursor:pointer;"></span>
        `;

        // Add navigation functionality
        document.getElementById("prev").onclick = () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        };
        document.getElementById("next").onclick = () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        };
    }

    renderCalendar();
</script>
