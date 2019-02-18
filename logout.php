<?php
    session_start();
    session_destroy() ;
    include 'helpers/helper.php';
    include 'helpers/crud.php';
    $_SESSION["isLogin"] = "";
    header ("location:signin.php");
?>