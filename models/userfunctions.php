<?php

function getStudentLogin($ID)
	{
		$conn = getMainConnection();
		$query = "SELECT * FROM student WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new StudentLogin($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
function getUser($ID)
	{
		$conn = getMainConnection();
		$query = "SELECT * FROM users WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new User($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getInstitute($ID)
	{
		$conn = getMainConnection();
		$query = "SELECT * FROM info WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Institute($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function checkUsernameExists($username)
	{
		$conn = getMainConnection();
		$query = "SELECT * FROM users WHERE username = '".$username."' AND activeflag <>0";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		$flag=true;
		if($numrows == 0)
		{
			$flag=false;
		}
		
		return $flag;
		
		}
		
		function getAllActiveUsers($id)
	{
		
		$conn=getMainConnection();
		$list = array();
		$query = "SELECT * FROM users WHERE activeflag=1 AND classID = ".$id." AND level!=3 ORDER BY branchID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getUser($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
			function getAllUsers($id)
	{
		
		$conn=getMainConnection();
		$list = array();
		$query = "SELECT * FROM users WHERE activeflag<>0 AND classID = ".$id." AND level!=1 ORDER BY level ASC,branchID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getUser($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveUsersByBranch($id,$branch)
	{
		
		$conn=getMainConnection();
		$list = array();
		$query = "SELECT * FROM users WHERE activeflag=1 AND classID = ".$id." AND branchID = ".$branch." AND level!=3 ORDER BY branchID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getUser($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveTeachers($id)
	{
		
		$conn=getMainConnection();
		$list = array();
		$query = "SELECT * FROM users WHERE activeflag=1 AND classID = ".$id." AND level=3 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getUser($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
		function updateUser($ID,$name,$activeflag,$pass,$phone_number)
	{
		if($pass!=''&&$pass!=NULL)
		$password=md5($pass);
		else
		$password='1-1';
		
	    $Obj=getUser($ID);
		$Obj->setName($name);
	    $Obj->setActiveFlag($activeflag);
		$Obj->setPhone($phone_number);
		
		if($password!='1-1')
	    $Obj->setPassword($password);
		
	    $result=$Obj->update();
		
		if($result)  
	$message="User Updated Successfully :".$name;
	else 
	$message="User Updation Failed : ".mysql_error();
	return $message;
		
		}
	?>