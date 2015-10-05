<?php 

/* <-------------------------------------Task List Functions---------------------------------> */

function getTaskList($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM task_list WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Task_List($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllTaskLists()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM task_list WHERE activeflag<>0 ORDER BY ID ASC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getTaskList($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}	
	
	function getAllActiveTaskList()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM task_list WHERE activeflag=1 ORDER BY ID ASC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getTaskList($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}	
	
	function createTaskList($name)
	{
		$conn = getConnection();
		
$query = "INSERT INTO `task_list` (`ID`, `name`, `activeflag`, `associate` ,`type`, `lastupdated`) VALUES (NULL, '".$name."', '1', '', 'CUSTOM', CURRENT_TIMESTAMP)";
			$result = mysql_query($query);
			
			if($result)  
			$message="Task List Created Successfully :".$name;
			else 
			$message="Task List Creation Failed : ".mysql_error();
				
		return $message;
	}
		
		
		function updateTaskList($ID,$name,$activeflag)
	{
		$conn=getConnection();
	    $Obj=getTaskList($ID);
		$Obj->setName($name);
	    $Obj->setActiveFlag($activeflag);
	    
	    $result=$Obj->update();
		
		if($result)  
	$message="Task Updated Successfully ";
	else 
	$message="Task Updation Failed : ";
	return $message;
		
		}
		
/* <-------------------------------------Task Structure Functions---------------------------------> */
	

function getTaskStructure($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM task_structure WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Task_Structure($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllTaskStructure()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM task_structure WHERE activeflag<>0 ORDER BY ID ASC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getTaskStructure($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}	
	
	function getAllActiveTaskStructure()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM task_structure WHERE activeflag=1 ORDER BY ID ASC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getTaskStructure($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}	
	
	function getTaskListOfStructure($id)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM structure_task WHERE activeflag=1 AND structureID=".$id." ORDER BY `order` ASC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getStructureTask($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}	
		
function createTaskStructure($name,$tasks,$associate)
	{
		$conn = getConnection();
		
$query = "INSERT INTO `task_structure` (`ID`, `name`,`associate`, `activeflag`,`lastupdated`) VALUES (NULL, '".$name."','".$associate."',1,CURRENT_TIMESTAMP)";
			$result = mysql_query($query);
			
			if($result)
			{
				$id=mysql_insert_id();
				for($i=0;$i<count($tasks);$i++)
				{
$query = "INSERT INTO `structure_task` (`ID`,`order`,`structureID`,`listID`,`activeflag`,`lastupdated`) VALUES (NULL, '".($i+1)."', '".$id."', '".$tasks[$i]."', 1 ,CURRENT_TIMESTAMP)";
			$result = mysql_query($query);
					}
				
				
				}
			
			
			if($result)  
			$message="Task Structure Created Successfully :".$name;
			else 
			$message="Task Structure Creation Failed : ".mysql_error();
				
		return $message;
	}
		
		function updateTaskStructure($ID,$name,$tasks,$activeflag)
	{
		$conn=getConnection();
	    $Obj=getTaskStructure($ID);
		$Obj->setName($name);
	    $Obj->setActiveFlag($activeflag);
	    
	    $result=$Obj->update();
		
	if($result)  
	$message="Task Structure Updated Successfully ";
	else 
	$message="Task Structure Updation Failed : ";
	
	if($result)
			{
				
				for($i=0;$i<count($tasks);$i++)
				{
$query = "UPDATE structure_task SET `order` = '".($i+1)."' WHERE ID= ".$tasks[$i];
$result = mysql_query($query);
					}
				
				
				}
	
	return $message;
		
		}
	
		
/* <-------------------------------------Structure Task Functions---------------------------------> */

	function getStructureTask($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM structure_task WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Structure_Task($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
		
/* <-------------------------------------Task Assigned Functions---------------------------------> */

function getTaskAssigned($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM task_assigned WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Task_Assigned($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function assignTaskToStaff($name,$ID,$status,$userID)
	{
		$conn = getConnection();
			
$query = "INSERT INTO `task_assigned` (`ID`, `staffID`, `name`, `structure_taskID`, `type`, `order`, `status`, `priority`, `activeflag`, `lastupdated`, `datecreated`,`createdby`) VALUES (NULL, '".$ID."', '".$name."', '0', '0', '0', '0', '".$status."', '1', CURRENT_TIMESTAMP, NOW(), '".$userID."')";
			$result = mysql_query($query);
		
		if($result)  
			$message="Task Assigned Successfully :".$name;
			else 
			$message="Task Assign  Failed : ".mysql_error();
				
		return $message;
		}
		
			function assignTaskStructureToStaff($structureID,$staffID,$recurring,$priority,$name,$userID)
	{
		$conn = getConnection();
			
			//First check whether task structure is already assigned if recurring is on
			
			if($recurring==1)
			{
				
				$temp=getTaskStructure($structureID)->getAssociate();
				if($temp!='CUSTOM')
				{
				
				list($flag,$id)=isRecurringTaskStructureAlreadyAssigned($structureID,$staffID);
				
				 //If already assigned, do nothing
				 if($flag)
				 return 'Task Already Assigned';
				 else
				 {
					 //Enable recurring
					 enableStructureRecurringMode($structureID,$id,$priority,$staffID);
					 return 'Task Structure Assigned';
					 }
				}
				else
				return 'Task Structure cannot be assigned as it is not recurring';
				}
			else
			{
				$value= assignTasksOfStructureToStaff($structureID,$staffID,$priority,$name,$userID);
				return $value;
				}
		
		}
		
		function assignTasksOfStructureToStaff($structureID,$staffID,$priority,$name,$userID)
	{
		
		$conn = getConnection();
		
		$list=getTaskListOfStructure($structureID);
		
		for($i=0;$i<count($list);$i++)
		{
			
			$structureTaskID=$list[$i]->getID();
			$order=$list[$i]->getOrder();
		
		$query = "INSERT INTO `task_assigned` (`ID`, `staffID`, `name`, `structure_taskID`, `type`, `order`, `status`, `priority`, `activeflag`, `lastupdated`, `datecreated`,`createdby`) VALUES (NULL, '".$staffID."', '".$name."', '".$structureTaskID."', '1', '".$order."', '0', '".$priority."', '1', CURRENT_TIMESTAMP, NOW(), '".$userID."')";
			$result = mysql_query($query);
		
		
		}
		
		if($result)  
			$message="Task Assigned Successfully :".getUser($staffID)->getName();
			else 
			$message="Task Assign  Failed : ".getUser($staffID)->getName().' : '.mysql_error();
				
		return $message;
		}
		
		function getAllTaskAssignedToUser($Obj)
		{
		
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM task_assigned WHERE activeflag<>0 AND staffID=".$Obj->getID()." ORDER BY status ASC,priority DESC,type ASC,datecreated DESC,activeflag DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getTaskAssigned($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
			}
			
					function getAllTaskAssignedToMe($Obj)
		{
		
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM task_assigned WHERE activeflag=1 AND staffID=".$Obj->getID()." ORDER BY status ASC,priority DESC,type ASC,datecreated DESC,activeflag DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getTaskAssigned($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
			}
			
			function updateTaskAssigned($ID,$activeflag,$completed,$priority,$task,$userID)
			{
				
				
		$conn=getConnection();
	    $Obj=getTaskAssigned($ID);
		
		if($Obj->getType()==0)
		$Obj->setName($task);
		
	    $Obj->setActiveFlag($activeflag);
		$Obj->setStatus($completed);
		$Obj->setPriority($priority);
		$Obj->setCreatedBy($userID);
	    
	    $result=$Obj->update();
		
	if($result)  
	$message="Task Assigned Updated Successfully ";
	else 
	$message="Task Assigned Updation Failed ";
				return $message;
				}
				
				function markTaskCompleted($a,$user)
		{
			$conn = getConnection();
			$query = "UPDATE task_assigned SET status = 1,createdby = '".$user."' WHERE ID= ".$a;
			$result = mysql_query($query);
		}
/* <-------------------------------------Recurring Structure Functions---------------------------------> */

function isRecurringTaskStructureAlreadyAssigned($structureID,$staffID)
{
	$conn = getConnection();
	$query = "SELECT * FROM recurring_structure WHERE structureID = '".$structureID."' AND staffID = '".$staffID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			
			if($member['activeflag']==1)
			return array(true,$member['ID']);
			else
			return array(false,$member['ID']);
		}
		else
		{
			return array(false,0);
			}
	}

function enableStructureRecurringMode($structureID,$id,$priority,$staffID)
{
	$conn = getConnection();
	if($id!=0)
	{
		$query = "UPDATE recurring_structure SET activeflag = 1 WHERE ID= ".$id;
		$result = mysql_query($query);
		return true;
		}
	else
	{
		
		$temp=getTaskStructure($structureID)->getAssociate();
		
		$query = "INSERT INTO `recurring_structure` (`ID`, `staffID`, `structureID`, `associate`, `priority`, `activeflag`) VALUES (NULL, '".$staffID."', '".$structureID."', '".$temp."', '".$priority."', '1')";
		$result = mysql_query($query);
		
		return true;
		}
	}
	
	function assignRecurringStructure($type,$name,$BatchObj,$userID)
	{
		
		
		$list=getAllActiveUsersByBranch(getCurrentInstituteID1(),$BatchObj->getBranchObj()->getID());
		$conn = getConnection();
		for($i=0;$i<count($list);$i++)
		{
		
	    $query = "SELECT * FROM recurring_structure WHERE associate = '".$type."' AND staffID = '".$list[$i]->getID()."' AND activeflag = 1";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		if($numrows == 0)
		{
			
		}
		else
		{
			while($member = mysql_fetch_array($result))
		{
			
			assignTasksOfStructureToStaff($member['structureID'],$member['staffID'],$member['priority'],$name,$userID);
		}
			}
		}
		}
	?>