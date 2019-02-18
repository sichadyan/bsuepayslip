<?php 
$_HeaderTitle = 'Employee List'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';


if (isset($_GET['id'])) {
    //== GET EMPLOYEE LIST ==
    $users_employee = _getAllDataByParam('user','id=' . $_GET['id']);
    
    //var_dump($users_employee);
    $empdataList = array(); // empty array
    if ($users_employee != null && $users_employee['count'] != 0){       
        $empdataList = $users_employee['data'][0];
    }
    else{
        $empdataList = null;
    }

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

}
else{
    echo (popUp("warning","No Data Found", "No Record Found!","employeelist.php"));
}


//  var_dump ($users_employee);
?>
<!-- Main content -->
<form method="post">
    <div class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <span>Edit Employee&nbsp;<i class="fas fa-angle-double-right"></i>&nbsp;<strong><?php echo formatFullName('lfm',$empdataList['firstname'],$empdataList['middlename'],$empdataList['lastname']); ?></strong></span>
                    <div class="btn-group float-right">
                        <button class="btn btn-primary btn-sm" id="btnUpdate" name="btnUpdate">Update</button>
                        <a href="employeelist.php" class="btn btn-sm btn-default float-right" style="color: black;">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php 
                            echo '
                <input type="hidden" id="_id" name="_id" value="'. $empdataList["id"] .'"/>
                <label for="idnumber" class="label">ID Number</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" id="idnumber" name="idnumber" value="'. $empdataList["idnumber"] .'" class="form-control" placeholder="ID Number" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="firstname" class="label">Firstname</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" id="firstname" name="firstname" value="'. $empdataList["firstname"] .'" class="form-control" placeholder="First Name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="middlename" class="label">Middlename</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" id="middlename" name="middlename" value="'. $empdataList["middlename"] .'" class="form-control" placeholder="Middle Name">
                </div>';
                            
                            echo '
                <label for="lastname" class="label">Lastname</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" id="lastname" name="lastname" value="'. $empdataList["lastname"] .'" class="form-control" placeholder="Last Name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="birthdate" class="label">Birthdate</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" id="birthdate" autocomplete="off" value="'. date("Y-m-d",strtotime($empdataList["birthdate"])) .'" name="birthdate" class="form-control" placeholder="Birthdate" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="gender" class="label">Gender</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-transgender"></i></span>
                    </div>
                    <select id="gender" name="gender" class="form-control dropdown" required>
                      <option value="">[Select Gender]</option>  
                      <option '. (strpos($empdataList["gender"],"Male") !== 0 ? "selected" : "")  .' value="Male">Male</option>
                      <option '. (strpos($empdataList["gender"],"Female") !== 0 ? "selected" : "")  .' value="Female">Female</option>
                  </select><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?php 
                            //Load User Information
                            echo '
                <label for="departmentid" class="label">Department</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-list-ul"></i></span>
                    </div>
                    <select id="departmentid" name="departmentid" class="form-control dropdown" required>
                      <option value="">[Select Department]</option> 
                      ';
                      foreach ($deptdataList as $row){
                       echo '<option '. (strpos($row["id"], $empdataList["departmentid"]) !== 0 ? "selected" : "")  .'>' . $row["departmentname"] .'</option>';
                      }
                      echo '
                  </select><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="positionid" class="label">Position</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-list"></i></span>
                    </div>
                    <select id="positionid" name="positionid" class="form-control dropdown" required>
                      <option value="">[Select Position]</option>  
                      ';
                      foreach ($positiondataList as $row){
                        echo '<option '. (strpos($row["id"], $empdataList["positionid"]) !== 0 ? "selected" : "")  .'>' . $row["positionname"] .'</option>';
                       }
                       
                      echo '
                  </select><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>
                ';
                            
                            echo '
                <label for="phonenumber" class="label">Phonenumber</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                    </div>
                    <input type="text" id="phonenumber" name="phonenumber" value="'. $empdataList["contactnumber"] .'" class="form-control" placeholder="Mobile Number" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="emailadd" class="label">Email Address</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="email" id="emailadd" name="emailadd" value="'. $empdataList["emailadd"] .'" class="form-control" placeholder="Email Address" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';

                            echo '
                <label for="address" class="label">Address</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-address-card"></i></span>
                    </div>
                    <textarea id="address" name="address" class="textarea form-control" cols="1" rows="5" placeholder="Home Address">'. $empdataList["address"] .'</textarea>
                </div>';     

                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</form>
<?php include 'helpers/footer.php'; ?>
<?php 
//===SAVE NEW EMPLOYEE=====

if (ISSET($_POST["btnUpdate"])){
    $_id=$_POST['_id'];
    $idnumber=$_POST['idnumber'];
    $firstname=$_POST['firstname'];
    $middlename=$_POST['middlename'];
    $lastname=$_POST['lastname'];
    $birthdate=date("Y-m-d",strtotime($_POST['birthdate']));
    $gender=$_POST['gender'];
    $departmentid=$_POST['departmentid'];
    $positionid=$_POST['positionid'];
    $address=$_POST['address'];
    $contactnumber=$_POST['phonenumber'];
    $emailadd=$_POST['emailadd'];
    $modifiedby= formatFullName('fml',$_POST['firstname'],$_POST['middlename'],$_POST['lastname']);
    $modifieddate= date("Y-m-d H:i:s");   

    $tablename = 'user';
    $columvalues =  "idnumber='$idnumber',
                   firstname='$firstname',
                   middlename='$middlename',
                   lastname='$lastname',
                   birthdate='$birthdate',
                   gender='$gender',
                   departmentid='$departmentid',
                   positionid='$positionid',
                   address='$address',
                   contactnumber='$contactnumber',
                   emailadd='$emailadd',
                   modifiedby='$modifiedby',
                   modifieddate='$modifieddate'";
    $filter= "id='$_id'";

    $result = _updateData($tablename,$columvalues,$filter);
    if($result['data']) { 
        echo (popUp("success","Updated!", "(" . $result['count'] . ") Record Updated!","employeelist.php"));
    } else {  
        echo (popUp("error","", "Problem in Adding New Record.",""));
    }
}

// //===EDIT EMPLOYEE=====

// //===UPDATE EMPLOYEE=====

?>