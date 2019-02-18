<?php 
$_HeaderTitle = 'Department'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';

//== GET EMPLOYEE LIST ==
$department = _getAllData('department');
$deptdataList = array(); // empty array
if ($department != null && $department['count'] != 0){       
    $deptdataList = $department['data'];
}
else{
    $deptdataList = null;

    
}
//  var_dump ($department);
?>
<!-- Main content -->

<div class="content">
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-default float-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Add Department</button>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable">
                    <thead>
                        <tr>
                            <th>Action              
                            </th>
                            <th>Department
                            </th>
                            <th>Description
                            </th>
                            <th>Created By
                            </th>
                            <th>Created Date
                            </th>
                            <th>Modified By
                            </th>
                            <th>Modified Date
                            </th>
                            <th>IsActive
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //DO LOOP HERE
                        //var_dump($deptdataList);
                        if ($deptdataList == null){
                            echo '<tr><td colspan="8" class="text-center">-- No Records Found! --</td></tr>';
                        }
                        else{
                            foreach ($deptdataList as $row){
                                echo '<tr>';
                                echo '<td><div class="btn-group"><a href="departmentedit.php?id='. $row["id"] .'" class="btn btn-sm btn-primary">Edit</a><form method="post"><button type="submit" onclick="return confirm(\'Are you sure you want to delete this?\');" class="btn btn-sm btn-danger" name="btnDelete" id="btnDelete" value="'. $row["id"].'">Delete</button></form></div></td>';
                                echo '<td>'. $row["departmentname"] .'</td>';
                                echo '<td>'. $row["departmentdescription"] .'</td>';
                                echo '<td>'. $row['createdby'] .'</td>';
                                echo '<td>'. $row['createddate'] .'</td>';
                                echo '<td>'. $row['modifiedby'] .'</td>';
                                echo '<td>'. $row['modifieddate'] .'</td>';
                                echo '<td>'. $row['isactive'] .'</td>';
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
                    <h4 class="modal-title">Add New Department</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="text" id="Departmentname" name="Departmentname" class="form-control" placeholder="Department name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" id="Departmentdescription" autocomplete="off" name="Departmentdescription" class="form-control" placeholder="Department description" />
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
//===SAVE NEW DEPARTMENT=====
if (ISSET($_POST["btnSubmit"])){
    $departmentname=$_POST['Departmentname'];
    $departmentdescription= $_POST['Departmentdescription'];
    $createdby= formatFullName('fml', $_SESSION["isLogin"]['firstname'], $_SESSION["isLogin"]['middlename'], $_SESSION["isLogin"]['lastname']);
    $createddate= date("Y-m-d H:i:s");

    $tablename = 'department';
    $tablecolumns = 'departmentname, 
                  departmentdescription,
                  createdby, 
                  createddate,
                  isactive
                  ';
    $columvalues =  "'$departmentname',
                  '$departmentdescription',
                  '$createdby',
                  '$createddate',
                  1
                  ";

    $result = _saveData($tablename,$tablecolumns,$columvalues);
    if($result['data']) { 
        echo (popUp("success","Saved", "(" . $result['count'] . ") Record Saved!","department.php"));
    } else {  
        echo (popUp("error","", "Problem in Adding New Record.",""));
    }
}

//===EDIT DEPARTMENT=====
//NEW PAGE

//===DELETE DEPARTMENT=====
else if (ISSET($_POST["btnDelete"])) {
    $rowID = $_POST["btnDelete"];
    //echo("<script>alert('". $rowID ."')</script>");
    $result = _removeData('department','id=' . $rowID);
    var_dump($result);
    if ($result != null && $result['count'] != 0){       
        echo (popUp("success","Deleted!","(" . $result['count'] . ") Item Deleted!!","department.php"));
    }
    else{
        echo (popUp("error","", "Problem in Deleting Record.",""));
    }

}


?>