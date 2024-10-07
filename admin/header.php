<?php
include_once('../model/controller.php');
include_once('session.php');
function log_in(){
    if (isset($_SESSION["username"]) || isset($_SESSION["email"])) {
        return true;
    }else{
        return false;
    }
}
if(log_in() != true){
 header("Location: ./");
}

if(isset($_SESSION['username']) || isset($_SESSION["email"])){
    $username = $_SESSION["username"];
    $email = $_SESSION["email"];
    $chk = getUsrzAdm($username,$email);
        if(mysqli_num_rows($chk) > 0){
         //return true;
        }else{
            session_destroy();
            header("Location: ./");
        }
    }
if($_SESSION["username"]){
        $em = $_SESSION["username"];
        $user = getUsrAdm($em);
        $ft = getUsrInfoAdm($em);
        while ($fetch = $ft->fetch_assoc()) { 
            $user_id = $fetch['lecturer_id'];
            $usn = ucfirst($fetch['username']);
            $username = $fetch['username'];
            $mail = $fetch['email'];
        }
    }else if($_SESSION["email"]) {
        $em = $_SESSION["email"];
        $user = getUsrAdm($em);
        $ft = getUsrInfoAdm($em);
        while ($fetch = $ft->fetch_assoc()) { 
            $user_id = $fetch['lecturer_id'];
            $usn = ucfirst($fetch['username']);
            $username = $fetch['username'];
            $mail = $fetch['email'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
    <meta charset="utf-8" />
    <title>Avers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/logo-sm.png">
    <link rel="stylesheet" href="../assets/libs/jsvectormap/css/jsvectormap.min.css">
     <!-- App css -->
     <link href="../assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
     <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <!-- Top Bar Start -->
    <div class="topbar d-print-none">
        <div class="container-xxl">
            <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">    
                <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">                        
                    <li>
                        <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                            <i class="iconoir-menu-scale"></i>
                        </button>
                    </li> 
                    <li class="mx-3 welcome-text">
                        <h3 class="mb-0 fw-bold text-truncate">Welcome, <?php echo $usn; ?>!</h3>
                        <!-- <h6 class="mb-0 fw-normal text-muted text-truncate fs-14">Here's your overview this week.</h6> -->
                    </li>                   
                </ul>
                <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                    <li class="topbar-item">
                        <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                            <i class="icofont-moon dark-mode"></i>
                            <i class="icofont-sun light-mode"></i>
                        </a>                    
                    </li>
    
                    <li class="dropdown topbar-item">
                        <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="../assets/images/avatar.png" alt="" class="thumb-lg rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0">
                            <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                                <div class="flex-shrink-0">
                                    <img src="../assets/images/avatar.png" alt="" class="thumb-md rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                    <h6 class="my-0 fw-medium text-dark fs-13"><?php echo $usn; ?></h6>
                                    <small class="text-muted mb-0"><?php echo $role; ?></small>
                                </div><!--end media-body-->
                            </div>
                            <div class="dropdown-divider mt-0"></div>
                            <small class="text-muted px-2 pb-1 d-block">Account</small>
                            <a class="dropdown-item" href="./profile"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item text-danger" href="./logout"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
                        </div>
                    </li>
                </ul><!--end topbar-nav-->
            </nav>
            <!-- end navbar-->
        </div>
    </div>
    <!-- Top Bar End -->
    <!-- leftbar-tab-menu -->
    <div class="startbar d-print-none">
        <!--start brand-->
        <div class="brand">
            <a href="#" class="logo">
                <span>
                    <img src="../assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
                <span class="" style="color: blue;">
                   Avers AAUA
                      </span>
            </a>
        </div>
        <!--end brand-->
        <!--start startbar-menu-->
        <div class="startbar-menu" >
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <div class="d-flex align-items-start flex-column w-100">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-auto w-100">
                        <li class="menu-label pt-0 mt-0">
                            <!-- <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small> -->
                            <span>Main Menu</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./dashboard" role="button"
                                aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="iconoir-home-simple menu-icon"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users" role="button"
                                aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="iconoir-user menu-icon"></i>
                                <span>Students</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./course" role="button"
                                aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="iconoir-home-simple menu-icon"></i>
                                <span>Courses</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./profile" role="button"
                                aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="iconoir-user menu-icon"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./results" role="button"
                                aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="iconoir-reports menu-icon"></i>
                                <span>Results</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#sidebarDashboards" role="button"
                                aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="iconoir-mail menu-icon"></i>
                                <span>Messages</span>
                            </a>
                        </li> -->
                            
                        
                    </ul><!--end navbar-nav--->
                    
                </div>
            </div><!--end startbar-collapse-->
        </div><!--end startbar-menu-->    
    </div><!--end startbar-->
    <div class="startbar-overlay d-print-none"></div>
    <!-- end leftbar-tab-menu-->

    <div class="page-wrapper">
        <!-- Page Content-->
        <div class="page-content">
            <div class="container-xxl">