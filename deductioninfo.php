<?php 
$_HeaderTitle = 'Deduction Info'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';

//== GET EMPLOYEE LIST ==
$users_deduction = _getAllDataByParam('user_deduction_config','id=' . $_GET['id']);
$userdeducdataList = array(); // empty array
if ($users_deduction != null && $users_deduction['count'] != 0){       
    $userdeducdataList = $users_deduction['data'];
}
else{
    $userdeducdataList = null;
}

//== GET DEDUCTION LIST ==
$deductionconfig = _getAllData('deduction');
$deductdataList = array(); // empty array
if ($deductionconfig != null && $deductionconfig['count'] != 0){       
    $deductdataList = $deductionconfig['data'];
}
else{
    $deductdataList = null;
}

?>
<!-- Main content -->

<div class="content">
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-default float-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add Deduction</button>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable">
                    <thead>
                        <tr>
                            <th>Action
                            </th>
                            <th>Deduction Code
                            </th>
                            <th>Deductions
                            </th>
                            <th>Amount
                            </th>
                            <th>Remarks
                            </th>
                            <th>Deduction Start Date
                            </th>
                            <th>Deduction End Date
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
                        //var_dump($userdeducdataList);
                        if ($userdeducdataList == null){
                            echo '<tr><td colspan="9" class="text-center">-- No Records Found! --</td></tr>';
                        }
                        else{
                            foreach ($userdeducdataList as $row){
                                echo '<tr>';
                                echo '<td><div class="btn-group"><a href="deductionuserupdate.php?id='. $row["id"] .'" class="btn btn-sm btn-primary">Edit</a><form method="post"><button type="submit" onclick="return confirm(\'Are you sure you want to delete this?\');" class="btn btn-sm btn-danger" name="btnDelete" id="btnDelete" value="'. $row["id"].'">Delete</button></form></div></td>';
                                echo '<td>'. $row["deductionid"] .'</td>';
                                echo '<td>'. $row["deductionname"] .'</td>';
                                echo '<td>'. $row["description"] .'</td>';
                                echo '<td>'. $row["ammount"] .'</td>';
                                echo '<td>'. $row["remarks"] .'</td>';
                                echo '<td>'. $row["deductiondatestart"] .'</td>';
                                echo '<td>'. $row["deductiondateend"] .'</td>';
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
                    <h4 class="modal-title">Add New Deduction</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
              <div class="modal-body">        
                    
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-list-ul"></i></span>
                            </div>
                            <select id="departmentid" name="departmentid" class="form-control dropdown" required>
                                <option value="">[Select Deduction Type]</option>
                                <?php 
                                foreach ($deductdataList as $row){
                                    echo '<option value="'. $row["id"] .'">' . $row["deductionname"] .'   (P'. number_format($row["amount"]) .')</option>';
                                }
                                ?>
                            </select><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>
                            

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Remarks" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>

                <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" id="deductiondatestart" name="deductiondatestart" class="form-control" placeholder="Deduction Date Start" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                        </div>
                        
                <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" id="deductiondateend" name="deductiondateend" class="form-control" placeholder="Deduction Date End" required /><span class="bg-danger col-valign-center">&nbsp;</span>
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
    $deductionconfigid=$_POST['departmentid'];
    $positionid=$_POST['positionid'];
    $address=$_POST['address'];
    $contactnumber=$_POST['phonenumber'];
    $emailadd=$_POST['emailadd'];
    $createdby= formatFullName('fml',$_POST['firstname'],$_POST['middlename'],$_POST['lastname']);
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
                  '$deductionconfigid',
                  '$positionid',
                  '$address',
                  '$contactnumber',
                  '$emailadd',
                  '$createdby',
                  '$createddate'
                  ";

    $result = _saveData($tablename,$tablecolumns,$columvalues);
    if($result['data']) { 
        echo (popUp("success","Saved", "(" . $result['count'] . ") Record Saved!","employeelist.php"));
    } else {  
        echo (popUp("error","", "Problem in Adding New Record.",""));
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