<?php

function _getAllData($tablename){
    if ($tablename != NULL){
        require_once('../config/fix_mysql.inc.php');
        require_once("../config/config.php");
        $result = mysql_query("SELECT * FROM " . $tablename)  or die (mysql_error());
        
        if($result){
            $result_list = array();
            while($row = mysql_fetch_array($result)) {
                $result_list[] = $row;
             }
            
            $data['data'] = $result_list;
            $data['count'] = count($result_list);
            //var_dump($result_list);
            return $data;
        }
        else{
            $data['data'] = NULL;
            $data['count'] = 0;
            return $data;
        }
    }
}


function _getAllDataByParam($tablename,$param){
    if ($tablename != NULL){
        require_once('../config/fix_mysql.inc.php');
        require_once("../config/config.php");
        $result = mysql_query("SELECT * FROM " . $tablename . " WHERE " . $param)  or die (mysql_error());
        // echo "SELECT * FROM " . $tablename . " WHERE " . $param;
        if($result){
            $result_list = array();
            while($row = mysql_fetch_array($result)) {
                $result_list[] = $row;
             }
            $data['data'] = $result_list;
            $data['count'] = count($result_list);
            return $data;
        }
        else{
            $data['data'] = NULL;
            $data['count'] = 0;
            return $data;
        }
    }
}

function _saveData($tablename,$tableColumns,$ColumnValues){

    if ($tablename != NULL){
        require_once('../config/fix_mysql.inc.php');
        require_once("../config/config.php");

        $query = "INSERT INTO " . $tablename . 
        " ( " . $tableColumns . " ) 
        VALUES (" . $ColumnValues . " )";

        //echo ($query);
        $result = mysql_query($query) or die (mysql_error());
        
        if($result){
            $data['data'] = $result;
            $data['count'] = mysql_affected_rows();
            return $data;
        }
        else{
            $data['data'] = $result;
            $data['count'] = 0;
            return $data;
        }
    }    
}

function _updateData($tablename,$ColumnValues,$param){

    if ($tablename != NULL){
        require_once('../config/fix_mysql.inc.php');
        require_once("../config/config.php");

        $query = "UPDATE " . $tablename . " SET " . $ColumnValues . " WHERE " . $param;

        //echo ($query);
        $result = mysql_query($query) or die (mysql_error());
        
        if($result){
            $data['data'] = $result;
            $data['count'] = mysql_affected_rows();
            return $data;
        }
        else{
            $data['data'] = $result;
            $data['count'] = 0;
            return $data;
        }
    }
    
}

function _removeData($tablename,$param){

    if ($tablename != NULL){
        require_once('../config/fix_mysql.inc.php');
        require_once("../config/config.php");

        $query = "DELETE FROM " . $tablename . " WHERE " . $param;

        //echo ($query);
        $result = mysql_query($query) or die (mysql_error());
        
        if($result){
            $data['data'] = $result;
            $data['count'] = mysql_affected_rows();
            return $data;
        }
        else{
            $data['data'] = $result;
            $data['count'] = 0;
            return $data;
        }
    }
    
}

?>