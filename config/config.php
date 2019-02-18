<?php

////For Localhost: Enable This
$databaseHost = '127.0.0.1';
$databaseName = 'bsuepayslip';
$databaseUsername = 'root';
$databasePassword = '';

////For Online Database Use this
// $databaseHost = '182.50.151.57';
// $databaseName = 'bsuepayslip';
// $databaseUsername = 'bsuepayslip';
// $databasePassword = 'p@ssw0rd57';

  $conn = mysql_connect($databaseHost, $databaseUsername, $databasePassword);
  if(!$conn)
  {
		die("Could not connect" . mysql_error());
	}
	
  $db = mysql_select_db($databaseName, $conn);
  if(!$db)
  {
		die("Could not select database" . mysql_error());
	}
?>