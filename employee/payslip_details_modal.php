<?php 
 include('helpers/crud.php');

if(isset($_POST['f'])){

	if($_POST['f'] == 'getDetailsPayslip'){
		$rs['salary'] = null;
		$rs['deduction'] = null;
		$rs['user'] = null;
		
		extract($_POST);

		#GET SALARY INFO
		$salary_info = _getAllDataByParam('salary_info','user_id="' . $id . "\"");
		$rs['salary'] = array(); // empty array
		if ($salary_info != null && $salary_info['count'] != 0){       
		    $rs['salary'] = $salary_info['data'];
		}
		

		#GET DEDUCTION INFO
		$deduction_info = _getAllDataByParam('deduction_info','user_id="' . $id . "\"");
		$rs['deduction'] = array(); // empty array
		if ($deduction_info != null && $deduction_info['count'] != 0){       
		    $rs['deduction'] = $deduction_info['data'];
		}

		#GET USER INFO
		$user_info = _getAllDataByParam('user','id="' . $id . "\"");
		$rs['user'] = array(); // empty array
		if ($user_info != null && $user_info['count'] != 0){       
		    $rs['user'] = $user_info['data'];
		}
		


		echo json_encode($rs);


	}

}




?>