<?php

require_once "./guards/auth_required_guard.php";
auth_required_guard('./login');

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

$activeTab = $_GET['tab'] ?? 'mytasks';

$tasks = [];

require_once "./database/models/Task.php";
require_once "./functions/redirect_with_error.php";
require_once "./functions/format_task_date.php";

try {
    $tasks = Task::get_all();
} catch (\Throwable $e) {
    redirect_with_error('./', $e);
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

    <script src="assets/js/modernizr.min.js"></script>

    <?php if ($error): ?>
        <script>
            alert("Error occured:\n<?= $error ?>");
        </script>
    <?php endif; ?>
</head>

<body>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="/" class="logo"><img src="assets/images/synrgise-logo.png"></a>
                </div>
                <!-- End Logo container-->


                <div class="menu-extras">

                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="dropdown hidden-xs">
                            <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg">
                                <li class="text-center notifi-title">Notification</li>
                                <li class="list-group">
                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="pull-left">
                                                <em class="fa fa-user-plus fa-2x text-info"></em>
                                            </div>
                                            <div class="media-body clearfix">
                                                <div class="media-heading">New user registered</div>
                                                <p class="m-0">
                                                    <small>You have 10 unread messages</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
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
                                    </a>
                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="pull-left">
                                                <em class="fa fa-bell-o fa-2x text-danger"></em>
                                            </div>
                                            <div class="media-body clearfix">
                                                <div class="media-heading">Updates</div>
                                                <p class="m-0">
                                                    <small>There are
                                                        <span class="text-primary">2</span> new updates available</small>
                                                </p>
                                            </div>
                                        </div>
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
                                <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                <li><a href="/logout.php"><i class="md md-settings-power"></i> Logout</a></li>
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
                        <li class="active"><a href="/"><i class="md md-home"></i> <span> Dashboard </span> </a></li>
                    </ul>
                    <!-- End navigation menu  -->
                </div>
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
                            <li class="<?php if ($activeTab === 'mytasks') echo 'tab active'; ?>">
                                <a id="myTasks" data-toggle="tab" href="#mytasks">
                                    <span class="visible-xs"><i data-toggle="tooltip" title="My Tasks" class="fa fa-user"></i></span>
                                    <span class="hidden-xs">My Tasks</span>
                                </a>
                            </li>
                            <li class="<?php if ($activeTab === 'managetasks') echo 'tab active'; ?>">
                                <a id="manageTasks" data-toggle="tab" href="#managetasks" style="cursor: pointer;">
                                    <span class="visible-xs"><i data-toggle="tooltip" title="Manage Tasks" class="fa fa-gear"></i></span>
                                    <span class="hidden-xs">Manage Tasks</span>
                                </a>
                            </li>
                            <li class="<?php if ($activeTab === 'completedtasks') echo 'tab active'; ?>">
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
                    <?php include_once "./includes/my_tasks_tab.php"  ?>
                    <?php include_once "./includes/manage_tasks_tab.php"  ?>
                    <?php include_once "./includes/completed_tasks_tab.php"  ?>

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
        $(document).ready(function() {

            $(".new-task-btn").click(function() {
                $(".created-tasks").hide();
                $(".new-button").hide();
                $(".edit-task_panel").hide();
                $(".new-task_panel").fadeIn(500);
            });

            $(".cancel-btn").click(function() {
                $(".new-task_panel").hide();
                $(".edit-task_panel").hide();
                $(".created-tasks").fadeIn(500);
                $(".new-button").fadeIn(500);
            });

            $(".edit-task-btn").click(function() {
                $(".created-tasks").hide();
                $(".new-task_panel").hide();
                $(".edit-task_panel").hide();
                $(".new-button").hide();
                const id = $(this).attr('data-id');
                $(`.edit-task_panel[data-id="${id}"]`).fadeIn(500);
            });

            $("#myTasks").click(function() {
                $(".new-task_panel").hide();
                $(".edit-task_panel").hide();
                $(".new-button").fadeIn(500);
                $(".created-tasks").fadeIn(500);
            });

            $("#list-view").click(function() {
                $(".completed-blocks").hide();
                $(".completed-list").fadeIn(500);
                $(".list-view").addClass('text-primary');
                $(".block-view").removeClass('text-primary');
            });

            $("#block-view").click(function() {
                $(".completed-list").hide();
                $(".edit-task_panel").hide();
                $(".completed-blocks").fadeIn(500);
                $(".list-view").removeClass('text-primary');
                $(".block-view").addClass('text-primary');
            });

            $('body').on('focus', ".date-input", function() {
                console.log('datepicker');
                $(this).datepicker({
                    format: 'yyyy-mm-dd'
                });
            });
        });
    </script>



</body>

</html>