<?php
							if(isset($_COOKIE["usercookie"])){
							require_once("db_connect/db_con.php");
							$query = "select *,DATE_FORMAT(due_date,'%d') As niceday,DATE_FORMAT(due_date,'%m') As nicemonth from tasks where user_id='".$_COOKIE["usercookie"]."' AND complete='F' AND publish='F'";
							$statement = $conn->prepare($query);
							$statement->execute();
							$tasks = $statement->fetchAll();
							$statement->closeCursor();
							
							
							$query_complete = "select *,DATE_FORMAT(due_date,'%d') As niceday,DATE_FORMAT(due_date,'%m') As nicemonth from tasks where user_id='".$_COOKIE["usercookie"]."' AND complete='T' AND publish='F'";
							$statement_complete = $conn->prepare($query_complete);
							$statement_complete->execute();
							$tasks_complete = $statement_complete->fetchAll();
							$statement_complete->closeCursor();
							
							
							$query_messages = "select * from messages where seen='F' AND user_id='".$_COOKIE["usercookie"]."'";
							$statement_messages = $conn->prepare($query_messages);
							$statement_messages->execute();
							$tasks_messages = $statement_messages->fetchAll();
							$statement_messages->closeCursor();
							
							$query_updates = "select * from updates where seen='F' AND user_id='".$_COOKIE["usercookie"]."'";
							$statement_updates = $conn->prepare($query_updates);
							$statement_updates->execute();
							$tasks_updates = $statement_updates->fetchAll();
							$statement_updates->closeCursor();
							
							$query_settings = "select * from settings where seen='F' AND user_id='".$_COOKIE["usercookie"]."'";
							$statement_settings = $conn->prepare($query_settings);
							$statement_settings->execute();
							$tasks_settings = $statement_settings->fetchAll();
							$statement_settings->closeCursor();
							
							
							}
							
							
							function month($nicemonths){
								$month = $nicemonths;
							switch($month){
							case ($month == 01):
                             $month ="Jan";
							 break;
							 case ($month == 02):
                             $month ="Feb";
							 break;
							 case ($month == 03):
                             $month ="Mar";
							 break;
							 case ($month == 04):
                             $month ="Apr";
							 break;
							 case ($month == 05):
                             $month ="May";
							 break;
							 case ($month == 06):
                             $month ="Jun";
							 break;
							 case ($month == 07):
                             $month ="Jul";
							 break;
							 case ($month == 08):
                             $month ="Aug";
							 break;
							 case ($month == 09):
                             $month ="Sep";
							 break;
							 case ($month == 10):
                             $month ="Oct";
							 break;
							 case ($month == 11):
                             $month ="Nov";
							 break;
							 case ($month == 12):
                             $month ="Dec";
							 break;
							 default:
							 $month="Date no applicable";
							 break;
							}
return $month;							
							}
							
							

							?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title>Synrgise - Innovate Learning</title>


        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
        <link href="assets/css/elements.css" rel="stylesheet" type="text/css">
        <link href="assets/css/datepicker.css" rel="stylesheet">
        <link href="assets/css/modal.css" rel="stylesheet">
        <script src="assets/js/modernizr.min.js"></script>


    </head>


    <body>

      <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="index.html" class="logo"><img src="assets/images/synrgise-logo.png"></a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown hidden-xs">
                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                    <i class="md md-notifications"></i> <span id="count_badge" class="badge badge-xs badge-danger"><?php echo(count($tasks_messages)+count($tasks_updates)+count($tasks_settings)); ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="text-center notifi-title">Notification</li>
                                    <li class="list-group">
                                       <!-- list item-->
                                       <a href="javascript:void(0);" id="messageM" name="messageM" class="list-group-item">
                                          <?php
											 if(count($tasks_messages) > 0){
											 ?>
										  <div class="media">
                                             <div class="pull-left">
                                                <em class="fa fa-user-plus fa-2x text-info"></em>
                                             </div>
											 
                                             <div class="media-body clearfix">
                                                <div class="media-heading">New user registered</div>
                                                <p class="m-0">
                                                   <small>You have <?php echo count($tasks_messages)?> unread message</small>
                                                </p>
                                             </div>
											 
                                          </div>
										  <?php
											 }
											 ?>
                                       </a>
                                       <!-- list item-->
                                        <a href="javascript:void(0);" id="settingM" name="settingM" class="list-group-item">
                                         <?php
											 if(count($tasks_settings) > 0){
											 ?>
										 <div class="media">
                                             <div class="pull-left">
                                                <em class="fa fa-diamond fa-2x text-primary"></em>
                                             </div>
											 
                                             <div class="media-body clearfix">
                                                <div class="media-heading">New settings</div>
                                                <p class="m-0">
                                                   <small>There are new settings available</small>
                                                </p>
                                             </div>
											
                                          </div>
										   <?php
											 }
											 ?>
                                        </a>
                                        <!-- list item-->
                                        <a href="javascript:void(0);" id="updateM" name="updateM" class="list-group-item">
                                           <?php
											 if(count($tasks_updates) > 0){
											 ?>
										  <div class="media">
                                             <div class="pull-left">
                                                <em class="fa fa-bell-o fa-2x text-danger"></em>
                                             </div>
											 
                                             <div class="media-body clearfix">
                                                <div class="media-heading">Updates</div>
                                                <p class="m-0">
                                                   <small>There is
                                                      <span class="text-primary"><?php echo count($tasks_updates)?></span> new update available</small>
                                                </p>
                                             </div>
											 
                                          </div>
										  <?php
											 }
											 ?>
                                        </a>
                                       <!-- last list item -->
                                        <a href="javascript:void(0);" class="list-group-item">
                                          <small>See all notifications</small>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown user-box">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown" aria-expanded="true">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img">
                                    <div class="user-status away"><i class="zmdi zmdi-dot-circle"></i></div>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)" id="profile"><i class="md md-face-unlock"></i> Profile</a></li>
                                    <li><a href="javascript:void(0)" id="settings"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)" id="lock"><i class="md md-lock"></i> Lock screen</a></li>
                                    <li><a href="files/logout.php"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="active"><a href="index.html"><i class="md md-home"></i> <span> Dashboard </span> </a></li>
                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
  

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <form method="post" action="tasks/update.php">
  <div class="modal-content">
    <span class="close">&times;</span>
	
	<p align="center"><label>Edit task</label></p>
	<input type="hidden" name="idM" id="idM" value="">
    <input type="text" id="titleM" name="titleM" class="form-control"  value="" placeholder="title">
	<input type="text" id="descriptionM" name="descriptionM" class="form-control" value="" placeholder="description">
	<input type="text" id="dateM" name="dateM"class="form-control date-input" value="" placeholder="date">
	<input type="submit">						
	
	
  </div>
</form>
</div>
<!-- The Modal -->
<div id="myModalscreenLock" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    
	<p align="center"><label>Screen Locked</label></p>
	<img src="assets/images/locked.png" style="width:100px;height100px;margin-left:40%;">
	<input type="text" id="locked" name="locked" class="form-control"  value="" placeholder="password"><br/>
	<input type="submit" onclick = "unclock();" style="width:60%;margin-left:20%;">						
	
	
  </div>
</div>

<div id="myModalprofile" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
	<p align="center"><label>Profile</label></p>
	<img src="assets/images/users/avatar-6.jpg" style="margin-left:40%;border-radius: 50%;"><br/><br/>
	<label>Username:</label>
	<input type="text" id="usernameprofile" name="usernameprofile" class="form-control"  value="" placeholder="password"><br/>
	<label>Password:</label>
	<input type="text" id="passprofile" name="passprofile" class="form-control"  value="" placeholder="password"><br/>
	
  </div>
</div>

<div id="myModalsettings" class="modal">
  <!-- Modal content -->
  <form method="post" action="files/settings.php">
  <div class="modal-content">
	<p align="center"><label>Settings</label></p>
	<img src="assets/images/users/avatar-6.jpg" style="margin-left:40%;border-radius: 50%;"><br/><br/>
	<label>Username:</label>
	<input type="text" id="usernamesettings" name="usernamesettings" class="form-control"  value="" placeholder="password"><br/>
	<label>Password:</label>
	<input type="text" id="passsettings" name="passsettings" class="form-control"  value="" placeholder="password"><br/>
	 <button type="submit" class="btn btn-primary waves-effect waves-light new-task-btn"><i class="fa fa-plus"></i> EDIT</button>
  </div>
  </form>
</div>

<div id="myModalsettingsN" class="modal">
  <!-- Modal content -->
  
  <div class="modal-content">
  <div class="pull-left">
      <em class="fa fa-diamond fa-2x text-primary"></em>
           </div>
	<p align="left" ><label>Settings</label></p>
	<?php
	foreach($tasks_settings as $settings):
	?>
	<p><?php echo $settings["settings"]; ?></p>
 <?php
	endforeach;
	?>
	<p id="test">""</p>
</div>
</div>
<div id="myModalupdatesN" class="modal">
  <!-- Modal content -->
  
 
	<div class="modal-content">
	<div class="pull-left">
     <em class="fa fa-bell-o fa-2x text-danger"></em>
     </div>
	<p align="left" ><label>Updates</label></p>
	<?php
	foreach($tasks_updates as $update):
	?>
	<p><?php echo $update["updates"]; ?></p>
	<?php
	endforeach;
	?>
  </div>
</div>
<div id="myModalmessagesN" class="modal">
  <!-- Modal content -->
  
  
	<div class="modal-content">
	<div class="pull-left">
      <em class="fa fa-user-plus fa-2x text-info"></em>
       </div>
	<p align="left" ><label>Messages</label></p>
	<?php
	foreach($tasks_messages as $message):
	?>
	<p><?php echo $message["message"]; ?></p>
	<?php
	endforeach;
	?>
  </div>
</div>


            <div class="subheader">
                <div class="container">
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            <h1 style="color: #fff;">Tasks</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs">
                                <li class="tab active">
                                    <a id="myTasks" data-toggle="tab" href="#mytasks" >
                                        <span class="visible-xs"><i data-toggle="tooltip" title="My Tasks" class="fa fa-user"></i></span>
                                        <span class="hidden-xs">My Tasks</span>
                                    </a>
                                </li>
                                <li>
                                    <a id="manageTasks" data-toggle="tab" href="#managetasks" style="cursor: pointer;">
                                        <span class="visible-xs"><i data-toggle="tooltip" title="Manage Tasks" class="fa fa-gear"></i></span>
                                        <span class="hidden-xs">Manage Tasks</span>
                                    </a>
                                </li>
                                <li>
                                    <a id="completedTasks" data-toggle="tab" href="#completedtasks" style="cursor: pointer;">
                                        <span class="visible-xs"><i data-toggle="tooltip" title="Completed Tasks" class="fa fa-folder-open-o"></i></span>
                                        <span class="hidden-xs">Completed Tasks</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->

        <div class="wrapper">
            <div class="container">
                <div class="row">
				
                    <div class="tab-content">
                        <div id="mytasks" class="tab-pane fade in active">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <div class="pull-right">
									<form method="post" action="tasks/mytasks.php">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Mark as complete</button>
                                    </div>
                                </div>
                            </div>
			
                            <div class="row">
							<?php foreach($tasks as $task):?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right"><?php echo $task["niceday"]; ?><br><?php echo month($task["nicemonth"]); ?></div>
                                            <div class="checkbox checkbox-primary ">
                                                <input class="todo-done" id="marktask[]" value="<?php echo $task["task_id"]; ?>" type="checkbox" name="marktask[]">
                                                <label for="1"></label>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3 ><?php echo $task["title"]; ?></h3>
                                                    <p><?php echo $task["body"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php endforeach; ?>
                            </div>
                        </div>
</form>

                        <div id="managetasks" class="tab-pane fade">
                            <div class="row m-b-20 new-button">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary waves-effect waves-light new-task-btn"><i class="fa fa-plus"></i> Add New Task</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Created Tasks -->
							
							
                            <div class="row created-tasks">
							<?php foreach($tasks as $task): ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right"><?php echo $task["niceday"]; ?><br><?php echo month($task["nicemonth"]); ?></div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3><?php echo $task["title"]; ?></h3>
                                                    <p><?php echo $task["body"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
											<!--form  action="index.php" onsubmit="run();return false"-->
                                                <button data-toggle="tooltip"  type="button" onclick="onClick(this);"  id="edit" name="edit" value="<?php echo $task["task_id"]; ?>" title="Edit" class="btn btn icon-btn">
                                                    <i class="fa fa-pencil"></i>
													
                                                </button>
												<!--/form-->
                                            </div>
											
                                            <div class="icon-links quick-icon-links">
											<form method="post" action ="tasks/managetask.php">
                                                <button data-toggle="tooltip" type="submit" id="Unpublish" value="<?php echo $task["task_id"]; ?>" name="Unpublish" title="Unpublish" class="btn btn icon-btn">
                                                    <i class="fa fa-power-off"></i>
                                                </button>
												</form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<?php endforeach;?>
                            </div><!-- end Created Tasks -->
							

<!-- Trigger/Open The Modal -->

                            <!-- New Tasks -->
							<form method="post" action="tasks/newtask.php">
                            <div class="row new-task_panel" style="display: none;">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-plus"></i> New Task</h4>
                                    </div>
                                    <div class="panel-body">
                                        <form role="form">
                                            <div class="form-group">
                                                <label class="control-label">Task Name</label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Some text value...">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-md-4">Due Date</label>
                                                    <div class="input-group col-md-8">
                                                        <input type="text" class="form-control date-input" placeholder="yyyy-mm-dd" id="datepicker" name="datepicker">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="pull-right">
                                                    <button type="submit" class="create-btn btn btn-primary waves-effect waves-light">Create</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- end New Tasks -->
							</form>
                        </div>

                        <div id="completedtasks" class="tab-pane fade">
						<form method="post" action="tasks/completedtask.php">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="icon-links quick-icon-links">
                                            <button data-toggle="tooltip" type="button" id="block-view" title="Block view" class="btn btn icon-btn">
                                                <i class="block-view fa fa-th-large text-primary"></i>
                                            </button>
                                        </div>
                                        <div class="icon-links quick-icon-links" style="margin-right: 20px;">
                                            <button data-toggle="tooltip" type="button" id="list-view" title="List view" class="btn btn icon-btn">
                                                <i class="list-view fa fa-th-list"></i>
                                            </button>
                                        </div>

                                        <button type="button" class="btn dropdown-toggle btn-primary waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="md md-file-download"></i> Export</button>
                                        <ul class="dropdown-menu" role="menu" style="right: 30px;">
                                            
                                            <li><a href="tasks/export.php">Excel CSV</a></li>
											<li><a href="tasks/export_pdf.php">PDF</a></li>
                                        </ul>
											
                                        <button type="submit" id="deleteAll" name ="deleteAll" class="btn btn-default waves-effect waves-light"> Delete All</button>
</form>
                                    </div>
                                </div>
                            </div>
							</form>
                            <div class="row completed-blocks">
	<form method="post" action="tasks/completedtask.php">
	<?php foreach($tasks_complete as $task_complete): ?>
                                <div class="col-sm-6 col-md-4">
								
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right"><?php echo $task_complete["niceday"]; ?><br><?php echo month($task_complete["nicemonth"]); ?></div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                     <h3><?php echo $task_complete["title"]; ?></h3>
                                                    <p><?php echo $task_complete["body"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="submit" id="Delete" name="Delete" value="<?php echo $task_complete["task_id"]; ?>" title="Delete" class="btn btn icon-btn">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
									
                                </div>
								<?php endforeach; ?>
								</form>
                            </div>
							
                            <div class="row completed-list" style="display: none;">
							
                                <table id="" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Due Date</th>
                                            <th>Task Name</th>
                                            <th>Desscription</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<form method="post" action="tasks/completedtask.php">
	<?php foreach($tasks_complete as $task_complete): ?>
                                        <tr>
                                            <td><?php echo $task_complete["niceday"]."".month($task_complete["nicemonth"]); ?></td>
                                            <td><?php echo $task_complete["title"]; ?></td>
                                            <td><?php echo $task_complete["body"]; ?></td>
                                            <td>
                                                <div class="icon-links quick-icon-links">
                                                    <button data-toggle="tooltip" type="submit" id="Delete" name="Delete" value="<?php echo $task_complete["task_id"]; ?>" title="Delete" class="btn btn icon-btn">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                        
                                    </tbody>
									<?php endforeach; ?>
								</form>
                                </table>
								
                            </div>
							
                        </div>
                    </div>
                </div>


                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                2017 © Synrgise.
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>
            <!-- end container -->


        </div>



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.js"></script>



        <script>

            $(document).ready(function(){

                $(".new-task-btn").click(function(){
                    $(".created-tasks").hide();
                    $(".new-button").hide();
                    $(".new-task_panel").fadeIn(500);
                });

                $(".create-btn").click(function(){
                    $(".new-task_panel").hide();
                    $(".new-button").fadeIn(500);
                    $(".created-tasks").fadeIn(500);
                });
           
                $("#list-view").click(function(){
                    $(".completed-blocks").hide();
                    $(".completed-list").fadeIn(500);
                    $(".list-view").addClass('text-primary');
                    $(".block-view").removeClass('text-primary');
                });
           
                $("#block-view").click(function(){
                    $(".completed-list").hide();
                    $(".completed-blocks").fadeIn(500);
                    $(".list-view").removeClass('text-primary');
                    $(".block-view").addClass('text-primary');
                });

                 $('body').on('focus',".date-input", function(){
                        console.log('datepicker');
                        $(this).datepicker({
                            format: 'yyyy-mm-dd'
                        });
                    });
            });
   // Get the modal
var modal = document.getElementById("myModal");
var modalLock = document.getElementById("myModalscreenLock");
var modalProfile = document.getElementById("myModalprofile");
var modalsettings = document.getElementById("myModalsettings");
var modalUpdates = document.getElementById("myModalupdatesN");
var modalMessages = document.getElementById("myModalmessagesN");
var modalSettingsM = document.getElementById("myModalsettingsN");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
lock.onclick = function() {
  modalLock.style.display = "block";
}
// When the user clicks on the button, open the modal
messageM.onclick = function() {
  modalMessages.style.display = "block";
   document.getElementById("messageM").style.display = "none";
  fetch("updates/message.php") .then(resp => resp.text()) .then(text =>{ 
	let chunk = text.split("\"");
	let filtered = chunk.filter(function (el){
  return el != "";  
});
document.getElementById("count_badge").innerHTML = filtered;

});
}
// When the user clicks on the button, open the modal
settingM.onclick = function() {
  modalSettingsM.style.display = "block";
   document.getElementById("settingM").style.display = "none";
  fetch("updates/settings.php") .then(resp => resp.text()) .then(text =>{ 
	let chunk = text.split("\"");
	let filtered = chunk.filter(function (el){
  return el != "";  
});
document.getElementById("count_badge").innerHTML = filtered;

});
  
}
// When the user clicks on the button, open the modal
updateM.onclick = function() {
  modalUpdates.style.display = "block";
  document.getElementById("updateM").style.display = "none";
  fetch("updates/update.php") .then(resp => resp.text()) .then(text =>{ 
	let chunk = text.split("\"");
	let filtered = chunk.filter(function (el){
  return el != "";  
});
document.getElementById("count_badge").innerHTML = filtered;

});
}
settings.onclick = function() {
  modalsettings.style.display = "block";
   fetch("files/profile.php") .then(resp => resp.text()) .then(text =>{ 
	let chunk = text.split("\"");
	let filtered = chunk.filter(function (el){
  return el != "";  
});

document.getElementById("usernamesettings").value = filtered[1];
document.getElementById("passsettings").value = filtered[0];
});
}

profile.onclick = function() {
  modalProfile.style.display = "block";
  fetch("files/profile.php") .then(resp => resp.text()) .then(text =>{ 
	let chunk = text.split("\"");
	let filtered = chunk.filter(function (el){
  return el != "";  
});

document.getElementById("usernameprofile").value = filtered[1];
document.getElementById("passprofile").value = filtered[0];
});
}


function unclock(){
	let pass = document.getElementById("locked").value

fetch("files/unlock.php") .then(resp => resp.text()) .then(text =>{ 
	let chunk = text.split("\"");
	let filtered = chunk.filter(function (el){
  return el != "";  
});

if(pass === filtered[0]){
modalLock.style.display = "none";	
}else{
alert("password incorrect");	
}
});
	
}



function onClick(element) {
modal.style.display = "block";
let ids = document.getElementById("edit").value=element.value;

fetch('tasks/taskupdates.php',{
        			method:'post',
                     headers: {
                         Accept: 'application/json',
                         'Content-Type': 'application/json',
                       },
        			body:JSON.stringify({
        			
        				email:ids
        				
        			})

        		})
        		.then(resp => resp.text()).then(text =>{ 
				document.getElementById("idM").value = JSON.parse(text)[0].task_id;
				document.getElementById("titleM").value = JSON.parse(text)[0].title;
				document.getElementById("descriptionM").value = JSON.parse(text)[0].body;
				document.getElementById("dateM").value = JSON.parse(text)[0].due_date;
})  
}


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}



// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
   if (event.target == modalProfile) {
    modalProfile.style.display = "none";
  }
  if (event.target == modalsettings) {
    modalsettings.style.display = "none";
  }
  
   if (event.target == modalUpdates) {
    modalUpdates.style.display = "none";
  }
  
   if (event.target == modalMessages) {
    modalMessages.style.display = "none";
  }
  
   if (event.target == modalSettingsM) {
    modalSettingsM.style.display = "none";
  }
}

        </script>


    </body>
</html>