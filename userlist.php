<?php 
$_HeaderTitle = 'User Role Assignment'; 

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

//  var_dump ($users_employee);
?>
<!-- Main content -->

<div class="content">
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable" style="width: 100%">
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
                            echo '<tr><td colspan="8" class="text-center">-- No Records Found! --</td></tr>';
                        }
                        else{
                            foreach ($empdataList as $row){
                                echo '<tr>';
                                echo '<td>';
                                echo '<form method="post">';
                                echo '<div class="input-group input-group-sm">';
                                echo '<select id="drpRole" name="drpRole" class="form-control dropdown" required>';
                                echo '<option value="">[Role]</option>';
                                echo '<option value="1">Employee</option>';
                                echo '<option value="0">Administrator</option>'; 
                                echo '</select>';
                                echo '<span class="input-group-append">';
                                echo '<button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-sm btn-success" value="'. $row["id"] .'"><i class="fa fa-floppy"></i> Update</button>';
                                echo '</span>';
                                echo '</div>';
                                echo '</form>';
                                echo '</td>';
                                echo '<td>'. $row["idnumber"] .'</td>';
                                echo '<td><span class="badge bg-'. ((getRoleName($row['roleid']) == "Employee" ? "success" : "primary")) .'">'. getRoleName($row['roleid']) .'</span></td>';
                                echo '<td>'. formatFullName('lfm',$row['firstname'],$row['middlename'],$row['lastname']) .'</td>';
                                echo '<td>'. getDepartmentName($row['departmentid']) .'</td>';
                                echo '<td>'. getPositionName($row['positionid']) .'</td>';
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

<?php include 'helpers/footer.php'; ?>
<?php 
//===SAVE NEW EMPLOYEE=====
if (ISSET($_POST["btnSubmit"])){
    $roleid=$_POST['drpRole'];
    $_id = $_POST["btnSubmit"];
    $modifiedby= formatFullName('fml', $_SESSION["isLogin"]['firstname'], $_SESSION["isLogin"]['middlename'], $_SESSION["isLogin"]['lastname']);
    $modifieddate= date("Y-m-d H:i:s");   

    $tablename = 'user';
    $columvalues =  "roleid='$roleid',
                  modifiedby='$modifiedby',
                  modifieddate='$modifieddate'";
    $filter= "id='$_id'";

    $result = _updateData($tablename,$columvalues,$filter);
    if($result['data']) { 
        echo (popUp("success","Updated!", "(" . $result['count'] . ") Record Updated!","userlist.php"));
    } else {  
        echo (popUp("error","", "Problem in Adding New Record.",""));
    }
}

?>