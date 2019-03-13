<?php 
$_HeaderTitle = 'Deduction Type Setup'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';

//== GET EMPLOYEE LIST ==
$deduction = _getAllData('deduction');
$deducdataList = array(); // empty array
if ($deduction != null && $deduction['count'] != 0){       
    $deducdataList = $deduction['data'];
}
else{
    $deducdataList = null;
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
//  var_dump ($deduction);
?>
<!-- Main content -->



<div class="content">
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-default float-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add Deduction Type</button>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Action              
                            </th>
                            <th>Deduction Name
                            </th>
                            <th>Description
                            </th>
                            <th>Amount
                            </th>
                            <th>Created By
                            </th>
                            <th>Created Date
                            </th>
                            <th>Is Active
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            //DO LOOP HERE
                            //var_dump($deducdataList);
                            if ($deducdataList == null){
                                echo '<tr><td colspan="7" class="text-center">-- No Records Found! --</td></tr>';
                            }
                            else{
                                foreach ($deducdataList as $row){
                                    echo '<tr>';
                                    echo '<td><div class="btn-group"><a href="deductionedit.php?id='. $row["id"] .'" class="btn btn-sm btn-primary">Edit</a><form method="post"><button type="submit" onclick="return confirm(\'Are you sure you want to delete this?\');" class="btn btn-sm btn-danger" name="btnDelete" id="btnDelete" value="'. $row["id"].'">Delete</button></form></div></td>';
                                    echo '<td>'. $row["deductionname"] .'</td>';
                                    echo '<td>'. $row["description"] .'</td>';
                                    echo '<td>'. number_format($row["amount"]) .'</td>';
                                    echo '<td>'. $row['createdby'] .'</td>';
                                    echo '<td>'. $row['createddate'] .'</td>';
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
                    <h4 class="modal-title">Add New Deduction Type</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="text" id="deductionname" name="deductionname" class="form-control" placeholder="Deduction Name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="text" id="deductiondesc" name="deductiondesc" class="form-control" placeholder="Description"/>
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
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="number" id="deductionammount" name="deductionammount" min="0" max="100000" step=".01" class="form-control" placeholder="Amount" required /><span class="bg-danger col-valign-center">&nbsp;</span>
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
    $deductionname=$_POST['deductionname'];
    $deductiondescription= $_POST['deductiondesc'];
    $deductionammount= $_POST['deductionammount'];
    $createdby= formatFullName('fml', $_SESSION["isLogin"]['firstname'], $_SESSION["isLogin"]['middlename'], $_SESSION["isLogin"]['lastname']);
    $createddate= date("Y-m-d H:i:s");

    $tablename = 'deduction';
    $tablecolumns = 'deductionname, 
                  description,
                  amount,
                  createdby, 
                  createddate,
                  isactive
                  ';
    $columvalues =  "'$deductionname',
                  '$deductiondescription',
                  '$deductionammount',
                  '$createdby',
                  '$createddate',
                  1
                  ";

    $result = _saveData($tablename,$tablecolumns,$columvalues);
    if($result['data']) { 
        echo (popUp("success","Saved", "(" . $result['count'] . ") Record Saved!","deductions.php"));
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
    $result = _removeData('deduction','id=' . $rowID);
    var_dump($result);
    if ($result != null && $result['count'] != 0){       
        echo (popUp("success","Deleted!","(" . $result['count'] . ") Item Deleted!!","deductions.php"));
    }
    else{
        echo (popUp("error","", "Problem in Deleting Record.",""));
    }

}


?>