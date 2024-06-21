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
    .task-card {
        margin-bottom: 20px;
    }

    .task-card .card-body {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .task-card .card-body span {
        word-wrap: break-word;
    }
</style>
</head>
<body>
  

<!-- to do task -->

<div id="myModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="taskInput">Task:</label>
                    <input type="text" id="taskInput" class="form-control" placeholder="Enter task">
                </div>
                <div class="form-group">
                    <label for="dueDateInput">Due Date:</label>
                    <input type="date" id="dueDateInput" class="form-control">
                </div>
                <div class="form-group">
                    <label for="prioritySelect">Priority:</label>
                    <select id="prioritySelect" class="form-control">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="labelSelect">Label:</label>
                    <select id="labelSelect" class="form-control">
                        <option value="work">Work</option>
                        <option value="school">School</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveTaskBtn" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</div>



<!-- layout -->



            <div class="container-fluid">
				<!-- <div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">To-do List</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Inbox</a></li>
					</ol>
                </div> -->
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="email-left-box px-0 mb-3">
                                <div class="row">
        <div class="col">
        <div class="p-0">
                                        <!-- add task -->
                                        <button id="addTaskBtn"  class="btn btn-primary btn-block"><i class="fas fa-plus"></i>Add Task</a>
                                    </div>
        </div>
       
    </div>
                                    <!-- <div id="taskList" class="row"></div> -->
                                    <div class="mail-list rounded mt-4">
                                        <a href="email-inbox.html" class="list-group-item active"><i class="fa fa-inbox font-18 align-middle me-2"></i> Inbox <span class="badge badge-primary badge-sm float-end">198</span> </a>
                                        <a href="javascript:void()" class="list-group-item"><i class="fa fa-paper-plane font-18 align-middle me-2"></i>All Task</a> <a href="javascript:void()" class="list-group-item"><i class="fa fa-star font-18 align-middle me-2"></i>Important <span class="badge badge-danger text-white badge-sm float-end"></span>
                                        </a>
                                        <a href="javascript:void()" class="list-group-item"><i class="mdi mdi-file-document-box font-18 align-middle me-2"></i>Today</a><a href="javascript:void()" class="list-group-item"><i class="fa fa-trash font-18 align-middle me-2"></i>Trash</a>
                                    </div>
                                    <div class="mail-list rounded overflow-hidden mt-4">
										<div class="intro-title d-flex justify-content-between my-0">
											<h5>List</h5>
										</div>
                                        <a href="email-inbox.html" class="list-group-item"><span class="icon-warning"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                            Work </a>
                                        <a href="email-inbox.html" class="list-group-item"><span class="icon-primary"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                            School </a>
                                   
                                    </div>
                                </div>
                                <div class="email-right-box ms-0 ms-sm-4 ms-sm-0">
                                    <div role="toolbar" class="toolbar ms-1 ms-sm-0">
                                        <div class="btn-group mb-1">
											<div class="form-check custom-checkbox">
												<input type="checkbox" class="form-check-input" id="checkAll">
												<label class="form-check-label" for="checkAll"></label>
											</div>
										</div>
                                        <div class="btn-group mb-1">
                                            <button class="btn btn-primary light px-3" type="button"><i class="ti-reload"></i>
                                            </button>
                                        </div>
                                        <div class="btn-group mb-1">
                                            <button aria-expanded="false" data-bs-toggle="dropdown" class="btn btn-primary px-3 light dropdown-toggle" type="button">More <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu"> <a href="javascript: void(0);" class="dropdown-item">Mark as Unread</a> <a href="javascript: void(0);" class="dropdown-item">Add to Tasks</a>
                                               </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="email-list mt-3">
                                       
                                        <div class="message">
                                            <div>
                                                <div class="d-flex message-single">
                                                    <div class="ps-1 align-self-center">
														<div class="form-check custom-checkbox">
															<input type="checkbox" class="form-check-input" id="checkbox7">
															<label class="form-check-label" for="checkbox7"></label>
														</div>
													</div>
                                                    
                                                </div>
                                                
                                                <a href="email-read.html" class="col-mail col-mail-2">
                                                    <div class="subject">
                                                    

                                                    </div>
                                                    <!-- <div class="date">11:49 am</div> -->
                                                </a>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <!-- panel -->
                                    <!-- <div class="row mt-4">
                                        <div class="col-12 ps-3">
                                            <nav>
												<ul class="pagination pagination-gutter pagination-primary pagination-sm no-bg">
													<li class="page-item page-indicator"><a class="page-link" href="javascript:void()"><i class="la la-angle-left"></i></a></li>
													<li class="page-item active"><a class="page-link" href="javascript:void()">1</a></li>
													<li class="page-item "><a class="page-link" href="javascript:void()">2</a></li>
													<li class="page-item"><a class="page-link" href="javascript:void()">3</a></li>
													<li class="page-item"><a class="page-link" href="javascript:void()">4</a></li>
													<li class="page-item page-indicator"><a class="page-link" href="javascript:void()"><i class="la la-angle-right"></i></a></li>
												</ul>
											</nav>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>