<?php 
$_HeaderTitle = 'Payslip Details'; 

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


    //== GET EMPLOYEE LIST ==
    $deduction_info = _getAllDataByParam('deduction_info','user_id=' . $_GET['id']);
    
    //var_dump($users_employee);
    $deduction_info_list = array(); // empty array
    if ($deduction_info != null && $deduction_info['count'] != 0){       
        $deduction_info_list = $deduction_info['data'][0];
        

    }
    else{
        $deduction_info_list = null;
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
            <div class="card" >
                <div class="card-header" style="background: #800000;">
                    <span>Payslip for&nbsp;<i class="fas fa-angle-double-right"></i>&nbsp;<?php echo '<strong>'. $deduction_info_list["indicator"] .'</strong>'; ?></span>

                    <div class="btn-group float-right">
                        <a href="printpayslip.php" class="btn btn-sm btn-default float-right" style="color: black;">Print</a>
                        <a href="viewpayslip.php" class="btn btn-sm btn-default float-right" style="color: black;">Back</a>
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


// //===EDIT EMPLOYEE=====

// //===UPDATE EMPLOYEE=====

?>