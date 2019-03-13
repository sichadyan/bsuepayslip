<?php

require_once('../config/fix_mysql.inc.php');
require_once("../config/config.php");
include('../config/authenticate.php');

date_default_timezone_set("Asia/Manila");

$today = date('Y-m-d H:i:s');
$uid = $_SESSION["isLogin"]['id'];	
if(isset($_POST['f'])){

extract($_POST);
	if($f == 'postMessage'){
		$type1 = '_danger'; 
		$type2 = '_success';
		$title = 'Oopps!';
		$msg = 'Something went wrong!';
		$status = 0;
			

		if($topic == ''){
			$msg = 'Please Enter Topic!';

		}else{
			if($message == ''){
				$msg = 'Please Enter Message!';
			}
			else{
				$query = "INSERT INTO message_tbl (user_id, topic, message, date_created) VALUES ($uid, '$topic', '$message', '$today')";
        		$result = mysql_query($query) or die (mysql_error());
        		if($result){
        			$type2 = '_danger'; 
					$type1 = '_success';
					$title = 'Successs!';
					$msg = 'Message Sent!';
					$status = 1;
		
        		}

			}
		}

		$rs = [
			"type1" => $type1, 
			"type2" => $type2, 
			"title" => $title,
			"message" => $message,
			"status" => $status
				
		];
		echo json_encode($rs);


	}
}






?>