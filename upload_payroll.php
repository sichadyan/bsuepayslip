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
		 include 'helpers/header.php';

		 $objPHPExcel = PHPExcel_IOFactory::load($file);
	 	 $sheetCount = 4;

	 	 	 for($i = 0; $i <= $sheetCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
				$sheetInsertData   = $objPHPExcel->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
				$sheetName = $objPHPExcel->getActiveSheet()->getTitle();
				$numOfDataUploaded = 0;


				if($i == 1) {
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

								$absent_without = !empty($awp[$x]) ? checkData($awp[$x]): 0;
								$with_tax = !empty($kk[$x]) ? checkData($kk[$x]): 0;
								$pag_ibig_contri = !empty($ll[$x]) ? checkData($ll[$x]): 0;
								$pag_ibig_loan = !empty($mm[$x]) ? checkData($mm[$x]): 0;
								$pag_ibig_calamity = !empty($nn[$x]) ? checkData($nn[$x]): 0;
								$skapapa = !empty($oo[$x]) ? checkData($oo[$x]): 0;
								$emp_dues = !empty($pp[$x]) ? checkData($pp[$x]): 0;
								$land_loan = !empty($qq[$x]) ? checkData($qq[$x]): 0;
								$over_payment = !empty($rr[$x]) ? checkData($rr[$x]): 0;
								$v_care = !empty($ss[$x]) ? checkData($ss[$x]): 0;


 								$total_deduction =  $absent_without + $with_tax + $pag_ibig_contri + $pag_ibig_loan + $pag_ibig_calamity + $skapapa + $emp_dues + $land_loan + $over_payment + $v_care;


								$emp_id = _getAllDataByParam('user','employeeid="' . $bb[$x] . "\"");
										 if ($emp_id != null && $emp_id['count'] != 0){
									       $id_emp = $emp_id["data"][0]['id'];
									       $number = $emp_id["data"][0]['contactnumber'];
									    }

								if(trim($aa[$x]) != ''){
										#SAVING OF SALARY
										$createddate= date("Y-m-d H:i:s");

										$tablename_salary 			= 'salary_info';
										$tablecolumns_salary 		= 'user_id, amount, date_created, amount_earned, total_deduction';
										$columvalues_salary 		= "'$id_emp','$hh[$x]','$createddate','$amnt_earned[$x]', '$total_deduction'";
										$result_salary 		= _saveData($tablename_salary,$tablecolumns_salary,$columvalues_salary,$total_deduction);

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

										$api = "TR-CHARL388930_ZHEXM";
										$mes = "Payslip is available!";
										$send_mes = itexmo($number, $mes, $api);


								}

							}


						}

					}
					echo '<div class="alert alert-success" role="alert">
						  This is a success alert with <a href="payroll.php" class="alert-link">an example link</a>. Give it a click if you like.
						  </div>';
				}
			}

	  }

}


?>
