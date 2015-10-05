<?php
include_once '../../models/commonfiles.php';

set_time_limit(10000);
$conn=getConnection();

if(isset($_POST['smsID']))
$smsID = mysql_real_escape_string(trim($_POST['smsID']));
else
{
	echo "No Sms Selected";
	die();
	}

if(isset($_POST['batchID']))
$batchID = mysql_real_escape_string(trim($_POST['batchID']));
else
{
	echo "No Batch Selected";
	die();
	}	

$count=getCustomSmsCount($smsID);
$custominput=array();
for($i=0;$i<$count;$i++)
{
	$input=mysql_real_escape_string(trim($_POST[$smsID.'c'.$i]));
	array_push($custominput, $input);
}

//print_r($custominput);	


$temparray=array();
for($i=0;$i<3;$i++)
{
	if(isset($_POST['to'.$i])&&$_POST['to'.$i]==1)
{
	array_push($temparray, $i);
}
	}

$smssent=0;
$list=array();
$batchObj=getBatch($batchID);
$list=getAllStudentsByBatch($batchObj,3);


$sms=getSmsTemplate($smsID);

//echo count($list)."<br />";

for($i=0;$i<count($list);$i++)
{
if(isset($_POST['id'.$list[$i]->getID()])&&$_POST['id'.$list[$i]->getID()]==1)
{
	//$ID = $list[$i][0]->getID();
	//$tempStudent=getStudent($ID,0);
	$number=getStudentSmsNumber($list[$i],$temparray);
	
	//increaseSmsCounter($temparray);
	
	
	
	$test=prepMessageSms($sms,$custominput,$list[$i]);
	//echo $test."<br />";
	$request=getSmsSendInfo($number,$test);
	echo $request." ".$list[$i]->getID()."<br />";

$sent=count($temparray);
if($sent==0)
$sent=1;
$smssent+=$sent;

	//echo $smssent;
/*
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
	echo "Message Sent Succesfully to ".$list[$i]->getName()."<br />";
   
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
echo "Message Sent Succesfully to ".$list[$i]->getName()."<br />";
	}	
	*/
}
}

// Demo Sms Send

   $tempStu=new Short1;
   $tempStu->setFirstName('Demo');
   $tempStu->setLastName('Student');
   
    $number='';
	for($t=17;$t<20;$t++)
	{
		if(getActiveFlagValue($t)==1)
		{
		$number.="91".getValue($t).",";
		$smssent++;
		}
		}
	$number = substr($number, 0, strlen($number)-1);
    
	$test=prepMessageSms($sms,$custominput,$tempStu);
	
	//echo $test."<br />";
	
	$request=getSmsSendInfo($number,$test);
	echo $request." ".$tempStu->getName()."<br />";



	//echo $smssent;
/*
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
	echo "Message Sent Succesfully to ".$list[$i]->getName()."<br />";
   
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
echo "Message Sent Succesfully to ".$list[$i]->getName()."<br />";
	}	
*/

for($i=1;$i<$smssent;$i++)
{
	increaseSmsCounter();
}
?>