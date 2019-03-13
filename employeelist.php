<?php 
$_HeaderTitle = 'Employee List'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';

//== GET EMPLOYEE LIST ==
$users_employee = _getAllData('user');
$empdataList = array(); // empty array
if ($users_employee != null && $users_employee['count'] != 0){       
    $empdataList = $users_employee['data'];
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
//  var_dump ($users_employee);
?>
<!-- Main content -->

<div class="content">
    <div class="container-fluid" >
        <div class="card card-success" >
            <div class="card-header" style="background-color:  #800000;">
                <button type="button" class="btn btn-sm btn-default float-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Add Employee</button>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable">
                    <thead>
                        <tr>
                            <th>Action
                            </th>
                            <th>ID#
                            </th>
                            <th>Role
                            </th>
                            <th>Full Name
                            </th>
                            <th>Department
                            </th>
                            <th>Position
                            </th>
                            <th>Gender
                            </th>
                            <th>Created By
                            </th>
                            <th>Created Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //DO LOOP HERE
                        //var_dump($empdataList);
                        if ($empdataList == null){
                            echo '<tr><td colspan="9" class="text-center">-- No Records Found! --</td></tr>';
                        }
                        else{
                            foreach ($empdataList as $row){
                                echo '<tr>';
                                echo '<td><div class="btn-group"><a href="employeeedit.php?id='. $row["id"] .'" class="btn btn-sm btn-primary">Edit</a><a href="employeeedit.php?id='. $row["id"] .'" class="btn btn-sm btn-info">Details</a><form method="post"><button type="submit" onclick="return confirm(\'Are you sure you want to delete this?\');" class="btn btn-sm btn-danger" name="btnDelete" id="btnDelete" value="'. $row["id"].'">Delete</button></form></div></td>';
                                echo '<td>'. $row["idnumber"] .'</td>';
                                echo '<td>'. getRoleName($row['roleid']) .'</td>';
                                echo '<td>'. formatFullName('lfm',$row['firstname'],$row['middlename'],$row['lastname']) .'</td>';
                                echo '<td>'. getDepartmentName($row['departmentid']) .'</td>';
                                echo '<td>'. getPositionName($row['positionid']) .'</td>';
                                echo '<td>'. $row['gender'] .'</td>';
                                echo '<td>'. $row['createdby'] .'</td>';
                                echo '<td>'. $row['createddate'] .'</td>';
                                echo '</tr>';
                            }
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Add New Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Note: Newly Created Account's Password will be in this format:</p>
                    <p>Password format: <u>your lastname</u>&nbsp;&nbsp;+&nbsp;&nbsp; <u>your idnumber</u></p>
                    <p>
                        <i>(ex. delacruz123456)</i>
                    <p>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" id="idnumber" name="idnumber" class="form-control" placeholder="ID Ledger" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middle Name">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" id="birthdate" autocomplete="off" name="birthdate" class="form-control" placeholder="Birthdate" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-transgender"></i></span>
                            </div>
                            <select id="gender" name="gender" class="form-control dropdown" required>
                                <option value="">[Select Gender]</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-list-ul"></i></span>
                            </div>
                            <select id="departmentid" name="departmentid" class="form-control dropdown" required>
                                <option value="">[Select Department]</option>
                                <?php 
                                foreach ($deptdataList as $row){
                                    echo '<option value="'. $row["id"] .'">' . $row["departmentname"] .'</option>';
                                }
                                ?>
                            </select><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-list"></i></span>
                            </div>
                            <select id="positionid" name="positionid" class="form-control dropdown" required>
                                <option value="">[Select Position]</option>
                                <?php 
                                foreach ($positiondataList as $row){
                                    echo '<option value="'. $row["id"] .'">' . $row["positionname"] .'</option>';
                                }
                                ?>
                            </select><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-address-card"></i></span>
                            </div>
                            <textarea id="address" name="address" class="textarea form-control" cols="1" rows="3" placeholder="Home Address"></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            </div>
                            <input type="text" id="phonenumber" name="phonenumber" class="form-control" placeholder="Mobile Number" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="email" id="emailadd" name="emailadd" class="form-control" placeholder="Email Address" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-sm btn-success">Save</button>
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'helpers/footer.php'; ?>
<?php 
//===SAVE NEW EMPLOYEE=====
if (ISSET($_POST["btnSubmit"])){
    $roleid='1';
    $idnumber=$_POST['idnumber'];
    //Passwordformat: lastname + idnumber
    $password= md5($_POST['lastname'] . $_POST['idnumber']);
    $firstname=$_POST['firstname'];
    $middlename=$_POST['middlename'];
    $lastname=$_POST['lastname'];
    $birthdate= date("Y-m-d",strtotime($_POST['birthdate']));
    $gender=$_POST['gender'];
    $departmentid=$_POST['departmentid'];
    $positionid=$_POST['positionid'];
    $address=$_POST['address'];
    $contactnumber=$_POST['phonenumber'];
    $emailadd=$_POST['emailadd'];
    $createdby= $_SESSION["isLogin"]['lastname'] . $_SESSION["isLogin"]['firstname'];
    $createddate= date("Y-m-d H:i:s");
    $isactive = 1;

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
    $data = _getAllDataByParam('user','idnumber="' . $idnumber . "\"");

    if ($data != null && $data['count'] != 0){
        echo (popUp("error","", "Problem in Adding New Record. Employee id already exist!",""));
    }
    else{
        $result = _saveData($tablename,$tablecolumns,$columvalues);
        if($result['data']) { 
            echo (popUp("success","Saved", "(" . $result['count'] . ") Record Saved!","employeelist.php"));
        } else {  
            echo (popUp("error","", "Problem in Adding New Record.",""));
        }
    }
}

//===EDIT EMPLOYEE=====
//REDIRECT TO ANOTHER PAGE
//===DELETE EMPLOYEE=====
else if (ISSET($_POST["btnDelete"])) {
    $rowID = $_POST["btnDelete"];
    //echo("<script>alert('". $rowID ."')</script>");
    $result = _removeData('user','id=' . $rowID);
    var_dump($result);
    if ($result != null && $result['count'] != 0){       
        echo (popUp("success","Deleted!","(" . $result['count'] . ") Item Deleted!!","employeelist.php"));
    }
    else{
        echo (popUp("error","", "Problem in Deleting Record.",""));
    }

}



?>

