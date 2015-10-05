<?php
include_once '../../models/commonfiles.php';

set_time_limit(10000);

if(isset($_POST['testID']))
$testID = trim($_POST['testID']);
else
{
	echo "No Test Selected";
	die();
	}
$smssent=0;
if(isset($_POST['custom']))
$custom = trim($_POST['custom']);
else
$custom='';

if(isset($_POST['smsID']))
$smsID = trim($_POST['smsID']);
else
{
	echo "No Sms Selected";
	die();
	}


$testObj=getTest($testID);
$temparray=array();
for($i=0;$i<3;$i++)
{
	if(isset($_POST['to'.$i])&&$_POST['to'.$i]==1)
{
	array_push($temparray, $i);
}
	}

$list=array();
$studentarray=array();
$list=getAllMarksOfTestArranged($testObj,'DESC');
//echo count($list)."<br />";

for($i=0;$i<count($list);$i++)
{
if(isset($_POST['id'.$list[$i][0]->getID()])&&$_POST['id'.$list[$i][0]->getID()]==1)
{
	//$ID = $list[$i][0]->getID();
	//$tempStudent=getStudent($ID,0);
	$number=getStudentSmsNumber($list[$i][0],$temparray);
	
	$sms=getSmsTemplate($smsID);
	
	$test=prepSms($list[$i][0],$list[$i][1],$testObj,$sms,$custom);
	//echo $test."<br />";
	$request=getSmsSendInfo($number,$test);
	//echo $request." ".$list[$i][0]->getID()."<br />";

$sent=count($temparray);
if($sent==0)
$sent=1;
$smssent+=$sent;

if(getSmsType()==1)
{

$url=getSmsUrl();

$ch = curl_init(); 
 if (!$ch){die("Couldn't initialize a cURL handle");}
 $ret = curl_setopt($ch, CURLOPT_URL,$url);
 curl_setopt ($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
 curl_setopt ($ch, CURLOPT_POSTFIELDS, $request);
 $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

 $curlresponse = curl_exec($ch); 
if(curl_errno($ch))
	echo 'curl error : '. curl_error($ch);

 if (empty($ret)) {
   
    die(curl_error($ch));
    curl_close($ch); 
 } else {
    $info = curl_getinfo($ch);
    curl_close($ch); 
    echo "<br>";
	echo "Message Sent Succesfully to ".$list[$i][0]->getName()."<br />";
   
 }	
}

if(getSmsType()==2)
{

$url=getSmsUrl();
$url.="?".$request;
//echo $url;
if (!function_exists('curl_init')){ 
		echo('CURL is not installed!');
        	die('CURL is not installed!');
    	}
		
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
echo $curl_scraped_page;
//echo "Message Sent Succesfully to ".$list[$i]->getName()."<br />";
  
 	
}
if(getSmsType()==3)
{
	$url=getSmsUrl();
    $url.="?".$request;
//echo $url;
	$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
//echo $curl_scraped_page;
echo "Message Sent Succesfully to ".$list[$i][0]->getName()."<br />";
	
	
	}	
}
}
for($i=1;$i<$smssent;$i++)
{
	increaseSmsCounter();
}
?>