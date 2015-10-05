<?php 



function getConnection()  //standard function so that other methods call this to make a new connection
	
		{
			
			
			if(isset($_SESSION['api']))
			$api=1;
			else
			$api=0;
	
		if($_SESSION['usertype']==1&&$api==0)
		{
			$database=getCurrentDatabase();
			//$database='myclass_pgt';
			}
			
			if($_SESSION['usertype']==0&&$api==0)
		{
			$database=$_SESSION['db'];
			}
		
		if($_SESSION['usertype']==3&&$api==1)
		{
			
			$con=getMainConnection();
			$id=$_SESSION['temp_class_ID'];
			
			
			$query = "SELECT * FROM info WHERE ID = '".$id."'";
	        $result = mysql_query($query);
	        $numrows = mysql_affected_rows();
	       if($numrows == 1)
		   {
			
			$member = mysql_fetch_array($result);
	        
			
			
			if($member['activeflag']!=0)
	        return getTemporaryConnection($member['databasename']);
			
		    }
		    return NULL;
			
		     }
		
		$conn = @mysql_connect (HOST , USER , PASSWORD);
		mysql_select_db ($database, $conn);
		return $conn;
	}
	
	//getCurrentDatabase()
	function getMainConnection()  //standard function so that other methods call this to make a new connection
	{
		$conn = @mysql_connect (HOST , USER , PASSWORD);
		mysql_select_db (MAIN_DATABASE , $conn);
		return $conn;
	}

function getStudentConnection($obj)  //standard function so that other methods call this to make a new connection
	
		{
		$_SESSION['db']='';
		//$currentdb=$obj->getDatabaseName();
		$_SESSION['db']=$obj->getDatabaseName();
		
	}
	
	function getTemporaryConnection($database)  //standard function so that other methods call this to make a new connection
	
		{
			
	$conn = @mysql_connect (HOST , USER , PASSWORD);
		mysql_select_db ($database, $conn);
		return $conn;
	}
	
	function getNewStudentConnection($id)  //standard function so that other methods call this to make a new connection
	
		{
				
		$conn=getMainConnection();
	    $query = "SELECT * FROM info WHERE ID = '".$id."'";
	    $result = mysql_query($query);
		$member = mysql_fetch_array($result);
		$dbname=$member['databasename'];
		
		$conn1 = @mysql_connect (HOST , USER , PASSWORD);
		mysql_select_db ($dbname, $conn1);
		return $conn1;
	
	    }
?>