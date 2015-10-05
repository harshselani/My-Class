<?php

function getReport($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM report WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Report($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getTestObjsForReport($ids)
	{
		$list=array();
		$temparray=array();
		$ids=trim($ids);
		if($ids!='')
		{
		$temparray=explode(";",$ids);
		foreach($temparray as $t)
		{
			$temp = getTest($t);
			array_push($list,$temp);
		}
		
		if(count($list) != 0)
		{
			return $list;
		}
		return NULL;
		}
		return NULL;
		}
		
		
	function createReport($batchID,$name,$date,$testids,$creatorID,$type,$key)
	{
		
	$conn=getConnection();
	
	$query="INSERT INTO `report` (`ID`, `name`, `testID`, `batchID`, `datereport`, `activeflag`,`datecreated`, `createdby`, `lastupdated`, `type`, `indentifier`) VALUES (NULL, '".$name."', '".$testids."', '".$batchID."', '".$date."', '1', NOW(), '".$creatorID."', CURRENT_TIMESTAMP , '".$type."', '".$key."' )";
	
	$result = mysql_query($query,$conn);
	//echo mysql_error();
	if($result)  
	{
	$temp = mysql_insert_id();
	$tempObj=getReport($temp);
	$message="Report Card Created Successfully : ".$tempObj->getName();
	
	}
	else 
	{
		$message="Report Card Creation Failed : ".$name;
		$temp=0;
	}
	
	return array($message,$temp);
	
	}
	
	function getAllReportByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM report WHERE batchID='".$obj->getID()."' AND activeflag<>0 ORDER BY datereport DESC, activeflag DESC";
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
	
	function updateReport($reportID,$name,$date,$testids,$activeflag,$id)
	{
		$conn=getConnection();
	    $reportObj=getReport($reportID);
		if($reportObj->getType()==0)
		{
		$reportObj->setName($name);
	    $reportObj->setTestids($testids);
	    $reportObj->setActiveFlag($activeflag);
	    $reportObj->setDateReport($date);
		$reportObj->setCreatedBy($id);
	    $result=$reportObj->update();
		
		
		}
		else
		{
		$conn=getConnection();
		$query = "SELECT * FROM report WHERE indentifier = '".$reportObj->getIndentifier()."' AND activeflag = 1 AND type = 1";
		$result1 = mysql_query($query);
		
		while($member = mysql_fetch_array($result1))
		{
		$reportObj=getReport($member['ID']);	
		
		$test=getTestIDForReport($reportObj->getBatchObj(),$testids);
		
		$reportObj->setName($name);
	    $reportObj->setTestids($test);
	    $reportObj->setActiveFlag($activeflag);
	    $reportObj->setDateReport($date);
		$reportObj->setCreatedBy($id);
	    $result=$reportObj->update();
			
			}
			
		}
		if($result)  
	$message="Report Updated Successfully :".$name;
	else 
	$message="Report Updation Failed : ".$name;
	return $message;
		}
		
		function getAllActiveReportsByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM report WHERE batchID='".$obj->getID()."' AND activeflag = 1 ORDER BY type DESC, datereport DESC";
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
	

	?>