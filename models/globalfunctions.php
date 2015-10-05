<?php

function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
	
function getCurrentInstituteID()
{
	//return 2;
	return $_SESSION['classID'];
	}
	
	function getCurrentInstituteID1()
{
	//return 2;
	return getValue(16);
	}

function getValue($id)
{
	$conn=getConnection();
	$query = "SELECT * FROM options WHERE ID = '".$id."'";
	$result = mysql_query($query);
	$numrows = mysql_affected_rows();
	if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
	        if($member['activeflag']!=0)
	        return $member['value'];
			else
			return NULL;
		}
		return NULL;
	}




function setValue($id,$value)
{
	$conn=getConnection();
	$query = "UPDATE options SET value = '".$value."' WHERE ID= ".$id;
	$result = mysql_query($query);
		if($result)
		return true;
		else
		return false;
	}
	
	function getActiveFlagValue($id)
{
	$conn=getConnection();
	$query = "SELECT * FROM options WHERE ID = '".$id."'";
	$result = mysql_query($query);
	$numrows = mysql_affected_rows();
	if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
	        
	        return $member['activeflag'];
			
		}
		return NULL;
	}
	
	
	function setActiveFlagValue($id,$value)
{
	$conn=getConnection();
	$query = "UPDATE options SET activeflag = '".$value."' WHERE ID= ".$id;
	$result = mysql_query($query);
		if($result)
		return true;
		else
		return false;
	}
	
function generateRandomString($length)
	{
		
		if($length>0)
		{
			$rand_id="";
			for($i=1; $i<=$length; $i++)
			{
				mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,36);
				$rand_id .= rand($num);
			}

		}

		return $rand_id;
	}

function random_gen($length)
{
  $random= "";
  srand((double)microtime()*1000000);
  $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $char_list .= "abcdefghijklmnopqrstuvwxyz";
  $char_list .= "1234567890";
  // Add the special characters to $char_list if needed

  for($i = 0; $i < $length; $i++)  
  {    
     $random .= substr($char_list,(rand()%(strlen($char_list))), 1);  
  }  
  return $random;
} 

function getSessionid()
{
	return $_SESSION['random'];
	
	}

function setSessionid()
{
	$_SESSION['random']=random_gen(50);
	
	}
	
	function getStatus($act)
	{
		$status;
		if($act==1)
		{
		$status="Enabled";
		}
		if($act==-1)
		{
		$status="Disabled";
		}
		if($act==0)
		{
		$status="Deleted";
		}
		return $status;
	}
	
	function getTypeDisplay($act)
	{
		$status;
		if($act==1)
		{
		$status="Common";
		}
		if($act==0)
		{
		$status="Exclusive";
		}
		return $status;
	}
	
function isEmailValid($email)
	{
		
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
		{
			return true;
		}
		
		return false;
	}

function getBestName($f, $m, $l)
	{
		
		/*if(getCurrentInstituteID1()==1)
		{
			return $l.' '.$f;
			}
		else
		{
		$ret = $f;
		
		if($l=='' && $m!='')
		{
			$ret .= ' '.$m;
			return $ret;
		}

		
		if($l=='' && $m=='')
		{
			return $ret;
		}
		else
		{
			$ret .= ' '.$l;
			return $ret;
		}
		}*/
		
		return $f.' '.$l;
	}
	
function uploadPicture($picture)
{
	$conn=getConnection();
	if($picture!='')
	{
	$attachmentstring = "";
		
		
			$save_path = "../includes/studentphoto/";
			$save_path1 = "includes/studentphoto/";
			$filename =  basename($picture[1]);
			$file_ext = substr($filename, strripos($filename, '.'));
			$file_basename = substr($filename, 0, strripos($filename, '.'));
			$file_name = $file_basename;
			$file_basename = md5($file_basename.random_gen(10));
			$file_basename = $file_basename.rand();
			$filename = $file_basename.$file_ext;
			$target_path = $save_path.$filename;
			$url=$save_path1.$filename;
			move_uploaded_file($picture[0],$target_path);
			
			$attachmentstring .= $url;
		
	return $attachmentstring;
	}
	else
	return '';
	}
	
	function uploadNotes($picture)
{
	$conn=getConnection();
	$attachmentstring = "";
		
		
			$save_path = "../includes/notes/";
			$save_path1 = "includes/notes/";
			$filename =  basename($picture[1]);
			$file_ext = substr($filename, strripos($filename, '.'));
			$file_basename = substr($filename, 0, strripos($filename, '.'));
			$file_name = $file_basename;
			$file_basename = md5($file_basename.random_gen(10));
			$file_basename = $file_basename.rand();
			$filename = $file_basename.$file_ext;
			$target_path = $save_path.$filename;
			$url=$save_path1.$filename;
			move_uploaded_file($picture[0],$target_path);
			
			$attachmentstring .= $url;
		
	return $attachmentstring;
	}
	

	
	function studentLogin($unme,$pswd) 
	
		{
		$conn = getMainConnection();
		//Parent Login
		$query = "SELECT * FROM student WHERE phone_father = '".$unme."' AND activeflag = 1";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		
		if($rows != 1)
		{
			//Student Login
		
		$query = "SELECT * FROM student WHERE phone_stu = '".$unme."' AND activeflag = 1";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		
		if($rows != 1)
		{
			return NULL;
		}
		else
		{
			$required_row = mysql_fetch_array($result);
			$hashed_pswd = md5($pswd);
			$cmp_ans = strcmp($required_row['studentpass'], $hashed_pswd);
			
			if($cmp_ans == 0)
			{
				$authorised_studentID = $required_row['ID'];
				
				if($authorised_studentID != NULL)
				{
					$sobj = getStudentLogin($authorised_studentID);
					return array($sobj,0);
				}

			}


		}

		}
		else
		{
			$required_row = mysql_fetch_array($result);
			
			if(true)
			{
				$authorised_studentID = $required_row['ID'];
				
				if($authorised_studentID != NULL)
				{
					$sobj = getStudentLogin($authorised_studentID);
					return array($sobj,1);
				}

			}

		}

		return NULL;
	}
	
	function newStudentLogin($username,$classID,$examYear,$number_type) 
	
		{
		$conn = getNewStudentConnection($classID);
		
		
		
		$query = "SELECT * FROM student WHERE (phone_stu LIKE '".$username."' OR phone_father LIKE '".$username."') AND examyear = '".$examYear."' AND activeflag = 1";
		
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		
		if($rows != 1)
		{
		
		
		}
		else
		{
			
			$required_row = mysql_fetch_array($result);
			
			
			$authorised_studentID = $required_row['mainID'];
				
				if($authorised_studentID != NULL)
				{
					$sobj = getStudentLogin($authorised_studentID);
					return array($sobj,0);
				}

			}
			
return NULL;
		}
		
	
	
	function staffLogin($unme,$pswd) //globalfunctions class
	
		{
		$conn = getMainConnection();
		$query = "SELECT * FROM users WHERE username = '".$unme."' AND activeflag = 1 ";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		
		if($rows != 1)
		{
			return NULL;
		}
		else
		{
			$required_row = mysql_fetch_array($result);
			//$appended_pswd = $pswd.$required_row['salt'];
			$hashed_pswd = md5($pswd);
			$cmp_ans = strcmp($required_row['hashed_password'], $hashed_pswd);
			
			if($cmp_ans == 0)
			{
				$authorised_staffID = $required_row['ID'];
				
				if($authorised_staffID != NULL)
				{
					$sobj = getUser($authorised_staffID);
					//return "true1";
					return $sobj;
				}

			}
			return NULL;

		}

		return NULL;
	}
	
	function updateCustomActiveFlag($ID,$type,$activeflag)
	{
		$table='';
		$conn=getConnection();
		if($type==0)
		$table='student';
		elseif($type==1)
		$table='batch';
		elseif($type==2)
		$table='test';
		else
		$table='';
		
		$query = "UPDATE ".$table." SET activeflag = '".$activeflag."' WHERE ID= ".$ID;
		$result = mysql_query($query);
		
		}
		
		function getAllClassNotices()
{
	$conn=getMainConnection();
	$query = "SELECT * FROM notice WHERE activeflag = 1 ORDER BY ID DESC";
	$result = mysql_query($query);
	$id=getCurrentInstituteID1();
	$output='';
	$flag=false;
	while($member = mysql_fetch_array($result))
		{
			$flag=true;
			$temp=explode(';',$member['classID']);
			$flag=in_array($id,$temp);
			if($flag||$member['classID']==0)
			$output.='<li><h4>'.$member['name'].'<h4></li>';
			$output.='<br />';
		}
		
		if($flag)
		$output='<h3>&nbsp;&nbsp;Note : </h3>'.$output;
		
		return $output;
	}
	
	function enterLoginLog($ip,$user)
	{
		$conn=getMainConnection();
		
		$id=$user->getClassID();
		
		    $query = "SELECT * FROM info WHERE ID = '".$id."'";
	        $result = mysql_query($query);
	        $numrows = mysql_affected_rows();
	       
		   if($numrows == 1)
		   {
			
			$member = mysql_fetch_array($result);
	        if($member['activeflag']!=0)
	        getTemporaryConnection($member['databasename']);
			
		    }
		
		$query = "INSERT INTO `login_logs` (`ID`, `userID`, `lastlogin`, `ip`) VALUES (NULL, '".$user->getID()."', '".time()."', '".$ip."')";
		$result = mysql_query($query);
		
	}
	
		function deleteBaseAppStudentData($ID)
	{
		
		$conn=getConnection();
		$query = "DELETE FROM app_login WHERE ID= ".$ID;
		$result = mysql_query($query);
		
		}
		
		function deleteTestAppStudentData($ID)
	{
		
		$conn=getConnection();
		$query = "DELETE FROM test_app_login WHERE ID= ".$ID;
		$result = mysql_query($query);
		
		}
?>