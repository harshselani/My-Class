<?php
include("database.php");


class Session
{
   var $username;            //Username given on sign-up
   var $userid;              //Random value generated on current login
   var $userlevel;           //The level to which the user pertains
   var $time;                //Time user was last active (page loaded)
   var $logged_in;           //True if user is logged in, false otherwise
   var $userID; 
   var $classID;                           //The array holding all user info
   var $url;                 //The page url current being viewed
   var $referrer;            //Last recorded site page viewed
   var $ip;                  //Remote IP address  
   var $name;
   var $databasename;
   var $usertype;
   var $permissions;

   function Session(){
      $this->ip = $_SERVER["REMOTE_ADDR"];
      $this->time = time();
      $this->startSession();
   }

   function startSession(){
      global $database;  
      session_start();   
	  
      /* Determine if user is logged in */
      $this->logged_in = $this->checkLogin();

      /* Set referrer page */
      if(isset($_SESSION['url'])){
         $this->referrer = $_SESSION['url'];
      }else{
         $this->referrer = "/";
      }

      /* Set current url */
      $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
   }

   function checkLogin(){
      global $database; 
      /* Check if user has been remembered */
    
      if(isset($_SESSION['usertype'])&&isset($_SESSION['userID'])&&$_SESSION['usertype']==1){
         if($database->confirmUserID($_SESSION['userID']) != 0){
            unset($_SESSION['userID']);
			unset($_SESSION['username']);
			unset($_SESSION['classID']);
			unset($_SESSION['userBranchID']);
			unset($_SESSION['usertype']);
			unset($_SESSION['databasename']);
			unset($_SESSION['permissions']);
			
            return false;
         }
         
		 $temp=getUser($_SESSION['userID']);
         $this->userID  = $temp->getID();
         $this->username  = $temp->getUsername();
		 $this->classID  = $temp->getClassID();
		 $this->userBranchID  = $temp->getUserBranchID();
		 $this->name  = $temp->getName();
		 $this->userlevel  = $temp->getLevel();
		 $this->databasename  = $temp->getInstituteObj()->getDatabaseName();
		 $this->usertype  = 1;
		 $this->permissions  = $temp->getPermissions();
		// unsetDatabaseName();
		// setDatabaseName($this->databasename,$this->classID);
		 
         return true;
      }
      else{
        
		 return false;
      }
   }

   function confirmlogin(){
      global $database;  

	  /* Checks if this IP address is currently blocked*/	
      $result = $database->confirmIPAddress($this->ip);

      if($result == 1){
         $error_type = "access";
         $_SESSION['loginfail']="Access denied for ".TIME_PERIOD." minutes";
		 return false;
      } 
     else
     return true;
   }
   
   function login($temp){
      global $database;  

	 
      /* Username and password correct, register session variables */
         $this->userID  = $temp->getID();
         $this->username  = $temp->getUsername();
		 $this->classID  = $temp->getClassID();
		 $this->userBranchID  = $temp->getUserBranchID();
		 $this->name  = $temp->getName();
         $this->logged_in=true;
		 $this->userlevel  = $temp->getLevel();
		 $this->databasename  = $temp->getInstituteObj()->getDatabaseName();
		 $this->usertype  = 1;
		 $this->permissions  = $temp->getPermissions();
		 $_SESSION['userID'] = $temp->getID();
		 $_SESSION['userBranchID'] = $temp->getUserBranchID();
		 $_SESSION['username']= $temp->getUsername();
		 $_SESSION['classID']= $temp->getClassID();
		 $_SESSION['usertype']=1;
		 $_SESSION['databasename']= $temp->getInstituteObj()->getDatabaseName();
		 $_SESSION['permissions']=$temp->getPermissions();
		 
		//setDatabaseName($this->databasename,$this->classID);
		 
      /* Null login attempts */
	  $database->clearLoginAttempts($this->ip);


   }

   function logout(){
      global $database;  

     

            unset($_SESSION['userID']);
			unset($_SESSION['userBranchID']);
			unset($_SESSION['username']);
			unset($_SESSION['classID']);
			unset($_SESSION['usertype']);
            unset($_SESSION['databasename']);
			unset($_SESSION['permissions']);
			
      $this->logged_in = false;
	  $_SESSION['url']='';
	  redirect_to('../staffLogin.php');
      
   }
};


/* Initialize session object */
$session = new Session;

/* Initialize form object */


?>
