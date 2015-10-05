<?php

function getBatchClass($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM batchclass WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new BatchClass($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
			function getAllActiveBatchClasses()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batchclass WHERE activeflag=1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatchClass($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
			function getAllInActiveBatchClasses()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batchclass WHERE activeflag=-1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatchClass($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllBatchClassesSorted()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batchclass WHERE activeflag<>0 ORDER BY batchID ASC,activeflag DESC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatchClass($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveBatchClassByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batchclass WHERE activeflag=1 AND batchID='".$obj."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatchClass($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
		function getAllInActiveBatchClassByBranch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=-1 AND batchID='".$obj->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatchClass($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveBatchClassByBranch($obj)
	{
		$conn=getConnection();
		$batchlist=array();
		$batchlist=getAllActiveBatchesByBranch($obj);
		$list = array();
		for($i=0;$i<count($batchlist);$i++)
		{
		$query = "SELECT * FROM batch WHERE activeflag=1 AND batchID='".$batchlist[$i]->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatchClass($member['ID']);
			array_push($list,$temp);
		}
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function createBatchClass($name,$extra,$batchID,$creator)
	{
		$conn = getConnection();
		$query = "SELECT * FROM batchclass WHERE name LIKE '%".$name."%'  AND batchID = '".$batchID."'";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			$query = "INSERT INTO batchclass(name ,info ,batchID ,activeflag ,datecreated ,createdby ,lastupdated) VALUES('".$name."' ,'".$extra."' ,'".$batchID."' , 1 , NOW(),".$creator.",NOW())";
			$result = mysql_query($query);
			
			if($result)  
			$message="Batch Class Created Successfully :".$name;
			else 
			$message="Batch Class Creation Failed :".$name;
		}
		else
		{
			$message="Batch Class Creation Failed : Similar Exists -".$name;
		}

		return $message;
	}
	
	function updateBatchClass($batchID,$extra,$name,$activeflag,$id)
	{
		$conn=getConnection();
	    $Obj=getBatchClass($batchID);
		$Obj->setName($name);
		$Obj->setInfo($extra);
	    $Obj->setActiveFlag($activeflag);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Batch Class Updated Successfully :".$name;
	else 
	$message="Batch Class Updation Failed : ".$name;
	return $message;
		
		}
	?>