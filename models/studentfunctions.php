<?php
function getStudent($ID,$n)
	{
		$conn=getConnection();
		$query = "SELECT * FROM student WHERE ID ='".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			if($n==0)
			$tempObj = new Student($member['ID']);
			elseif($n==3)
			$tempObj = new Short1($member['ID']);
			else
			$tempObj = new Short($member['ID']);
			
			return $tempObj;
		}
		return NULL;
	}
	

	
	function getStudentByMainID($mainID,$n)
	{
		$conn=getConnection();
		$query = "SELECT * FROM student WHERE mainID ='".$mainID."' AND activeflag!=0";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows==1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = getStudent($member['ID'],$n);
			return $tempObj;
		}
		return NULL;
	}
	
		function getStudentByFatherNo($no,$n)
	{
		$conn=getConnection();
		$query = "SELECT * FROM student WHERE phone_father ='".$no."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = getStudent($member['ID'],$n);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllActiveStudents($n)
	{
		$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM student WHERE activeflag=1 ORDER BY batchID DESC,firstname ASC,lastname ASC, rollno ASC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
	function getAllBaseAppStudents()
	{
		
	$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM app_login ORDER BY lastupdated DESC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['studentID'],3);
			array_push($stulist,array($temp,$member['activeflag'],$member['phone'],$member['imei'],$member['ID']));
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;	
	}
	
	function getAllTestAppStudents()
	{
		
	$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM test_app_login ORDER BY lastupdated DESC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['studentID'],3);
			array_push($stulist,array($temp,$member['activeflag'],$member['phone'],$member['imei'],$member['ID']));
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;	
	}
	
	function getAllInActiveStudents($n)
	{
		$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM student WHERE activeflag=-1 ORDER BY ID ASC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	

	
	function getAllActiveStudentsByBatch($obj,$n)
	{
		$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM student WHERE activeflag=1 AND batchID = ".$obj->getID()." ORDER BY rollno ASC ";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
		function getAllActiveStudentsByBatchNameSorted($obj,$n)
	{
		$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM student WHERE activeflag=1 AND batchID = ".$obj->getID()." ORDER BY firstname ASC,lastname ASC ";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
	
	function getAllNewAdmissionStudent()
	{
		
	$id=getCurrentInstituteID1();
	$conn=getMainConnection();	
	$stulist = array();
	$query = "SELECT * FROM student_admin WHERE classID='".$id."' AND activeflag=0 ORDER BY lastupdated DESC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			
			array_push($stulist,$member);
			
		}
		
		return $stulist;
	}
	
function getAllStudentsByBatch($obj,$n)
	{
		$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM student WHERE batchID='".$obj->getID()."' AND activeflag<>0 ORDER BY activeflag DESC,firstname ASC,lastname ASC, rollno ASC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
	function getAllStudentsByBranch($obj,$n)
	{
		$conn=getConnection();
		$stulist = array();
		$list=array();
		$list=getAllActiveBatchesByBranch($obj);
		for($i=0;$i<count($list);$i++)
{
		
$query = "SELECT * FROM student WHERE batchID='".$list[$i]->getID()."' ORDER BY activeflag DESC,firstname ASC,lastname ASC, rollno ASC";
		 $conn=getConnection();
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		
		}
}
		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
	function getAllActiveStudentsByYear($examyear,$n)
	{
		$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM student WHERE activeflag=1 AND examyear='".$examyear."' ORDER BY firstname ASC,lastname ASC, rollno ASC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
	function getAllActiveStudentsByBatchClass($obj,$n)
	{
		$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM student WHERE activeflag=1 AND classID='".$obj->getID()."' ORDER BY firstname ASC,lastname ASC, rollno ASC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
	function getAllStudentsByBatchClass($obj,$n)
	{
		$conn=getConnection();
		$stulist = array();
		$query = "SELECT * FROM student WHERE activeflag=1 AND classID='".$obj->getID()."' ORDER BY firstname ASC,lastname ASC, rollno ASC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}

	function getAllActiveStudentsByBranch($obj,$n)
	{
		$conn=getConnection();
		$batchlist=array();
		$batchlist=getAllActiveBatchesByBranch($obj);
		$stulist = array();
		for($i=0;$i<count($batchlist);$i++)
		{
		$query = "SELECT * FROM student WHERE activeflag=1 AND batchID='".$batchlist[$i]->getID()."' ORDER BY firstname ASC,lastname ASC, rollno ASC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}
		}
		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
function createStudent($rollno,$grno,$firstname,$lastname,$Fname,$Mname,$address,$phone_stu,$phone_father,$phone_mother,$phone_other,$BatchObj,$examyear,$picture,$activeflag,$lasteditedby,$comments,$actid,$ClassObj,$loginflag,$gender,$dateofbirth,$hscno,$cetno,$college,$studentpass,$email,$lastlogin,$parentpass,$dateofadmission,$board10,$agg10,$ms10)
{
	$temp=array();
	// check whetehr student exists in main db
	list($flag,$id)=studentExistsInMainDatabase($phone_stu,$phone_father,$examyear);
	//check whether student exists in current db
	if(!studentExistsInCurrentDatabase($phone_stu,$phone_father,$examyear))
	{
	
	if($flag)
	{
		//update classid and add student
		updateStudentClassID($id,getCurrentInstituteID1());
		$mainID=$id;
		$tempobj=insertStudent($mainID,$rollno,$grno,$firstname,$lastname,$Fname,$Mname,$address,$phone_stu,$phone_father,$phone_mother,$phone_other,$BatchObj,$examyear,$picture,$activeflag,$lasteditedby,$comments,$actid,$ClassObj,$loginflag,$gender,$dateofbirth,$hscno,$cetno,$college,$studentpass,$email,$lastlogin,$parentpass,$dateofadmission,$board10,$agg10,$ms10);
		if($tempobj!=NULL)
		{
		$message="Student Added successfully : ".$firstname." ".$lastname;
		}
		else
		{
			$message="Student Addition Failed1 : ".$firstname." ".$lastname;
				$tempobj=NULL;
			}
		}
		else
		{
			//add student in main database and current one
			
			$mainID=insertStudentInMainDatabase($firstname,$lastname,$phone_stu,$phone_father,$examyear,$activeflag,$actid,$loginflag,$dateofbirth,$studentpass,$lastlogin,$parentpass,getCurrentInstituteID1());
			if($mainID!=NULL)
			{
			$tempobj=insertStudent($mainID,$rollno,$grno,$firstname,$lastname,$Fname,$Mname,$address,$phone_stu,$phone_father,$phone_mother,$phone_other,$BatchObj,$examyear,$picture,$activeflag,$lasteditedby,$comments,$actid,$ClassObj,$loginflag,$gender,$dateofbirth,$hscno,$cetno,$college,$studentpass,$email,$lastlogin,$parentpass,$dateofadmission,$board10,$agg10,$ms10);
			$message="Student Added Successfully : ".$firstname." ".$lastname;
			}
			else
			{
		//$message=mysql_error();
		$message="Student Addition Failed2 : ".$firstname." ".$lastname;
				$tempobj=NULL;
				}
			}
			
	}
	else
	{
		if($flag)
	{
		//update classid 
		updateStudentClassID($id,getCurrentInstituteID1());
		
		//echo $id;
		
		$tempStu=getStudentByMainID($id,0);
		
		//print_r($tempStu);
		
		if($tempStu!=NULL)
		$message="Student Already Exsists  : ".$firstname." ".$lastname.'.<br />Similar Student Details : Name => '.$tempStu->getFullName().'&nbsp; Batch =>'.$tempStu->getBatchObj()->getBestDisplay();
		else
		$message="Student Already Exsists Harsh  : ".$firstname." ".$lastname;
		
		//updateStudentBatchID($tempStu->getID(),27,3);
		
		$tempobj=NULL;
		}
		else
		{
			//add student in main database 
	//since student exists in current db n nt in main db, there must be sum error
			

			$message="Contact System Administrator : ".$firstname." ".$lastname;
			
			$tempobj=NULL;
			}
		}
	array_push($temp, $message);
	array_push($temp, $tempobj);
	return $temp;
	
	}

function studentExistsInMainDatabase($phone_stu,$phone_father,$examyear)
{
	$conn=getMainConnection();
	$query = "SELECT * FROM `student` WHERE `phone_stu` = '".$phone_stu."' OR `phone_father` = '".$phone_father."' AND activeflag <> 0";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	$flag=false;
	$id=0;
		if($rows==0)
		{
			$flag=false;
	         $id=0;
			
			}
			else
			{
				while($member=mysql_fetch_array($result))
				{
					if(($member['examyear']==$examyear))
			{
				
				$flag=true;
	            $id=$member['ID'];
				break;
			}
					
					}
					
				}
				return array($flag,$id);
	}
	
function studentExistsInCurrentDatabase($phone_stu,$phone_father,$examyear)
{
	$conn=getConnection();
	$query = "SELECT * FROM `student` WHERE (`phone_stu` = '".$phone_stu."' OR `phone_father` = '".$phone_father."') AND activeflag <> 0";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	$flag=false;
	
		if($rows==0)
		{
			$flag=false;
			
			}
			else
			{
				while($member=mysql_fetch_array($result))
				{
					if(($member['examyear']==$examyear))
			{
				$flag=true;
				break;
			}
					
					}
					
				}
				return $flag;
	}

function updateStudentClassID($id,$instituteID)
{
	$conn=getMainConnection();
	$query = "SELECT * FROM `studentinstituteid` WHERE `studentID` = '".$id."' AND `instituteID` = '".$instituteID."'";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	if($rows==0||$result==false)
	{
		$query2 = "INSERT INTO studentinstituteid(ID ,studentID ,instituteID ,activeflag ) VALUES(NULL,'".$id."' ,'".$instituteID."' ,1)";
		$result2 = mysql_query($query2);
		return true;	
			
	}
	else 
	{
		$member = mysql_fetch_array($result);
		$query2 = "UPDATE `studentinstituteid` SET `activeflag` = 1 WHERE `ID` = '".$member['ID']."'";
	    $result2 = mysql_query($query2);
		return true;
		}
}

function insertStudent($mainID,$rollno,$grno,$firstname,$lastname,$Fname,$Mname,$address,$phone_stu,$phone_father,$phone_mother,$phone_other,$BatchObj,$examyear,$picture,$activeflag,$lasteditedby,$comments,$actid,$ClassObj,$loginflag,$gender,$dateofbirth,$hscno,$cetno,$college,$studentpass,$email,$lastlogin,$parentpass,$dateofadmission,$board10,$agg10,$ms10)
{
	
	$conn=getConnection();
$picurl=uploadPicture($picture);
	//$picurl="test";
	if($ClassObj!=NULL)
	$classID=$ClassObj->getID();
	else
	$classID=0;
	
	$query="INSERT INTO `student` (`ID`, `mainID`, `rollno`, `grno`, `firstname`, `lastname`, `address`, `phone_stu`, `phone_father`, `phone_mother`, `phone_other`, `batchID`, `examyear`, `picurl`, `activeflag`, `Fname`, `Mname`, `lasteditedby`, `dateupdated`, `comments`, `actid`, `classID`, `loginflag`, `gender`, `dateofbirth`, `hscno`, `cetno`, `college`, `studentpass`, `email`, `lastlogin`, `parentpass` ,`dateofadmission`, `board10`,`agg10`, `ms10`) VALUES (NULL, '".$mainID."', '".$rollno."', '".$grno."', '".$firstname."', '".$lastname."', '".$address."', '".$phone_stu."', '".$phone_father."', '".$phone_mother."', '".$phone_other."', '".$BatchObj->getID()."', '".$examyear."', '".$picurl."', '".$activeflag."', '".$Fname."', '".$Mname."', '".$lasteditedby."', CURRENT_TIMESTAMP, '".$comments."', '".$actid."', '".$classID."', '".$loginflag."', '".$gender."', '".$dateofbirth."', '".$hscno."', '".$cetno."', '".$college."', '".$studentpass."', '".$email."', '".$lastlogin."', '".$parentpass."', '".$dateofadmission."', '".$board10."', '".$agg10."', '".$ms10."')";
	$result = mysql_query($query,$conn);
	echo mysql_error();
	if($result != NULL)
			{
				$temp = mysql_insert_id();
				$tempObj=getStudent($temp,1);
				return $tempObj;
				
			}
            else
			return NULL;
			
	}
	function insertStudentInMainDatabase($firstname,$lastname,$phone_stu,$phone_father,$examyear,$activeflag,$actid,$loginflag,$dateofbirth,$studentpass,$lastlogin,$parentpass,$instituteIDs)
{
	$conn=getMainConnection();
	
	
	$query="INSERT INTO `student` (`ID`, `firstname`, `lastname`, `phone_stu`, `phone_father`, `examyear`, `activeflag`, `actid`, `loginflag`, `dateofbirth`, `studentpass`, `lastlogin`, `parentpass`, `instituteIDs`, `loginip`) VALUES (NULL,'".$firstname."', '".$lastname."','".$phone_stu."', '".$phone_father."','".$examyear."','".$activeflag."','".$actid."', '".$loginflag."','".$dateofbirth."','".$studentpass."','".$lastlogin."', '".$parentpass."', '".$instituteIDs."',0)";
	$result = mysql_query($query,$conn);
	
	if($result != NULL)
			{
				$temp = mysql_insert_id();
				$query2 = "INSERT INTO studentinstituteid(ID ,studentID ,instituteID ,activeflag ) VALUES(NULL,'".$temp."' ,'".$instituteIDs."' ,1)";
		        $result2 = mysql_query($query2,$conn);
				
				return $temp;
			}

			return NULL;
	}
	
	function checkStudentNumberExsists($ID,$phone)
	{
	
	$conn=getConnection();
	$query = "SELECT * FROM `student` WHERE `phone_stu` = '".$phone."' AND `ID` != '".$ID."' AND activeflag <> 0";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	$flag=false;
	
		if($rows==0)
		{
			$flag=false;
			
			}
			else
			{
				$flag=true;
				}
				return $flag;
		
		}
		
		function checkFatherNumberExsists($ID,$phone)
	{
	
	$conn=getConnection();
	$query = "SELECT * FROM `student` WHERE `phone_father` = '".$phone."' AND `ID` != '".$ID."' AND activeflag <> 0";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	$flag=false;
	
		if($rows==0)
		{
			$flag=false;
			
			}
			else
			{
				$flag=true;
				}
				return $flag;
		
		}
		
	function updateStudent($ID,$rollno,$grno,$firstname,$lastname,$Fname,$Mname,$address,$phone_stu,$phone_father,$phone_mother,$phone_other,$BatchObj,$picture,$activeflag,$userid,$comment,$actid,$ClassObj,$loginflag,$gender,$dateofbirth,$hscno,$cetno,$college,$email,$dateofadmission,$board10,$agg10,$ms10,$comment)
{
	

$conn=getConnection();


$picurl=uploadPicture($picture);


$Obj=getStudent($ID,0);

$flag1=false;
$flag2=false;

if($Obj->getPhoneFather()!=$phone_father)
$flag1=true;

if($Obj->getPhoneStu()!=$phone_stu)
$flag2=true;


if($activeflag==0)
{
removeStudentFromMainTable($Obj->getMainID());
$Obj->setActiveFlag(trim($activeflag));
$result=$Obj->update();
$message="Student Deletion Succeeded : ".$Obj->getName();
return $message;
}


if($flag1)
updateMainFatherNumber($Obj->getMainID(),$phone_father);


if($flag2)
updateMainStudentNumber($Obj->getMainID(),$phone_stu);




if($picurl=='')
$picurl=$Obj->getPicUrl();

$Obj->setRollNo(trim($rollno));		
$Obj->setGRno(trim($grno));
$Obj->setFirstName(trim($firstname));
$Obj->setLastName(trim($lastname));
$Obj->setMname(trim($Mname));
$Obj->setFname(trim($Fname));
$Obj->setPicUrl(trim($picurl));
$Obj->setAddress(trim($address));
$Obj->setPhoneStu(trim($phone_stu));
$Obj->setPhoneFather(trim($phone_father));
$Obj->setPhoneMother(trim($phone_mother));
$Obj->setPhoneOther(trim($phone_other));
//$Obj->setBatchObj($BatchObj);
$Obj->setPicUrl($picurl);
$Obj->setActiveFlag(trim($activeflag));
$Obj->setLastEditedBy(trim($userid));
$Obj->setComments(trim($comments));
$Obj->setActid(trim($actid));
//$Obj->setClassObj($ClassObj);
$Obj->setLoginFlag(trim($loginflag));
$Obj->setGender(trim($gender));
$Obj->setDateOfBirth(trim($dateofbirth));
$Obj->setHscNo(trim($hscno));
$Obj->setCetNo(trim($cetno));
$Obj->setCollege(trim($college));
$Obj->setEmail(trim($email));
$Obj->setDateOfAdmission(trim($dateofadmission));
$Obj->setBoard10(trim($board10));
$Obj->setAggregate10(trim($agg10));
$Obj->setMathsScience10(trim($ms10));
$Obj->setComments(trim($comment));
$result=$Obj->update();
		
		if($result)  
	$message="Student Updated Successfully :".$Obj->getName();
	else 
	$message="Student Updation Failed : ".$Obj->getName();
	return $message;
	
	
	}

function updateMainFatherNumber($mainID,$father)
{
	$conn = getMainConnection();
	$query = "SELECT * FROM `studentinstituteid` WHERE `mainID` = '".$studentID."'";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	if($result)
	{
		
		
		
		while($member = mysql_fetch_array($result))
		{
			$tempObj=getInstitute($member['instituteID']);
			$con1=getTemporaryConnection($tempObj->getDatabaseName());
			$query1 = "UPDATE `student` SET `phone_father` = '".$father."' WHERE `mainID` = '".$mainID."'";
	                $result1= mysql_query($query1,$con1);
			
			}
	$conn = getMainConnection();
	$query1 = "UPDATE `student` SET `phone_father` = '".$father."' WHERE `ID` = '".$mainID."'";
	$result1= mysql_query($query1,$conn);
	
	}
	}
	
	function updateMainStudentNumber($mainID,$phone_stu)
{
	$conn = getMainConnection();
	$query = "SELECT * FROM `studentinstituteid` WHERE `studentID` = '".$mainID."'";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	if($result)
	{
		while($member = mysql_fetch_array($result))
		{
			$tempObj=getInstitute($member['instituteID']);
			$con1=getTemporaryConnection($tempObj->getDatabaseName());
			$query1 = "UPDATE `student` SET `phone_stu` = '".$phone_stu."' WHERE `mainID` = '".$mainID."'";
	        $result1= mysql_query($query1,$con1);
			
			}

	$conn = getMainConnection();
	$query1 = "UPDATE `student` SET `phone_stu` = '".$phone_stu."' WHERE `ID` = '".$mainID."'";
	$result1= mysql_query($query1,$conn);
	
	}
	}
	
	function removeStudentFromMainTable($mainID)
	{
	
	$instituteID=getCurrentInstituteID1();
	
	$conn=getMainConnection();
	$query = "SELECT * FROM `studentinstituteid` WHERE `studentID` = '".$mainID."' AND `instituteID` = '".$instituteID."' AND `activeflag` = 1";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	if($rows==1)
	{	
	     $member=mysql_fetch_array($result);
             $query1 = "UPDATE `studentinstituteid` SET `activeflag` = 0 WHERE `ID` = '".$member['ID']."'";
	     $result1 = mysql_query($query1,$conn);
             return true;
				
        }
        return false;
	}
	
	function getStudentInformationByID($ID,$info)
	{
		$conn=getConnection();
		$query = "SELECT * FROM student WHERE ID ='".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member=mysql_fetch_array($result);
			$temp = $member[$info];
			return $temp;
		}
		return NULL;
		}
		
		function updateStudentBatchClassID($stuID,$userID,$batchClassID)
		{
			$conn=getConnection();
			$query = "UPDATE `student` SET `classID` = '".$batchClassID."',`lasteditedby` = '".$userID."' WHERE `ID` = '".$stuID."'";
	        $result = mysql_query($query);
			}
			
					function updateStudentBatchID($stuID,$userID,$batchClassID)
		{
			$conn=getConnection();
			$query = "UPDATE `student` SET `batchID` = '".$batchClassID."',`lasteditedby` = '".$userID."' WHERE `ID` = '".$stuID."'";
	        $result = mysql_query($query);
			//return $result.' : '.$stuID.' : '.mysql_error();
			}
	?>