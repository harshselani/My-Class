<?php

function getMarks($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM marks WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Marks($member['ID']);
			return $tempObj;
		}
		return NULL;
	}

function getAllMarksOfTest($testObj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM marks WHERE testID='".$testObj->getID()."' AND activeflag!=-3 ORDER BY studentID ASC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			
			$temp = getMarks($member['ID']);
			array_push($list,$temp);
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getStudentMark($studentObj,$testObj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM marks WHERE testID ='".$testObj->getID()."' AND activeflag!=-3 AND studentID ='".$studentObj->getID()."' ";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$temp = getMarks($member['ID']);
			return $temp;
		}
		return NULL;

	}


function getStudentMarksByTestAndBatch($testObj,$batchObj)
	{
		$conn=getConnection();
		$list = array();
	
	    $stuobj=getAllActiveStudentsByBatch($batchObj,1);
		
		for($i=0;$i<count($stuobj);$i++)
		
		{
			$markobj=getStudentMark($stuobj[$i],$testObj);
			$temp = array($stuobj[$i],$markobj);
			//$temp = array($stuobj[$i]);
			array_push($list,$temp);
			
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}

function getStudentMarksByTestAndBatchNameSorted($testObj,$batchObj)
	{
		$conn=getConnection();
		$list = array();
	
	    $stuobj=getAllActiveStudentsByBatchNameSorted($batchObj,1);
		
		for($i=0;$i<count($stuobj);$i++)
		
		{
			$markobj=getStudentMark($stuobj[$i],$testObj);
			$temp = array($stuobj[$i],$markobj);
			//$temp = array($stuobj[$i]);
			array_push($list,$temp);
			
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}

function enterMarks($studentID,$testID,$mark,$option,$userID)
{
	$conn=getConnection();
	list($flag,$markID)=marksEntryExists($studentID,$testID);
	if($flag)
	{
	$query1 = "UPDATE `marks` SET `mark` = '".$mark."',`activeflag` = '".$option."' WHERE `ID` = '".$markID."'";
	$result1= mysql_query($query1,$conn);
	if($result1)
	{
	return true;
	}
	else 
	{
		return false;
	}
		
		}
	else
	{
$query="INSERT INTO `marks` (`ID`, `studentID`, `testID`, `mark`, `activeflag`, `datecreated`, `createdby`, `lastupdated`) VALUES (NULL,'".$studentID."', '".$testID."','".$mark."','".$option."', NOW(),'".$userID."',CURRENT_TIMESTAMP)";
	$result = mysql_query($query,$conn);
		if($result)
	{
	return true;
	}
	else 
	{
		return false;
	}
		
		}
	}
	
	function enterMarksAuto($marksID,$studentID,$testID,$mark,$userID)
{
	$conn=getConnection();
	list($flag,$markID)=marksEntryExists($studentID,$testID);
	if($flag)
	{
	$query1 = "UPDATE `marks` SET `mark` = '".$mark."' WHERE `ID` = '".$markID."'";
	$result1= mysql_query($query1,$conn);
	if($result1)
	{
	return true;
	}
	else 
	{
		return false;
	}
		
		}
	else
	{
$query="INSERT INTO `marks` (`ID`, `studentID`, `testID`, `mark`, `activeflag`, `datecreated`, `createdby`, `lastupdated`) VALUES (NULL,'".$studentID."', '".$testID."','".$mark."',1, NOW(),'".$userID."',CURRENT_TIMESTAMP)";
	$result = mysql_query($query,$conn);
		if($result)
	{
	return true;
	}
	else 
	{
		return false;
	}
		
		}
	}
	
	function enterMarksOptionsAuto($marksID,$studentID,$testID,$option,$userID)
{
	$conn=getConnection();
	list($flag,$markID)=marksEntryExists($studentID,$testID);
	
	if($flag)
	{
	$query1 = "UPDATE `marks` SET `activeflag` = '".$option."' WHERE `ID` = '".$markID."'";
	$result1= mysql_query($query1,$conn);
	if($result1)
	{
	
	return true;
	}
	else 
	{
		
		return false;
	}
		
		}
	else
	{
$query="INSERT INTO `marks` (`ID`, `studentID`, `testID`, `mark`, `activeflag`, `datecreated`, `createdby`, `lastupdated`) VALUES (NULL,'".$studentID."', '".$testID."',0,'".$option."', NOW(),'".$userID."',CURRENT_TIMESTAMP)";
	$result = mysql_query($query,$conn);
		if($result)
	{
	return true;
	}
	else 
	{
		return false;
	}
		
		}
	}
	
	function enterOptionsAuto($studentID,$testID,$mark,$userID)
{
	$conn=getConnection();
	list($flag,$markID)=marksEntryExists($studentID,$testID);
	if($flag)
	{
	$query1 = "UPDATE `marks` SET `mark` = '".$mark."' WHERE `ID` = '".$markID."'";
	$result1= mysql_query($query1,$conn);
	if($result1)
	{
	return true;
	}
	else 
	{
		return false;
	}
		
		}
	else
	{
$query="INSERT INTO `marks` (`ID`, `studentID`, `testID`, `mark`, `activeflag`, `datecreated`, `createdby`, `lastupdated`) VALUES (NULL,'".$studentID."', '".$testID."','".$mark."',1, NOW(),'".$userID."',CURRENT_TIMESTAMP)";
	$result = mysql_query($query,$conn);
		if($result)
	{
	return true;
	}
	else 
	{
		return false;
	}
		
		}
	}
	
	function enterMarksForOnlineTest($studentID,$testID,$mark,$userID)
{
	$conn=getConnection();
	list($flag,$markID)=marksEntryExists($studentID,$testID);
	if(!$flag)
	{
	$query="INSERT INTO `marks` (`ID`, `studentID`, `testID`, `mark`, `datecreated`, `createdby`, `lastupdated`) VALUES (NULL,'".$studentID."', '".$testID."','".$mark."', NOW(),'".$userID."',CURRENT_TIMESTAMP)";
	$result = mysql_query($query,$conn);
		if($result)
	{
	return mysql_insert_id();
	}
	else 
	{
		return 0;
	}
		
		}
	else
	{
return 0;
		
		}
	}

	
function marksEntryExists($studentID,$testID)
{
	$conn=getConnection();
	$query = "SELECT * FROM `marks` WHERE `studentID` = '".$studentID."' AND `testID` = '".$testID."' AND activeflag!=-3";
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
	
	
	function getHighest($testObj)
	{
		$conn=getConnection();
		if($testObj->getType()==0)
		{
		$list = array();
		$query = "SELECT * FROM marks WHERE testID='".$testObj->getID()."' AND activeflag!=-3 ORDER BY mark DESC";
		$result = mysql_query($query,$conn);
		$flag=false;
		while($member = mysql_fetch_array($result))
		{
			if(!$flag)
			{
				$tempmark=$member['mark'];
				$flag=true;
				}
			if($tempmark==$member['mark'])
			{
			$temp = getMarks($member['ID']);
			array_push($list,$temp);
			}
			else
			break;
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
		else
		{
			
			$testlist = array();
			$testlist =$testObj->getCommonTests();
			$condition='';
			for($i=0;$i<count($testlist);$i++)
    {
	
	$condition.="testID = '".$testlist[$i]->getID()."' ";
	if($i!=(count($testlist)-1))
	{$condition.="OR ";}
	}
		$list = array();
		$query = "SELECT * FROM marks WHERE ".$condition." AND activeflag!=-3 ORDER BY mark DESC";
		$result = mysql_query($query,$conn);
		$flag=false;
		while($member = mysql_fetch_array($result))
		{
			if(!$flag)
			{
				$tempmark=$member['mark'];
				$flag=true;
				}
			if($tempmark==$member['mark'])
			{
			$temp = getMarks($member['ID']);
			array_push($list,$temp);
			}
			else
			break;
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
			
			}
		}
		
		function getAllMarksOfTestArranged($testObj,$order)
	{
		$conn=getConnection();
		
		if($testObj->getType()==0)
		{
		$list = array();
		$query = "SELECT * FROM marks WHERE testID = '".$testObj->getID()."' AND activeflag!=-3 ORDER BY mark DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempstu=getStudent($member['studentID'],1);
			$tempmark = getMarks($member['ID']);
			$temparray = array($tempstu,$tempmark);
			//$temp = array($stuobj[$i]);
			array_push($list,$temparray);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
		elseif($testObj->getType()==1)
		{
			$testlist = array();
			$testlist =$testObj->getCommonTests();
			$list = array();
			$condition='';
			for($i=0;$i<count($testlist);$i++)
    {
	
	$condition.="testID = '".$testlist[$i]->getID()."' ";
	if($i!=(count($testlist)-1))
	{$condition.="OR ";}
		
	}
		$query = "SELECT * FROM marks WHERE ".$condition." AND activeflag!=-3 ORDER BY mark DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempstu=getStudent($member['studentID'],1);
			$tempmark = getMarks($member['ID']);
			$temparray = array($tempstu,$tempmark);
			
			array_push($list,$temparray);
			
		}
	
	if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
			
			}
			else
			{
				return NULL;
				}
	}
	
	function getAllMarksOfTestArranged1($testObj,$order)
	{
		$conn=getConnection();
		
		
		$list = array();
		$query = "SELECT * FROM marks WHERE testID = '".$testObj->getID()."' AND activeflag!=-3 ORDER BY mark DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempstu=getStudent($member['studentID'],1);
			$tempmark = getMarks($member['ID']);
			$temparray = array($tempstu,$tempmark);
			//$temp = array($stuobj[$i]);
			array_push($list,$temparray);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
	}

function getAverage($testObj,$no)
{

$list=array();
$list=getAllMarksOfTestArranged($testObj,'DESC');
if($no>=count($list)||$no==0||$no==NULL||$no=='')
$no=count($list)/4;
$no=round($no,0);

if($no==0)
$no++;
$avg=0;
for($i=0;$i<$no;$i++)
{
	$avg+=$list[$i][1]->getDisplayMark1();
	
	}
	
	
	$temp=$avg/$no;
	$temp=round($temp,2);
return $temp;
//echo $temp;
	}
	
	function getDataforReportChart($studentObj,$reportObj)
	{
		$conn=getConnection();
		//$reportObj=getReport($reportID);
		$templist=array();
        $templist=$reportObj->getTestObjs();
		//$studentObj=getStudent($studentID,3);
		
		$markarray=array();
		$highestarray=array();
		$averagearray=array();
		$showarray=array();
		$n=0;
		for(;$n<count($templist);$n++)
{
	$marks=getStudentMark($studentObj,$templist[$n])->getMark();
     if($marks<0)
	 $marks=0;
	 array_push($markarray,array($n,$marks));
	 array_push($highestarray,array($n,$templist[$n]->getHighestMarks()->getMark()));
	 array_push($averagearray,array($n,$templist[$n]->getAverage()));
	 array_push($showarray,array($n,$templist[$n]->getName()));
}
		array_push($markarray,array($n,$marks));
		array_push($highestarray,array($n,$templist[$n-1]->getHighestMarks()->getMark()));
		 array_push($averagearray,array($n,$templist[$n-1]->getAverage()));
	    array_push($showarray,array($n,''));
		return array($markarray,$showarray,$highestarray,$averagearray);
		//return $markarray;
		}
		
		function getStudentIDFromRollNoArray($stuobj,$rollno)
		{
		
		$id=0;
		
		for($i=0;$i<count($stuobj);$i++)
		
		{
			if($stuobj[$i]->getRollNo()==$rollno)
			$id=$stuobj[$i]->getID();
		}
			
			return $id;
		}
?>