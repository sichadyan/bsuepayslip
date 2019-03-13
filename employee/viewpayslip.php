<?php 
    $_HeaderTitle = 'View Payslip'; 
?> 

<?php include 'helpers/header.php'; 
 	  include 'helpers/crud.php'; 
#GET DEDUCTION INFO
$deduction_id = $_SESSION["isLogin"]['id'];
$deduction_info = _getAllDataByParam('deduction_info','user_id="' . $deduction_id . "\"");
$empdataList = array(); // empty array
if ($deduction_info != null && $deduction_info['count'] != 0){       
    $empdataList = $deduction_info['data'];
}
else{
    $empdataList = null;
}

#GET SALARY INFO
$salary_id = $_SESSION["isLogin"]['id'];
$salary_info = _getAllDataByParam('salary_info','user_id="' . $salary_id . "\"");
$salary_list = array(); // empty array
if ($salary_info != null && $salary_info['count'] != 0){       
    $salary_list = $salary_info['data'];
}
else{
    $salary_list = null;
}


?>
    <p><!-- Main content -->
    

<!-- <?php echo $_SESSION["isLogin"]['lastname'] . ", " . $_SESSION["isLogin"]['id']; ?> -->

	<div class="content">
    <div class="container-fluid">
        <div class="card card-danger">
            <div class="card-header">
                <span>View paylip&nbsp;<i class="fas fa-angle-double-right"></i>&nbsp;</span>
                <div class="btn-group float-right">
                        <a href="index.php" class="btn btn-sm btn-default float-right" style="color: black;">Back</a>
                    </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable">
                    <thead>
                        <tr>
                            <th>Action
                            </th>
                            <th>Title
                            </th>
                            <th>For the Month of
                            </th>
                            <th>For the Year of
                            </th>
                            <th>Date Release
                            </th>
                        </tr>
                    </thead>
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
                                echo '<td><div class="btn-group"><button class="btn btn-info" id="details" data-id="'. $row['user_id'] .'" type="button">Details</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>';
                                echo '<td>'. $row["indicator"] .'</td>';
                                echo '<td>'. $row['for_month_of'] .'</td>';
                                echo '<td>'. $row['year'] .'</td>';
                                echo '<td>'. $row['date_created'] .'</td>';
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

    <p><!-- /.content -->
<style type="text/css">
	


</style>
<div class="container">
 
<div id="myModal" data class="modal fade" role="dialog" data-id='0'>
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title">Print this payslip!</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div id="to_print_body" style="padding: 20px;">
      <div style=" font-family: 'Times New Roman', Times, serif;"><center><i><b>BATANGAS STATE UNIVERSITY</b></i></center></div>
      <div style=" font-family: 'Times New Roman', Times, serif;"><center><i><b>ARASOF NASUGBU CAMPUS</b></i></center></div>
      <div style=" font-family: 'Times New Roman', Times, serif;"><center><i><b>PAY SLIP</b></i></center></div>
      <br>
      <div style=" font-family: 'Times New Roman', Times, serif; text-align: right;"><i><b>date/time:<label id="lbl_date_created"></label></b></i></div>
      <br>
      <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 20%;"><b>Name:</b></td>
		    <td style="border-bottom: 1px solid black;" id="lbl_firstname"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 20%;"><b>Period covered:</b></td>
		    <td style="border-bottom: 1px solid black;" id="lbl_indicator"></td>
		  </tr>
		</table>
	  </div>
	  <br>
	  <br>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;"><b>Amount Earned</b></div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;"><b>PERA</b></div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Amount Earned</b></td>
		    <td style="border: 2px solid black; text-align: center;" id="lbl_salary"></td>
		  </tr>
		</table>
	  </div>
	  <br>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;"><b>Less:</b></div>
	  <br>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Absences w/o Pay</b></td>
		    <td style="border-bottom:  1px solid black;" id="lbl_absences_with_out_pay"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Withholding Tax</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_withholding_tax"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pag-ibig Cont.</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_pag_ibig_contri"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pag-ibig Loan</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_pag_ibig_loan"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pag-ibig Calamity Loan</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_pag_ibig_calamity_loan"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SKAPAPA CCI</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_skapapa"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LANDBANK Loan</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_landbank_loan"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Over Payment</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_pag_ibig_calamity_loan"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_pag_ibig_calamity_loan"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</b></td>
		    <td style="border-bottom:  1px solid black; text-align: center;" id="lbl_pag_ibig_calamity_loan"></td>
		  </tr>
		</table>
	  </div>
	  <br>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%; text-align: right;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Deduction &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
		    <td style="border:  2px solid black; text-align: center;" id="lbl_total_deduction"></td>
		  </tr>
		</table>
	  </div>
	  <br>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
	      <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 80%; text-align: right;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Net Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
		    <td style="border:  2px solid black; text-align: center;" id="lbl_total_deduction"></td>
		  </tr>
		</table>
	  </div>
	  <br>
	  <br>
	  <br>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: center;">
      	<table style="width: 100%;">
		  <tr>
		  	<td style="width: 40%;"></td>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 20%; border-bottom: 1px solid black; text-align: center;"><b></b></td>
		    <td style="width: 40%;"></td>
		  </tr>
		</table>
	  </div>
	  <div style=" font-family: 'Times New Roman', Times, serif; text-align: left;">
      	<table style="width: 100%;">
		  <tr>
		    <td style="font-family: 'Times New Roman', Times, serif; width: 100%; text-align: center;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Deduction &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
		  </tr>
		</table>
	  </div>
      </div>

      <div class="modal-footer">	
      	<button type="button" class="btn btn-info" id="print_payslip">Print</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  
  
</div>

  <?php include 'helpers/footer.php'; ?>



    <script type="text/javascript">
    	$(function(){
    	 $(document).on("click","#details",function() {
    	 	var modal = $('#myModal');
			modal.modal('show');
			
			var id = $(this).data('id');

			$.ajax({
				type: 'POST',
				dataType: 'json',
				url:  'payslip_details_modal.php',
				data:{'f': 'getDetailsPayslip', 'id': id},
				success: function(data){
					console.log(data);
					var salary = data.salary;
					var deduction = data.deduction;
					var user = data.user;

					if(!$.trim(salary) == false){
						let row 				= salary['0'];
						let amount 				= row.amount;
						let amount_earned		= row.amount_earned;
						let date_created 		= row.date_created;
						let indicator 			= row.indicator;
						let total_deduction 	= row.total_deduction;

						
						$('#lbl_salary').text(amount_earned);
						$('#lbl_total_deduction').text(total_deduction);
						$('#lbl_indicator').text(indicator);

					}
					if(!$.trim(deduction) == false){
						let row 					= deduction['0'];
						let absences_without_pay 	= row.absences_without_pay;
						let date_created			= row.date_created;
						let emp_asso_due 			= row.emp_asso_due;
						let indicator 				= row.indicator;
						let landbank_loan 			= row.landbank_loan;
						let pagibig_calamity_loan 	= row.pagibig_calamity_loan;
						let pagibig_cont 			= row.pagibig_cont;
						let pagibig_load 			= row.pagibig_load;
						let skapapa_cci 			= row.skapapa_cci;
						let value_care 				= row.value_care;
						let withholding_tax 		= row.withholding_tax;
						let over_payment 			= row.over_payment;
						


						$('#lbl_absences_with_out_pay').text(absences_without_pay);
						$('#lbl_withholding_tax').text(withholding_tax);
						$('#lbl_pag_ibig_contri').text(pagibig_cont);
						$('#lbl_pag_ibig_loan').text(pagibig_load);
						$('#lbl_pag_ibig_calamity_loan').text(pagibig_calamity_loan);
						$('#lbl_skapapa').text(skapapa_cci);
						$('#lbl_employee_asso').text(emp_asso_due);
						$('#lbl_landbank_loan').text(landbank_loan);
						$('#lbl_over_payment').text(over_payment);
						$('#lbl_value_care').text(value_care);
						$('#lbl_absences_with_out_pay').text(absences_without_pay);
						$('#lbl_date_created').text(date_created);
						
						
					}
					if(!$.trim(user) == false){
						let row 			= user['0'];
						let firstname 		= row.firstname;
						let middlename		= row.middlename;
						let lastname 		= row.lastname;
						

						
						$('#lbl_firstname').text(firstname + ' ' + middlename + ' ' + lastname);
						

					}
				}
			});


			
			
    });

    	$(document).on('click', '#print_payslip', function(){
    		$('#to_print_body').printThis({
    			importCSS: false,
    			
    			
    			
    		});
    	});
    	});
    </script>






  							    