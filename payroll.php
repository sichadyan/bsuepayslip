<?php 
    $_HeaderTitle = 'Upload Payroll'; 
?> 

<?php 
  include 'helpers/header.php'; 
  include 'helpers/helper.php';
  include 'helpers/crud.php';



$users_employee = _getAllData('payroll_details');
$empdataList = array(); // empty array
if ($users_employee != null && $users_employee['count'] != 0){       
    $empdataList = $users_employee['data'];
}
else{
    $empdataList = null;
}

?>

  





    <p><!-- Main content -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" re="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!------ Include the above in your HEAD tag ---------->


<div class="container">

  <div class="content">
          <div class="container-fluid">
              <div class="card card-success">
                  <div class="card-header">
                      <button type="button" class="btn btn-sm btn-default float-right" data-toggle="modal" data-target="#payrollModal"><i class="fa fa-plus"></i>Upload File</button>
                  </div>
                  <div class="card-body">
                      <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable">
                          <thead>
                              <tr>
                                  <th>Action</th>
                                  <th>Sheet Name</th>
                                  <th>For Month of</th>
                                  <th>In the Year of</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                              // DO LOOP HERE
                              // var_dump($empdataList);
                              if ($empdataList == null){
                                  echo '<tr><td colspan="9" class="text-center">-- No Records Found! --</td></tr>';
                              }
                              else{
                                  foreach ($empdataList as $row){
                                      echo '<tr>';
                                      echo '<td><div class="btn-group"><a href="payroll_details.php?title='. $row["title"] .'" class="btn btn-sm btn-primary">Details</a></div></td>';
                                      echo '<td>'. $row["title"] .'</td>';
                                      echo '<td>'. $row["month"] .'</td>';
                                      echo '<td>'. $row["year"] .'</td>';
                                  
                                      echo '</tr>';
                                  }
                              } 
                              ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
    </div>
  </div>
</div> 

<div id="payrollModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form id="upload_form" method="post" enctype="multipart/form-data">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Upload Payroll Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Upload File</strong></div>
                        <div class="panel-body">

                          <!-- Standar Form -->
                          <h4>Select excel file from your computer</h4>
                            <div class="form-inline">
                              <div class="form-group">
                                  <input type="text" name="month">
                                <input type="file" name="excel_payroll" id="file">
                              </div>
                            </div><br>
                          </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                         <button name="import_payroll" type="submit" class="btn btn-sm btn-primary" onclick="uploadFile()" value="Upload File">Upload file</button>
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


  <?php include 'helpers/footer.php'; ?>



  <?php 
if(isset($_POST["import_payroll"])){
   $filename = explode(".", $_FILES["excel_payroll"]["name"]);
   $extension = end($filename); // For getting Extension of selected file
   $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
    if(in_array($extension, $allowed_extension)){
        $file = $_FILES["excel_payroll"]["tmp_name"]; 
  
     include("plugins/PHPExcel/Classes/PHPExcel.php"); 
     include("plugins/PHPExcel/Classes/PHPExcel/IOFactory.php");
     $objPHPExcel = PHPExcel_IOFactory::load($file);
     $sheetCount = 4;
     
       for($i = 0; $i <= $sheetCount; $i++) {
        $objPHPExcel->setActiveSheetIndex($i);
        $sheetInsertData   = $objPHPExcel->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
        $sheetName = $objPHPExcel->getActiveSheet()->getTitle();
        $numOfDataUploaded = 0;


        if($i == 2) {

          foreach($sheetInsertData as $j => $col) {
            if($j > 2) {
              #LEDGER ID 
              $a  = $col["A"]."|";
              $aa = explode("|", $a);

              #EMPLOYEE ID 
              $b  = $col["B"]."|";
              $bb = explode("|", $b);

              #FIRSTNAME
              $c  = $col["C"]."|";
              $cc = explode("|", $c);

              #MIDDLENAME
              $d  = $col["D"]."|";
              $dd = explode("|", $d);

              #LASTNAME
              $e  = $col["E"]."|";
              $ee = explode("|", $e);

              #Department
              $f  = $col["F"]."|";
              $ff = explode("|", $f);

              #Position
              $g  = $col["G"]."|";
              $gg = explode("|", $g);

              #MONTHLY SALARY
              $h  = $col["H"]."|";
              $hh = explode("|", $h);

              #AMOUNT EARNED
              $amount_earned  = $col["I"]."|";
              $amnt_earned = explode("|", $amount_earned);

              #ABSENCES w/o PAY
              $absences_w_pay  = $col["J"]."|";
              $awp = explode("|", $absences_w_pay);

              #WITHHOLDING TAX
              $k  = $col["K"]."|";
              $kk = explode("|", $k);

              #PAG IBIG CONTRIBUTION
              $l  = $col["L"]."|";
              $ll = explode("|", $l);

              #PAG IBIG LOAN
              $m  = $col["M"]."|";
              $mm = explode("|", $m);

              #PAG IBIG CALAMITY LOAN
              $n  = $col["N"]."|";
              $nn = explode("|", $n);

              #SKAPAPA CCI
              $o  = $col["O"]."|";
              $oo = explode("|", $o);

              #EMPLOYEE Asso. Dues
              $p  = $col["P"]."|";
              $pp = explode("|", $p);

              #LANDBANK LOAN
              $q  = $col["Q"]."|";
              $qq = explode("|", $q);

              #OVER PAYMENT
              $r  = $col["R"]."|";
              $rr = explode("|", $r);

              #VALUE CARE
              $s  = $col["S"]."|";
              $ss = explode("|", $s);


              for($x = 0; $x < count($aa); $x++) {
                $emp_id = _getAllDataByParam('user','employeeid="' . $bb[$x] . "\"");
                     if ($emp_id != null && $emp_id['count'] != 0){
                         $id_emp = $emp_id["data"][0]['id'];
                      }
                if(trim($aa[$x]) != ''){
                    $month = date('F');
                          #SAVING OF SALARY
                          $createddate= date("Y-m-d H:i:s");
                          $tablename_salary       = 'salary_info';
                          $tablecolumns_salary    = 'user_id, amount, date_created, for_month_of, indicator';
                          $columvalues_salary     = "'$id_emp','$hh[$x]','$createddate', '$month', '$sheetName'";
                          $result_salary    = _saveData($tablename_salary,$tablecolumns_salary,$columvalues_salary);

                          #SAVING OF DEDUCTION
                          $tablename_deduction    = 'deduction_info';
                          $tablecolumns_deduction   = 'user_id,absences_without_pay, withholding_tax, pagibig_cont  , pagibig_load, pagibig_calamity_loan, skapapa_cci, emp_asso_due, landbank_loan, over_payment, value_care, for_month_of, indicator';
                          $columvalues_deduction    = "'$id_emp','$awp[$x]','$kk[$x]','$ll[$x]','$mm[$x]','$nn[$x]','$oo[$x]','$pp[$x]','$qq[$x]','$rr[$x]','$ss[$x]', '$month', '$sheetName'";
                          $result_deduction     = _saveData($tablename_deduction,$tablecolumns_deduction,$columvalues_deduction);

                          // if($result_deduction['data']) { 
                          //       echo (popUp("success","Saved", "Record Saved!","payroll.php"));
                          //   } else {  
                          //       echo (popUp("error","", "Problem in Adding New Record.",""));
                          //   }        
                }
              }
            }
          }   
        #SAVING OF TITLE
        $year = date('Y');
        $month = date('F');
        $tablename_payroll_details = 'payroll_details';
        $tablecolumns_payroll_details = 'title, month, year';
        $columvalues_payroll_details = "'$sheetName', '$month', '$year'";
        $result_payroll_details = _saveData($tablename_payroll_details, $tablecolumns_payroll_details, $columvalues_payroll_details);

        }
      } 
    }
}

  ?>