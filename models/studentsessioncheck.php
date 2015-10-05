<?php
include("databasestudent.php");


class Session
{
               //Username given on sign-up
                //Random value generated on current login
   var $userlevel;               //The level to which the user pertains
   var $time;                //Time user was last active (page loaded)
   var $logged_in;           //True if user is logged in, false otherwise
   var $userID; 
   var $instituteID;                           //The array holding all user info
   var $url;                 //The page url current being viewed
   var $referrer;            //Last recorded site page viewed
   var $ip;                  //Remote IP address  
   var $name;
   var $usertype;

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
    
      if(isset($_SESSION['userID'])&&$_SESSION['usertype'] == 0&&isset($_SESSION['usertype'])){
         if($database->confirmUserID($_SESSION['userID']) != 0){
            unset($_SESSION['userID']);
			 unset($_SESSION['usertype']);
			return false;
         }
         
		 $temp=getStudentLogin($_SESSION['userID']);
         $this->userID  = $temp->getID();
       $this->name  = $temp->getFullName();
		$this->instituteID  = $temp->getInstituteIDoFStudent();
		 $this->usertype  = 0;
		
		 
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
        $this->name  = $temp->getFullName();
         $this->logged_in=true;
		 $this->usertype  = 0;
		 $this->instituteID = $temp->getInstituteIDoFStudent();
		 $_SESSION['userID'] = $temp->getID();
		  $_SESSION['usertype'] = 0;
		 
		//setDatabaseName($this->databasename,$this->classID);
		 
      /* Null login attempts */
	  $database->clearLoginAttempts($this->ip);


   }

   function logout(){
      global $database;  

     

            unset($_SESSION['userID']);
			unset($_SESSION['usertype']);
			unset($_SESSION['studentType']);
			if(isset($_SESSION['democlass']))
			unset($_SESSION['democlass']);
      $this->logged_in = false;
	  $_SESSION['url']='';
	  redirect_to('../studentLoginNew.php?reason=logout');
      
   }
};


/* Initialize session object */
$session = new Session;

/* Initialize form object */


?>
