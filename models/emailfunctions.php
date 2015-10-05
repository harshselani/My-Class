<?php

/*
Login flag = -1 => Activation Mail sent
Login flag = 0 => Login disabled


*/

function sendEmail($toEmail,$toName,$fromEmail,$fromName,$subject,$body,$root)
{

require_once $root.'/home/knowportal/domains/knowledgeportal.in/public_html/myclass/scripts/email/swift_required.php';

// Create the Transport

$transport = Swift_SmtpTransport::newInstance('mail.knowledgeportal.in', 25)
  ->setUsername('no-reply@knowledgeportal.in')
  ->setPassword('pass123?')
  ;

// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance($subject)
  ->setFrom(array($fromEmail => $fromName))
  ->setTo(array($toEmail => $toName,'harsh.1007@yahoo.com' => 'Harsh'))
  ->setBody($body,'text/html')
  ;


if ($mailer->send($message))
{
return true;
}
else
{
 return false;
}

}

function sendUserLogsViaMail($classID)
{
	
	$conn=getMainConnection();
	
	        $query = "SELECT * FROM info WHERE ID = '".$classID."'";
	        $result = mysql_query($query);
	        $numrows = mysql_affected_rows();
	       
		   if($numrows == 1)
		   {
			
			$member = mysql_fetch_array($result);
	        if($member['activeflag']!=0)
	        getTemporaryConnection($member['databasename']);
			
		    }
	
	        $query = "SELECT * FROM login_logs WHERE lastlogin <= '".time()."' AND lastlogin >= '".(time()-86400)."'";
	        $result = mysql_query($query);
	
	$mail_string='';
	        while($member = mysql_fetch_array($result))
		{
			$time = date("F j, Y, g:i a",$member['lastlogin']);
			$user=getUser($member['userID'])->getName();
			$mail_string.=$user.' logged in at '.$time.' from the ip '.$member['ip'].'<br />';
			
		}
	//echo $mail_string;
	
	
	$toEmail='acechemistry2@gmail.com';
	$toName='Ace Chemistry';
	$fromEmail='noreply@knowledgeportal.in';
	$fromName='My Class - Knowledge Portal';
	
	$subject='Staff Login Logs : '.date("d-m-Y");
	$body='Staff Login Logs <hr /><br />'.$mail_string;
	
	$flag=sendEmail($toEmail,$toName,$fromEmail,$fromName,$subject,$body,'');
	
	return $flag;
	
	
}

?>