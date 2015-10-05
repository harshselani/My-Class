<?php


	
	function getMyInstitutes($id)
	{
		$conn = getMainConnection();
		$list=array();
		$temparray=array();
		$temparray=explode(";",$id);
		
		foreach($temparray as $t)
		{
			$temp = getInstitute($t);
			array_push($list,$temp);
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
		
			function getAllActiveInstitutes()
	{
		$conn = getMainConnection();
		$list=array();
		
		$query = "SELECT * FROM info WHERE activeflag=1 ORDER BY ID ASC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = array($member['ID'],$member['classname']);
			array_push($list,$temp);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
	
	/*function getMyMarks($obj,$id)
	{
		$conn = getStudentConnection($obj);
		$list = array();
		$query = "SELECT * FROM marks WHERE studentID='".$id."' ORDER BY datecreated DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempmark = getMarks($member['ID']);
			array_push($list,$tempmark);
			
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
		*/
	
	function checkNumberExists($number)
{
	$conn=getMainConnection();
	$query = "SELECT * FROM `student` WHERE `phone_stu` = '".$number."' OR `phone_father` = '".$number."' AND activeflag <> 0";
	$result = mysql_query($query,$conn);
	$rows = mysql_num_rows($result);
	$flag=false;
	$id=0;
		if($rows==1)
		{
			$member=mysql_fetch_array($result);
			$flag=true;
	        $id=$member['ID'];
			//$classID=$member['instituteIDs'];
			$query1 = "SELECT * FROM `studentinstituteid` WHERE `studentID` = '".$id."'  AND `activeflag` = 1";
	        $result1 = mysql_query($query1,$conn);
	        $member1=mysql_fetch_array($result1);
			$classID=$member1['instituteID'];
			}
			else
			{
			$flag=false;
	        $id=0;	
			$classID=0;
			}
				return array($flag,$id,$classID);
	}
	
	function resetActid($id)
		{
			$conn=getMainConnection();
			$actid=rand(1000,9999);
			$query = "UPDATE student SET actid = '".$actid."' WHERE ID = ".$id;
			$result = mysql_query($query);
			if($result)
			return $actid;
			else
			return NULL;
		}
	function resetPassword($number,$pass1,$id)
	{
		$conn=getMainConnection();
		$column=getColumnName($number,$id);
		if($column!=NULL)
		{
			$conn=getMainConnection();
			$hashed_pswd = md5($pass1);
			$query1 = "UPDATE student SET ".$column." = '".$hashed_pswd."' WHERE ID = ".$id;
			$result1 = mysql_query($query1);
			if($result1)
			return true;
			else
			return false;
			
			}
			else 
			return false;
		}
		
		function getColumnName($number,$id)
		{
			$conn=getMainConnection();
			$query = "SELECT * FROM `student` WHERE `ID` = '".$id."' AND activeflag <> 0";
	        $result = mysql_query($query,$conn);
			$column=NULL;
			if($result)
			{
				$member=mysql_fetch_array($result);
				if($member['phone_stu']==$number)
				$column='studentpass';
				if($member['phone_father']==$number)
				$column='parentpass';
				}
			return $column;
			}
	?>