<div class="content-body">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Statistics</a></li>
					</ol>
                </div>
				<div class="row">
					<!-- INFO -->
					<div class="col-xl-6">
											<div class="card tryal-gradient">
												<div class="card-body tryal row">
													<div class="col-xl-12 col-sm-6">

														 
														<h2>Hello, Admin</h2>

														<span>Starting April 23,2024
															all students and employees will be required to activate Multi-Factor Authentication to access Office 365 services </span>
														<a href="https://play.google.com/store/apps/details?id=com.azure.authenticator&hl=en&gl=US&pli=1" class="btn btn-rounded  mt-2 fs-18 font-w500">Click here to Activate MFA</a>
													
													
													</div>
													<!-- <div class="col-xl- col-sm-7">
														<img src="images/calendar.png" class="sd-shape">
													</div> -->
												</div>
											</div>
											
										</div>

				<!-- 2nd col -->
				<div class="col-xl-3">
						<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "chronosync";
						
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						//it only counts accounts with position student
                        $count = "SELECT COUNT(position) FROM accounts WHERE position = 'student' ";
                        $count_result = $conn->query("$count");

                        $total_admin = 0;

                        if($count_result && $count_result->num_rows > 0){
                            $row = $count_result->fetch_row();
                            $total_student = $row[0];
                        }
                        ?>
					<div class="col-xl-12">
						<div class="widget-stat card">
							<div class="card-body p-5">
								<div class="media ai-icon">
									<span class="me-3 bgl-primary text-primary">
										
										<svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">Total students</p>
										<h4 class="mb-0"><?php echo ($total_student). ''; ?></h4>
										<span class="badge badge-primary"><?php echo ($total_student / 2). '%'; ?></span>
									</div>
								</div>
							</div>
						</div>
                    </div>
					
                    <div class="col-xl-12">
                        <div class="widget-stat card">
							<div class="card-body p-5">
								<div class="media ai-icon">
									<span class="me-3 bgl-warning text-warning">
										<svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
											<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
											<polyline points="14 2 14 8 20 8"></polyline>
											<line x1="16" y1="13" x2="8" y2="13"></line>
											<line x1="16" y1="17" x2="8" y2="17"></line>
											<polyline points="10 9 9 9 8 9"></polyline>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">Total Courses</p>
										<h4 class="mb-0">4</h4>
										<span class="badge badge-warning"></span>
									</div>
								</div>
							</div>
						</div>
                    </div>
					</div>

					<!-- third col -->
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "chronosync";
						
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
                        //it only counts accounts with position admin
                        $count = "SELECT COUNT(position) FROM accounts WHERE position = 'admin' ";
                        $count_result = $conn->query("$count");

                        $total_admin = 0;

                        if($count_result && $count_result->num_rows > 0){
                            $row = $count_result->fetch_row();
                            $total_admin = $row[0];
                        }
                        ?>
					<div class="col-xl-3">
                    <div class="col-xl-12">
                        <div class="widget-stat card">
							<div class="card-body  p-5">
								<div class="media ai-icon">
								<span class="me-3 bgl-danger text-danger">
										
										<svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">Total Teachers</p>
										<h4 class="mb-0"><?php echo ($total_admin). ''; ?></h4><br>
										<span class="badge badge-danger">-3.5%</span>
									</div>
								</div>
							</div>
						</div>
                    </div>


                    <?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "chronosync";
						
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
                        //it only counts accounts with position admin
                        $count = "SELECT COUNT(*) FROM accounts";
                        $count_result = $conn->query("$count");

                        $total_user = 0;

                        if($count_result && $count_result->num_rows > 0){
                            $row = $count_result->fetch_row();
                            $total_user = $row[0];
                        }
                        ?>
                    <div class="col-xl-12">
                        <div class="widget-stat card">
							<div class="card-body p-5">
								<div class="media ai-icon">
								<span class="me-3 bgl-success text-success">
										
										<svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">Total Users</p>
										<h4 class="mb-0"><?php echo ($total_user). ''; ?></h4>
										<span class="badge badge-success">-3.5%</span>
									</div>
								</div>
							</div>
						</div>
                    </div>				
									</div>
								</div>

								<!-- botom  CHART-->
								<div class="row">
					<!-- INFO -->
	
					<!-- analytics Card -->
					<div class="col-xl-9 px-4">
    <div class="card" style="height: 25rem;">
        <div class="card-header">
            <h4 class="card-title"> School Events</h4>
        </div>
		<!-- Adjusting for card header height -->
        <div class="card-body" style="height: calc(100% - 56px);"> 
            <canvas id="lineChart_2" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>
</div>

										
										
										<!-- Event Card -->

	<div class="col-xl-3">
								
			<div class="card" style="width: 25rem">
								
				<h2 class="card-title lead p-4 border-bottom" style="font-weight: 600">
					Events
				</h2>
				<div class="pane border-bottom p-3">
					<i class="far fa-3x fa-calendar-alt text-danger ms-2" aria-hidden="true"></i>
					<div class="ms-3">
					<h2 class="card-title mb-1 lead" style="font-weight: 600">
						STI TNT
					</h2>
					<p class="card-text mb-2">Organized by Alabang Festival Mall</p>
					<p class="card-text mb-0 small text-muted">Time: 6:00AM</p>
					<p class="card-text mb-0 small text-muted">
						Place: Alabang , Festival Mall
					</p>
	  
   	 </div>
	
  </div>
  <div class="col-xl-6 my-auto mx-auto">
  <button type="button" class="btn  btn-primary "><span class="btn-icon-start text-primary"><i class="fa fa-plus color-primary"></i>
  <a href="#" >                           
</span>New Events</button></div></a>      
  </div>

								
  
							</div>

							<!-- last section -->
							<div class="row">
							<div class="col-xl-6">
											<div class="card ">


														
													
													</div>
													
												</div>
											</div>
											
										</div>
						

<div class="gcse-search"></div>
        <!-- This will typically be a snippet of JavaScript provided by Google -->
    </div>
</div>
										

					<!-- End last section -->
					
	<!-- Required vendors -->
	<script src="vendor/global/global.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
    
	<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <!-- Chart ChartJS plugin files -->
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/plugins-init/chartjs-init.js"></script>
	
    <script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>


						</div>
					</div>
				</div>

				
			</div>
			</div>
			
				

					