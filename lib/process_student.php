<?php
include "Database.php" ;
$db=new Database();
$table="student";
if(isset($_REQUEST['action']) and !empty($_REQUEST['action'])){
    $studentData=array(
        "name"=>$_POST['name'],
        "email"=>$_POST['email'],
        "phone"=>$_POST['phone']
    );
   echo $db->insert($table,$studentData);
}