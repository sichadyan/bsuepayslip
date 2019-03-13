<?php

$connect = mysqli_connect("localhost", "root", "", "bsuepayslip");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 


if(isset($_POST["import_payroll"])){
	 $filename = explode(".", $_FILES["excel_payroll"]["name"]);
	 $extension = end($filename); // For getting Extension of selected file
	 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
	  if(in_array($extension, $allowed_extension)){
	  	  $file = $_FILES["excel_payroll"]["tmp_name"]; 
 	
		 include("plugins/PHPExcel/Classes/PHPExcel.php"); 
		 include("plugins/PHPExcel/Classes/PHPExcel/IOFactory.php");
		 // include 'helpers/header.php';
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
							$a 	= $col["A"]."|";
							$aa = explode("|", $a);

							#EMPLOYEE ID 
							$b 	= $col["B"]."|";
							$bb	= explode("|", $b);

							#FIRSTNAME
							$c 	= $col["C"]."|";
							$cc = explode("|", $c);

							#MIDDLENAME
							$d 	= $col["D"]."|";
							$dd = explode("|", $d);

							#LASTNAME
							$e 	= $col["E"]."|";
							$ee = explode("|", $e);

							#Department
							$f  = $col["F"]."|";
							$ff = explode("|", $f);

							#Position
							$g 	= $col["G"]."|";
							$gg = explode("|", $g);

							#MONTHLY SALARY
							$h 	= $col["H"]."|";
							$hh = explode("|", $h);

							#AMOUNT EARNED
							$amount_earned 	= $col["I"]."|";
							$amnt_earned = explode("|", $amount_earned);

							#ABSENCES w/o PAY
							$absences_w_pay  = $col["J"]."|";
							$awp = explode("|", $absences_w_pay);

							#WITHHOLDING TAX
							$k	= $col["K"]."|";
							$kk = explode("|", $k);

							#PAG IBIG CONTRIBUTION
							$l 	= $col["L"]."|";
							$ll = explode("|", $l);

							#PAG IBIG LOAN
							$m 	= $col["M"]."|";
							$mm = explode("|", $m);

							#PAG IBIG CALAMITY LOAN
							$n 	= $col["N"]."|";
							$nn = explode("|", $n);

							#SKAPAPA CCI
							$o 	= $col["O"]."|";
							$oo = explode("|", $o);

							#EMPLOYEE Asso. Dues
							$p 	= $col["P"]."|";
							$pp = explode("|", $p);

							#LANDBANK LOAN
							$q  = $col["Q"]."|";
							$qq = explode("|", $q);

							#OVER PAYMENT
							$r 	= $col["R"]."|";
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
										#SAVING OF SALARY
										$createddate= date("Y-m-d H:i:s");
										$tablename_salary 			= 'salary_info';
										$tablecolumns_salary 		= 'user_id, amount, date_created, indicator';
										$columvalues_salary 		= "'$id_emp','$hh[$x]','$createddate', '$sheetName'";
										$result_salary 		= _saveData($tablename_salary,$tablecolumns_salary,$columvalues_salary);

										#SAVING OF DEDUCTION
										$tablename_deduction		= 'deduction_info';
										$tablecolumns_deduction		= 'user_id,absences_without_pay, withholding_tax, pagibig_cont	, pagibig_load, pagibig_calamity_loan, skapapa_cci, emp_asso_due, landbank_loan, over_payment, value_care, indicator';
										$columvalues_deduction		= "'$id_emp','$awp[$x]','$kk[$x]','$ll[$x]','$mm[$x]','$nn[$x]','$oo[$x]','$pp[$x]','$qq[$x]','$rr[$x]','$ss[$x]', '$sheetName'";
										$result_deduction			= _saveData($tablename_deduction,$tablecolumns_deduction,$columvalues_deduction);
										if($result_deduction['data']) { 
									        echo (popUp("success","Saved", "(" . $result_deduction['count'] . ") Record Saved!","./payroll.php"));
									    } else {  
									        echo (popUp("error","", "Problem in Adding New Record.",""));
									    }

										
								}
							}
						}
					}		
				}
			}	
	  }
}


?>