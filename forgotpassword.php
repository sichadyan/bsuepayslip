<?php include 'helpers/headertemplateforgotpass.php'; ?>
<?php 
  include 'helpers/helper.php';
  include 'helpers/crud.php';

  //== GET DEPARTMENT LIST ==
  $department = _getAllData('department');
  $deptdataList = array(); // empty array
  if ($department != null && $department['count'] != 0){       
      $deptdataList = $department['data'];
  }
  else{
      $deptdataList = null;
  }

  //== GET POSITION LIST ==
  $positions = _getAllData('position');
  $positiondataList = array(); // empty array
  if ($positions != null && $positions['count'] != 0){       
      $positiondataList = $positions['data'];
  }
  else{
      $positiondataList = null;
  }
?>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Enter email to reset your password.</p>

    <form method="post">
     


      <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-at"></i></span>
          </div>
          <input type="email" id="emailadd" name="emailadd" class="form-control" placeholder="Email Address" required/><span class="bg-danger col-valign-center">&nbsp;</span>
      </div>

      <hr/>
      



      <div class="center">
          </i><center><button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-block btn-flat">Reset Password</button> </center>
         
          
         
                <center><a href="signinuser.php">   Back</a> </center>
             
        </div>
        <!-- /.col -->
          
        <!-- /.col -->
      </form>

      <!-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a> -->
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<?php include_once 'helpers/footertemplate.php'; ?>
<?php
if (ISSET($_POST["btnSubmit"])){

        $roleid='1';
        $idnumber=$_POST['idnumber'];
        $password= md5($_POST['password']);
        $firstname=$_POST['firstname'];
        $middlename=$_POST['middlename'];
        $lastname=$_POST['lastname'];
        $birthdate=  date("Y-m-d",strtotime($_POST['birthdate']));
        $gender=$_POST['gender'];
        $departmentid=$_POST['departmentid'];
        $positionid=$_POST['positionid'];
        $address=$_POST['address'];
        $contactnumber=$_POST['phonenumber'];
        $emailadd=$_POST['emailadd'];
        $createdby=$_POST['firstname'] . ' ' . $_POST['lastname'];
        $createddate= date("Y-m-d H:i:s");

        echo $birthdate;
        var_dump($birthdate);
  
        $tablename = 'user';
        $tablecolumns = 'roleid, 
                        idnumber, 
                        password, 
                        firstname, 
                        middlename, 
                        lastname, 
                        birthdate, 
                        gender, 
                        departmentid, 
                        positionid, 
                        address, 
                        contactnumber, 
                        emailadd, 
                        createdby, 
                        createddate';
        $columvalues =  "'$roleid',
                        '$idnumber',
                        '$password',
                        '$firstname',
                        '$middlename',
                        '$lastname',
                        '$birthdate',
                        '$gender',
                        '$departmentid',
                        '$positionid',
                        '$address',
                        '$contactnumber',
                        '$emailadd',
                        '$createdby',
                        '$createddate'
                        ";

        $result = _saveData($tablename,$tablecolumns,$columvalues);
          
      if($result['data']) {
        echo (popUp("success","Saved", "(" . $result['count'] . ") Record Saved!","signin.php"));
        exit();
      } else {  
        echo (popUp("error","", "Problem in Adding New Record.",""));
      }
}
?>