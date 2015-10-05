<?php

/*

Type = 0 : Offline Test
Type = 1 : Home Test
Type = 2 : Online Test
Type = 3 : FIB Test
Type = 4 : Correction Test

*/


function getTest($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM test WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Test($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getTest1($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM test WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Test1($member['ID']);
			return $tempObj;
		}
		return NULL;
	}

function getAllActiveTestsByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE activeflag=1 AND batchID='".$obj->getID()."' ORDER BY subjectID ASC, datetest DESC";
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
	
	function getAllActiveHomeTestsByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE activeflag=1 AND quiztype=1 AND batchID='".$obj->getID()."' ORDER BY subjectID ASC, datetest DESC";
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
	
	function getAllCommonActiveTestsByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE activeflag=1 AND batchID='".$obj->getID()."' AND type=1 ORDER BY subjectID ASC, datetest DESC";
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
	
		function getAllInActiveTestsByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE activeflag=-1 AND batchID='".$obj->getID()."' ORDER BY subjectID ASC, datetest DESC";
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
	
	function getAllActiveTestsByBatchAndSubject($batchobj,$subjectobj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE activeflag=1 AND batchID='".$batchobj->getID()."' AND subjectID='".$subjectobj->getID()."' ORDER BY ID ASC";
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
	
			function getAllInActiveTestsByBatchAndSubject($batchobj,$subjectobj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE activeflag=-1 AND batchID='".$batchobj->getID()."' AND subjectID='".$subjectobj->getID()."' ORDER BY ID ASC";
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

function getAllActiveTestsByYear($examyear)
	{
		$conn=getConnection();
		$batchlist=array();
		$batchlist=getAllActiveBatchesByYear($examyear);
		$list = array();
		for($i=0;$i<count($batchlist);$i++)
		{
		
		$query = "SELECT * FROM test WHERE activeflag=1 AND batchID='".$batchlist[$i]->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getTest($member['ID']);
			array_push($list,$temp);
		}
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllInActiveTestsByYear($examyear)
	{
		$conn=getConnection();
		$batchlist=array();
		$batchlist=getAllActiveBatchesByYear($examyear);
		$list = array();
		for($i=0;$i<count($batchlist);$i++)
		{
		
		$query = "SELECT * FROM test WHERE activeflag=-1 AND batchID='".$batchlist[$i]->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getTest($member['ID']);
			array_push($list,$temp);
		}
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	
	
	function createTest($name,$maximum,$topic,$datetest,$BatchObj,$SubjectObj,$creatorID,$type,$key,$quiztype,$quizmodule,$rightmark,$wrongmark,$moduleID)
	{
		
	$conn=getConnection();
	if(!testExists($name,$BatchObj,$SubjectObj,$quiztype))
	{
	$query="INSERT INTO `test` (`ID`, `name`, `maximum`, `topic`, `datetest`, `activeflag`, `batchID`, `subjectID`, `datecreated`, `createdby`, `lastupdated`, `type`, `indentifier`, `quiztype`, `quizmodule`, `correctmark`, `wrongmark`,`typeID`) VALUES (NULL, '".$name."', '".$maximum."', '".$topic."', '".$datetest."', '1', '".$BatchObj->getID()."', '".$SubjectObj->getID()."', NOW(), '".$creatorID."', CURRENT_TIMESTAMP , '".$type."', '".$key."', '".$quiztype."', '".$quizmodule."', '".$rightmark."', '".$wrongmark."', '".$moduleID."' )";
	$result = mysql_query($query,$conn);
	echo mysql_error();
	if($result)  
	$message="Test Created Successfully :".$name;
	else 
	$message="Test Creation Failed : ".$name;
	}
	else 
	$message="Test Creation Failed : Similar test exists : ".$name;
	return $message;
	
	}
	
	function createOnlineTest($name,$maximum,$topic,$datetest,$BatchObj,$SubjectObj,$creatorID,$type,$key,$quiztype,$quizmodule,$rightmark,$wrongmark,$nomark,$moduleID)
	{
		
	$conn=getConnection();
	if(!testExists($name,$BatchObj,$SubjectObj,$quiztype))
	{
	$query="INSERT INTO `test` (`ID`, `name`, `maximum`, `topic`, `datetest`, `activeflag`, `batchID`, `subjectID`, `datecreated`, `createdby`, `lastupdated`, `type`, `indentifier`, `quiztype`, `quizmodule`, `correctmark`, `wrongmark`, `nomark`,`typeID`) VALUES (NULL, '".$name."', '".$maximum."', '".$topic."', '".$datetest."', '1', '".$BatchObj->getID()."', '".$SubjectObj->getID()."', NOW(), '".$creatorID."', CURRENT_TIMESTAMP , '".$type."', '".$key."', '".$quiztype."', '".$quizmodule."', '".$rightmark."', '".$wrongmark."', '".$nomark."', '".$moduleID."' )";
	$result = mysql_query($query,$conn);
	echo mysql_error();
	if($result)  
	$message="Test Created Successfully :".$name;
	else 
	$message="Test Creation Failed : ".$name;
	}
	else 
	$message="Test Creation Failed : Similar test exists : ".$name;
	return $message;
	
	}
	
	function testExists($name,$BatchObj,$SubjectObj,$quiztype)
{
	$conn=getConnection();
	$query = "SELECT * FROM `test` WHERE `name` LIKE '".$name."' AND `batchID` = '".$BatchObj->getID()."' AND `subjectID` = '".$SubjectObj->getID()."' AND `quiztype` = '".$quiztype."' AND `activeflag` <> 0 ";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	$flag=false;
	
		if($rows==0)
		{$flag=false;}
		else
		{$flag=true;}
return $flag;
	}
	
	
	
	function updateTest($testID,$name,$maximum,$topic,$datetest,$SubjectObj,$activeflag,$id)
	{
		
	$conn=getConnection();
	$testObj=getTest($testID);
	
	
	
	
	if($testObj->getType()==0)
		{
	$testObj->setName($name);
	$testObj->setMaximum($maximum);
	$testObj->setTopic($topic);
	$testObj->setDateTest($datetest);
	$testObj->setSubjectID($SubjectObj->getID());
	$testObj->setCreatedBy($id);
	$testObj->setActiveFlag($activeflag);
		
	$result=$testObj->update();
	}
	else
	{
		
		$conn=getConnection();
		$query = "SELECT * FROM test WHERE indentifier = '".$testObj->getIndentifier()."' AND activeflag <> 0 AND type = 1";
		$result1 = mysql_query($query);
		
		while($member = mysql_fetch_array($result1))
		{
	
	$testObj=getTest($member['ID']);
	$testObj->setName($name);
	$testObj->setMaximum($maximum);
	$testObj->setTopic($topic);
	$testObj->setDateTest($datetest);
	$testObj->setSubjectID($SubjectObj->getID());
	$testObj->setCreatedBy($id);
	
	//$testObj->setActiveFlag($activeflag);
		
	$result=$testObj->update();
			
			}
			
			$testObj=getTest($testID);
			$testObj->setActiveFlag($activeflag);
			$result=$testObj->update();
		}
	
	//if($result)  
	$message="Test Updated Successfully :".$name;
	//else 
	//$message="Test Updation Failed  ".$name.mysql_error();
	return $message;
	
	}
	
	function addNewBatchesForTest($testID,$batches,$creatorID)
	{
		
	$conn=getConnection();
	
	$testObj=getTest($testID);
	
	$type=$testObj->getType();
	$indentifier=$testObj->getIndentifier();
	
	if($type==0)
	{
		// Convert to common type
	$type=1;
	$indentifier=random_gen(20);
	
	$testObj->setType($type);
	$testObj->setIndentifier($indentifier);
	
	$result=$testObj->update();
	
	}
	
	for($i=0;$i<count($batches);$i++)
	{
	
	$query="INSERT INTO `test` (`ID`, `name`, `maximum`, `topic`, `datetest`, `activeflag`, `batchID`, `subjectID`, `datecreated`, `createdby`, `lastupdated`, `type`, `indentifier`, `quiztype`, `quizmodule`, `correctmark`, `wrongmark`,`typeID`) VALUES (NULL, '".$testObj->getName()."', '".$testObj->getMaximum()."', '".$testObj->getTopic()."', '".$testObj->datecreated."', '".$testObj->getActiveFlag()."', '".$batches[$i]."', '".$testObj->getSubjectID()."', NOW(), '".$creatorID."', CURRENT_TIMESTAMP , '".$type."', '".$indentifier."', '".$testObj->getQuizType()."', '".$testObj->getQuizModuleID()."', '".$testObj->getCorrectMark()."', '".$testObj->getWrongMark()."', '".$testObj->getTypeID()."' )";
	$result = mysql_query($query,$conn);
	
	$newID=mysql_insert_id();
	
	if($testObj->getQuizType()!=0)
	addQuestionsForNewSimilarTest($testID,$newID);
	
	}
		
	}
	
	
	function addQuestionsForNewSimilarTest($testID,$newID)
	{
	    
		$conn=getConnection();
		$query = "SELECT * FROM test_question WHERE testID = ".$testID;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{

$query1 ="INSERT INTO `test_question` (`ID`, `testID`, `questionID`, `activeflag`) VALUES (NULL, '".$newID."','".$member['questionID']."','".$member['activeflag']."')";
$result1 = mysql_query($query1,$conn);

		}
	}
		
		
	function getAllTestsByBatch($batchobj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE batchID='".$batchobj->getID()."' AND activeflag<>0 ORDER BY subjectID ASC, activeflag DESC,datetest DESC";
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
	
function enableAllTest($batchID)
	{
	$conn=getConnection();
	
	$query1 = "SELECT * FROM test WHERE batchID = '".$batchID."' AND activeflag<>0";
	$result1 = mysql_query($query1);
	while($member = mysql_fetch_array($result1))
		{
		$conn=getConnection();
		$testObj=getTest($member['ID']);	
		$testObj->updateActiveFlag(1);
		//echo 1;
		}
	
		
		
	
	}
	
	function getSimilarTest($batchobj,$testObj)
	{
		$conn=getConnection();
		$list = array();
$query = "SELECT * FROM test WHERE type = 1 AND batchID='".$batchobj->getID()."' AND indentifier = '".$testObj->getIndentifier()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = getTest($member['ID']);
			return $tempObj;
		}
		else 
		return NULL;
		
		
	}
	
	function getTestIDForReport($batchobj,$testids)
	{
		$conn=getConnection();
		$temparray=array();
		$testarray=array();
		
$temparray=explode(';',$testids);
for($i=0;$i<count($temparray);$i++)
{
	$testObj=getTest($temparray[$i]);
	$temp=getSimilarTest($batchobj,$testObj);
	array_push($testarray,$temp->getID());
	}
		if(count($testarray) != 0)
		{
			
			$testid=implode(';',$testarray);
			return $testid;
		}

		return NULL;
		
		}
		
		function getAllQuizTestsByBatch($batchobj,$no)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE batchID='".$batchobj->getID()."' AND activeflag<>0 AND quiztype = '".$no."' ORDER BY subjectID ASC, activeflag DESC,datetest DESC";
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
	
	function getActiveQuizTestsByBatch($batchobj,$no)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM test WHERE batchID='".$batchobj->getID()."' AND activeflag = 1 AND quiztype = '".$no."' ORDER BY subjectID ASC, datetest DESC";
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
?>