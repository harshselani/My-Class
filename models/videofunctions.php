<?php 

function getVideo($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM video WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Video($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllLecturesForVideo($start,$end)
	{
		$conn=getConnection();
		$query = "SELECT * FROM lecture WHERE start_datetime >= '".$start."' AND start_datetime	<= '".$end."'";
		$result = mysql_query($query);
		$list=array();
		while($member = mysql_fetch_array($result))
		{
			$temp = getLecture($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveVideosByExamYear($examyear)
	{
		$conn=getConnection();
		$query = "SELECT * FROM video WHERE examyear = '".$examyear."' AND activeflag = 1 ORDER BY ID DESC";
		$result = mysql_query($query);
		$list=array();
		while($member = mysql_fetch_array($result))
		{
			$temp = getVideo($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function addVideoLecture($name,$format,$examyear,$start,$end,$creator)
	{
		
	$conn=getConnection();
	
	    
		do{
			
		$temp_url = md5($name.random_gen(10).getCurrentInstituteID1());
			
		$query = "SELECT * FROM video WHERE url LIKE '".$temp_url."'";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		if($rows==0)
		$tempflag=false;
		else 
		$tempflag=true;
		
		}while($tempflag);
	
	$url=$temp_url.'.'.$format;
	
	        $query = "INSERT INTO video(name ,url,examyear,activeflag ,createdby , start_date, end_date, lastupdated) VALUES('".$name."' ,'".$url."' ,'".$examyear."' , 1 , ".$creator.", '".$start."', '".$end."',NOW())";
			$result = mysql_query($query);
			
			if($result)  
			$temp=array(true,mysql_insert_id());
			else 
			$temp=array(false,mysql_error());
			
			return $temp;
		
	}
	
	function addLecturesForVideo($id,$lecture_array,$creator)
	{
		
	$conn=getConnection();
	
	for($i=0;$i<count($lecture_array);$i++)
{
	$query = "INSERT INTO video_lecture(videoID ,lectureID,createdby ,activeflag ) VALUES('".$id."' ,'".$lecture_array[$i]."', ".$creator.",1)";
	$result = mysql_query($query);
}
			
		
	}
	
	
		
	?>