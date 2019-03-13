<?php 
$output = '';
include("PHPExcel/Classes/PHPExcel.php"); 
include("PHPExcel/Classes/PHPExcel/IOFactory.php");


if(isset($_POST["import_stud_v1"]))
{

		 $excelfile = explode(".", $_FILES["excel_stud_v1"]["name"]); 
		 $extension = end($excelfile);
		 // For getting Extension of selected file
		 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
		 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
		 {

				  $file = $_FILES["excel_stud_v1"]["tmp_name"]; 
				 	
					
					 include("PHPExcel/Classes/PHPExcel.php"); 
					 include("PHPExcel/Classes/PHPExcel/IOFactory.php");
					 $objPHPExcel = PHPExcel_IOFactory::load($file);
					 $sheetCount = 0;

					 
					 		for($i = 0; $i <= $sheetCount; $i++) {

								$objPHPExcel->setActiveSheetIndex($i);
								$sheetInsertData   = $objPHPExcel->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
								$numOfDataUploaded = 0;

							
								if($i == 0) { #UPLOAD STUDENT 
									foreach($sheetInsertData as $j => $col) {
										if($j > 1) {
											#LRN
											$a  = $col["A"]."|";
											$aa = explode("|", $a);

											#ESC ID
											$b  = $col["B"]."|";
											$bb = explode("|", $b);

											#QVR ID
											$c  = $col["C"]."|";
											$cc = explode("|", $c);

											#STUDENT ID
											$d  = $col["D"]."|";
											$dd = explode("|", $d);

											#LASTNAME
											$e  = $col["E"]."|";
											$ee = explode("|", $e);

											#FIRSTNAME
											$f  = $col["F"]."|";
											$ff = explode("|", $f);

											#MIDDLE NAME
											$g  = $col["G"]."|";
											$gg = explode("|", $g);

											#EXTENSION NAME
											$h 	= $col["H"]."|";
											$hh = explode("|", $h);

											#NATIONALITY
											$i 	= $col["I"]."|";
											$ii = explode("|", $i);
	
											for($x = 0; $x < count($aa); $x++) {
												#CODE HERE
											}
										}
									}
								}
							}
		}
}
								
?>

