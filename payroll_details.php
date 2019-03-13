<?php
$_HeaderTitle = 'Employee List'; 
require_once('plugins/tcpdf/tcpdf.php');
 include 'config/config.php';

if (isset($_GET['title'])) {
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
	}
	$indicator = $_GET['title'];
	$result = mysql_query("SELECT * FROM deduction_info as a INNER JOIN  salary_info as b ON a.user_id = b.user_id WHERE a.indicator = '$indicator'");
		if($result)
		{
			include 'table_design.php';
		    while($row = mysql_fetch_array($result))
		    {	
		    	$id = $row['user_id'];
		    	$user_data = mysql_query("SELECT * FROM user as a INNER JOIN department as b ON a.departmentid = b.id INNER JOIN position as c ON a.positionid = c.id WHERE a.id = '$id'");
		    	if($user_data){
		    		 while($row_user = mysql_fetch_array($user_data)){
		    		 	$html .='
							<tr>
							<td align="center" border="1">'.$row_user["idnumber"].'</td>
							<td align="center" border="1">'.$row_user["departmentname"].'</td>
							<td align="center" border="1">'.$row_user["firstname"].' '.$row_user["middlename"].' '.$row_user["lastname"].'</td>
							<td align="center" border="1">'.$row_user["positionname"].'</td>
							<td align="center" border="1">'.$row_user["employeeid"].'</td>
							<td align="center" border="1">'.$row["amount"].'</td>
							<td align="center" border="1">TBD</td>
							<td align="center" border="1">'.$row["absences_without_pay"].'</td>
							<td align="center" border="1">'.$row["withholding_tax"].'</td>
							<td align="center" border="1">'.$row["pagibig_cont"].'</td>
							<td align="center" border="1">'.$row["pagibig_load"].'</td>
							<td align="center" border="1">'.$row["pagibig_calamity_loan"].'</td>
							<td align="center" border="1">'.$row["skapapa_cci"].'</td>
							<td align="center" border="1">'.$row["emp_asso_due"].'</td>
							<td align="center" border="1">'.$row["landbank_loan"].'</td>
							<td align="center" border="1">'.$row["over_payment"].'</td>
							<td align="center" border="1">'.$row["value_care"].'</td>
							</tr>';
		    		 }
		    	}
    			
		    	
					
		    }

	    	$html .= '
					</table>
					</body>
					</html>';
		} else {
		    echo 'Invalid query: ' . mysql_error() . "\n";
		    echo 'Whole query: ' . $result; 
		}	



$width = 1756;  
$height = 266; 
$pageLayout = array($width, $height); //  or array($height, $width) 
$pdf = new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false); 
$pdf->SetFont('helvetica', '', 9);
$pdf->AddPage('L', 'A4');
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->lastPage();
$pdf->Output('htmlout.pdf', 'I');

}


?>