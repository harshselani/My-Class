<?php 

include_once 'constant.php';
include_once 'connection.php';
include_once 'globalfunctions.php';
include_once 'studentfunctions.php';
include_once 'batchfunctions.php';
include_once 'notesfunctions.php';
include_once 'userfunctions.php';
include_once 'testfunctions.php';
include_once 'reportfunctions.php';
include_once 'marksfunctions.php';
include_once 'announcementfunctions.php';
include_once 'branchfunctions.php';
include_once 'batchclassfunctions.php';
include_once 'subjectfunctions.php';
include_once 'studentloginfunctions.php';
include_once 'smsfunctions.php';
include_once 'quizclasses.php';
include_once 'taskclasses.php';
include_once 'lectureclass.php';
include_once 'permissionfunctions.php';
include_once 'videofunctions.php';
include_once 'emailfunctions.php';
include_once 'reviewfunctions.php';


set_time_limit(10000);
date_default_timezone_set('Asia/Calcutta'); 

class Student
	{
		var $user_type;
		var $ID;
		var $mainID;
		var $rollno;
		var $grno;
		var $firstname;
		var $lastname;
		var $Fname;
		var $Mname;
		var $address;
		var $phone_stu;
		var $phone_father;
		var $phone_mother;
		var $phone_other;
		var $BatchObj;
		var $examyear;
		var $picurl;
		var $activeflag;
		var $lasteditedby;
		var $dateupdated;
		var $comments;
		var $actid;
		var $ClassObj;
		var $loginflag;
		var $gender;
		var $dateofbirth;
		var $hscno;
		var $cetno;
		var $college;
		var $studentpass;
		var $email;
		var $BranchObj;
		var $marksObj;
		var $lastlogin;
		var $parentpass;
	    var $dateofadmission;
		var $board10;
		var $agg10;
		var $ms10;
		
		// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

		
		function getName()
		{
			
			return getBestName($this->firstname, $this->Fname, $this->lastname);
		}
		
			function getShortName()
		{
			
			return $this->firstname.' '.substr($this->lastname,0,1);
		}

		// -- Function Name : setuser_type
		// -- Params : 
		// -- Purpose : 
		
	
		function setRollNo($rollno)
		{
			$this->rollno = $rollno;
		}
		
		function setMainID($mainID)
		{
			$this->mainID = $mainID;
		}
		
			function setGRno($grno)
		{
			$this->grno = $grno;
		}
		

		function setFirstName($firstname)
		{
			$this->firstname = $firstname;
		}

	function setLastName($lastname)
		{
			$this->lastname = $lastname;
		}
		
		

		function setMname($Mname)
		{
			$this->Mname = $Mname;
		}

		/**
		* This function is used to set the last name of the student
		*/
		function setFname($Fname)
		{
			$this->Fname = $Fname;
		}

		/**
		* This function is used to set the Photo of the student
		*/
		function setPicUrl($picurl)
		{
			$this->picurl = $picurl;
		}
		
		function setAddress($address)
		{
			$this->address = $address;
		}


		function setPhoneStu($phone_stu)
		{
			$this->phone_stu = $phone_stu;
		}

	function setPhoneFather($phone_father)
		{
			$this->phone_father = $phone_father;
		}
		
			function setPhoneMother($phone_mother)
		{
			$this->phone_mother = $phone_mother;
		}
		
			function setPhoneOther($phone_other)
		{
			$this->phone_other = $phone_other;
		}

function setBatchObj($BatchObj)
		{
			$this->BatchObj = $BatchObj;
		}

function setExamYear($examyear)
		{
			$this->examyear = $examyear;
		}



function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}

function setLastEditedBy($lasteditedby)
		{
			$this->lasteditedby = $lasteditedby;
		}

function setDateUpdated($dateupdated)
		{
			$this->dateupdated = $dateupdated;
		}

function setComments($comments)
		{
			$this->comments = $comments;
		}

function setActid($actid)
		{
			$this->actid = $actid;
		}

function setClassObj($ClassObj)
		{
			$this->ClassObj = $ClassObj;
		}

function setLoginFlag($loginflag)
		{
			$this->loginflag = $loginflag;
		}

function setGender($gender)
		{
			$this->gender = $gender;
		}

function setDateOfBirth($dateofbirth)
		{
			$this->dateofbirth = $dateofbirth;
		}

function setHscNo($hscno)
		{
			$this->hscno = $hscno;
		}

function setCetNo($cetno)
		{
			$this->cetno = $cetno;
		}

function setCollege($college)
		{
			$this->college = $college;
		}

function setStudentPass($studentpass)
		{
			$this->studentpass = $studentpass;
		}

	function setEmail($email)
		{
			$this->email = $email;
		}

function setParentPass($parentpass)
		{
			$this->parentpass = $parentpass;
		}


function setLastLogin($lastlogin)
		{
			$this->lastlogin = $lastlogin;
		}
		
		function setDateOfAdmission($dateofadmission)
		{
			$this->dateofadmission = $dateofadmission;
		}
		
		function setBoard10($board10)
		{
			$this->board10 = $board10;
		}
		
		function setAggregate10($agg10)
		{
			$this->agg10 = $agg10;
		}
		
		function setMathsScience10($ms10)
		{
			$this->ms10 = $ms10;
		}


	function getID()
		{
			return $this->ID;
		}
	
	function getMainID()
		{
			return $this->mainID;
		}
		
	function getRollNo()
		{
			return $this->rollno;
		}



		function getUsertype()
		{
			return USERTYPE_STUDENT;
		}

		
		function getGRno()
		{
			return $this->grno;
		}
		

		function getFirstName()
		{
			return $this->firstname;
		}

	function getLastName()
		{
			return $this->lastname;
		}
		
		function getFullName()
		{
			return $this->firstname." ".$this->Fname." ".$this->lastname;
		}
		

		function getMname()
		{
			return $this->Mname;
		}

		/**
		* This function is used to get the last name of the student
		*/
		function getFname()
		{
			return $this->Fname;
		}

		/**
		* This function is used to get the Photo of the student
		*/
		function getPicUrl()
		{
			return $this->picurl;
		}
		
		function getAddress()
		{
			return $this->address;
		}


		function getPhoneStu()
		{
			return $this->phone_stu;
		}

	function getPhoneFather()
		{
			return $this->phone_father;
		}
		
			function getPhoneMother()
		{
			return $this->phone_mother;
		}
		
			function getPhoneOther()
		{
			return $this->phone_other;
		}

function getBatchObj()
		{
			return $this->BatchObj;
		}

function getBranchObj()
		{
			return $this->BranchObj;
		}

function getExamYear()
		{
			return $this->examyear;
		}



function getActiveFlag()
		{
			return $this->activeflag;
		}

function getLastEditedBy()
		{
			return $this->lasteditedby;
		}

function getDateUpdated()
		{
			return $this->dateupdated;
		}

function getComments()
		{
			return $this->comments;
		}

function getActid()
		{
			return $this->actid;
		}

function getClassObj()
		{
			return $this->ClassObj;
		}

function getLoginFlag()
		{
			return $this->loginflag;
		}

function getGender()
		{
			return $this->gender;
		}

function getDateOfBirth()
		{
			//return $this->dateofbirth;
		$temp=array();
		$temp=explode('-',$this->dateofbirth);
		$date=$temp['2'].'-'.$temp['1'].'-'.$temp['0'];
		return $date;
		}

function getHscNo()
		{
			return $this->hscno;
		}

function getCetNo()
		{
			return $this->cetno;
		}

function getCollege()
		{
			return $this->college;
		}

function getStudentPass()
		{
			return $this->studentpass;
		}

	function getEmail()
		{
			return $this->email;
		}
		
	function getParentPass()
		{
			return $this->parentpass;
		}
	
	function getLastLogin()
		{
			return $this->lastlogin;
		}
	
	function getDateOfAdmission()
		{
			//return $this->dateofadmission;
			$temp=array();
		$temp=explode('-',$this->dateofadmission);
		$date=$temp['2'].'-'.$temp['1'].'-'.$temp['0'];
		return $date;
		}
		
	function getBoard10()
		{
			return $this->board10;
		}
		
		function getAggregate10()
		{
			return $this->agg10;
		}
		
		function getMathsScience10()
		{
			return $this->ms10;
		}	
	
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE student SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}

			function updateLoginFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE student SET loginflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		

		// -- Function Name : read
		// -- Params : 
		// -- Purpose : 
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM student WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
				$member = mysql_fetch_array($result);
$this->setMainID(trim($member['mainID']));		
$this->setRollNo(trim($member['rollno']));		
$this->setGRno(trim($member['grno']));
$this->setFirstName(trim($member['firstname']));
$this->setLastName(trim($member['lastname']));
$this->setMname(trim($member['Mname']));
$this->setFname(trim($member['Fname']));
$this->setPicUrl(trim($member['picurl']));
$this->setAddress(trim($member['address']));
$this->setPhoneStu(trim($member['phone_stu']));
$this->setPhoneFather(trim($member['phone_father']));
$this->setPhoneMother(trim($member['phone_mother']));
$this->setPhoneOther(trim($member['phone_other']));
$this->setBatchObj(getBatch($member['batchID']));
$this->setExamYear(trim($member['examyear']));

$this->setActiveFlag(trim($member['activeflag']));
$this->setLastEditedBy(trim($member['lasteditedby']));
$this->setDateUpdated(trim($member['dateupdated']));
$this->setComments(trim($member['comments']));
$this->setActid(trim($member['actid']));
$this->setClassObj(new BatchClass($member['classID']));
$this->setLoginFlag(trim($member['loginflag']));
$this->setGender(trim($member['gender']));
$this->setDateOfBirth(trim($member['dateofbirth']));
$this->setHscNo(trim($member['hscno']));
$this->setCetNo(trim($member['cetno']));
$this->setCollege(trim($member['college']));
$this->setStudentPass(trim($member['studentpass']));
$this->setEmail(trim($member['email']));
$this->BranchObj=(getBranch($this->getBatchObj()->getID()));
$this->setParentPass(trim($member['parentpass']));
$this->setLastLogin(trim($member['lastlogin']));
$this->setDateOfAdmission(trim($member['dateofadmission']));
$this->setBoard10(trim($member['board10']));
$this->setAggregate10(trim($member['agg10']));
$this->setMathsScience10(trim($member['ms10']));
//$this->marksObj=new Marks($this->ID);
			}

		}
		
	
		function update()
		{
			$conn = getConnection();
			
			if($ClassObj!=NULL)
			$classID=$ClassObj->getID();
			else
			$classID=0;
						
			$query = "UPDATE student SET activeflag = '".$this->activeflag."',rollno = '".$this->getRollNo()."', grno = '".$this->getGRno()."',firstname = '".$this->getFirstName()."',lastname = '".$this->getLastName()."',Mname = '".$this->getMname()."',Fname = '".$this->getFname()."',picurl = '".$this->getPicUrl()."',address = '".$this->getAddress()."',phone_stu = '".$this->getPhoneStu()."',phone_father = '".$this->getPhoneFather()."',phone_mother = '".$this->getPhoneMother()."',phone_other = '".$this->getPhoneOther()."',batchID = '".$this->getBatchObj()->getID()."',lasteditedby = '".$this->getLastEditedBy()."',comments = '".$this->getComments()."',actid = '".$this->getActid()."',classID  = '".$classID."',loginflag = '".$this->getLoginFlag()."',gender = '".$this->getGender()."',dateofbirth = '".$this->dateofbirth."',hscno = '".$this->getHscNo()."',cetno = '".$this->getCetNo()."',college = '".$this->getCollege()."',email = '".$this->getEmail()."',dateofadmission = '".$this->dateofadmission."',board10 = '".$this->getBoard10()."',agg10 = '".$this->getAggregate10()."',ms10 = '".$this->getMathsScience10()."', dateupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";

			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
			
			
			
	function getMyMarks()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM marks WHERE studentID='".$this->ID."' ORDER BY testID DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempmark = getMarks($member['ID']);
			array_push($list,$tempmark);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
		function getMyFees()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM feepayement WHERE studentID='".$this->ID."' ORDER BY datepaid ASC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempmark = getFeePayement($member['ID']);
			array_push($list,$tempmark);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}	
		
	}

class Short
	{
		
		var $ID;
		var $mainID;
		var $rollno;
		var $grno;
		var $firstname;
		var $lastname;
		var $phone_stu;
		var $phone_father;
		var $phone_mother;
		var $Fname;
	    var $BatchObj;
		var $examyear;
		var $activeflag;
		var $ClassObj;
	    var $BranchObj;
		var $loginflag;
		var $picurl;
		
		// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

		
		function getName()
		{
			return getBestName($this->firstname, $this->Fname, $this->lastname);
		}
		
		function getShortName()
		{
			
			return $this->firstname.' '.substr($this->lastname,0,1);
		}


		// -- Function Name : setuser_type
		// -- Params : 
		// -- Purpose : 
		function getFullName()
		{
			return $this->firstname." ".$this->Fname." ".$this->lastname;
		}
	
		function setRollNo($rollno)
		{
			$this->rollno = $rollno;
		}
		
		function setMainID($mainID)
		{
			$this->mainID = $mainID;
		}
		
			function setGRno($grno)
		{
			$this->grno = $grno;
		}
		

		function setFirstName($firstname)
		{
			$this->firstname = $firstname;
		}

function setLoginFlag($loginflag)
		{
			$this->loginflag = $loginflag;
		}
		
	function setLastName($lastname)
		{
			$this->lastname = $lastname;
		}
		
		
function setPhoneStu($phone_stu)
		{
			$this->phone_stu = $phone_stu;
		}

	function setPhoneFather($phone_father)
		{
			$this->phone_father = $phone_father;
		}
		
			function setPhoneMother($phone_mother)
		{
			$this->phone_mother = $phone_mother;
		}
	
		/**
		* This function is used to set the last name of the student
		*/
		function setFname($Fname)
		{
			$this->Fname = $Fname;
		}

		/**
		* This function is used to set the Photo of the student
		*/
		

function setBatchObj($BatchObj)
		{
			$this->BatchObj = $BatchObj;
		}

function setExamYear($examyear)
		{
			$this->examyear = $examyear;
		}



function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}



function setClassObj($ClassObj)
		{
			$this->ClassObj = $ClassObj;
		}


function setPicUrl($picurl)
		{
			$this->picurl = $picurl;
		}

	function getID()
		{
			return $this->ID;
		}
	
	function getMainID()
		{
			return $this->mainID;
		}
		
	function getRollNo()
		{
			return $this->rollno;
		}

		
		function getGRno()
		{
			return $this->grno;
		}
		

		function getFirstName()
		{
			return $this->firstname;
		}

	function getLastName()
		{
			return $this->lastname;
		}
		
		

		/**
		* This function is used to get the last name of the student
		*/
		function getFname()
		{
			return $this->Fname;
		}

		/**
		* This function is used to get the Photo of the student
		*/
	

function getBatchObj()
		{
			return $this->BatchObj;
		}

function getBranchObj()
		{
			return $this->BranchObj;
		}

function getExamYear()
		{
			return $this->examyear;
		}

function getPhoneStu()
		{
			return $this->phone_stu;
		}

	function getPhoneFather()
		{
			return $this->phone_father;
		}
		
			function getPhoneMother()
		{
			return $this->phone_mother;
		}

function getActiveFlag()
		{
			return $this->activeflag;
		}

function getLoginFlag()
		{
			return $this->loginflag;
		}

function getClassObj()
		{
			return $this->ClassObj;
		}

function getPicUrl()
		{
			return $this->picurl;
		}
		
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE student SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}

		
		

		// -- Function Name : read
		// -- Params : 
		// -- Purpose : 
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM student WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
				$member = mysql_fetch_array($result);
$this->setMainID(trim($member['mainID']));		
$this->setRollNo(trim($member['rollno']));		
$this->setGRno(trim($member['grno']));
$this->setFirstName(trim($member['firstname']));
$this->setLastName(trim($member['lastname']));
$this->setFname(trim($member['Fname']));
$this->setBatchObj(getBatch($member['batchID']));
$this->setExamYear(trim($member['examyear']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setClassObj(getBatchClass($member['classID']));
$this->BranchObj=(getBranch($this->getBatchObj()->getID()));
$this->setLoginFlag(trim($member['loginflag']));
$this->setPhoneStu(trim($member['phone_stu']));
$this->setPhoneFather(trim($member['phone_father']));
$this->setPhoneMother(trim($member['phone_mother']));
$this->setPicUrl(trim($member['picurl']));
			}

		}
		
		function getMyMarks()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM marks WHERE studentID=".$this->ID." ORDER BY testID DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempmark = getMarks($member['ID']);
			array_push($list,$tempmark);
			//break;
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getMyNotes()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE batchID='".$this->BatchObj->getID()."' AND activeflag=1 ORDER BY subjectID DESC,datecreated DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempmark = getNotes($member['ID']);
			array_push($list,$tempmark);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getMyAnnouncements()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM announcement WHERE batchID='".$this->BatchObj->getID()."' AND activeflag=1 ORDER BY lastupdated DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getAnnouncement($member['ID']);
			array_push($list,$temp);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	}
	
	class Short1
	{
		
		var $ID;
		var $mainID;
		var $rollno;
		var $grno;
		var $firstname;
		var $lastname;
		var $phone_stu;
		var $phone_father;
		var $phone_mother;
		var $Fname;
	    var $BatchID;
		var $examyear;
		var $activeflag;
		var $ClassID;
	    var $BranchID;
		var $loginflag;
		var $picurl;
		
		// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

		
		function getName()
		{
			return getBestName($this->firstname, $this->Fname, $this->lastname);
		}
		
		function getShortName()
		{
			
			return $this->firstname.' '.substr($this->lastname,0,1);
		}


		// -- Function Name : setuser_type
		// -- Params : 
		// -- Purpose : 
		function getFullName()
		{
			return $this->firstname." ".$this->Fname." ".$this->lastname;
		}
	
		function setRollNo($rollno)
		{
			$this->rollno = $rollno;
		}
		
		function setMainID($mainID)
		{
			$this->mainID = $mainID;
		}
		
			function setGRno($grno)
		{
			$this->grno = $grno;
		}
		

		function setFirstName($firstname)
		{
			$this->firstname = $firstname;
		}

function setLoginFlag($loginflag)
		{
			$this->loginflag = $loginflag;
		}
		
	function setLastName($lastname)
		{
			$this->lastname = $lastname;
		}
		
		
function setPhoneStu($phone_stu)
		{
			$this->phone_stu = $phone_stu;
		}

	function setPhoneFather($phone_father)
		{
			$this->phone_father = $phone_father;
		}
		
			function setPhoneMother($phone_mother)
		{
			$this->phone_mother = $phone_mother;
		}
	
		/**
		* This function is used to set the last name of the student
		*/
		function setFname($Fname)
		{
			$this->Fname = $Fname;
		}

		/**
		* This function is used to set the Photo of the student
		*/
		

function setBatchID($BatchID)
		{
			$this->BatchID = $BatchID;
		}

function setExamYear($examyear)
		{
			$this->examyear = $examyear;
		}



function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}



function setClassID($ClassID)
		{
			$this->ClassID = $ClassID;
		}


function setPicUrl($picurl)
		{
			$this->picurl = $picurl;
		}

	function getID()
		{
			return $this->ID;
		}
	
	function getMainID()
		{
			return $this->mainID;
		}
		
	function getRollNo()
		{
			return $this->rollno;
		}

		
		function getGRno()
		{
			return $this->grno;
		}
		

		function getFirstName()
		{
			return $this->firstname;
		}

	function getLastName()
		{
			return $this->lastname;
		}
		
		

		/**
		* This function is used to get the last name of the student
		*/
		function getFname()
		{
			return $this->Fname;
		}

		/**
		* This function is used to get the Photo of the student
		*/
	

function getBatchID()
		{
			return $this->BatchID;
		}



function getExamYear()
		{
			return $this->examyear;
		}

function getPhoneStu()
		{
			return $this->phone_stu;
		}

	function getPhoneFather()
		{
			return $this->phone_father;
		}
		
			function getPhoneMother()
		{
			return $this->phone_mother;
		}

function getActiveFlag()
		{
			return $this->activeflag;
		}

function getLoginFlag()
		{
			return $this->loginflag;
		}

function getClassID()
		{
			return $this->ClassID;
		}

function getClassObj()
{
	        if($this->ClassID!=0)
			return getBatchClass($this->ClassID);
			else
			return NULL;
		}
function getPicUrl()
		{
			return $this->picurl;
		}
		
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE student SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}

		
		

		// -- Function Name : read
		// -- Params : 
		// -- Purpose : 
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM student WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
				$member = mysql_fetch_array($result);
$this->setMainID(trim($member['mainID']));		
$this->setRollNo(trim($member['rollno']));		
$this->setGRno(trim($member['grno']));
$this->setFirstName(trim($member['firstname']));
$this->setLastName(trim($member['lastname']));
$this->setFname(trim($member['Fname']));
$this->setBatchID($member['batchID']);
$this->setExamYear(trim($member['examyear']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setClassID($member['classID']);

$this->setLoginFlag(trim($member['loginflag']));
$this->setPhoneStu(trim($member['phone_stu']));
$this->setPhoneFather(trim($member['phone_father']));
$this->setPhoneMother(trim($member['phone_mother']));
$this->setPicUrl(trim($member['picurl']));
			}

		}
		
		function getMyMarks()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM marks WHERE studentID=".$this->ID." ORDER BY testID DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempmark = getMarks($member['ID']);
			array_push($list,$tempmark);
			//break;
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getMyNotes()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE batchID='".$this->BatchID."' AND activeflag=1 ORDER BY subjectID DESC,datecreated DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempmark = getNotes($member['ID']);
			array_push($list,$tempmark);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getMyAnnouncements()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM announcement WHERE batchID='".$this->BatchID."' AND activeflag=1 ORDER BY lastupdated DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getAnnouncement($member['ID']);
			array_push($list,$temp);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	}

class Branch
{
	
	
		var $ID;
		var $name;
		var $activeflag;
		var $datecreated;
		var $createdby;
		var $lastupdated;
		var $creatorObj;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}
		
		function getID()
		{
			return $this->ID;
		}
		
		function getName()
		{
			return $this->name;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getCreatorObj()
		{
			return $this->creatorObj;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function setName($name)
		{
			$this->name = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
	function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE branch SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
			function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM branch WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->creatorObj=getUser($this->createdby);
		}
	}
		
		
	function update()
		{
			$conn = getConnection();
			$query = "UPDATE branch SET activeflag = '".$this->activeflag."', name = '".$this->name."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
		
		
	}




class Batch
{
	    var $ID;
		var $name;
		var $activeflag;
		var $examyear;
		var $branchID;
		var $datecreated;
		var $createdby;
		var $lastupdated;
		//var $creatorID;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

function getID()
		{
			return $this->ID;
		}
	
	
	function getName()
		{
			return $this->name;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getExamYear()
		{
			return $this->examyear;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getCreatorObj()
		{
			return getUser($this->getCreatedBy());
		}
		
		
		
		function getBranchObj()
		{
			return getBranch($this->getBranchID());
		}
		
		function getBranchID()
		{
			return $this->branchID;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function setName($name)
		{
			$this->name = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
function setExamYear($year)
		{
			$this->examyear = $year;
		}
		
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function getBestDisplay()
		{
			
			return $this->getBranchObj()->getName()." : ".$this->getName()." : ".$this->getExamYear();
			}
		
		function getBestDisplay1()
		{
			
			return $this->getBranchObj()->getName()." : ".$this->getName();
			}
			
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE batch SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM batch WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setExamYear(trim($member['examyear']));
$this->branchID=trim($member['branchID']);

		}
	}
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE batch SET activeflag = '".$this->activeflag."', name = '".$this->name."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
		
	}
	
	class Notes
{
	    var $ID;
		var $name;
		var $activeflag;
		var $url;
		var $BatchID;
		var $SubjectID;
		var $datecreated;
		var $createdby;
		var $lastupdated;
	    var $type;
		var $testID;
		var $same_type;
		var $indentifier;
		var $moduleID;
		
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}
function getID()
		{
			return $this->ID;
		}
		
		function getName()
		{
			return $this->name;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getUrl()
		{
			return $this->url;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getSubjectObj()
		{
			return getSubject($this->SubjectID);
		}
		
		function getTestID()
		{
			return $this->testID;
		}
		
		function getBatchObj()
		{
			return getBatch($this->BatchID);
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
		function getType()
		{
			return $this->type;
		}
		
		function getSameType()
		{
			return $this->same_type;
		}

function getIndentifier()
		{
			return $this->indentifier;
		}

function getModuleID()
		{
			return $this->moduleID;
		}

function setName($name)
		{
			$this->name = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
function setUrl($url)
		{
			$this->url = $url;
		}
		
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function setSubjectID($SubjectID)
		{
			$this->SubjectID = $SubjectID;
		}
		
		function setType($type)
		{
			$this->type = $type;
		}
	
	function setSameType($type)
		{
			$this->same_type = $type;
		}

function setIndentifier($indentifier)
		{
			$this->indentifier = $indentifier;
		}
	
	function setModuleID($a)
		{
			$this->moduleID = $a;
		}
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE notes SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
			return $result;
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM notes WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setUrl(trim($member['url']));
$this->BatchID=trim($member['batchID']);
$this->SubjectID=trim($member['subjectID']);
$this->setType(trim($member['type']));
$this->testID=trim($member['testID']);
$this->setSameType(trim($member['same_type']));
$this->setIndentifier(trim($member['indentifier']));
$this->setModuleID(trim($member['moduleID']));
		}
	}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE notes SET activeflag = '".$this->activeflag."', name = '".$this->name."', createdby = '".$this->createdby."', url = '".$this->url."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
		
	}
	
	class BatchClass
{
	    var $ID;
		var $name;
		var $activeflag;
		var $info;
		var $batchID;
		var $datecreated;
		var $createdby;
		var $lastupdated;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}
function getID()
		{
			return $this->ID;
		}
	
			function getName()
		{
			return $this->name;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getInfo()
		{
			return $this->info;
		}
		
		function getBatchID()
		{
			return $this->batchID;
		}
		
		function getBestDisplay()
		{
			return getBatch($this->batchID)->getBestDisplay().' : '.$this->name;
		}
		
		
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function setName($name)
		{
			$this->name = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
function setInfo($info)
		{
			$this->info = $info;
		}
		
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
	
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE batchclass SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM batchclass WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setInfo(trim($member['info']));
$this->batchID=trim($member['batchID']);
		}
	}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE batchclass SET activeflag = '".$this->activeflag."', name = '".$this->name."', info = '".$this->info."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
			
	}
	
		class Announcement
{
	    var $ID;
		var $display;
		var $activeflag;
		var $batchID;
		var $datecreated;
		var $createdby;
		var $lastupdated;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}
function getID()
		{
			return $this->ID;
		}
	
				function getName()
		{
			return $this->name;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getDisplay()
		{
			return $this->display;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getBatchObj()
		{
			return getBatch($this->batchID);
		}
		
		function getBatchID()
		{
			return $this->batchID;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function setName($name)
		{
			$this->name = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
function setDisplay($display)
		{
			$this->display = $display;
		}
		
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
	
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE announcement SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM announcement WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setDisplay(trim($member['display']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->batchID=trim($member['batchID']);
		}
	}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE announcement SET activeflag = '".$this->activeflag."', display = '".$this->display."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
			
	}
	
		class Test
{
	    var $ID;
		var $name;
		var $maximum;
	    var $topic;
		var $datetest;
		var $activeflag;
		var $SubjectID;
		var $BatchID;
		var $datecreated;
		var $createdby;
		var $lastupdated;
		var $type;
		var $indentifier;
		var $quiztype;
		var $quizmodule;
		var $correctMark;
		var $wrongMark;
		var $noMark;
		var $average;
		var $typeID;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	function getID()
		{
			return $this->ID;
		}
		
		
		function getName()
		{
			return $this->name;
		}
		
		function getMaximum()
		{
			return $this->maximum;
		}
		
	/*	function getHighest()
		{
			return $this->highest;
		}
		*/
		function getTopic()
		{
			return $this->topic;
		}
		
		function getDateTest()
		{
			//return $this->datetest;
		$temp=array();
		$temp=explode('-',$this->datetest);
		$date=$temp['2'].'-'.$temp['1'].'-'.$temp['0'];
		return $date;
		
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
function getSubjectObj()
		{
			return getSubject($this->SubjectID);
		}
		
		function getSubjectID()
		{
			return $this->SubjectID;
		}
		
		function getBatchObj()
		{
			return getBatch($this->BatchID);
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function getType()
		{
			return $this->type;
		}

function getIndentifier()
		{
			return $this->indentifier;
		}

function getQuizType()
		{
			return $this->quiztype;
		}
		
		function getQuizModuleID()
		{
			return $this->quizmodule;
		}
		
		function getCorrectMark()
		{
			return $this->correctMark;
		}
		
		function getWrongMark()
		{
			return $this->wrongMark;
		}
		
		function getNoMark()
		{
			return $this->noMark;
		}
		
		function getAverage()
		{
			return $this->average;
		}
		
		function getTypeID()
		{
			return $this->typeID;
		}

function setName($name)
		{
			$this->name = $name;
		}

function setMaximum($maximum)
		{
			$this->maximum = $maximum;
		}
		
/*		function setHighest($highest)
		{
			$this->highest = $highest;
		}
		*/
		
		function setTopic($topic)
		{
			$this->topic = $topic;
		}
		
		function setDateTest($datetest)
		{
			$this->datetest = $datetest;
		}
		

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
function setSubjectID($SubjectID)
		{
			$this->SubjectID = $SubjectID;
		}
		
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function setType($type)
		{
			$this->type = $type;
		}

function setIndentifier($indentifier)
		{
			$this->indentifier = $indentifier;
		}

function setQuizType($a)
		{
			$this->quiztype = $a;
		}
		
		function setQuizModule($a)
		{
			$this->quizmodule = $a;
		}
			
		function setCorrectMark($a)
		{
			$this->correctMark=$a;
		}
		
		function setWrongMark($a)
		{
			$this->wrongMark=$a;
		}	
		
		function setNoMark($a)
		{
			$this->noMark=$a;
		}	
			
			function setAverage($a)
		{
			$this->average=$a;
		}
			
			function setTypeID($a)
		{
			$this->typeID=$a;
		}
			
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			
			if($this->getType()==0)
		{
			$query = "UPDATE test SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		
		}
		else
		{
		
		$conn=getConnection();
		$query = "SELECT * FROM test WHERE indentifier = '".$this->indentifier."' AND activeflag = '".$this->activeflag."' AND type = 1";
		$result1 = mysql_query($query);
		
		while($member = mysql_fetch_array($result1))
		{
			$conn=getConnection();
			$query2 = "UPDATE test SET activeflag = '".$ac."' WHERE ID = ".$member['ID'];
			$result2 = mysql_query($query2);
		}
		}
		
		}
		
		function updateAverageOfTest($ac)
		{
			$conn = getConnection();
			
			if($this->getType()==0)
		{
			$query = "UPDATE test SET average = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		
		}
		else
		{
		
		$conn=getConnection();
		$query = "SELECT * FROM test WHERE indentifier = '".$this->indentifier."' AND activeflag = '".$this->activeflag."' AND type = 1";
		$result1 = mysql_query($query);
		
		while($member = mysql_fetch_array($result1))
		{
			$conn=getConnection();
			$query2 = "UPDATE test SET average = '".$ac."' WHERE ID = ".$member['ID'];
			$result2 = mysql_query($query2);
		}
		}
		
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM test WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setMaximum(trim($member['maximum']));
$this->setTopic(trim($member['topic']));
$this->setDateTest(trim($member['datetest']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->BatchID=trim($member['batchID']);
$this->SubjectID=trim($member['subjectID']);
$this->setType(trim($member['type']));
$this->setIndentifier(trim($member['indentifier']));
$this->setQuizType(trim($member['quiztype']));
$this->setQuizModule(trim($member['quizmodule']));
$this->setCorrectMark(trim($member['correctmark']));
$this->setWrongMark(trim($member['wrongmark']));
$this->setNoMark(trim($member['nomark']));
$this->setAverage(trim($member['average']));
$this->setTypeID(trim($member['typeID']));
		}
		
	
		
	}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE test SET activeflag = '".$this->activeflag."', name = '".$this->name."', maximum = '".$this->maximum."', topic = '".$this->topic."', datetest = '".$this->datetest."', subjectID = '".$this->SubjectID."', createdby = '".$this->createdby."', type = '".$this->type."', indentifier = '".$this->indentifier."', correctmark = '".$this->correctMark."', wrongmark = '".$this->wrongMark."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
			
			function getHighestMarks()
	{
		$conn=getConnection();
		
		if($this->getType()==0)
		{
		$query = "SELECT * FROM marks WHERE testID='".$this->ID."' ORDER BY mark DESC";
		$result = mysql_query($query,$conn);
		
		$member = mysql_fetch_array($result);
		$temp = getMarks($member['ID']);
		
		if($temp != NULL)
		{
			return $temp;
		}

		return NULL;
		}
		else
		{
			$testlist = array();
			$testlist =$this->getCommonTests();
			$condition='';
			for($i=0;$i<count($testlist);$i++)
    {
	
	$condition.="testID = '".$testlist[$i]->getID()."' ";
	if($i!=(count($testlist)-1))
	{$condition.="OR ";}
		
	}
	$query = "SELECT * FROM marks WHERE ".$condition." ORDER BY mark DESC";
		$result = mysql_query($query);
		$member = mysql_fetch_array($result);
		$temp = getMarks($member['ID']);
		
		if($temp != NULL)
		{
			return $temp;
		}

		return NULL;
			
			}
		}	
		
		function getCommonBatches()
	{
		$conn=getConnection();
		$list = array();
$query = "SELECT * FROM test WHERE type = 1 AND indentifier = '".$this->getIndentifier()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
	
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['batchID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		$temp = getBatch($this->BatchID);
		array_push($list,$temp);
		return $list;
		
		}	
		
		
		function getCommonTests()
	{
		$conn=getConnection();
		$list = array();
$query = "SELECT * FROM test WHERE type = 1 AND indentifier = '".$this->getIndentifier()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
	
		while($member = mysql_fetch_array($result))
		{
			$temp = getTest($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		
		}	
		
	}
	
	class Test1
{
	    var $ID;
		var $name;
		var $maximum;
	//	var $highest;
		var $topic;
		var $datetest;
		var $activeflag;
		var $SubjectID;
		var $BatchID;
		var $datecreated;
		var $createdby;
		var $lastupdated;
		var $type;
		var $indentifier;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	function getID()
		{
			return $this->ID;
		}
		
		
		function getName()
		{
			return $this->name;
		}
		
		function getMaximum()
		{
			return $this->maximum;
		}
		
	/*	function getHighest()
		{
			return $this->highest;
		}
		*/
		function getTopic()
		{
			return $this->topic;
		}
		
		function getDateTest()
		{
			//return $this->datetest;
		$temp=array();
		$temp=explode('-',$this->datetest);
		$date=$temp['2'].'-'.$temp['1'].'-'.$temp['0'];
		return $date;
		
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
function getSubjectID()
		{
			return $this->SubjectID;
		}
		
		function getBatchID()
		{
			return $this->BatchID;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function getType()
		{
			return $this->type;
		}

function getIndentifier()
		{
			return $this->indentifier;
		}


function setName($name)
		{
			$this->name = $name;
		}

function setMaximum($maximum)
		{
			$this->maximum = $maximum;
		}
		
/*		function setHighest($highest)
		{
			$this->highest = $highest;
		}
		*/
		
		function setTopic($topic)
		{
			$this->topic = $topic;
		}
		
		function setDateTest($datetest)
		{
			$this->datetest = $datetest;
		}
		

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
function setSubjectID($SubjectID)
		{
			$this->SubjectID = $SubjectID;
		}
		
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function setType($type)
		{
			$this->type = $type;
		}

function setIndentifier($indentifier)
		{
			$this->indentifier = $indentifier;
		}
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			
			if($this->getType()==0)
		{
			$query = "UPDATE test SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		
		}
		else
		{
		
		$conn=getConnection();
		$query = "SELECT * FROM test WHERE indentifier = '".$this->indentifier."' AND activeflag = '".$this->activeflag."' AND type = 1";
		$result1 = mysql_query($query);
		
		while($member = mysql_fetch_array($result1))
		{
			$conn=getConnection();
			$query2 = "UPDATE test SET activeflag = '".$ac."' WHERE ID = ".$member['ID'];
			$result2 = mysql_query($query2);
		}
		}
		
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM test WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setMaximum(trim($member['maximum']));
//$this->setHighest(trim($member['highest']));
$this->setTopic(trim($member['topic']));
$this->setDateTest(trim($member['datetest']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->BatchID=trim($member['batchID']);
$this->SubjectID=trim($member['subjectID']);
$this->setType(trim($member['type']));
$this->setIndentifier(trim($member['indentifier']));
		}
		
	
		
	}
		
		
			
			function getHighestMarks()
	{
		$conn=getConnection();
		
		if($this->getType()==0)
		{
		$query = "SELECT * FROM marks WHERE testID='".$this->ID."' ORDER BY mark DESC";
		$result = mysql_query($query,$conn);
		
		$member = mysql_fetch_array($result);
		$temp = getMarks($member['ID']);
		
		if($temp != NULL)
		{
			return $temp;
		}

		return NULL;
		}
		else
		{
			$testlist = array();
			$testlist =$this->getCommonTests();
			$condition='';
			for($i=0;$i<count($testlist);$i++)
    {
	
	$condition.="testID = '".$testlist[$i]->getID()."' ";
	if($i!=(count($testlist)-1))
	{$condition.="OR ";}
		
	}
	$query = "SELECT * FROM marks WHERE ".$condition." ORDER BY mark DESC";
		$result = mysql_query($query);
		$member = mysql_fetch_array($result);
		$temp = getMarks($member['ID']);
		
		if($temp != NULL)
		{
			return $temp;
		}

		return NULL;
			
			}
		}	
		
		function getCommonBatches()
	{
		$conn=getConnection();
		$list = array();
$query = "SELECT * FROM test WHERE type = 1 AND indentifier = '".$this->getIndentifier()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
	
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['batchID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		    $temp = getBatch($this->getID());
			array_push($list,$temp);
			return $list;
		
		
		}	
		
		
		function getCommonTests()
	{
		$conn=getConnection();
		$list = array();
$query = "SELECT * FROM test WHERE type = 1 AND indentifier = '".$this->getIndentifier()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
	
		while($member = mysql_fetch_array($result))
		{
			$temp = getTest($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		
		}	
		
	}
	
	
		class Subject
{
	    var $ID;
		var $name;
		var $activeflag;
		var $datecreated;
		var $createdby;
		var $lastupdated;
		
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	function getID()
		{
			return $this->ID;
		}
		
		function getName()
		{
			return $this->name;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function setName($name)
		{
			$this->name = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE subject SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM subject WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));

		}
	}
	
	}
	
	
	
		class Report
{
	    var $ID;
		var $name;
		var $TestObjs;
		var $Testids;
		var $BatchObj;
		var $activeflag;
		var $datecreated;
		var $createdby;
		var $lastupdated;
		var $datereport;
		var $type;
		var $indentifier;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	function getID()
		{
			return $this->ID;
		}
		
		function getName()
		{
			return $this->name;
		}
		
		function getBatchObj()
		{
			return $this->BatchObj;
		}
		
		function getDateReport()
		{
			//return $this->datereport;
				
		$temp=array();
		$temp=explode('-',$this->datereport);
		$date=$temp['2'].'-'.$temp['1'].'-'.$temp['0'];
		return $date;
		}
		
		function getTestObjs()
		{
			return $this->TestObjs;
		}
		
		function getTestids()
		{
			return $this->Testids;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function getType()
		{
			return $this->type;
		}

function getIndentifier()
		{
			return $this->indentifier;
		}
		
function setTestids($Testids)
		{
			$this->Testids = $Testids;
		}
		
function setName($name)
		{
			$this->name = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setDateReport($datereport)
		{
			$this->datereport = $datereport;
		}

		
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
		function setType($type)
		{
			$this->type = $type;
		}

function setIndentifier($indentifier)
		{
			$this->indentifier = $indentifier;
		}
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE report SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM report WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setDateCreated(trim($member['datecreated']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(getUser(trim($member['createdby'])));
$this->setLastUpdated(trim($member['lastupdated']));
$this->BatchObj=(getBatch(trim($member['batchID'])));
$this->TestObjs=getTestObjsForReport(trim($member['testID']));
$this->setDateReport(trim($member['datereport']));
$this->setTestids(trim($member['testID']));
$this->setType(trim($member['type']));
$this->setIndentifier(trim($member['indentifier']));
		}
	}
	
	function update()
		{
			$conn = getConnection();
			$query = "UPDATE report SET activeflag = '".$this->activeflag."', name = '".$this->name."', testID = '".$this->Testids."', datereport = '".$this->datereport."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
			
	function getTestObjsForReportUpdate()
	{
		$conn=getConnection();
		
		if($this->getType()==0)
		{
			$list = array();
			$list = getAllActiveTestsByBatch($this->getBatchObj());
			if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
			
			}
		else
		{
		
		$list = array();
		$list = getAllCommonActiveTestsByBatch($this->getBatchObj());
			if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		}
			
	}
			
	function getCommonBatches()
	{
		$conn=getConnection();
		$list = array();
$query = "SELECT * FROM report WHERE type = 1 AND indentifier = '".$this->getIndentifier()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
	
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['batchID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		
		
		
		}	
		
		function getCommonReportByBatch()
	{
		$conn=getConnection();
		$list = array();
if($this->getType()==1)
{
$query = "SELECT * FROM report WHERE type = 1 AND indentifier = '".$this->getIndentifier()."' AND activeflag = 1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
	
		while($member = mysql_fetch_array($result))
		{
			$temp = getReport($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
}
else
{
	$temp = getReport($this->ID);
	array_push($list,$temp);
	return $list;
	}
		
	
		}	
			
	}
	
	class Marks
	{
		var $ID;
		var $studentID;
		var $TestID;
		var $mark;
		var $activeflag;
		var $datecreated;
		var $createdby;
		var $lastupdated;
		
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	function getID()
		{
			return $this->ID;
		}
		
		function getStudentID()
		{
			return $this->studentID;
		}
		
		function getMark()
		{
			return $this->mark;
		}
		
		function getActiveflag()
		{
			return $this->activeflag;
		}
		
		function getDisplayMark()
		{
			if($this->activeflag==-1)
			return "Absent";
			elseif($this->activeflag==-2)
			return "Not Attended";
			else
			return $this->mark;
		}
		
		function getDisplayMark1()
		{
			if($this->activeflag==-1)
			return 0;
			elseif($this->activeflag==-2)
			return 0;
			else
			return $this->mark;
		}
		
				function getDisplayMark2()
		{
			if($this->activeflag==-1)
			return 'Ab';
			elseif($this->activeflag==-2)
			return 'Not Attended';
			else
			return $this->mark;
		}
		
		function getMarkStatus()
		{
			if($this->activeflag==-1)
			return "Absent";
			elseif($this->activeflag==-2)
			return "Not Attended";
			else
			return "Attended";
		}
		
		function getTestObj()
		{
			return getTest($this->TestID);
		}
		
			function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
		function setStudentID($studentID)
		{
			$this->studentID = $studentID;
		}
		
		function setMark($mark)
		{
			$this->mark = $mark;
		}
		
		function setActiveflag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
		
		function setTestID($TestID)
		{
			$this->TestID = $TestID;
		}
		
		function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
	
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM marks WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setStudentID(trim($member['studentID']));
$this->setMark(trim($member['mark']));
$this->setActiveflag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->TestID=trim($member['testID']);
$this->setDateCreated(trim($member['datecreated']));
		}
	}
		}
	
	class User
{
	    var $ID;
		var $name;
		var $username;
		var $hashed_password;
		var $level;
		var $activeflag;
		var $datecreated;
		var $lastlogin;
		var $classID;
		var $loginflag;
		var $loginip;
		//var $instituteID;
		var $branchID;
		var $phone;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	function getID()
		{
			return $this->ID;
		}
		
		function getUsername()
		{
			return $this->username;
		}
		
		function getPassword()
		{
			return $this->hashed_password;
		}
		
		function getName()
		{
			return $this->name;
		}
		
		function getBestDisplay()
		{
			if($this->branchID!=0)
			return getBranch($this->branchID)->getName().' : '.$this->name;
			else
			return 'All Branches : '.$this->name;
		}
		
		function getLevel()
		{
			return $this->level;
		}
		
		function getLevelDisplay()
		{
			if($this->level==1)
			return 'Admin';
			elseif($this->level==2)
			return 'Staff';
			elseif($this->level==3)
			return 'Teacher';
			else
			return '';
		}
		
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
			function getLastLogin()
		{
			return $this->lastlogin;
		}
		
		function getClassID()
		{
			return $this->classID;
		}
		
		function getUserBranchID()
		{
			return $this->branchID;
		}
		
		function getInstituteObj()
		{
			return getInstitute($this->getClassID());
		}
		
			function getLoginFlag()
		{
			return $this->loginflag;
		}
		
		function getLoginIP()
		{
			return $this->loginip;
		}
		
		function getPhone()
		{
			return $this->phone;
		}
		
		function setName($name)
		{
			$this->name = $name;
		}
		
		function setUsername($username)
		{
			$this->username = $username;
		}
		
		function setPassword($pass)
		{
			$this->hashed_password = $pass;
		}
		
		function setLevel($level)
		{
			$this->level = $level;
		}
		
		function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
		
		function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
		
		function setLastLogin($lastlogin)
		{
			$this->lastlogin = $lastlogin;
		}
		
		function setClassID($classID)
		{
			$this->classID = $classID;
		}
		
		function setUserBranchID($batchID)
		{
			$this->branchID = $batchID;
		}
		
		
		
		function setLoginFlag($loginflag)
		{
			$this->loginflag = $loginflag;
		}
		
		function setLoginIp($loginip)
		{
			$this->loginip = $loginip;
		}
		
		function setPhone($phone)
		{
			$this->phone = $phone;
		}
		
		
		function updateActiveFlag($ac)
		{
			$conn = getMainConnection();
			$query = "UPDATE users SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
				function updateLoginFlag($ac)
		{
			$conn = getMainConnection();
			$query = "UPDATE users SET loginflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
				function updateLastLogin()
		{
			$conn = getMainConnection();
			$query = "UPDATE users SET lastlogin = CURRENT_TIMESTAMP WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function updateLoginIP($ip)
		{
			$conn = getMainConnection();
			$query = "UPDATE users SET loginip = '".$ip."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getMainConnection();
			$query = "SELECT * FROM users WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setUsername(trim($member['username']));
$this->setPassword(trim($member['hashed_password']));
$this->setLevel(trim($member['level']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setDateCreated(trim($member['datecreated']));
$this->setClassID(trim($member['classID']));
$this->setUserBranchID(trim($member['branchID']));
$this->setPhone(trim($member['phone']));
$this->setLoginFlag(trim($member['loginflag']));
$this->setLoginIp(trim($member['loginip']));

		}
	}
	
	function update()
		{
			$conn = getMainConnection();
			$query = "UPDATE users SET activeflag = '".$this->activeflag."', name = '".$this->name."', phone = '".$this->phone."', hashed_password = '".$this->hashed_password."' WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
			
			
			function getPermissions()
	{
		
		$list=array();
		$conn = getMainConnection();
		$query = "SELECT * FROM permission WHERE userID = '".$this->ID."' AND activeflag = 1";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = $member['permissionType'];
			array_push($list,$temp);
		}
        
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
		
		
	}
	
	class Institute
	{
		
		var $ID;
		var $classname;
		var $databasename;
		var $amount;
		var $activeflag;
		var $datecreated;
		var $lastupdated;
		var $comment;
		var $contactno;
		var $address;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	function getID()
		{
			return $this->ID;
		}
		
		function getClassName()
		{
			return $this->classname;
		}
		
		function getDatabaseName()
		{
			return $this->databasename;
		}
		
		function getAmount()
		{
			return $this->amount;
		}
		
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
			function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
		function getComment()
		{
			return $this->comment;
		}
		
			function getContactNo()
		{
			return $this->contactno;
		}
		
		function getAddress()
		{
			return $this->address;
		}
		
				function setClassName($classname)
		{
			  $this->classname=$classname;
		}
		
		function setDatabaseName($databasename)
		{
			  $this->databasename=$databasename;
		}
		
		function setAmount($amount)
		{
			  $this->amount=$amount;
		}
		
		function setActiveFlag($activeflag)
		{
			  $this->activeflag=$activeflag;
		}
		
		function setDateCreated($datecreated)
		{
			  $this->datecreated=$datecreated;
		}
		
			function setLastUpdated($lastupdated)
		{
			  $this->lastupdated=$lastupdated;
		}
		
		function setComment($comment)
		{
			  $this->comment=$comment;
		}
		
			function setContactNo($contactno)
		{
			  $this->contactno=$contactno;
		}
		
		function setAddress($address)
		{
			  $this->address=$address;
		}
		
		
		
		function updateActiveFlag($ac)
		{
			$conn = getMainConnection();
			$query = "UPDATE info SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		

	function read()
		{
			$conn = getMainConnection();
			$query = "SELECT * FROM info WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setClassName(trim($member['classname']));
$this->setDatabaseName(trim($member['databasename']));
$this->setAmount(trim($member['amount']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setDateCreated(trim($member['datecreated']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setContactNo(trim($member['contactno']));
$this->setAddress(trim($member['address']));
$this->setComment(trim($member['comment']));
		}
	}
		
		}

class StudentLogin
	{
		
		var $ID;
		var $firstname;
		var $lastname;
		var $phone_stu;
		var $phone_father;
		var $examyear;
		var $activeflag;
		var $actid;
		var $dateofbirth;
		var $loginflag;
		var $studentpass;
		var $parentpass;
		var $lastlogin;
		var $instituteIDs;
		
		var $loginip;
		
		// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

		
		

		// -- Function Name : setuser_type
		// -- Params : 
		// -- Purpose : 
		function getFullName()
		{
			return $this->firstname." ".$this->lastname;
		}
			

		function setFirstName($firstname)
		{
			$this->firstname = $firstname;
		}


		
	function setLastName($lastname)
		{
			$this->lastname = $lastname;
		}
		
		
function setPhoneStu($phone_stu)
		{
			$this->phone_stu = $phone_stu;
		}

	function setPhoneFather($phone_father)
		{
			$this->phone_father = $phone_father;
		}
	
		/**
		* This function is used to set the last name of the student
		*/
		

		/**
		* This function is used to set the Photo of the student
		*/
		
function setLoginFlag($loginflag)
		{
			$this->loginflag = $loginflag;
		}


function setExamYear($examyear)
		{
			$this->examyear = $examyear;
		}



function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}

function setActid($ac)
		{
			$this->actid = $ac;
		}




function setDateOfBirth($dateofbirth)
		{
			$this->dateofbirth = $dateofbirth;
		}

function setStudentPass($studentpass)
		{
			$this->studentpass = $studentpass;
		}

function setParentPass($parentpass)
		{
			$this->parentpass = $parentpass;
		}
	function setLastLogin($ll)
		{
			$this->lastlogin = $ll;
		}



function setInstituteIDs($instituteIDs)
		{
			$this->instituteIDs = $instituteIDs;
		}

function setLoginIP($loginip)
		{
			$this->loginip = $loginip;
		}



	function getID()
		{
			return $this->ID;
		}
	
	
		

				function getFirstName()
		{
			return $this->firstname;
		}


		
	function getLastName()
		{
			return $this->lastname;
		}
		
		
function getPhoneStu()
		{
			return $this->phone_stu;
		}

	function getPhoneFather()
		{
			return $this->phone_father;
		}
	
		/**
		* This function is used to get the last name of the student
		*/
		

		/**
		* This function is used to get the Photo of the student
		*/
		
function getLoginFlag()
		{
			return $this->loginflag;
		}


function getExamYear()
		{
			return $this->examyear;
		}



function getActiveFlag()
		{
			return $this->activeflag;
		}

function getActid()
		{
			return $this->actid;
		}




function getDateOfBirth()
		{
			return $this->dateofbirth;
		}

function getStudentPass()
		{
			return $this->studentpass;
		}

function getParentPass()
		{
			return $this->parentpass;
		}
	function getLastLogin()
		{
			return $this->lastlogin;
		}



function getInstituteIDs()
		{
			return $this->instituteIDs;
		}

function getLoginIP()
		{
			return $this->loginip;
		}


		function updateLoginIP($ip)
		{
			$conn = getMainConnection();
			$query = "UPDATE student SET loginip = '".$ip."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}

		function updateLastLogin()
		{
			$conn = getMainConnection();
			$query = "UPDATE student SET lastlogin = CURRENT_TIMESTAMP WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		

		// -- Function Name : read
		// -- Params : 
		// -- Purpose : 
		function read()
		{
			$conn = getMainConnection();
			$query = "SELECT * FROM student WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
				$member = mysql_fetch_array($result);

$this->setFirstName(trim($member['firstname']));
$this->setLastName(trim($member['lastname']));
$this->setPhoneStu(trim($member['phone_stu']));
$this->setPhoneFather(trim($member['phone_father']));
$this->setLoginFlag(trim($member['loginflag']));
$this->setExamYear(trim($member['examyear']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setActid(trim($member['actid']));
$this->setDateOfBirth(trim($member['dateofbirth']));
$this->setParentPass(trim($member['parentpass']));
$this->setStudentPass(trim($member['studentpass']));
$this->setLastLogin(trim($member['lastlogin']));
$this->setInstituteIDs(trim($member['instituteIDs']));
$this->setLoginIP(trim($member['loginip']));
			}

		}
		
		function getInstituteIDoFStudent()
		{
			$conn = getMainConnection();
			$query = "SELECT * FROM studentinstituteid WHERE studentID='".$this->ID."' AND activeflag=1";
			$result = mysql_query($query);
			$temparray=array();
			$temp='';
			
			while($member = mysql_fetch_array($result))
		{
			$id = $member['instituteID'];
			array_push($temparray,$id);
		}

        $temp = implode(';',$temparray);
		
		return $temp;

			}
	
	}
	
	class Remark
{
	
	
		var $ID;
		var $minimum;
		var $activeflag;
		var $maximum;
		var $createdby;
		var $lastupdated;
		var $display;
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}
		
		function getID()
		{
			return $this->ID;
		}
		
		function getDisplay()
		{
			return $this->display;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getMinimum()
		{
			return $this->minimum;
		}
		
		function getMaximum()
		{
			return $this->maximum;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function setDisplay($name)
		{
			$this->display = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	function setMinimum($d)
		{
			$this->minimum = $d;
		}
	
	function setMaximum($d)
		{
			$this->maximum = $d;
		}
		
	function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
	
	
	
	function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE remark SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
			function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM remark WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setDisplay(trim($member['display']));
$this->setMinimum(trim($member['min']));
$this->setMaximum(trim($member['max']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));

		}
	}
		
		
	function update()
		{
			$conn = getConnection();
			$query = "UPDATE remark SET activeflag = '".$this->activeflag."', display = '".$this->display."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}
		
		
	}
	
	class Permission
{
	
	
		var $ID;
		var $userID;
		var $activeflag;
		var $permissionType;
		var $lastupdated;
		
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}
		
		function getID()
		{
			return $this->ID;
		}
		
		function getUserID()
		{
			return $this->userID;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getPermissionType()
		{
			return $this->permissionType;
		}
		
		
		
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}

function setUserID($name)
		{
			$this->userID = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	
	
	function setPermissionType($d)
		{
			$this->permissionType = $d;
		}
		
	
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
	function updateActiveFlag($ac)
		{
			$conn = getMainConnection();
			$query = "UPDATE permission SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
			function read()
		{
			$conn = getMainConnection();
			$query = "SELECT * FROM permission WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setUserID(trim($member['userID']));
$this->setPermissionType(trim($member['permissionType']));

$this->setActiveFlag(trim($member['activeflag']));

$this->setLastUpdated(trim($member['lastupdated']));

		}
	}
		
		
	
		
		
	}
	
	class Video
{
	
	
		var $ID;
		var $name;
		var $url;
		var $activeflag;
		var $lastupdated;
		var $createdby;
		var $start_date;
		var $end_date;
		var $examyear;
		
	
	// -- Function Name : __construct
		// -- Params : $ID
		// -- Purpose : 
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}
		
		function getID()
		{
			return $this->ID;
		}
		
		function getName()
		{
			return $this->name;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getUrl()
		{
			return $this->url;
		}
		
		
		function getStartDate()
		{
			return $this->start_date;
		}
		
		function getEndDate()
		{
			return $this->end_date;
		}
		
		function getExamyear()
		{
			return $this->examyear;
		}
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
		function getVideoFormat()
		{
			$temp= $this->url;
			$tempa=explode('.',$temp);
			return $tempa[1];
		}



function setCreatedBy($name)
		{
			$this->createdby = $name;
		}
		
		function setName($name)
		{
			$this->name = $name;
		}

function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	

	
	function setUrl($d)
		{
			$this->url = $d;
		}
		
	function setStartDate($a)
		{
			 $this->start_date=$a;
		}
		
		function setEndDate($a)
		{
			$this->end_date=$a;
		}
		
		function setExamyear($a)
		{
			$this->examyear=$a;
		}
	
	
	function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
	function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE video SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
			function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM video WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);

$this->setCreatedBy(trim($member['createdby']));
$this->setUrl(trim($member['url']));
$this->setName(trim($member['name']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setStartDate(trim($member['start_date']));
$this->setEndDate(trim($member['end_date']));
$this->setExamyear(trim($member['examyear']));

		}
	}
		
		
	
		
		
	}
?>