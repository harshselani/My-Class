<?php

function getSubject($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM subject WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Subject($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllActiveSubjects()
	{
		$conn=getConnection();
		$subjectlist = array();
		$query = "SELECT * FROM subject WHERE activeflag=1 ORDER BY ID ASC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getSubject($member['ID']);
			array_push($subjectlist,$temp);
		}

		if(count($subjectlist) != 0)
		{
			return $subjectlist;
		}

		return NULL;
	}
	
function createSubject($name,$creatorObj)
	{
		$conn = getConnection();
		$query = "SELECT * FROM subject WHERE name LIKE '%".$name."%'";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		
		if($rows==0)
		{
			$query = "INSERT INTO subject(name ,activeflag ,datecreated ,createdby ,lastupdated) VALUES('$name' , 1 , NOW(),".$creatorObj->getID().",NOW())";
			$result = mysql_query($query);
			
			if($result)  return 1;
			else return 0;
		}
		else
		{
			return 2;
		}

		return 0;
	}
?>