<?php

/*
Type = 0 : Student Notes
Type = 1 : Test Solution
Type = 2 : Staff Material By Batch
Type = 3 : User Material
*/


	function getNotes($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM notes WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Notes($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllActiveNotes()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag=1 AND type=0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
			function getAllInActiveNotes()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag=-1 AND type=0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveNotesByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag=1 AND type=0 AND batchID='".$obj->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllStaffNotesByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag<>0 AND type=2 AND batchID='".$obj->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveStaffNotesByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag<>0 AND type=2 AND batchID='".$obj->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllNotesByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag<>0 AND batchID='".$obj->getID()."' AND type=0 ORDER BY activeflag ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}

function getAllNotesByBatchID($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag<>0 AND batchID='".$obj."' AND type=0 ORDER BY activeflag ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}

	
		function getAllInActiveNotesByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag=-1 AND batchID='".$obj->getID()."' AND type=0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveNotesByBranch($obj)
	{
		$conn=getConnection();
		$batchlist=array();
		$batchlist=getAllActiveBatchesByBranch($obj);
		$list = array();
		for($i=0;$i<count($batchlist);$i++)
		{
		
		$query = "SELECT * FROM notes WHERE activeflag=1 AND batchID='".$batchlist[$i]->getID()."' AND type=0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		}
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	
	
	function getAllActiveNotesByYear($examyear)
	{
		$conn=getConnection();
		$batchlist=array();
		$batchlist=getAllActiveBatchesByYear($examyear);
		$list = array();
		for($i=0;$i<count($batchlist);$i++)
		{
		
		$query = "SELECT * FROM notes WHERE activeflag=1 AND batchID='".$batchlist[$i]->getID()."' AND type=0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		}
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function createNote($name,$batchID,$subjectID,$note,$creatorID,$type,$testID)
	{
		$conn = getConnection();
		$url=uploadNotes($note);
		if($type==1)
		{
			list($flag,$solnID)= testSolutionExists($testID,1);
			if($flag)
			{
				$query = "UPDATE notes SET activeflag = 1, name = '".$name."',url = '".$url."',createdby = '".$creatorID."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$solnID."";
			$result = mysql_query($query);
				
				}
			else
			{
				
				$query = "INSERT INTO `notes` (`name`, `activeflag`, `batchID`, `subjectID`,`url`, `datecreated`, `createdby`, `lastupdated`,`type`,`testID`) VALUES ('".$name."', '1', '".$batchID."', '".$subjectID."', '".$url."', NOW(), '".$creatorID."', CURRENT_TIMESTAMP, '".$type."', '".$testID."')";
			$result = mysql_query($query);
				}
			
			if($result)  
			$message="Solution Uploaded Successfully : ".$name;
			else 
			$message=mysql_error();
			}
		else
		{
			
$query = "INSERT INTO `notes` (`name`, `activeflag`, `batchID`, `subjectID`,`url`, `datecreated`, `createdby`, `lastupdated`,`type`,`testID`) VALUES ('".$name."', '1', '".$batchID."', '".$subjectID."', '".$url."', NOW(), '".$creatorID."', CURRENT_TIMESTAMP, '".$type."', '".$testID."')";
			$result = mysql_query($query);
		
		if($result)  
			$message="Note Created Successfully :".$name;
			else 
			$message=mysql_error();
		}
			
			//$message="Note Creation Failed : ".$name;
				
				

		return $message;
	}
	
	function createNote1($name,$batchID,$subjectID,$url,$creatorID,$type,$testID,$moduleID)
	{
		$conn = getConnection();
		
		
			
$query = "INSERT INTO `notes` (`name`, `activeflag`, `batchID`, `subjectID`,`url`, `datecreated`, `createdby`, `lastupdated`,`type`,`testID`,`moduleID`) VALUES ('".$name."', '1', '".$batchID."', '".$subjectID."', '".$url."', NOW(), '".$creatorID."', CURRENT_TIMESTAMP, '".$type."', '".$testID."', '".$moduleID."')";
			$result = mysql_query($query);
		
		if($result)  
			$message="Note Created Successfully :".$name;
			else 
			$message=mysql_error();
		
			
			//$message="Note Creation Failed : ".$name;
				
				

		return $message;
	}
	
	function createStaffNote($name,$batchID,$subjectID,$url,$creatorID,$type,$testID,$same_type,$key)
	{
		$conn = getConnection();
		
$query = "INSERT INTO `notes` (`name`, `activeflag`, `batchID`, `subjectID`,`url`, `datecreated`, `createdby`, `lastupdated`,`type`,`testID`,`same_type`,`indentifier`) VALUES ('".$name."', '1', '".$batchID."', '".$subjectID."', '".$url."', NOW(), '".$creatorID."', CURRENT_TIMESTAMP, '".$type."', '".$testID."', '".$same_type."', '".$key."')";
			$result = mysql_query($query);
		
		if($result)  
			$message="Note Created Successfully :".$name;
			else 
			$message=mysql_error();
		
			
			//$message="Note Creation Failed : ".$name;
				
				

		return $message;
	}
	
	function testSolutionExists($testID,$type)
{
	$conn=getConnection();
	$query = "SELECT * FROM `notes` WHERE `activeflag` <> 0  AND `testID` = '".$testID."' AND `type` = '".$type."' ";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	$flag=false;
	
		if($rows==0)
		{
			$flag=false;
			$testID=0;
		}
		else
		{
			    $flag=true;
		        $member = mysql_fetch_array($result);
				$flag=true;
				$testID=$member['ID'];
			}
				$temp=array($flag,$testID);
				return $temp;

	}
	
	function getSimilarStaffNotesByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM notes WHERE activeflag<>0 AND type=2 AND same_type=1 AND indentifier='".$obj->getIndentifier()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function updateStaffNote($Obj,$name,$url,$status,$id)
	{
		$conn=getConnection();
	    
		$Obj->setName($name);
	    $Obj->setActiveFlag($status);
		$Obj->setUrl($url);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Staff Material Updated Successfully :".$name;
	else 
	$message="Staff Material Updation Failed : ".$name;
	return $message;
		
		}
		
		function getAllMyStaffNotes($userID,$branchID,$userlevel)
	{
		$conn=getConnection();
		$list = array();
		$obj=getBranch($branchID);
		
		if($userlevel!=1)
		$query = "SELECT * FROM notes WHERE activeflag<>0 AND type=3 AND batchID =".$userID." ORDER BY lastupdated DESC";
		else
		$query = "SELECT * FROM notes WHERE activeflag<>0 AND type=3  ORDER BY lastupdated DESC";
		
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

/*
        $batchlist=getAllActiveBatchesByBranch($obj);
		
		for($i=0;$i<count($batchlist);$i++)
		{
		
		$query = "SELECT * FROM notes WHERE activeflag<>0 AND batchID='".$batchlist[$i]->getID()."' AND type=2 ORDER BY lastupdated DESC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getNotes($member['ID']);
			array_push($list,$temp);
		}

		}
*/
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	?>