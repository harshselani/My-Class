<?php

include_once 'quizfunctions.php';

class QuizModule
{
	var $ID;
	var $subjectID;
	var $name;
	var $activeflag;
	var $createdby;
	var $lastupdated;
	var $type;
	
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}
		
		function getSubjectID()
		{
			return $this->subjectID;
		}
		
		function getSubjectObj()
		{
			return getSubject($this->subjectID);
		}
		
		function getName()
		{
			return $this->name;
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
		
		function getType()
		{
			return $this->type;
		}
		
		function setSubjectID($a)
		{
			  $this->subjectID =$a;
		}
		
		function setName($a)
		{
			  $this->name =$a;
		}
		
		function setActiveFlag($a)
		{
			  $this->activeflag =$a;
		}
		
		function setCreatedBy($a)
		{
			  $this->createdby =$a;
		}
		
		function setLastUpdated($a)
		{
			  $this->lastupdated =$a;
		}
		
		function setType($a)
		{
			  $this->type =$a;
		}
	
	function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE modules SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
	
	function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM modules WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setSubjectID(trim($member['subjectID']));
$this->setName(trim($member['name']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setType(trim($member['type']));

		}
				
	}
	
	function update()
		{
			$conn = getConnection();
			$query = "UPDATE modules SET activeflag = '".$this->activeflag."', name = '".$this->name."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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

	
class Question
{
	var $ID;
	var $testID;
	var $quizmodule;
	var $name;
	var $rightanswer;
	var $type;
	var $activeflag;
	var $createdby;
	var $lastupdated;
	var $answerreason;
	var $level;
	
	function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}
		
		function getTestID()
		{
			return $this->testID;
		}
		
		function getTestObj()
		{
			return getTest($this->testID);
		}
		
		function getName()
		{
			return stripslashes($this->name);
		}
		
		function getRightAnswer()
		{
			return $this->rightanswer;
		}
		
		function getType()
		{
			return $this->type;
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
		
		function getQuizModule()
		{
			return $this->quizmodule;
		}
		
		function getAnswerReason()
		{
			return stripslashes($this->answerreason);
		}
		
		function getLevel()
		{
			return $this->level;
		}
		
		function setTestID($a)
		{
			  $this->testID =$a;
		}
		
		function setName($a)
		{
			  $this->name =$a;
		}
		
		function setRightAnswer($a)
		{
			  $this->rightanswer =$a;
		}
		
		function setType($a)
		{
			  $this->type =$a;
		}
		
		function setActiveFlag($a)
		{
			  $this->activeflag =$a;
		}
		
		function setCreatedBy($a)
		{
			  $this->createdby =$a;
		}
		
		function setLastUpdated($a)
		{
			  $this->lastupdated =$a;
		}
		
		function setQuizModule($a)
		{
			$this->quizmodule = $a;
		}
		
		function setAnswerReason($a)
		{
			$this->answerreason = $a;
		}
		
		function setLevel($a)
		{
			$this->level = $a;
		}
	
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE question SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
	
	function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM question WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setTestID(trim($member['testID']));
$this->setName(trim($member['name']));
$this->setRightAnswer(trim($member['answerID']));
$this->setType(trim($member['type']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setQuizModule(trim($member['quizmodule']));
$this->setAnswerReason(trim($member['answerreason']));
$this->setLevel(trim($member['level']));

		}
		}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE question SET activeflag = '".$this->activeflag."', name = '".$this->name."',answerID = '".$this->rightanswer."',quizmodule = '".$this->quizmodule."',answerreason = '".$this->answerreason."',level = '".$this->level."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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

class Answer
{
	var $ID;
	var $questionID;
	var $name;
	var $activeflag;
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
		
		function getQuestionID()
		{
			return $this->questionID;
		}
		
		function getQuestionObj()
		{
			return getQuizQuestion($this->questionID);
		}
		
		function getName()
		{
			return stripslashes($this->name);
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
		
		function setQuestionID($a)
		{
			  $this->testID =$a;
		}
		
		function setName($a)
		{
			  $this->name =$a;
		}
		
		function setActiveFlag($a)
		{
			  $this->activeflag =$a;
		}
		
		function setCreatedBy($a)
		{
			  $this->createdby =$a;
		}
		
		function setLastUpdated($a)
		{
			  $this->lastupdated =$a;
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM answer WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setQuestionID(trim($member['questionID']));
$this->setName(trim($member['name']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));

		}
		}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE answer SET activeflag = '".$this->activeflag."', name = '".$this->name."' ,createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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