<?php 
$_HeaderTitle = 'Deduction Type Update'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';


if (isset($_GET['id'])) {
    //== GET EMPLOYEE LIST ==
    $deduction = _getAllDataByParam('deduction','id=' . $_GET['id']);
    
    //var_dump($deduction);
    $deducdataList = array(); // empty array
    if ($deduction != null && $deduction['count'] != 0){       
        $deducdataList = $deduction['data'][0];
    }
    else{
        $deducdataList = null;
    }
}
else{
    
}


//  var_dump ($deduction);
?>
<!-- Main content -->
<form method="post">
    <div class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <span>Edit Deduction&nbsp;<i class="fas fa-angle-double-right"></i>&nbsp;<strong><?php echo getDeductionName($deducdataList["id"]); ?></strong></span>
                    <div class="btn-group float-right">
                        <button class="btn btn-primary btn-sm" id="btnUpdate" name="btnUpdate">Update</button>
                        <a href="deductions.php" class="btn btn-sm btn-default float-right" style="color: black;">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php 
                            echo '
                <input type="hidden" id="_id" name="_id" value="'. $deducdataList["id"] .'"/>
                <label for="deductionname" class="label">Deduction Name</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" id="deductionname" name="deductionname" value="'. $deducdataList["deductionname"] .'" class="form-control" placeholder="deduction Name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';
                            
                            echo '
                <label for="deductiondescription" class="label">Description</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" id="deductiondescription" name="deductiondescription" value="'. $deducdataList["description"] .'" class="form-control" placeholder="deduction Description" />
                </div>';

                            echo '
                <label for="deductionammount" class="label">Amount</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    
                      <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                    </div>
                    <input type="number" id="deductionammount" name="deductionammount" min="0" max="100000" step=".01" class="form-control" placeholder="Ammount" value="'. $deducdataList["amount"] .'" required /><span class="bg-danger col-valign-center">&nbsp;</span>
                </div>';

                echo '
                <label for="isactive" class="label">Status</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-edit"></i></span>
                    </div>
                    <select id="isactive" name="isactive" class="form-control dropdown" required>
                      <option value="">[Select Status]</option>  
                      <option '. (strpos($deducdataList["isactive"],"1") !== 0 ? "selected" : "")  .' value="1">Disabled</option>
                      <option '. (strpos($deducdataList["isactive"],"0") !== 0 ? "selected" : "")  .' value="0">Enabled</option>
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
    $deductionname=$_POST['deductionname'];
    $deductiondescription=$_POST['deductiondescription'];
    $deductionammount=$_POST['deductionammount'];
    $modifiedby= formatFullName('fml', $_SESSION["isLogin"]['firstname'], $_SESSION["isLogin"]['middlename'], $_SESSION["isLogin"]['lastname']);
    $modifieddate= date("Y-m-d H:i:s");   
    $isactive = $_POST['isactive'];
    
    $tablename = 'deduction';
    $columvalues =  "deductionname='$deductionname',
                    description='$deductiondescription',
                    amount='$deductionammount',
                    isactive='$isactive',
                    modifiedby='$modifiedby',
                    modifieddate='$modifieddate'";
    $filter= "id='$_id'";

    $result = _updateData($tablename,$columvalues,$filter);
    if($result['data']) { 
        echo (popUp("success","Updated!", "(" . $result['count'] . ") Record Updated!","deductions.php"));
    } else {  
        echo (popUp("error","", "Problem in Adding New Record.",""));
    }
}

?>