<?php 
  $_HeaderTitle = 'Salary'; 

  include 'helpers/header.php';
  include 'helpers/helper.php';
  include 'helpers/crud.php';
  
  //== GET USER LIST ==
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
              <button type="button" class="btn btn-sm btn-default float-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add Salary</button>
              </div>
              <div class="card-body">
                <table width="973" class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable">
                <thead>
                  <th width="71">
                   Action              
                  </th>
                  <th width="60">
                    User id</th>
                  <th width="100">
                    Basic Salary
                  </th>
                  <th width="167">
                    Total salary deduction</th>
                  <th width="79">
                    Net salary
                  </th>
                  <th width="122">
                    Cutoff start date</th>
                  <th width="117">
                    Cutoff end date
                  </th>
                  <th width="94">
                    Created By
                  </th>
                  <th width="123">
                    Created Date
                  </th>
                
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
        <h4 class="modal-title">Add Salary</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

       <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
          </div>
          <input type="text" id="Role name" name="Role name" class="form-control" placeholder="Role name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
      </div>

      <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
          </div>
          <input type="text" id="Role description" autocomplete="off" name="Role description" class="form-control" placeholder="Role description" required /><span class="bg-danger col-valign-center">&nbsp;</span>
          </div>
           <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
          </div>
          <input type="text" id="Role name" name="Role name" class="form-control" placeholder="Role name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
      </div>

      <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
          </div>
          <input type="text" id="Role description" autocomplete="off" name="Role description" class="form-control" placeholder="Role description" required /><span class="bg-danger col-valign-center">&nbsp;</span>
          </div>
           <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
          </div>
          <input type="text" id="Role name" name="Role name" class="form-control" placeholder="Role name" required /><span class="bg-danger col-valign-center">&nbsp;</span>
      </div>

      <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
          </div>
          <input type="text" id="Role description" autocomplete="off" name="Role description" class="form-control" placeholder="Role description" required /><span class="bg-danger col-valign-center">&nbsp;</span>
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
  $roleid='1';
  $idnumber=$_POST['idnumber'];
  //Passwordformat: idnumber + lastname + birthdate(mmddyy)
  $password= md5($_POST['departmentname'] . $_POST['idnumber']);
  $firstname=$_POST['departmentdescription'];
  $createdby= formatFullName('fml',$_POST['firstname'],$_POST['middlename'],$_POST['lastname']);
  $createddate= date("Y-m-d H:i:s");
  $isactive = 1;

  $tablename = 'department';
  $tablecolumns = '
                  idnumber, 
                  departmentname, 
                  departmentdescription,
                  createdby, 
                  createddate';
  $columvalues =  "'$idnumber',
                  '$departmentname',
                  '$departmentdescription',
                  '$createdby',
                  '$createddate'
                  ";

  $result = _saveData($tablename,$tablecolumns,$columvalues);
if($result['data']) { 
  echo (popUp("success","Saved", "(" . $result['count'] . ") Record Saved!","department.php"));
} else {  
  echo (popUp("error","", "Problem in Adding New Record.",""));
}
}

//===EDIT EMPLOYEE=====

//===UPDATE EMPLOYEE=====


?>