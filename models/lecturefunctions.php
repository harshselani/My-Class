<?php

/* <-------------------------------------Lecture Functions---------------------------------> */

function getLecture($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM marks WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Lecture($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllActiveLecturesByBatchClass($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM lecture WHERE activeflag=1 AND batchclassID='".$obj->getID()."' ORDER BY end_datetime DESC";
		//echo $query;
		$result = mysql_query($query);
		
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
	
	function getAllActiveLectureByBatchClassDate($ID,$date)
	{
		$conn=getConnection();
		$list = array();
		
$testdatearray=explode('-',$date);
if(count($testdatearray)==3)
{
$dd=$testdatearray[0];
$mm=$testdatearray[1];
$yyyy=$testdatearray[2];

$date=$yyyy.'-'.$mm.'-'.$dd.' 00:00:00';
$date1=$yyyy.'-'.$mm.'-'.$dd.' 23:59:00';

		
		$query = "SELECT * FROM lecture WHERE activeflag=1 AND batchclassID='".$ID."' AND start_datetime >= '".$date."' AND end_datetime <= '".$date1."' ORDER BY end_datetime DESC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getLecture($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}
}
		return 'no';
	}
	
	function createLecture($chapter,$teacher,$start_datetime,$end_datetime,$userID,$content,$homework,$extra,$batchclass)
	{
		$conn=getConnection();
		$query = "SELECT * FROM lecture WHERE start_datetime = '".$start_datetime."' AND end_datetime = '".$end_datetime."'  AND batchclassID = '".$batchclass."' AND `activeflag` <> 0";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			$query = "INSERT INTO lecture(`ID`, `moduleID`, `content`, `teacherID`, `start_datetime`, `end_datetime`, `homework`, `extra`, `batchclassID`, `lastupdated`, `createdby`, `activeflag`, `status`) VALUES(NULL,'".$chapter."' ,'".$content."' ,'".$teacher."','".$start_datetime."','".$end_datetime."','".$homework."' ,'".$extra."','".$batchclass."', NOW(),'".$userID."','1','1')";
			$result = mysql_query($query);
			
			if($result)  
			$message="Lecture Created Successfully :";
			else 
			$message="Lecture Creation Failed :".mysql_error();
		}
		else
		{
			$message="Lecture Creation Failed : Similar Lecture Exists";
		}

		return $message;
		}
		
		function updateLecture($chapter,$teacher,$start_datetime,$end_datetime,$userID,$content,$homework,$extra,$id,$status)
		{
			$conn=getConnection();
	        $Obj=getLecture($id);
			$Obj->setModuleID($chapter);
			$Obj->setContent($content);
			$Obj->setTeacherID($teacher);
			$Obj->setStartDatetime($start_datetime);
			$Obj->setEndDatetime($end_datetime);
			$Obj->setExtra($extra);
			$Obj->setHomework($homework);
			$Obj->setCreatedBy($userID);
			$Obj->setActiveFlag($status);
			
			$result=$Obj->update();
			
			if($result)  
	$message="Lecture Updated Successfully :";
	else 
	$message="Lecture Updation Failed : ";
	return $message;
			
			
			}
			
			function getAllStudentsByLecture($lecObj,$n)
	{
		
		$conn=getConnection();
		$stulist = array();
		
		$batchID=$lecObj->getBatchID();
		
		$query = "SELECT * FROM student WHERE batchID='".$batchID."' AND activeflag=1 ORDER BY firstname ASC,lastname ASC, rollno ASC";
		 
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStudent($member['ID'],$n);
			array_push($stulist,$temp);
		}

		if(count($stulist) != 0)
		{
			return $stulist;
		}

		return NULL;
	}
	
	function getStudentAttendanceStatus($stuID,$lectureID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM absent WHERE studentID='".$stuID."' AND lectureID='".$lectureID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			if($member['activeflag']==1)
			return 'Absent';
			elseif($member['activeflag']==0)
			return 'Present';
		}
		else
		return 'Present';
		
		}
		
		function updateStudentAttendance($stuID,$lecture,$type)
		{
		$conn=getConnection();

		
		$query = "SELECT * FROM absent WHERE studentID='".$stuID."' AND lectureID='".$lecture."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$query = "UPDATE absent SET activeflag = '".$type."' WHERE ID= ".$member['ID'];
			$result = mysql_query($query);
		
		}
		elseif($numrows == 0)
		{			
		if($type==1)
		{
		  $query = "INSERT INTO absent(`ID`, `studentID`, `lectureID`, `activeflag`) VALUES(NULL,'".$stuID."' ,'".$lecture."' ,'".$type."')";
			$result = mysql_query($query);
			}
			}
			else
			{
				//Error
				}
			}
			
			function getCalendarLecture($obj)
	{
		
		$conn=getConnection();
		
		$list_class=getAllActiveBatchClassByBatch($obj);
		$list = array();
		//Lectures
		
		$complete='calendar_green';
		$cancelled='calendar_red';
		$pending='calendar_blue';
		for($i=0;$i<count($list_class);$i++)
		{
		$conn=getConnection();
		$query = "SELECT * FROM lecture WHERE activeflag=1 AND batchclassID='".$list_class[$i]->getID()."' ORDER BY end_datetime DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			//$temp = getLecture($member['ID']);
			
			if($member['status']==1)
			$colour=$complete;
			else
			$colour=$cancelled;
			
			$temp = array('title' => getBatchClass($member['batchclassID'])->getName().' : '.getUser($member['teacherID'])->getName(),'start' =>$member['start_datetime'],'end' => $member['end_datetime'],'className' => $colour,'allDay' => false,'url' => 'viewLectureDetails.php?id='.$member['ID']);
			
			array_push($list,$temp);
		}
			}
	
		//Lecture Templates
		
		
		for($i=0;$i<count($list_class);$i++)
		{
		$conn=getConnection();
		$query = "SELECT * FROM template_lecture WHERE activeflag=1 AND status!=1 AND  batchclassID='".$list_class[$i]->getID()."' ORDER BY start_date DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			
		    $start=$member['start_date'].' '.$member['start_time'];
			$end=$member['start_date'].' '.$member['end_time'];
			
			if($member['status']==1)
			{
				$colour=$complete;
				$temp = array('title' => getBatchClass($member['batchclassID'])->getName().' : '.getUser($member['teacherID'])->getName(),'start' =>$start,'end' => $end,'className' => $colour,'allDay' => false);
			}
			elseif($member['status']==-1)
			{
				$colour=$pending;
				$temp = array('title' => getBatchClass($member['batchclassID'])->getName().' : '.getUser($member['teacherID'])->getName(),'start' =>$start,'end' => $end,'className' => $colour,'allDay' => false,'url' => 'addLectureFromTemplate.php?id='.$member['ID']);
			}
			else
			{
				$colour=$cancelled;
			$temp = array('title' => getBatchClass($member['batchclassID'])->getName().' : '.getUser($member['teacherID'])->getName(),'start' =>$start,'end' => $end,'className' => $colour,'allDay' => false);
			}
			
			array_push($list,$temp);
			}
			//$temp = getLectureTemplate($member['ID']);
			
			//$temp = array('title' => getUser($member['teacherID'])->getName(),'start' =>$member['start_datetime'],'end' => $member['end_datetime'],'className' => 'calendar_blue','allDay' => false);
			
		
			}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	/*
	function getLecturesByTemplateByBatchClass($id)
	{
		
		
		$list = array();
		
		$conn=getConnection();
		$query = "SELECT * FROM lecture_template WHERE activeflag=1 AND batchclassID='".$id."' ORDER BY end_date DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			
			$final_date=$member['start_date'];
			$day=getDayForCalendar($member['day']);
		while(1)
		{
			$final_date= date("Y-m-d", strtotime("next ".$day, strtotime($final_date)));
			if($final_date>$member['end_date'])
			break;
			
			$duration=strtotime($member['end_time'])-strtotime($member['start_time']);
			$duration/=60;
			
			$start_time= date("g:i a", strtotime($member['start_time']));
			$start= date("d-m-Y", strtotime($final_date));
			
			$temp = array($start,$member['teacherID'],$start_time,$duration);
			
			array_push($list,$temp);
			}
			
			//$temp = getLectureTemplate($member['ID']);
			
			//$temp = array('title' => getUser($member['teacherID'])->getName(),'start' =>$member['start_datetime'],'end' => $member['end_datetime'],'className' => 'calendar_blue','allDay' => false);
			
		}
			

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	*/
	
			/* <-------------------------------------Lecture Template Functions---------------------------------> */
		
			function getLectureTemplate($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM lecture_template WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Lecture_Template($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getDayForCalendar($no)
	{
		    if($no==1)
			$displayday='monday';
			elseif($no==2)
			$displayday='tuesday';
			elseif($no==3)
			$displayday='wednesday';
			elseif($no==4)
			$displayday='thursday';
			elseif($no==5)
			$displayday='friday';
			elseif($no==6)
			$displayday='saturday';
			elseif($no==0)
			$displayday='sunday';
			else
			$displayday='None';
			return $displayday;
		}
	function getAllActiveLectureTemplatesByBatchClass($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM lecture_template WHERE activeflag=1 AND batchclassID='".$obj->getID()."' ORDER BY end_date DESC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getLectureTemplate($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function createLectureTemplate($teacher,$startdate,$enddate,$userID,$start_time,$end_time,$extra,$day,$batchclass)
	{
		$conn=getConnection();
		$query = "SELECT * FROM lecture_template WHERE (start_time >= '".$start_time."' AND start_time <= '".$end_time."') OR (end_time >= '".$start_time."' AND end_time <= '".$end_time."') AND batchclassID = '".$batchclass."' AND day = '".$day."' AND `activeflag` <> 0";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			$query = "INSERT INTO lecture_template(`ID`,`teacherID`, `start_date`, `end_date`, `extra`, `batchclassID`,`day`,`start_time`,`end_time`, `lastupdated`, `createdby`, `activeflag`, `status`) VALUES(NULL,'".$teacher."','".$startdate."','".$enddate."','".$extra."' ,'".$batchclass."','".$day."' ,'".$start_time."','".$end_time."', NOW(),'".$userID."','1','1')";
			$result = mysql_query($query);
			
			if($result)
			{
			addLecturesByTemplate(mysql_insert_id(),$userID);	
			$message="Lecture Template Created Successfully :";
			}
			else 
			$message="Lecture Template Creation Failed :".mysql_error();
		}
		else
		{
			$message="Lecture Template Creation Failed : Similar Lecture Exists";
		}

		return $message;
		}
		
		function addLecturesByTemplate($id,$userID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM lecture_template WHERE activeflag=1 AND ID='".$id."'";
		
		$result = mysql_query($query);
		
		$member = mysql_fetch_array($result);
		$final_date=$member['start_date'];
		$day=getDayForCalendar($member['day']);
		
		while(1)
		{
			$final_date= date("Y-m-d", strtotime("next ".$day, strtotime($final_date)));
			if($final_date>$member['end_date'])
			break;
			
			createTemplateLecture($final_date,$member['teacherID'],$member['start_time'],$member['end_time'],$member['extra'],$member['batchclassID'],$id,$userID);
			
			
			}
			}
		
		/* <-------------------------------------Lecture Template Functions---------------------------------> */
		
			function getTemplateLecture($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM template_lecture WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Template_Lecture($member['ID']);
			return $tempObj;
		}
		return NULL;
	}	
	
	function createTemplateLecture($startdate,$teacher,$start_time,$end_time,$extra,$batchclass,$templateID,$userID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM template_lecture WHERE start_time = '".$start_time."' AND end_time = '".$end_time."' AND templateID = '".$templateID."' AND batchclassID = '".$batchclass."' AND start_date = '".$startdate."' AND `activeflag` <> 0";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			$query = "INSERT INTO template_lecture(`ID`,`templateID`,`teacherID`, `start_date`,`extra`, `batchclassID`,`start_time`,`end_time`, `lastupdated`, `createdby`, `activeflag`, `status`) VALUES(NULL,'".$templateID."','".$teacher."','".$startdate."','".$extra."' ,'".$batchclass."','".$start_time."','".$end_time."', NOW(),'".$userID."','1','-1')";
			$result = mysql_query($query);
			
			
		}
		
		}
		
			
	function getPendingLecturesByTemplateByBatchClass($id)
	{
		
		
		$list = array();
		
		$conn=getConnection();
		$query = "SELECT * FROM template_lecture WHERE status=-1 AND activeflag=1 AND batchclassID='".$id."' ORDER BY start_date DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			
			$temp = getTemplateLecture($member['ID']);
			array_push($list,$temp);
			
			}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllLecturesByTemplateByBatchClass($id)
	{
		
		
		$list = array();
		
		$conn=getConnection();
		$query = "SELECT * FROM template_lecture WHERE activeflag=1 AND batchclassID='".$id."' ORDER BY start_date DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			
			$temp = getTemplateLecture($member['ID']);
			array_push($list,$temp);
			
			}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getLecturesByTemplateByBatchClassForCalendar($id)
	{
		
		
		$list = array();
		
		$conn=getConnection();
		$query = "SELECT * FROM template_lecture WHERE activeflag=1 AND status!=1 batchclassID='".$id."' ORDER BY start_date DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			
			$temp = getTemplateLecture($member['ID']);
			array_push($list,$temp);
			
			}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	?>