<?php

/* <-------------------------------------Quiz Module Functions---------------------------------> */


/*

Type = 0 : Chapters
Type = 1 : Notes Modules
Type = 2 : Test Modules
*/
function getQuizModule($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM modules WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new QuizModule($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function createModule($name,$subject,$creatorID,$type)
	{
		$conn = getConnection();
		$query = "SELECT * FROM modules WHERE name LIKE '%".$name."%' AND activeflag<>0 AND type=".$type;
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			
$query = "INSERT INTO `modules` (`ID`, `subjectID`, `name`, `activeflag`, `createdby`, `lastupdated`,`type`) VALUES (NULL, '".$subject."', '".$name."', '1',  '".$creatorID."', CURRENT_TIMESTAMP,'".$type."')";
			$result = mysql_query($query);
			
			if($result)  
			$message="Module Created Successfully : ".$name;
			else 
			$message="Module Creation Failed : ".$name;
				}
		else
		{
			$message="Module Creation Failed : Similar Module exists :".$name;
		}

		return $message;
	}
	
	function getAllModules()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM modules WHERE activeflag<>0 AND type=0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizModule($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllNotesModules()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM modules WHERE activeflag<>0 AND type=1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizModule($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveNotesModules()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM modules WHERE activeflag=1 AND type=1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizModule($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveTestModules()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM modules WHERE activeflag=1 AND type=2 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizModule($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllTestModules()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM modules WHERE activeflag<>0 AND type=2 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizModule($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function updateModule($ID,$name,$activeflag,$id)
	{
		$conn=getConnection();
	    $Obj=getQuizModule($ID);
		$Obj->setName($name);
	    $Obj->setActiveFlag($activeflag);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Chapter Updated Successfully :".$name;
	else 
	$message="Chapter Updation Failed : ".$name;
	return $message;
		
		}

function getAllActiveModules()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM modules WHERE activeflag=1 AND type=0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizModule($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
/* <-------------------------------------Quiz Questions Functions---------------------------------> */

function getQuizQuestion($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM question WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Question($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function enterQuestionsForHomeTest($option,$testID,$userID,$quesno,$type,$key)
{
	$conn=getConnection();

$query ="INSERT INTO `question` (`ID`, `testID`, `name`, `answerID`, `activeflag`, `lastupdated`, `type`,`indentifier`, `createdby`, `answerreason`,`quizmodule`) VALUES (NULL, '".$testID."','".$quesno."','".$option."',1,CURRENT_TIMESTAMP,'".$type."','".$key."','".$userID."','',0)";
	$result = mysql_query($query,$conn);
		if($result)
	{
	return true;
	}
	else 
	{
		//return mysql_error();
		return false;
	}
		
		
	}
	
	function updateQuestionsForHomeTest($option,$testID,$userID,$quesID)
{
	$conn=getConnection();
	
	$query1 = "UPDATE `question` SET `answerID` = '".$option."', `createdby` = '".$userID."' WHERE `ID` = '".$quesID."' ";
	$result1= mysql_query($query1,$conn);
	if($result1)
	{
	return true;
	}
	else 
	{
		return mysql_error();
		//return false;
	}
	}
	
	
	
function questionEntryExistsForHomeTest($quesno,$testID)
{
	$conn=getConnection();
	$query = "SELECT * FROM `question` WHERE `name` LIKE '".$quesno."' AND `testID` = '".$testID."' AND activeflag = 1";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	$flag=false;
	$mark=0;
		if($rows==0)
		{
			$flag=false;
			$mark=0;
			}
			else
			{
				$member = mysql_fetch_array($result);
				$flag=true;
				$mark=$member['ID'];
			}
				$temp=array($flag,$mark);
				return $temp;
	}	
	
	function getHomeTestQuestionByTest($testObj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test_question WHERE testID='".$testObj->getID()."' AND activeflag = 1 ORDER BY ID ASC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			
			$temp = getQuizQuestion($member['questionID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		}
		
		function enterQuestionsForOnlineTest($option,$testID,$userID,$ques,$answerreason,$quizmodule,$type,$key)
{
	$conn=getConnection();
	
$query ="INSERT INTO `question` (`ID`, `testID`, `name`, `answerID`, `activeflag`, `lastupdated`, `type`,`indentifier`, `createdby`, `answerreason`,`quizmodule`) VALUES (NULL, '".$testID."','".$ques."','".$option."',1,CURRENT_TIMESTAMP,'".$type."','".$key."','".$userID."','".$answerreason."','".$quizmodule."')";
	$result = mysql_query($query,$conn);
		$id=0;
		$flag=false;
		
		
		if($result)
	{
	$id=mysql_insert_id();
	$flag=true;
	return array($id,$flag);
	}
	else 
	{
		//return mysql_error();
		return array($id,$flag);
	}
	}
	
	function enterQuestionsForOnlineTest1($option,$testID,$userID,$ques,$answerreason,$quizmodule,$type,$key,$level)
{
	$conn=getConnection();
	
$query ="INSERT INTO `question` (`ID`, `testID`, `name`, `answerID`, `activeflag`, `lastupdated`, `type`,`indentifier`, `createdby`, `answerreason`,`quizmodule`,`level`) VALUES (NULL, '".$testID."','".$ques."','".$option."',1,CURRENT_TIMESTAMP,'".$type."','".$key."','".$userID."','".$answerreason."','".$quizmodule."','".$level."')";
	$result = mysql_query($query,$conn);
		$id=0;
		$flag=false;
		
		
		if($result)
	{
	$id=mysql_insert_id();
	$flag=true;
	return array($id,$flag);
	}
	else 
	{
		//return mysql_error();
		return array($id,$flag);
	}
	}
	
	function enterAnswerOfQuestionForOnlineTest($option,$userID,$quesID)
{
	$conn=getConnection();
	
	$query1 = "UPDATE `question` SET `answerID` = '".$option."', `createdby` = '".$userID."' WHERE `ID` = '".$quesID."'";
	$result1= mysql_query($query1,$conn);
	if($result1)
	{
	return true;
	}
	else 
	{
		//return mysql_error();
		return false;
	}
	}
	
	function getQuestionByTest($testObj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test_question WHERE testID='".$testObj->getID()."' AND activeflag <>0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizQuestion($member['questionID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		}
		
		function updateQuestion($ID,$question,$answerreason,$rightID,$chapter,$status,$userid)
	{
		$conn=getConnection();
	    $Obj=getQuizQuestion($ID);
		$Obj->setName($question);
		$Obj->setAnswerReason($answerreason);
		$Obj->setRightAnswer($rightID);
		$Obj->setQuizModule($chapter);
	    $Obj->setActiveFlag($status);
		
	    $Obj->setCreatedBy($userid);
	    $result=$Obj->update();
		
		if($result)  
	    return true;
		else
		return false;
		
		}
		
		function updateQuestion1($ID,$question,$answerreason,$rightID,$chapter,$status,$userid,$level)
	{
		$conn=getConnection();
	    $Obj=getQuizQuestion($ID);
		$Obj->setName($question);
		$Obj->setAnswerReason($answerreason);
		$Obj->setRightAnswer($rightID);
		$Obj->setQuizModule($chapter);
	    $Obj->setActiveFlag($status);
		$Obj->setLevel($level);
		
	    $Obj->setCreatedBy($userid);
	    $result=$Obj->update();
		
		if($result)  
	    return true;
		else
		return false;
		
		}

		
		function getQuestionsByModule($Obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM question WHERE quizmodule='".$Obj->getID()."' AND activeflag <>0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizQuestion($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		}
		
		function getQuestionsByModuleForTest($Obj,$no)
	{
		$conn=getConnection();
		$list = array();
		$finallist = array();
		$query = "SELECT * FROM question WHERE quizmodule='".$Obj->getID()."' AND activeflag =1 AND type=2 AND name NOT LIKE 'Quesion%' AND name NOT LIKE 'Question%' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizQuestion($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			if(count($list)>=$no)
			{
			$rand_keys = array_rand($list, $no);
			}
			else
			{
			$rand_keys = array_rand($list, count($list));
			}
			
			if(count($rand_keys)>1)
			{
			shuffle($rand_keys);
			
			foreach ($rand_keys as $rand_keys)
			{
            array_push($finallist,$list[$rand_keys]);
            }
			}
			else
			array_push($finallist,$list[$rand_keys]);
			
			return $finallist;
		}

		return NULL;
		
		}
		
		function getAnswerNo($quesID)
		{
			$conn=getConnection();
			$query = "SELECT * FROM question WHERE ID='".$quesID."' AND activeflag = 1";
			$result = mysql_query($query);
		    $numrows = mysql_affected_rows();
			$ansno=0;
			$i=1;
			if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$ansID = $member['answerID'];
			
			$query1 = "SELECT * FROM answer WHERE questionID='".$quesID."' AND activeflag = 1 ORDER BY ID ASC";
			$result1 = mysql_query($query1);
			while($member1 = mysql_fetch_array($result1))
		{
			
			if($ansID==$member1['ID'])
			$ansno=$i;
			
			$i++;
		}
		
		return $ansno;
		}
		
		
			}
			
		function writeTestQuestions($testID,$questionID)
		{
			
			$conn=getConnection();
	
for($i=0;$i<count($testID);$i++)
{	
for($n=0;$n<count($questionID);$n++)
{
$query ="INSERT INTO `test_question` (`ID`, `testID`, `questionID`, `activeflag`) VALUES (NULL, '".$testID[$i]."','".$questionID[$n]."',1)";
$result = mysql_query($query,$conn);
}
}
}
	/* <-------------------------------------Quiz Answer Functions---------------------------------> */

function getQuizAnswer($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM answer WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Answer($member['ID']);
			return $tempObj;
		}
		return NULL;
	}	
	
	function checkAnswerHomeTest($answer,$correct)
	{
		$flag=false;
		if($answer==$correct)
		$flag=true;
		
		return $flag;
		}
		
		function updateHometestMarks($testID,$score,$student)
		{
	
	$query = "SELECT * FROM `marks` WHERE `testID` = '".$testID."' AND `studentID`= '".$student."'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	
	
		if($rows==0)
		{

$query="INSERT INTO `marks` (`ID`, `studentID`, `testID`, `mark`, `datecreated`, `createdby`, `lastupdated`) VALUES (NULL,'".$student."', '".$testID."','".$score."', NOW(),0,CURRENT_TIMESTAMP)";
	$result = mysql_query($query);
	if($result)
	return true;
	else
	return mysql_error();
			}
			else
			{
				return false;
			}
			
			}
			
			function checkHomeTestAnswered($note,$stuObj)
			{
				$query = "SELECT * FROM `marks` WHERE `testID` = '".$note->getTestID()."' AND `studentID`= '".$stuObj->getID()."'";
	            $result = mysql_query($query);
	            $rows = mysql_num_rows($result);
				if($rows==0)
		        return false;
				else return true;
				}
				
				function enterAnswersForOnlineTest($quesid,$option,$userID,$type,$key)
{
	$conn=getConnection();
	
$query ="INSERT INTO `answer` (`ID`, `questionID`, `name`, `activeflag`,`type`,`indentifier`, `lastupdated`,`createdby`) VALUES (NULL, '".$quesid."','".$option."',1,'".$type."','".$key."',CURRENT_TIMESTAMP,'".$userID."')";
	$result = mysql_query($query,$conn);
		$id=0;
		$flag=false;
		
		
		if($result)
	{
	$id=mysql_insert_id();
	$flag=true;
	return array($id,$flag);
	}
	else 
	{
		//return mysql_error();
		return array($id,$flag);
	}
		
		
	}
	
	function getAnswersByQuestion($Obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM answer WHERE questionID='".$Obj->getID()."' AND activeflag = 1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getQuizAnswer($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		}
		
		function updateAnswer($ID,$answer,$userid,$status)
	{
		$conn=getConnection();
	    $Obj=getQuizAnswer($ID);
		$Obj->setName($answer);
		$Obj->setCreatedBy($userid);
		$Obj->setActiveFlag($status);
	    $result=$Obj->update();
		
		if($result)  
	    return true;
		else
		return false;
		
		}
?>