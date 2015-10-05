<?php

include_once 'taskfunctions.php';

class Task_List
{
	    var $ID;
		var $name;
		var $type;
		var $activeflag;
		var $associate;
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
		
		function setName($a)
		{
			$this->name = $a;
		}
		
		
		function setType($a)
		{
			$this->type= $a;
		}
		
		function setAssociate($a)
		{
			$this->associate= $a;
		}
		
	
		function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	    function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		
		function getName()
		{
			return $this->name;
		}
		
		function getBestDisplay()
		{
			return $this->type.' : '.$this->name;
		}
		
		function getAssociate()
		{
			return $this->associate;
		}
		
		function getType()
		{
			return $this->type;
		}
		
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
				
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE task_list SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM task_list WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setAssociate(trim($member['associate']));
$this->setType(trim($member['type']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setLastUpdated(trim($member['lastupdated']));

		}
		}
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE task_list SET activeflag = '".$this->activeflag."', name = '".$this->name."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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
	
	class Task_Structure
{
	    var $ID;
		var $name;
		var $associate;
		var $activeflag;
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
		
		function setName($a)
		{
			$this->name = $a;
		}
		
		
		
		function setAssociate($a)
		{
			$this->associate= $a;
		}
		
	
		function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	    function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		
		function getName()
		{
			return $this->name;
		}
		
		function getBestDisplay()
		{
			return $this->associate.' : '.$this->name;
		}
		
		
		function getAssociate()
		{
			return $this->associate;
		}
		
		
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
				
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE task_structure SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM task_structure WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setAssociate(trim($member['associate']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setLastUpdated(trim($member['lastupdated']));

		}
		}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE task_structure SET activeflag = '".$this->activeflag."', name = '".$this->name."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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
	
	class Structure_Task
{
	    var $ID;
		var $order;
		var $structureID;
		var $listID;
		var $lastupdated;
		var $activeflag;
		
		
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}
		
		function setOrder($a)
		{
			$this->order = $a;
		}
		
		
		function setStructureID($a)
		{
			$this->structureID= $a;
		}
		
		function setListID($a)
		{
			$this->listID= $a;
		}
		
	
		function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	    function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		
		function getOrder()
		{
			return $this->order;
		}
		
		function getStructureID()
		{
			return $this->structureID;
		}
		
		function getListID()
		{
			return $this->listID;
		}
		
		function getListObj()
		{
			return getTaskList($this->listID);
		}
		
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
				
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE structure_task SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM structure_task WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setOrder(trim($member['order']));
$this->setStructureID(trim($member['structureID']));
$this->setListID(trim($member['listID']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setLastUpdated(trim($member['lastupdated']));

		}
		}
			}
			
		class Task_Assigned
{
	    var $ID;
		var $staffID;
		var $name;
		var $structure_taskID;
		var $type;
		var $order;
		var $status;
		var $priority;
		var $activeflag;
		var $lastupdated;
		var $datecreated;
		var $createdby;
		
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}
		
		function setStaffID($a)
		{
			$this->staffID = $a;
		}
		
		function setName($a)
		{
			$this->name = $a;
		}
		
		function setStructure_taskID($a)
		{
			$this->structure_taskID = $a;
		}
		
		
		function setType($a)
		{
			$this->type= $a;
		}
		
		function setOrder($a)
		{
			$this->order = $a;
		}
		
		function setStatus($a)
		{
			$this->status = $a;
		}
		
		function setPriority($a)
		{
			$this->priority = $a;
		}
		
		
	    function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	    function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function setDateCreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}
		
		function setCreatedBy($a)
		{
			 $this->createdby=$a;
		}
		
		function getStaffID()
		{
			return $this->staffID;
		}
		
		function getName()
		{
			return $this->name;
		}
		
		function getBestDisplay()
		{
			$temp=$this->name;
			if($this->type==1)
			$temp.=' >> '.getTaskList(getStructureTask($this->structure_taskID)->getListID())->getName();
			
			return $temp;
		}
		
		
		function getCompletion()
		{
			if($this->status==0)
			return 'Pending';
			else
			return 'Completed';
			}
		
		function getStructure_taskID()
		{
			return $this->structure_taskID;
		}
		
		function getDateCreated()
		{
			return $this->datecreated;
		}
		
		function getType()
		{
			return $this->type;
		}
		
		function getOrder()
		{
			return $this->order;
		}
		
		function getStatus()
		{
			return $this->status;
		}
		
		function getPriority()
		{
			return $this->priority;
		}
		
		function getActiveFlag()
		{
			return $this->activeflag;
		}
		
		
		function getLastUpdated()
		{
			return $this->lastupdated;
		}
		
		function getCreatedBy()
		{
			return $this->createdby;
		}
				
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE task_assigned SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM task_assigned WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setStaffID(trim($member['staffID']));
$this->setStructure_taskID(trim($member['structure_taskID']));
$this->setType(trim($member['type']));
$this->setOrder(trim($member['order']));
$this->setStatus(trim($member['status']));
$this->setPriority(trim($member['priority']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setDateCreated(trim($member['datecreated']));
$this->setCreatedBy(trim($member['createdby']));

		}
		}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE task_assigned SET activeflag = '".$this->activeflag."', name = '".$this->name."',status = '".$this->status."',priority = '".$this->priority."',createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
			
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