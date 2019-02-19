<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ePayslip | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="header">
<center><img src="dist/img/head.png" width="1374" height="138" class="logo"></center>
				
<div class="login-box">
  <div class="login-logo">
  
    <p><img src="dist/img/3.png" width="359" height="103" alt=""/></p>
  </div>
  <!-- /.login-logo -->
  <div class="card ">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Please Enter the Details Below..</p>

      <form method="post">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
          </div>
          <input type="text" id="uName" name="uName" class="form-control" placeholder="ID-Code" required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-key"></i></span>
          </div>
          <input type="password" id="uPass" name="uPass" class="form-control" placeholder="Password" required>
        </div>

        <div class="center">
          <!-- /.col -->
          
          <center>  <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block btn-flat">Sign In</button> </center>
          
          <!-- /.col -->
        </div>
      </form>

      <!---
      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      -->
      <!-- /.social-auth-links -->
      
      <p class="mb-1">
      <!--  <a href="#">I forgot my password</a> -->
      </p>
      <p class="mb-0">
     <center> <a href="signup.php" class="text-center">Register </a> </center>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>

<?php 
if (ISSET($_POST['btnSubmit'])){
    session_start();
    include 'helpers/helper.php';
    include 'helpers/crud.php';

    $idnumber=$_POST['uName'];
    $password=md5($_POST['uPass']);
    
    
    $data = _getAllDataByParam('user','idnumber="' . $idnumber . '" and password="' . $password . "\"");
    //var_dump($data['data']);

    if ($data != null && $data['count'] != 0){
        $_SESSION["isLogin"] = $data['data'][0];
        $fullname = $data['data'][0]['lastname'] . ", " . $data['data'][0]['firstname'];
        echo (popUp("success","Authenticated", "Welcome! ". $fullname ,"index.php"));
        exit();
    }
    else{
        echo '<script>alert("Username/Password is incorrect!");</script>';
    }
  }
?>
