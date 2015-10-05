<?php 

include_once 'constant.php';
include_once 'connection.php';
include_once 'globalfunctions.php';


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
			return $this->dateofbirth;
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
			return $this->dateofadmission;
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
$this->setBatchObj(new Batch($member['batchID']));
$this->setExamYear(trim($member['examyear']));
$this->setPicUrl(trim($member['picurl']));
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
	function getMyMarks()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM marks WHERE studentID='".$this->ID."' ORDER BY datecreated DESC";
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
		
	}

class Short
	{
		
		var $ID;
		var $mainID;
		var $rollno;
		var $grno;
		var $firstname;
		var $lastname;
		
		var $Fname;
	    var $BatchObj;
		var $examyear;
		var $activeflag;
		var $ClassObj;
	    var $BranchObj;
		var $loginflag;
		
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

function setLoginFlag($loginflag)
		{
			$this->loginflag = $loginflag;
		}
		
	function setLastName($lastname)
		{
			$this->lastname = $lastname;
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
			}

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
		
	}




class Batch
{
	    var $ID;
		var $name;
		var $activeflag;
		var $examyear;
		var $BranchObj;
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
		
		function getExamYear()
		{
			return $this->examyear;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getBranchObj()
		{
			return $this->BranchObj;
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
$this->BranchObj=(new Branch(trim($member['branchID'])));
		}
	}
		
	}
	
	class Notes
{
	    var $ID;
		var $name;
		var $activeflag;
		var $url;
		var $BatchObj;
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
		
		function getUrl()
		{
			return $this->url;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getBatchObj()
		{
			return $this->BatchObj;
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
		
	
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE notes SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
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
$this->BatchObj=(new Batch(trim($member['batchID'])));
		}
	}
		
	}
	
	class BatchClass
{
	    var $ID;
		var $name;
		var $activeflag;
		var $info;
		var $BatchObj;
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
		
		function getBatchObj()
		{
			return $this->BatchObj;
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
$this->BatchObj=(new Batch(trim($member['batchID'])));
		}
	}
		
	}
	
		class Announcement
{
	    var $ID;
		var $display;
		var $activeflag;
		var $BatchObj;
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
			return $this->BatchObj;
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
$this->BatchObj=(new Batch(trim($member['batchID'])));
		}
	}
		
	}
	
		class Test
{
	    var $ID;
		var $name;
		var $maximum;
	//	var $highest;
		var $topic;
		var $datetest;
		var $activeflag;
		var $SubjectObj;
		var $BatchObj;
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
			return $this->datetest;
		}
		
function getActiveFlag()
		{
			return $this->activeflag;
		}
		
function getSubjectObj()
		{
			return $this->SubjectObj;
		}
		
		function getBatchObj()
		{
			return $this->BatchObj;
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
	
function setSubjectObj($SubjectObj)
		{
			$this->SubjectObj = $SubjectObj;
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
			$query = "UPDATE test SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
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
$this->BatchObj=(getBatch(trim($member['batchID'])));
$this->SubjectObj=(getSubject(trim($member['subjectID'])));
		}
		
	
		
	}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE test SET activeflag = '".$this->activeflag."', name = '".$this->name."', maximum = '".$this->maximum."', topic = '".$this->topic."', datetest = '".$this->datetest."', subjectID = '".$this->SubjectObj->getID()."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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
			return $this->datereport;
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
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->BatchObj=(getBatch(trim($member['batchID'])));
$this->TestObjs=getTestObjsForReport(trim($member['testID']));
$this->setDateReport(trim($member['datereport']));
$this->setTestids(trim($member['testID']));
		}
	}
	
	function update()
		{
			$conn = getConnection();
			$query = "UPDATE report SET activeflag = '".$this->activeflag."', name = '".$this->name."', testID = '".$this->Testids."', datereport = '".$this->datereport."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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
	
	class Marks
	{
		var $ID;
		var $studentID;
		var $TestObj;
		var $mark;
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
		
		function getDisplayMark()
		{
			if($this->mark==-1)
			return "Absent";
			elseif($this->mark==-2)
			return "Not Attended";
			else
			return $this->mark;
		}
		
		function getDisplayMark1()
		{
			if($this->mark==-1)
			return 0;
			elseif($this->mark==-2)
			return 0;
			else
			return $this->mark;
		}
		
		function getDisplayMark2()
		{
			if($this->mark==-1)
			return 'Absent';
			elseif($this->mark==-2)
			return 'Not Attended';
			else
			return $this->mark;
		}
		
		function getMarkStatus()
		{
			if($this->mark==-1)
			return "Absent";
			elseif($this->mark==-2)
			return "Not Attended";
			else
			return "Attended";
		}
		
		function getTestObj()
		{
			return $this->TestObj;
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
		
		function setTestObj($TestObj)
		{
			$this->TestObj = $TestObj;
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

$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->TestObj=(getTest(trim($member['testID'])));
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
		
		function getLevel()
		{
			return $this->level;
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
		
			function getLoginFlag()
		{
			return $this->loginflag;
		}
		
		function getLoginIP()
		{
			return $this->loginip;
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
		
		function setLoginFlag($loginflag)
		{
			$this->loginflag = $loginflag;
		}
		
		function setLoginIp($loginip)
		{
			$this->loginip = $loginip;
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
$this->setLoginFlag(trim($member['loginflag']));
$this->setLoginIp(trim($member['loginip']));

		}
	}
	}
?>