<?php 
include_once 'globalclasses.php'; 
include_once 'sessioncheck.php'; 
include_once 'feeclasses.php'; 
if(isset($_SESSION['usertype'])&&$_SESSION['usertype']!=1){
redirect_to('../staffLogin.php');
}
if(!$session->logged_in){
redirect_to('../staffLogin.php');
}

if($session->userlevel!=1)
{
//$flag=checkUrlPermission($_SESSION['permissions'],$_SESSION['url']);
$flag=true;

if(!$flag)
{
redirect_to('permissionDenied.php');
}
}
?>