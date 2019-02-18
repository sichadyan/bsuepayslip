<?php 
$_HeaderTitle = 'Department Update'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';


if (isset($_GET['id'])) {
    //== GET EMPLOYEE LIST ==
    $department = _getAllDataByParam('department','id=' . $_GET['id']);
    
    //var_dump($department);
    $deptdataList = array(); // empty array
    if ($department != null && $department['count'] != 0){       
        $deptdataList = $department['data'][0];
    }
    else{
        $deptdataList = null;
    }
}
else{
    
}


//  var_dump ($department);
?>
<!-- Main content -->
<form method="post">
    <div class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <span>Edit Department&nbsp;<i class="fas fa-angle-double-right"></i>&nbsp;<strong><?php echo getDepartmentName($deptdataList["id"]); ?></strong></span>
                    <div class="btn-group float-right">
                        <button class="btn btn-primary btn-sm" id="btnUpdate" name="btnUpdate">Update</button>
                        <a href="department.php" class="btn btn-sm btn-default float-right" style="color: black;">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php 
                            echo '
                <input type="hidden" id="_id" name="_id" value="'. $deptdataList["id"] .'"/>
                <label for="departmentname" class="label">Department Name</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" id="departmentname" name="departmentname" value="'. $deptdataList["departmentname"] .'" class="form-control" placeholder="Department Name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="departmentdescription" class="label">Department Description</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" id="departmentdescription" name="departmentdescription" value="'. $deptdataList["departmentdescription"] .'" class="form-control" placeholder="Department Description" />
                </div>';

                echo '
                <label for="isactive" class="label">Status</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-edit"></i></span>
                    </div>
                    <select id="isactive" name="isactive" class="form-control dropdown" required>
                      <option value="">[Select Status]</option>  
                      <option '. (strpos($deptdataList["isactive"],"1") !== 0 ? "selected" : "")  .' value="1">Disabled</option>
                      <option '. (strpos($deptdataList["isactive"],"0") !== 0 ? "selected" : "")  .' value="0">Enabled</option>
                  </select>
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
    $departmentname=$_POST['departmentname'];
    $departmentdescription=$_POST['departmentdescription'];
    $modifiedby= formatFullName('fml', $_SESSION["isLogin"]['firstname'], $_SESSION["isLogin"]['middlename'], $_SESSION["isLogin"]['lastname']);
    $modifieddate= date("Y-m-d H:i:s");   
    $isactive = $_POST['isactive'];
    
    $tablename = 'department';
    $columvalues =  "departmentname='$departmentname',
                    departmentdescription='$departmentdescription',
                    isactive='$isactive',
                    modifiedby='$modifiedby',
                    modifieddate='$modifieddate'";
    $filter= "id='$_id'";

    $result = _updateData($tablename,$columvalues,$filter);
    if($result['data']) { 
        echo (popUp("success","Updated!", "(" . $result['count'] . ") Record Updated!","department.php"));
    } else {  
        echo (popUp("error","", "Problem in Adding New Record.",""));
    }
}

?>