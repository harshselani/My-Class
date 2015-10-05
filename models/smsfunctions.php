<?php

	function getSmsStatus()
	{
		return getValue(2);
		
		}
	
	function getSmsType()
	{
		if(getSmsStatus()==1)
		{
		return getValue(3);
		}
		else
		return NULL;
		}
		
	
		
	function getSmsFeedID()
	{
		if(getSmsStatus()==1)
		{
		return getValue(4);
		}
		else
		return NULL;
		
		}
		
	function getSmsUsername()
	{
		if(getSmsStatus()==1)
		{
		return getValue(5);
		}
		else
		return NULL;
		
		}
		
		function getSmsPassword()
	{
		if(getSmsStatus()==1)
		{
		return getValue(7);
		}
		else
		return NULL;
		
		}
				
	function getSmsUrl()
	{
		if(getSmsStatus()==1)
		{
		return getValue(6);
		}
		else
		return NULL;
		
		}
		
		function getSmsSendInfo($to,$text)
		{
			
		if(getSmsType()==1)
		{
		$info=smsTempType1($to,$text);
		return $info;
		}
		
		elseif(getSmsType()==2)
		{
		$info=smsTempType2($to,$text);
		return $info;
		}
		elseif(getSmsType()==3)
		{
		$info=smsTempType3($to,$text);
		return $info;
		}
		elseif(getSmsType()==4)
		{
		$info=smsTempType4($to,$text);
		return $info;
		}
		else
		return NULL;
		}
		
		
		
		function smsTempType1($to,$text)
		{
$param=array('feedid'=>'','username'=>'','password'=>'','To'=>'','Text'=>'');
$info='';
$param['feedid'] = getSmsFeedID();
$param['username'] = getSmsUsername();
$param['password'] = getSmsPassword();
$param['To'] = $to;
$param['Text'] = $text;

foreach($param as $key=>$val) {
$info.= $key."=".$val;
//we have to urlencode the values
$info.= "&";
//append the ampersand (&) sign after each parameter/value pair
}
$info = substr($info, 0, strlen($info)-1);
return $info;			
			}
	
			function smsTempType2($to,$text)
		{
$param=array('mobile'=>'','message'=>'','userid'=>'','pw'=>'');
$info='';
$param['mobile'] = $to;
$param['message'] = $text;
$param['userid'] = getSmsUsername();
$param['pw'] = getSmsPassword();


foreach($param as $key=>$val) {
$info.= $key."=".urlencode($val);
//we have to urlencode the values
$info.= "&";
//append the ampersand (&) sign after each parameter/value pair
}
$info = substr($info, 0, strlen($info)-1);
return $info;			
			}
					
		function smsTempType3($to,$text)
		{
$param=array('action'=>'','from'=>'','username'=>'','passphrase'=>'','phone'=>'','message'=>'');
$info='';
$param['action'] = 'send';
$param['from'] = getSmsFeedID();
$param['username'] = getSmsUsername();
$param['passphrase'] = getSmsPassword();
$param['phone'] = $to;
$param['message'] = $text;

foreach($param as $key=>$val) {
$info.= $key."=".urlencode($val);
//we have to urlencode the values
$info.= "&";
//append the ampersand (&) sign after each parameter/value pair
}
$info = substr($info, 0, strlen($info)-1);
return $info;			
			}
			
			function smsTempType4($to,$text)
		{
$param=array('user'=>'','senderID'=>'','receipientno'=>'','msgtxt'=>'','state'=>'');
$info='';
$param['receipientno'] = $to;
$param['msgtxt'] = $text;
$param['user'] = getSmsUsername().':'.getSmsPassword();
$param['senderID'] = getSmsFeedID();
$param['state'] = 1;

foreach($param as $key=>$val) {
$info.= $key."=".urlencode($val);
//we have to urlencode the values
$info.= "&";
//append the ampersand (&) sign after each parameter/value pair
}
$info = substr($info, 0, strlen($info)-1);
return $info;			
			}
			
function getStudentSmsNumber($student,$temparr)
			{
$number='';

if(count($temparr)==0)
{
	$temparr[]=0;
	}

	for($i=0;$i<count($temparr);$i++)
	{
		if($temparr[$i]==0)
		{
		if($student->getPhoneStu()!=NULL)
		$number.="91".$student->getPhoneStu().",";
		}
		if($temparr[$i]==1)
		{
		if($student->getPhoneFather()!=NULL)
		$number.="91".$student->getPhoneFather().",";
		}
		if($temparr[$i]==2)
		{
		if($student->getPhoneMother()!=NULL)
		$number.="91".$student->getPhoneMother().",";
		}
	}		

$number = substr($number, 0, strlen($number)-1);
return $number;	
				}

function getStaffSmsNumber($staff)
			{
$number='';

$number.="91".$staff->getPhone();
		
return $number;	
				}

function getSmsTemplate($id)
{
	$conn=getConnection();
	$query = "SELECT * FROM sms WHERE ID = '".$id."'";
	$result = mysql_query($query);
	$numrows = mysql_affected_rows();
	if($numrows==1)
		{
			$member = mysql_fetch_array($result);
	        if($member['activeflag']!=0)
	        return $member['value'];
			else
			return NULL;
		}
		return NULL;
	}
	
		function prepSms($student,$marks,$testObj,$sms,$custom,$nooftoppers,$average,$custom_avg_no_students)
	{
		
		if($testObj->getDateTest()!='0000-00-00')
	{
	$date = date("j/m/y", strtotime($testObj->getDateTest()));
	}
	else 
	$date = '';
	
	//values
	
	$name=$student->getShortName();
	$mymark=$marks->getDisplayMark2();
	$maxmark=$testObj->getMaximum();
	$testname=$testObj->getName();
	$highest=$testObj->getHighestMarks()->getDisplayMark1();
	$topics=$testObj->getTopic();
	
	
		$replaceArray=array($name,$mymark,$maxmark,$testname,$date,$highest,$nooftoppers,$average,$topics,$custom,$custom_avg_no_students);
		$findArray=array('NAME','MARKS','MAX','TEST','DATE','HIGHEST','NO_OF_TOPPERS','AVERAGE','TOPICS','CUSTOM','AVG_NO_STUDENTS');
/*		
		$NAME = $student->getName();
		$MARKS=$marks->getDisplayMark1();
		$MAX=$testObj->getMaximum();
		$TEST=$testObj->getName();
		$DATE=$testObj->getDateTest();
		$HIGHEST=$testObj->getHighestMarks();
		*/
		
		//$sms="Dear Parent, your child NAME got MARKS/MAX in TEST DATE test.Topper's marks: HIGHEST(NO_OF_TOPPERS students) Avg of 1st 50 stdts: AVERAGE";
		
		for($i=0;$i<count($replaceArray);$i++)
		{
		$postion=strpos($sms,$findArray[$i],0);
		
		if($postion!==FALSE)
		{
		$length=strlen($findArray[$i]);
		//echo $length." ".$postion." ".$replaceArray[$i]."<br />";
		$sms=substr_replace($sms,$replaceArray[$i],$postion,$length);
		}
		}
		return $sms;
		}
		
	function prepMessageSms($sms,$custom,$student)
	{
		$name=$student->getName();
		$replaceArray=array($name);
		$findArray=array('NAME');
		for($i=0;$i<count($replaceArray);$i++)
		{
		$postion=strpos($sms,$findArray[$i],0);
		
		if($postion!==FALSE)
		{
		$length=strlen($findArray[$i]);
		//echo $length." ".$postion." ".$replaceArray[$i]."<br />";
		$sms=substr_replace($sms,$replaceArray[$i],$postion,$length);
		}
		}
		
	    for($i=0;$i<=count($custom);$i++)
		{
		$postion=strpos($sms,'CUSTOM',0);
		
		if($postion!==FALSE)
		{
		$length=6;
		
		$replace=$custom[$i];
		
		$sms=substr_replace($sms,$replace,$postion,$length);
		
		}
			}
		
		
		return $sms;
		}
		
		function getSmsByType($id)
{
	
	$conn=getConnection();
	$list=array();
	$query = "SELECT * FROM sms WHERE type = '".$id."' AND activeflag = 1";
	$result = mysql_query($query);
	
	while($member = mysql_fetch_array($result))
		{
			if($member['count']==0)
			{
				$temp=array($member['ID'],$member['value']);
			}
	        else 
			{
				$temp=array();
				$temp=outputCustomSmsTemplate($member['ID'],$member['value'],$member['count']);
				}
			array_push($list,$temp);
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
	}
	
	function outputCustomSmsTemplate($id,$sms,$count)
	{
		for($i=0;$i<$count;$i++)
		{
		$postion=stripos($sms,'CUSTOM',0);
		
		if($postion!==FALSE)
		{
		$length=6;
		
		$replace="<input type='text' name='".$id."c".$i."' value='INPUT' size='100' />";
		
		$sms=substr_replace($sms,$replace,$postion,$length);
		
		}
			}
		
		$postion=stripos($sms,'AVG_NO_STUDENTS',0);
		
		if($postion!==FALSE)
		{
		$length=15;
		
		$replace="<input type='text' name='".$id."c_CUSTOM_NO_STUDENTS' value='No of Students' />";
		
		$sms=substr_replace($sms,$replace,$postion,$length);
		
		}
		
		$temp=array($id,$sms);
		return $temp;
		}
		
		function getCustomSmsCount($id)
{
	
	$conn=getConnection();
	$list=array();
	$query = "SELECT * FROM sms WHERE ID = '".$id."'";
	$result = mysql_query($query);
	$numrows = mysql_affected_rows();
	if($numrows==1)
		{
			$member = mysql_fetch_array($result);
	        if($member['activeflag']!=0)
	        return $member['count'];
			else
			return NULL;
		}
		return NULL;
		
	}
	
	function increaseSmsCounter()
	{
		$current=getValue(8);
		$current++;
		$conn=getConnection();
		$query = "UPDATE options SET value = '".$current."' WHERE ID = 8";
		$result = mysql_query($query);
		
		}
		
			function increaseSmsCounter1()
	{
		
		$query11 = "SELECT * FROM options WHERE ID = 8";
	    $result11 = mysql_query($query11);
		$member11 = mysql_fetch_array($result11);
		$current=$member11['value'];
		
		$current++;
		$query22 = "UPDATE options SET value = '".$current."' WHERE ID = 8";
		$result22 = mysql_query($query22);
		
		}
		
		function insertSentSms($sms,$ID,$no_of_students,$userID,$type)
	{
		
	$conn=getConnection();
	
	$query="INSERT INTO `sent_sms` (`ID`, `sms`, `batchID`, `datesent`, `no_of_students`, `userID`, `type`) VALUES (NULL, '".$sms."', '".$ID."', CURRENT_TIMESTAMP, '".$no_of_students."','".$userID."', '".$type."')";
	$result = mysql_query($query,$conn);
	return mysql_error();
	}
	
	function getSentBatchSms($id)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM sent_sms WHERE batchID='".$id."' AND type=2 ORDER BY ID DESC LIMIT 0,4";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = $member;
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
		
		function getSentTestSms()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM sent_sms WHERE type=1 ORDER BY ID DESC LIMIT 0,4";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = $member;
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
		
		function getAllSentSms()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM sent_sms ORDER BY ID DESC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = $member;
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
?>