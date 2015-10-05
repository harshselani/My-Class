<?php
class MySQLDB
{
   var $connection;         //The MySQL database connection

  function MySQLDB(){
      $this->connection = mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());
      mysql_select_db(MAIN_DATABASE, $this->connection) or die(mysql_error());
   }

   function confirmIPAddress($value) {
	$q = "SELECT attempts, (CASE when lastlogin is not NULL and DATE_ADD(LastLogin, INTERVAL ".TIME_PERIOD." MINUTE)>NOW() then 1 else 0 end) as Denied ".
   " FROM ".TBL_ATTEMPTS." WHERE ip = '$value'";
 
   $result = mysql_query($q, $this->connection);
   $data = mysql_fetch_array($result);   
 
   //Verify that at least one login attempt is in database

   if (!$data) {
     return 0;
   } 
   if ($data["attempts"] >= ATTEMPTS_NUMBER)
   {
      if($data["Denied"] == 1)
      {
         return 1;
      }
     else
     {
        $this->clearLoginAttempts($value);
        return 0;
     }
   }
   return 0;  
  }
   
   function addLoginAttempt($value) {
   // increase number of attempts
   // set last login attempt time if required    
	  $q = "SELECT * FROM ".TBL_ATTEMPTS." WHERE ip = '$value'"; 
	  $result = mysql_query($q, $this->connection);
	  $data = mysql_fetch_array($result);
	  
	  if($data)
      {
        $attempts = $data["attempts"]+1;

        if($attempts==3) {
		 $q = "UPDATE ".TBL_ATTEMPTS." SET attempts=".$attempts.", lastlogin=NOW() WHERE ip = '$value'";
		 $result = mysql_query($q, $this->connection);
		}
        else {
		 $q = "UPDATE ".TBL_ATTEMPTS." SET attempts=".$attempts." WHERE ip = '$value'";
		 $result = mysql_query($q, $this->connection);
		}
       }
      else {
	   $q = "INSERT INTO ".TBL_ATTEMPTS." (attempts,IP,lastlogin) values (1, '$value', NOW())";
	   $result = mysql_query($q, $this->connection);
	  }
    }
   
   
   
   
   function confirmUserID($user){
      /* Add slashes if necessary (for query) */
      
$user=mysql_real_escape_string(trim($user));

      /* Verify that user is in database */
      $q = "SELECT * FROM users WHERE ID = '".$user."' AND activeflag=1 AND loginflag=1";
      $result = mysql_query($q, $this->connection);
      if(!$result || (mysql_numrows($result) < 1)){
         return 1; //Indicates username failure
     // echo mysql_error();
	  } 
	  
	 // echo mysql_error();
	 return 0;

   }
   
   function clearLoginAttempts($value) {
    $q = "UPDATE ".TBL_ATTEMPTS." SET attempts = 0 WHERE ip = '$value'"; 
	return mysql_query($q, $this->connection);
   }
   

};

/* Create database connection */
$database = new MySQLDB;

?>
