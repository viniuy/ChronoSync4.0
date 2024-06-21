﻿<?php
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
			<div class="container-fluid">
				<div class="row">
					
					
				</div>	
				<div class="row kanban-bx">
					<div class="col">
						<div class="kanbanPreview-bx">
							<div class="draggable-zone dropzoneContainer">
								<div class="sub-card align-items-center d-flex justify-content-between mb-4">
									<div>
										<h4 class="fs-20 mb-0 font-w600">To-Do List (<span class="totalCount">24</span>)</h4>
									</div>
									<div class="plus-bx">
										<a href="javascript:void(0)"><i class="fas fa-plus"></i></a>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="sub-title">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#FFA7D7"></circle>
												</svg>
												Deisgner
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Create wireframe for landing page phase 1</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-design progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="text-warning">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#FFCF6D"></circle>
												</svg>
												Important
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Visual Graphic for Presentation to Client</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-warning progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
												<li><img src="images/contacts/pic222.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="text-success">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#09BD3C"></circle>
												</svg>

												Databse
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Setup database for create API connection</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-success progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
												<li><img src="images/contacts/pic222.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="kanbanPreview-bx">
							<div class="draggable-zone dropzoneContainer">
								<div class="sub-card align-items-center d-flex justify-content-between mb-4">
									<div>
										<h4 class="fs-20 mb-0 font-w600">On Progress(<span class="totalCount">2</span>)</h4>
									</div>
									<div class="plus-bx">
										<a href="javascript:void(0)"><i class="fas fa-plus"></i></a>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="text-sucess">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#09BD3C"></circle>
												</svg>
												UPDATE
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Update information in footer section</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-success progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="text-info">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#D653C1"></circle>
												</svg>
												Video
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Update information in footer section</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-info progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="col">
						<div class="kanbanPreview-bx">
							<div class="draggable-zone dropzoneContainer">
								<div class="sub-card align-items-center d-flex justify-content-between mb-4">
									<div>
										<h4 class="fs-20 mb-0 font-w600">On Progress(<span class="totalCount">2</span>)</h4>
									</div>
									<div class="plus-bx">
										<a href="javascript:void(0)"><i class="fas fa-plus"></i></a>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="text-sucess">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#09BD3C"></circle>
												</svg>
												UPDATE
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Update information in footer section</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-success progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="text-info">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#D653C1"></circle>
												</svg>
												Video
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Update information in footer section</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-info progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="kanbanPreview-bx">
							<div class="draggable-zone dropzoneContainer">
								<div class="sub-card align-items-center d-flex justify-content-between mb-4">
									<div>
										<h4 class="fs-20 mb-0 font-w600">Done(<span class="totalCount">3</span>)</h4>
									</div>
									<div class="plus-bx">
										<a href="javascript:void(0)"><i class="fas fa-plus"></i></a>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="text-danger">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#FC2E53"></circle>
												</svg>
												BUGS FIXING
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Update information in footer section</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-danger progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="text-danger">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#FC2E53"></circle>
												</svg>
												BUGS FIXING
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Update information in footer section</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-danger progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
								<div class="card draggable-handle draggable">
									<div class="card-body">
										<div class="d-flex justify-content-between mb-2">
											<span class="sub-title">
												<svg class="me-2" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="5" cy="5" r="5" fill="#FFA7D7"></circle>
												</svg>
												HTML
											</span>
											<div class="dropdown">
												<div class="btn-link" data-bs-toggle="dropdown">
													<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="3.5" cy="11.5" r="2.5" transform="rotate(-90 3.5 11.5)" fill="#717579"></circle>
														<circle cx="11.5" cy="11.5" r="2.5" transform="rotate(-90 11.5 11.5)" fill="#717579"></circle>
														<circle cx="19.5" cy="11.5" r="2.5" transform="rotate(-90 19.5 11.5)" fill="#717579"></circle>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete</a>
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>
												</div>
											</div>
										</div>
										<p class="font-w600 fs-18"><a href="javascript:void(0);" class="text-black">Create wireframe for landing page phase 1</a></p>
										<div class="progress default-progress my-4">
											<div class="progress-bar bg-design progress-animated" style="width: 45%; height:10px;" role="progressbar">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="row justify-content-between align-items-center kanban-user">
											<ul class="users col-6">
												<li><img src="images/contacts/pic11.jpg" alt=""></li>
												<li><img src="images/contacts/pic22.jpg" alt=""></li>
												<li><img src="images/contacts/pic33.jpg" alt=""></li>
											</ul>
											<div class="col-6 d-flex justify-content-end">
												<span class="fs-14"><i class="far fa-clock me-2"></i>Due in 4 days</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
				</div>	
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
		


		
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">DexignLab</a> 2021</p>
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
	<script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	<script src="vendor/draggable/draggable.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>

		<script src="vendor/fullcalendar/js/main.min.js"></script>
	<script src="js/plugins-init/calendar.js"></script>
	

</body>
</html>