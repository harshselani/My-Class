<?php 
include_once 'globalclasses.php'; 
include_once 'studentsessioncheck.php'; 


if(isset($_SESSION['usertype'])&&$_SESSION['usertype']!=0){
redirect_to('../studentLoginNew.php');
}
if(!$session->logged_in){
redirect_to('../studentLoginNew.php');
}
?>