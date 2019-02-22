<?php

$connect = mysqli_connect("localhost", "root", "", "bsuepayslip");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 
# UPLOAD DEPARTMENT 


#UPLOAD STUDENT TYPE
if(isset($_POST["import_payroll"]))
{
 $filename = explode(".", $_FILES["excel_payroll"]["name"]);
 $extension = end($filename); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel_payroll"]["tmp_name"]; 
 	
	
	 include("plugins/PHPExcel/Classes/PHPExcel.php"); 
	 include("plugins/PHPExcel/Classes/PHPExcel/IOFactory.php");
	 include 'helpers/header.php';
	 include 'helpers/helper.php';
	 include 'helpers/crud.php';
	 $objPHPExcel = PHPExcel_IOFactory::load($file);
	 $sheetCount = 1;

	 
	 		for($i = 0; $i <= $sheetCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
				$sheetInsertData   = $objPHPExcel->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
				$numOfDataUploaded = 0;

				if($i == 1) { #UPLOAD PAYROLL DATA
					foreach($sheetInsertData as $j => $col) {
						if($j > 2) {
							#Ledger ID 
							$a  = $col["A"]."|";
							$aa = explode("|", $a);
							
							for($x = 0; $x < count($aa); $x++) {

									// if($aa[$x] != "") {
									// 	$query = "INSERT INTO user_salary_config(userid)
									// 			VALUES(?)";
									// 	$sql = $connect->prepare($query);
									// 	$sql->bind_param("s", $aa[$x]);
									// 	$sql->execute();
									// 	$sql->close();
									// 	}
								}
							}
						}
					}	 
				} 
		 	}
		}

if(isset($_POST["import_employee"]))
{
 $filename = explode(".", $_FILES["excel_employee"]["name"]);
 $extension = end($filename); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel_employee"]["tmp_name"]; 
 	
	
	 include("plugins/PHPExcel/Classes/PHPExcel.php"); 
	 include("plugins/PHPExcel/Classes/PHPExcel/IOFactory.php");
	 include 'helpers/header.php';
	 include 'helpers/helper.php';
	 include 'helpers/crud.php';
	 $objPHPExcel = PHPExcel_IOFactory::load($file);
	 $sheetCount = 2;

	 
	 		for($i = 0; $i <= $sheetCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
				$sheetInsertData   = $objPHPExcel->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
				$numOfDataUploaded = 0;

				if($i == 2) { #UPLOAD PAYROLL DATA
					foreach($sheetInsertData as $j => $col) {
						if($j > 2) {
							#Ledger ID 
							$a  = $col["A"]."|";
							$aa = explode("|", $a);
							#DEPARTMENT
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
							#POSITION
							$f  = $col["F"]."|";
							$ff = explode("|", $f);
							#EMPLOYEE NUMBER
							$g  = $col["G"]."|";
							$gg = explode("|", $g);
							for($x = 0; $x < count($aa); $x++) {
								$data_dept = _getAllDataByParam('department','departmentname="' . $bb[$x] . "\"");
								if ($data_dept != null && $data_dept['count'] != 0) {
									$data_pos = _getAllDataByParam('position','positionname="' . $ff[$x] . "\"");
									if($data_pos != null && $data_pos['count'] != 0){
										$posid  = $data_pos["data"][0]['id'];
									}
										#OTHER DATA NEEDED
										$createdby= $_SESSION["isLogin"]['firstname'] ." ".  $_SESSION["isLogin"]['middlename'] ." ". $_SESSION["isLogin"]['lastname'] ;
										$role = 1;
										$defpassword = md5('password');
										$isactive = 1;
										$createddate= date("Y-m-d H:i:s");
										$deptid = $data_dept["data"][0]['id'];

										$tablename		= 'user';
										$tablecolumns 	= 'roleid,idnumber,employeeid,password,firstname,middlename,lastname,departmentid, positionid, createddate, createdby';
										$columvalues	= "'$role','$aa[$x]','$gg[$x]','$defpassword','$cc[$x]','$dd[$x]','$ee[$x]','$deptid','$posid','$createddate','$createdby'";
										    $result = _saveData($tablename,$tablecolumns,$columvalues);
										    if($result['data']) { 
										        echo (popUp("success","Saved", "(" . $result['count'] . ") Record Saved!","payroll.php"));
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

#UPLOADING OF DEDUCTION TYPE
if(isset($_POST["import_deductions"])){
 $filename = explode(".", $_FILES["excel_deductions"]["name"]);
 $extension = end($filename); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel_deductions"]["tmp_name"]; 
 	
	
	 include("plugins/PHPExcel/Classes/PHPExcel.php"); 
	 include("plugins/PHPExcel/Classes/PHPExcel/IOFactory.php");
	 include 'helpers/header.php';
	 include 'helpers/helper.php';
	 include 'helpers/crud.php';
	 $objPHPExcel = PHPExcel_IOFactory::load($file);
	 $sheetCount = 3;

	 
	 		for($i = 0; $i <= $sheetCount; $i++) {
				$objPHPExcel->setActiveSheetIndex($i);
				$sheetInsertData   = $objPHPExcel->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
				$numOfDataUploaded = 0;

				if($i == 3) { #UPLOAD DEDUCTION TYPE DATA
					foreach($sheetInsertData as $j => $col) {
						if($j > 1) {
							#DEDUCTION NAME
							$a  = $col["A"]."|";
							$aa = explode("|", $a);

							for($x = 0; $x < count($aa); $x++) {
								$data_deduc = _getAllDataByParam('deduction','deductionname="' . $aa[$x] . "\"");
								if ($data_deduc != null && $data_deduc['count'] != 0) {
									$isactive 		= 1;
									$tablename 		= 'deduction';
									$tablecolumns 	= 'deductionname';
									$columvalues	= "'$aa[$x]'";
									$result 		= _saveData($tablename,$tablecolumns,$columvalues);
										if($result['data']) {
										        echo (popUp("success","Saved", "(" . $result['count'] . ") Record Saved!","payroll.php"));
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