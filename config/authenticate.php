<?php
///Check if user is already logged in session
session_start();
if (isset($_SESSION["isLogin"]) == NULL){
    header('location:signin.php'); 
    exit(); 
  }
?>