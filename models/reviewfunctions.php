<?php


	function getReview($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM reviews WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			
			return $member;
		}
		return NULL;
	}
	
	function createReview($name,$status,$batchID,$creator)
	{
		$conn = getConnection();
		echo 4;
			$query = "INSERT INTO reviews(name ,open ,batchID ,activeflag ,datecreated ,createdby ,type) VALUES('".$name."' ,'".$status."' ,'".$batchID."' , 1 , NOW(),".$creator.",0)";
			$result = mysql_query($query);
			echo mysql_error();
			if($result)  
			$message="Review Created Successfully :".$name;
			else 
			$message="Review Creation Failed :".$name;
		

		return $message;
	}
	
	function getAllReviewsByBatch($batchID)
	{
	
	$conn = getConnection();
	$query = "SELECT * FROM reviews WHERE batchID = '".$batchID."' AND activeflag != 0";
		$result = mysql_query($query);
		$list=array();
		while($member = mysql_fetch_array($result))
		{
			
			array_push($list,$member);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;	
	}
	
	function updateReview($reviewID,$open,$name,$activeflag,$id)
	{
		$conn=getConnection();
	    
		$query = "UPDATE reviews SET activeflag = '".$activeflag."', name = '".$name."', open = '".$open."', createdby = '".$id."' WHERE ID = ".$reviewID."";
			$result = mysql_query($query);
		
		if($result)  
	$message="Review Updated Successfully ";
	else 
	$message="Review Updation Failed ";
	return $message;
		
		}
		
	function getAllActiveReviewsForStudent($ID,$batchID)
	{
		$conn=getConnection();
		$list=array();
		$query = "SELECT * FROM reviews WHERE batchID = '".$batchID."' AND activeflag = 1 AND open = 1";
		$result = mysql_query($query);
		
		
		if($member = mysql_fetch_array($result))
		{
			
		$query2 = "SELECT * FROM review_response WHERE studentID = '".$ID."' AND reviewID = '".$member['ID']."' AND activeflag = 1";
		$result2 = mysql_query($query2);
		$numrows = mysql_affected_rows();
		
		if($numrows == 0)
		{
			array_push($list,$member);
			
			
		}
			
			
		}
		return $list;
	}	
		
			function getReviewColumns()
	{
		$conn=getConnection();
		$list=array();
		$query = "SELECT * FROM review_columns WHERE activeflag = 1 AND type = 0";
		$result = mysql_query($query);
		
		
		while($member = mysql_fetch_array($result))
		{
			array_push($list,$member);
		}
		return $list;
	}
	
	function getReviewResponse($id)
	{
	$conn=getConnection();
	$list=array();
	$column_list=getReviewColumns();
	
	for($i=0;$i<count($column_list);$i++)
	{
		$temp=array();
		
		$query = "SELECT COUNT(*) AS temp_count FROM review_response WHERE activeflag = 1 AND reviewID = ".$id." AND columnID = ".$column_list[$i]['ID']." AND response = 1 GROUP BY columnID";
		$result = mysql_query($query);
		$member = mysql_fetch_array($result);
		array_push($temp,$member['temp_count']);
		
		$query = "SELECT COUNT(*) AS temp_count FROM review_response WHERE activeflag = 1 AND reviewID = ".$id." AND columnID = ".$column_list[$i]['ID']." AND response = 2 GROUP BY columnID";
		$result = mysql_query($query);
		$member = mysql_fetch_array($result);
		array_push($temp,$member['temp_count']);
		
		$query = "SELECT COUNT(*) AS temp_count FROM review_response WHERE activeflag = 1 AND reviewID = ".$id." AND columnID = ".$column_list[$i]['ID']." AND response = 3 GROUP BY columnID";
		$result = mysql_query($query);
		$member = mysql_fetch_array($result);
		array_push($temp,$member['temp_count']);
		
		$query = "SELECT COUNT(*) AS temp_count FROM review_response WHERE activeflag = 1 AND reviewID = ".$id." AND columnID = ".$column_list[$i]['ID']." AND response = 4 GROUP BY columnID";
		$result = mysql_query($query);
		$member = mysql_fetch_array($result);
		array_push($temp,$member['temp_count']);
		
		$query = "SELECT COUNT(*) AS temp_count FROM review_response WHERE activeflag = 1 AND reviewID = ".$id." AND columnID = ".$column_list[$i]['ID']." AND response = 5 GROUP BY columnID";
		$result = mysql_query($query);
		$member = mysql_fetch_array($result);
		array_push($temp,$member['temp_count']);
		
		array_push($list,array($column_list[$i]['name'],$temp));
		
	}
		return $list;
	}
		
	?>