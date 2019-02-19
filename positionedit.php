<?php 
$_HeaderTitle = 'Position Update'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';


if (isset($_GET['id'])) {
    //== GET EMPLOYEE LIST ==
    $position = _getAllDataByParam('position','id=' . $_GET['id']);
    
    //var_dump($position);
    $positiondataList = array(); // empty array
    if ($position != null && $position['count'] != 0){       
        $positiondataList = $position['data'][0];
    }
    else{
        $positiondataList = null;
    }
}
else{
    
}


//  var_dump ($position);
?>
<!-- Main content -->
<form method="post">
    <div class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <span>Edit Position&nbsp;<i class="fas fa-angle-double-right"></i>&nbsp;<strong><?php echo getPositionName($positiondataList["id"]); ?></strong></span>
                    <div class="btn-group float-right">
                        <button class="btn btn-primary btn-sm" id="btnUpdate" name="btnUpdate">Update</button>
                        <a href="position.php" class="btn btn-sm btn-default float-right" style="color: black;">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php 
                            echo '
                <input type="hidden" id="_id" name="_id" value="'. $positiondataList["id"] .'"/>
                <label for="positionname" class="label">Position Name</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" id="positionname" name="positionname" value="'. $positiondataList["positionname"] .'" class="form-control" placeholder="position Name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="positiondescription" class="label">Position Description</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" id="positiondescription" name="positiondescription" value="'. $positiondataList["positiondescription"] .'" class="form-control" placeholder="position Description" />
                </div>';

                echo '
                <label for="isactive" class="label">Status</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-edit"></i></span>
                    </div>
                    <select id="isactive" name="isactive" class="form-control dropdown" required>
                      <option value="">[Select Status]</option>  
                      <option '. (strpos($positiondataList["isactive"],"1") !== 0 ? "selected" : "")  .' value="1">Disabled</option>
                      <option '. (strpos($positiondataList["isactive"],"0") !== 0 ? "selected" : "")  .' value="0">Enabled</option>
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
    $positionname=$_POST['positionname'];
    $positiondescription=$_POST['positiondescription'];
    $modifiedby= formatFullName('fml', $_SESSION["isLogin"]['firstname'], $_SESSION["isLogin"]['middlename'], $_SESSION["isLogin"]['lastname']);
    $modifieddate= date("Y-m-d H:i:s");   
    $isactive = $_POST['isactive'];
    
    $tablename = 'position';
    $columvalues =  "positionname='$positionname',
                    positiondescription='$positiondescription',
                    isactive='$isactive',
                    modifiedby='$modifiedby',
                    modifieddate='$modifieddate'";
    $filter= "id='$_id'";

    $result = _updateData($tablename,$columvalues,$filter);        
    if($result['data']) { 
        echo (popUp("success","Updated!", "(" . $result['count'] . ") Record Updated!","position.php"));
    } else {  
        echo (popUp("error","", "Problem in Adding New Record.",""));
    }
}

?>