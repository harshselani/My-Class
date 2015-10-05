<?php 

function getBatch($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM batch WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Batch($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
		function getAllActiveBatches()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
			function getAllInActiveBatches()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=-1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveBatchesByBranch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=1 AND branchID='".$obj->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
		function getAllInActiveBatchesByBranch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=-1 AND branchID='".$obj->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveBatchesByYear($examyear)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=1 AND examyear='".$examyear."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllInActiveBatchesByYear($examyear)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=-1 AND examyear='".$examyear."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveBatchesByBranchAndYear($obj,$examyear)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=1 AND branchID='".$obj->getID()."' AND examyear='".$examyear."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function createBatch($name,$examyear,$branchObj,$creator)
	{
		$conn = getConnection();
		$query = "SELECT * FROM batch WHERE name LIKE '%".$name."%' AND examyear = '".$examyear."' AND branchID = '".$branchObj->getID()."'";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			$query = "INSERT INTO batch(name ,examyear ,branchID ,activeflag ,datecreated ,createdby ,lastupdated) VALUES('".$name."' ,'".$examyear."' ,'".$branchObj->getID()."' , 1 , NOW(),".$creator.",NOW())";
			$result = mysql_query($query);
			
			if($result)  
			$message="Batch Created Successfully :".$name;
			else 
			$message="Batch Creation Failed :".$name;
		}
		else
		{
			$message="Batch Creation Failed : Similar Branch exists -".$name;
		}

		return $message;
	}
	
	function getAllActiveBatchesSorted()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag=1 ORDER BY examyear DESC, branchID ASC, name ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllBatchesSorted()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM batch WHERE activeflag<>0 ORDER BY examyear DESC, branchID ASC, activeflag DESC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBatch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function updateBatch($batchID,$name,$activeflag,$id)
	{
		$conn=getConnection();
	    $Obj=getBatch($batchID);
		$Obj->setName($name);
	    $Obj->setActiveFlag($activeflag);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Batch Updated Successfully :".$name;
	else 
	$message="Batch Updation Failed : ".$name;
	return $message;
		
		}
		
		function batchExistsInBranch($branchID,$batchID)
		{
		
		$conn=getConnection();
		
		$query = "SELECT * FROM batch WHERE activeflag=1 AND branchID=".$branchID." AND ID=".$batchID." ";
		//echo $query;
		$result = mysql_query($query);
		
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			return true;
		}
		return false;
			}
	?>