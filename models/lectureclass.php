<?php

include_once 'lecturefunctions.php';

class Lecture
{
	    var $ID;
		var $moduleID;
		var $content;
		var $teacherID;
		var $start_datetime;
		var $end_datetime;
		var $homework;
		var $extra;
		var $batchclassID;
		var $activeflag;
		var $status;
		var $createdby;
		var $lastupdated;
		
		
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}

        function getModuleID()
		{
			return $this->moduleID;
		}
		
		function getContent()
		{
			return $this->content;
		}
		
		function getTeacherID()
		{
			return $this->teacherID;
		}
		
		function getStartDatetime()
		{
			return $this->start_datetime;
		}
		
		function getLectureDate()
		{
			return date("j-m-y", strtotime($this->start_datetime));
		}
		
		function getLectureStartTime()
		{
			return date("g:i a", strtotime($this->start_datetime));
		}
		
		function getLectureEndTime()
		{
			return date("g:i a", strtotime($this->end_datetime));
		}
		
		function getLectureDuration()
		{
			$duration=strtotime($this->end_datetime)-strtotime($this->start_datetime);
			$duration/=60;
			return $duration;
		}
		
		function getTeacherObj()
		{
			return getUser($this->teacherID);
			
		}
		
		function getEndDatetime()
		{
			return $this->end_datetime;
		}
		
		function getHomework()
		{
			return $this->homework;
		}
		
		function getExtra()
		{
			return $this->extra;
		}
		
		function getBatchClassID()
		{
			return $this->batchclassID;
		}
		
		function getBatchID()
		{
			return getBatchClass($this->batchclassID)->getBatchID();
		}
		
		function getFullDisplay()
		{
			return getBatchClass($this->batchclassID)->getBestDisplay().' => Date : '.$this->getLectureDate().' &nbsp;>> Prof. '.$this->getTeacherObj()->getName();
		}
		
			function getFullDisplayMin()
		{
			return getBatchClass($this->batchclassID)->getBestDisplay();
		}
		
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
		function getStatus()
		{
			return $this->status;
		}
		
		 function setModuleID($a)
		{
			 $this->moduleID=$a;
		}
		
		function setContent($a)
		{
			 $this->content=$a;
		}
		
		function setTeacherID($a)
		{
			 $this->teacherID=$a;
		}
		
		function setStartDatetime($a)
		{
			$this->start_datetime=$a;
		}
		
		
		
		function setEndDatetime($a)
		{
			$this->end_datetime=$a;
		}
		
		function setHomework($a)
		{
			 $this->homework=$a;
		}
		
		function setExtra($a)
		{
			 $this->extra=$a;
		}
		
		function setBatchClassID($a)
		{
			 $this->batchclassID=$a;
		}
		
		function setActiveFlag($a)
		{
			 $this->activeflag=$a;
		}
		
		function setCreatedBy($a)
		{
			 $this->createdby=$a;
		}
		
		
		function setLastUpdated($a)
		{
			 $this->lastupdated=$a;
		}
		
			function setStatus($a)
		{
			$this->status=$a;
		}
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE lecture SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function updateStatus($ac)
		{
			$conn = getConnection();
			$query = "UPDATE lecture SET status = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM lecture WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setModuleID(trim($member['moduleID']));
$this->setContent(trim($member['content']));
$this->setTeacherID(trim($member['teacherID']));
$this->setStartDatetime(trim($member['start_datetime']));
$this->setEndDatetime(trim($member['end_datetime']));
$this->setHomework(trim($member['homework']));
$this->setExtra(trim($member['extra']));
$this->setBatchClassID(trim($member['batchclassID']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setStatus(trim($member['status']));
		}
	}

function update()
		{
			$conn = getConnection();
			$query = "UPDATE lecture SET activeflag = '".$this->activeflag."', moduleID = '".$this->moduleID."', content = '".$this->content."', teacherID = '".$this->teacherID."', start_datetime = '".$this->start_datetime."', end_datetime = '".$this->end_datetime."', homework = '".$this->homework."', extra = '".$this->extra."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}

}

class Lecture_Template
{
	    var $ID;
		var $teacherID;
		var $start_date;
		var $end_date;
		var $extra;
		var $batchclassID;
		var $day;
		var $start_time;
		var $end_time;
		var $activeflag;
		var $status;
		var $createdby;
		var $lastupdated;
		
		
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}

		function getTeacherID()
		{
			return $this->teacherID;
		}
		
		function getStartDate()
		{
			return $this->start_date;
		}
		
		function getEndDate()
		{
			return $this->end_date;
		}
		
		function getStartDateFormated()
		{
			return date("j-m-y", strtotime($this->start_date));
		}
		
		function getEndDateFormated()
		{
			return date("j-m-y", strtotime($this->end_date));
		}
		
		function getExtra()
		{
			return $this->extra;
		}
		
		function getBatchClassID()
		{
			return $this->batchclassID;
		}
		
		function getBatchID()
		{
			return getBatchClass($this->batchclassID)->getBatchID();
		}
		
		function getFullDisplay()
		{
			return getBatchClass($this->batchclassID)->getBestDisplay().' => Date : '.$this->getLectureDate().' &nbsp;>> Prof. '.$this->getTeacherObj()->getName();
		}
		
		
		function getDay()
		{
			return $this->day;
		}
		
		function getDisplayDay()
		{
			
			if($this->day==1)
			$displayday='Monday';
			elseif($this->day==2)
			$displayday='Tuesday';
			elseif($this->day==3)
			$displayday='Wednesday';
			elseif($this->day==4)
			$displayday='Thursday';
			elseif($this->day==5)
			$displayday='Friday';
			elseif($this->day==6)
			$displayday='Saturday';
			elseif($this->day==0)
			$displayday='Sunday';
			else
			$displayday='None';
			return $displayday;
		}
		
		function getStartTime()
		{
			return $this->start_time;
		}
		
		
		
		function getStartTimeFormated()
		{
			return date("g:i a", strtotime($this->start_time));
		}
		
		function getEndTime()
		{
			return $this->end_time;
		}
		
		function getEndTimeFormated()
		{
			return date("g:i a", strtotime($this->end_time));
		}
		
		function getTeacherObj()
		{
			return getUser($this->teacherID);
			
		}
		
		function getLectureDuration()
		{
			$duration=strtotime($this->end_time)-strtotime($this->start_time);
			$duration/=60;
			return $duration;
		}
			
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
		function getStatus()
		{
			return $this->status;
		}
		
		 		function setTeacherID($a)
		{
			  $this->teacherID = $a;
		}
		
		function setStartDate($a)
		{
			  $this->start_date = $a;
		}
		
		function setEndDate($a)
		{
			  $this->end_date = $a;
		}
		
		function setExtra($a)
		{
			  $this->extra = $a;
		}
		
		function setBatchClassID($a)
		{
			  $this->batchclassID = $a;
		}
		
		function setDay($a)
		{
			  $this->day = $a;
		}
		
		function setStartTime($a)
		{
			  $this->start_time = $a;
		}
		
		function setEndTime($a)
		{
			  $this->end_time = $a;
		}
		
					
		function setActiveFlag($a)
		{
			  $this->activeflag = $a;
		}
		
		function setCreatedBy($a)
		{
			  $this->createdby = $a;
		}
		
		
		function setLastUpdated($a)
		{
			  $this->lastupdated = $a;
		}
		
		function setStatus($a)
		{
			  $this->status = $a;
		}
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE lecture_template SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function updateStatus($ac)
		{
			$conn = getConnection();
			$query = "UPDATE lecture_template SET status = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM lecture_template WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);


$this->setTeacherID(trim($member['teacherID']));
$this->setStartDate(trim($member['start_date']));
$this->setEndDate(trim($member['end_date']));
$this->setExtra(trim($member['extra']));
$this->setBatchClassID(trim($member['batchclassID']));
$this->setDay(trim($member['day']));
$this->setStartTime(trim($member['start_time']));
$this->setEndTime(trim($member['end_time']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setStatus(trim($member['status']));
		}
	}

function update()
		{
			$conn = getConnection();
			$query = "UPDATE lecture_template SET activeflag = '".$this->activeflag."', teacherID = '".$this->teacherID."', start_date = '".$this->start_date."', end_date = '".$this->end_date."', start_time = '".$this->start_time."', end_time = '".$this->end_time."', day = '".$this->day."', extra = '".$this->extra."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}

}

class Template_Lecture
{
	    var $ID;
		var $teacherID;
		var $start_date;
		
		var $extra;
		var $batchclassID;
		var $templateID;
		var $start_time;
		var $end_time;
		var $activeflag;
		var $status;
		var $createdby;
		var $lastupdated;
		
		
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}

		function getTeacherID()
		{
			return $this->teacherID;
		}
		
		function getStartDate()
		{
			return $this->start_date;
		}
		
		function getStartDate1()
		{
			return date("d-m-Y", strtotime($this->start_date));
		}
		
		function getStartDateFormated()
		{
			return date("d-m-y", strtotime($this->start_date));
		}
		
		
		
		function getExtra()
		{
			return $this->extra;
		}
		
		function getBatchClassID()
		{
			return $this->batchclassID;
		}
		
		function getTemplateID()
		{
			return $this->templateID;
		}
		
		function getBatchID()
		{
			return getBatchClass($this->batchclassID)->getBatchID();
		}
		
		function getFullDisplay()
		{
			return getBatchClass($this->batchclassID)->getBestDisplay();
		}
		
		
		
		
		
		
		function getStartTime()
		{
			return $this->start_time;
		}
		
		
		
		function getStartTimeFormated()
		{
			return date("g:i a", strtotime($this->start_time));
		}
		
		function getStartTimeFormated1()
		{
			return date("H:i", strtotime($this->start_time));
		}
		
		function getEndTime()
		{
			return $this->end_time;
		}
		
		function getEndTimeFormated()
		{
			return date("g:i a", strtotime($this->end_time));
		}
		
		function getEndTimeFormated1()
		{
			return date("H:i", strtotime($this->end_time));
		}
		
		function getTeacherObj()
		{
			return getUser($this->teacherID);
			
		}
		
		function getLectureDuration()
		{
			$duration=strtotime($this->end_time)-strtotime($this->start_time);
			$duration/=60;
			return $duration;
		}
			
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
		function getStatus()
		{
			return $this->status;
		}
		
		function getEditedStatus()
		{
			if($this->status==1)
			$m='Completed';
			elseif($this->status==-1)
			$m='Pending';
			else
			$m='Cancelled';
			
			return $m;
		}
		
		 		function setTeacherID($a)
		{
			  $this->teacherID = $a;
		}
		
		function setStartDate($a)
		{
			  $this->start_date = $a;
		}
		
		
		
		function setExtra($a)
		{
			  $this->extra = $a;
		}
		
		function setBatchClassID($a)
		{
			  $this->batchclassID = $a;
		}
		
		function setTemplateID($a)
		{
			  $this->templateID = $a;
		}
		
		function setStartTime($a)
		{
			  $this->start_time = $a;
		}
		
		function setEndTime($a)
		{
			  $this->end_time = $a;
		}
		
					
		function setActiveFlag($a)
		{
			  $this->activeflag = $a;
		}
		
		function setCreatedBy($a)
		{
			  $this->createdby = $a;
		}
		
		
		function setLastUpdated($a)
		{
			  $this->lastupdated = $a;
		}
		
		function setStatus($a)
		{
			  $this->status = $a;
		}
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE template_lecture SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function updateStatus($ac)
		{
			$conn = getConnection();
			$query = "UPDATE template_lecture SET status = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM template_lecture WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);


$this->setTeacherID(trim($member['teacherID']));
$this->setStartDate(trim($member['start_date']));

$this->setExtra(trim($member['extra']));
$this->setBatchClassID(trim($member['batchclassID']));
$this->setTemplateID(trim($member['templateID']));
$this->setStartTime(trim($member['start_time']));
$this->setEndTime(trim($member['end_time']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setStatus(trim($member['status']));
		}
	}

function update()
		{
			$conn = getConnection();
			$query = "UPDATE template_lecture SET activeflag = '".$this->activeflag."', teacherID = '".$this->teacherID."', start_date = '".$this->start_date."', start_time = '".$this->start_time."', end_time = '".$this->end_time."', extra = '".$this->extra."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			$result = mysql_query($query);
			$numrows=mysql_affected_rows();
			
			if($numrows==1)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			}

}
?>