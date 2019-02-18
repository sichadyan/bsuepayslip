<?php
//Always include this on the top your PHP page
include('config/authenticate.php')  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>ePayslip | <?php echo (isset($_HeaderTitle) ? $_HeaderTitle : 'Welcome'); ?></title>

<!-- datatables -->
<link rel="stylesheet" href="plugins/datatables/datatables.css">
  <!-- Font Awesome Icons -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css"> -->
  <!-- IonIcons -->
  <!-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark bg-success">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
          </a>
          <div class="dropdown-divider"></div>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-success elevation-4 ">
    <!-- Brand Logo -->
    <a href="indexuser.php" class="brand-link bg-success">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">ePayslip</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/4.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["isLogin"]['lastname'] . ", " . $_SESSION["isLogin"]['firstname']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <!-- Sidebar -->  <li class="nav-item has-treeview menu-open">
            <a href="indexuser.php" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p> Home</p>
            </a>
		  </li>      
          
          
          <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fa fa-male"></i>
              <p> My Profile </p>
            </a>
           
            
          
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-address-card"></i>
              <p>Payslips <em class="fa fa-angle-left right"></em> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="payslipuser.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Payslip</p>
                </a>
                
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>History</p>
                </a>
                
              </li>
            </ul>
          </li>
        
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>Settings <em class="fa fa-angle-left right"></em> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Notifications</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Change Email/Number</p>
                </a>
              </li>
              
            </ul>
          </li>
      
              <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-toolbox"></i>
              <p>Reports</p>
            </a>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-print"></i>
              <p>About</p>
            </a>
            <li class="nav-item">
            <a href="logout.php" onclick="return confirm('Are you sure you want to Log-Out?');" class="nav-link active">
            <p> Logout</p>
         
          </a>
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo (isset($_HeaderTitle) ? $_HeaderTitle : 'Index'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><?php echo (isset($_HeaderTitle) ? $_HeaderTitle : 'Index'); ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->