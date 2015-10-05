<?php

function getBranch($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM branch WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Branch($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllActiveBranches()
	{
		$conn=getConnection();
		$branchlist = array();
		$query = "SELECT * FROM branch WHERE activeflag=1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBranch($member['ID']);
			array_push($branchlist,$temp);
		}

		if(count($branchlist) != 0)
		{
			return $branchlist;
		}

		return NULL;
	}
	
	function getAllBranches()
	{
		$conn=getConnection();
		$branchlist = array();
		$query = "SELECT * FROM branch WHERE activeflag<>0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBranch($member['ID']);
			array_push($branchlist,$temp);
		}

		if(count($branchlist) != 0)
		{
			return $branchlist;
		}

		return NULL;
	}
	
			function getAllInActiveBranches()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM branch WHERE activeflag=-1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getBranch($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function createBranch($name,$creatorID)
	{
		$conn = getConnection();
		$query = "SELECT * FROM branch WHERE name LIKE '%".$name."%'";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			
$query = "INSERT INTO `branch` (`ID`, `name`, `activeflag`, `datecreated`, `createdby`, `lastupdated`) VALUES (NULL, '".$name."', '1', NOW(), '".$creatorID."', CURRENT_TIMESTAMP)";
			$result = mysql_query($query);
			
			if($result)  
			$message="Branch Created Successfully :".$name;
			else 
			$message="Branch Creation Failed : ".$name;
				}
		else
		{
			$message="Branch Creation Failed : Similar Branch exists :".$name;
		}

		return $message;
	}
	
	function updateBranch($branchID,$name,$activeflag,$id)
	{
		$conn=getConnection();
	    $Obj=getBranch($branchID);
		$Obj->setName($name);
	    $Obj->setActiveFlag($activeflag);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Branch Updated Successfully :".$name;
	else 
	$message="Branch Updation Failed : ".$name;
	return $message;
		
		}
	
	function getRemark($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM remark WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Remark($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllRemarks()
	{
		$conn=getConnection();
		$branchlist = array();
		$query = "SELECT * FROM remark WHERE activeflag<>0 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getRemark($member['ID']);
			array_push($branchlist,$temp);
		}

		if(count($branchlist) != 0)
		{
			return $branchlist;
		}

		return NULL;
	}
	
	function createReportRemark($min,$max,$remark,$user)
	{
		$conn=getConnection();
		$flag=checkRemarkExist($min,$max);
		if(!$flag)
		{
			$query = "INSERT INTO remark(min ,max ,display ,activeflag ,createdby ,lastupdated) VALUES('".$min."' ,'".$max."' ,'".$remark."', 1 ,'".$user."' , NOW())";
			$result = mysql_query($query);
			
			if($result)  
			$message="Remark Created Successfully ";
			else 
			$message="Remark Creation Failed ";
			
			}
			else
			$message="Remark in similar range exists!!";
			
			return $message;
		}

function checkRemarkExist($min,$max)
	{
		$flag=true;
		$conn=getConnection();
		$query = "SELECT * FROM remark WHERE min <= '".$max."' AND min >= '".$min."' AND activeflag = 1 ";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		if($rows == 0)
		{
			$query = "SELECT * FROM remark WHERE max <= '".$max."' AND max >= '".$min."' AND activeflag = 1 ";
		    $result = mysql_query($query);
		    $rows = mysql_num_rows($result);
			if($rows == 0)
		{
			$flag=false;
		}
		}
		return $flag;
		}
		
		function updateRemark($remarkID,$name,$activeflag,$id)
	{
		$conn=getConnection();
	    $Obj=getRemark($remarkID);
		$Obj->setDisplay($name);
	    $Obj->setActiveFlag($activeflag);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Remark Updated Successfully ";
	else 
	$message="Remark Updation Failed : ";
	return $message;
		
		}
		
		function getRemarkForPercentage($percentage)
		{
		
		$conn=getConnection();
		$percentage=round($percentage,0);
		$query = "SELECT * FROM remark WHERE min <= '".$percentage."' AND max >= '".$percentage."' AND activeflag = 1 ";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		if($rows == 1)
		{
			$member = mysql_fetch_array($result);
			return $member['display'];
			}
		else
		return -1;
		
		}
		
		
	?>