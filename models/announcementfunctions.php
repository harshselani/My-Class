<?php
function getAnnouncement($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM announcement WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Announcement($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
function getAllActiveAnnouncements()
	{
		$conn=getConnection();
		$announcementlist = array();
		$query = "SELECT * FROM announcement WHERE activeflag=1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getAnnouncement($member['ID']);
			array_push($announcementlist,$temp);
			
		}

		
		if(count($announcementlist) != 0)
		{
			return $announcementlist;
		}

		return NULL;
	}
		
		function getAllInActiveAnnouncements()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM announcement WHERE activeflag=-1 ORDER BY ID ASC";
		//echo $query;
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
	
	function getAllActiveAnnouncementsByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM announcement WHERE activeflag=1 AND batchID='".$obj->getID()."' ORDER BY ID ASC";
		//echo $query;
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
	
		function getAllInActiveAnnouncementsByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM announcement WHERE activeflag=-1 AND batchID='".$obj->getID()."' ORDER BY ID ASC";
		//echo $query;
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
	
	function getAllActiveAnnouncementsByBranch($obj)
	{
		$conn=getConnection();
		$batchlist=array();
		$batchlist=getAllActiveBatchesByBranch($obj);
		$list = array();
		for($i=0;$i<count($batchlist);$i++)
		{
		
		$query = "SELECT * FROM announcement WHERE activeflag=1 AND batchID='".$batchlist[$i]->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getAnnouncement($member['ID']);
			array_push($list,$temp);
		}

		}
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveAnnouncementsByYear($examyear)
	{
		$conn=getConnection();
		$batchlist=array();
		$batchlist=getAllActiveBatchesByYear($examyear);
		$list = array();
		for($i=0;$i<count($batchlist);$i++)
		{
		
		$query = "SELECT * FROM announcement WHERE activeflag=1 AND batchID='".$batchlist[$i]->getID()."' ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getAnnouncement($member['ID']);
			array_push($list,$temp);
		}

		}
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function createAnnouncement($name,$batchID,$creatorID)
	{
		$conn = getConnection();
		
			
$query = "INSERT INTO `announcement` (`display`, `activeflag`, `batchID`, `datecreated`, `createdby`, `lastupdated`) VALUES ('".$name."', '1', '".$batchID."', NOW(), '".$creatorID."', CURRENT_TIMESTAMP)";
			$result = mysql_query($query);
			
			if($result)  
			$message="Announcemet Created Successfully :".$name;
			else 
			$message=mysql_error();
			//$message="Announcemet Creation Failed : ".$name;
				
				

		return $message;
	}
	
	function getAllAnnouncementsByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM announcement WHERE activeflag <> 0 AND batchID='".$obj->getID()."' ORDER BY activeflag DESC";
		//echo $query;
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
	
		function getAllAnnouncementsByBatchID($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM announcement WHERE activeflag <> 0 AND batchID='".$obj."' ORDER BY activeflag DESC";
		//echo $query;
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
	
	function updateAnnouncement($ID,$name,$activeflag,$id)
	{
		$conn=getConnection();
	    $Obj=getAnnouncement($ID);
		$Obj->setDisplay($name);
	    $Obj->setActiveFlag($activeflag);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Announcement Updated Successfully :".$name;
	else 
	$message="Announcement Updation Failed : ".$name;
	return $message;
		
		}
	
	?>