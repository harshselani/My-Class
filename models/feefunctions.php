<?php 

/* <-------------------------------------Fee Structure Functions---------------------------------> */

function getFeeStructure($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM feestructure WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new FeeStructure($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function getAllFeeStructureByBatch($obj)
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM feestructure WHERE activeflag=1 AND batchID='".$obj->getID()."' ORDER BY ID DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getFeeStructure($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}	
	
	function createFeeStructure($name,$amount,$batchObj,$receiptno,$creator)
	{
		$conn = getConnection();
		$query = "SELECT * FROM feestructure WHERE name LIKE '%".$name."%' AND amount = '".$amount."' OR batchID = '".$batchObj->getID()."'";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			
			$query = "INSERT INTO `feestructure` (`ID`, `batchID`, `name`, `amount`, `activeflag`, `createdby`, `lastupdated`, `type`,`receiptno`) VALUES(NULL,'".$batchObj->getID()."' ,'".$name."' ,'".$amount."' , 1 ,'".$creator."', CURRENT_TIMESTAMP,1,'".$receiptno."')";
			$result = mysql_query($query);
			$id=0;
			if($result)  
			{
			$message="Fee Structure Created Successfully :".$name;
			$id=1;
			}
			else 
			$message="Fee Structure Creation Failed :".mysql_error();
		}
		else
		{
			$message="Fee Structure Creation Failed : Similar Fee Structure Exsists -".$name;
		}

		return array($message,$id);
	}
	
	function getAllFeeStructureSorted()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM feestructure WHERE activeflag<>0 ORDER BY batchID DESC, amount DESC, activeflag DESC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getFeeStructure($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function getAllActiveFeeStructureSorted()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM feestructure WHERE activeflag=1 ORDER BY batchID DESC, amount DESC";
		//echo $query;
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getFeeStructure($member['ID']);
			array_push($list,$temp);
		}

		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
	}
	
	function updateFeeStructure($feestructureID,$name,$amount,$activeflag,$id,$receiptno)
	{
		$conn=getConnection();
	    $Obj=getFeeStructure($feestructureID);
		$Obj->setName($name);
		$Obj->setAmount($amount);
	    $Obj->setActiveFlag($activeflag);
	    $Obj->setCreatedBy($id);
		$Obj->setReceiptNo($receiptno);
	    $result=$Obj->update();
		
		if($result)  
	$message="Fee Structure Updated Successfully :".$name;
	else 
	$message="Fee Structure Updation Failed : ".$name;
	return $message;
		
		}
		
		
/* <-------------------------------------Fee Installment Functions---------------------------------> */
	
function getFeeInstallment($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM feeinstallment WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new FeeInstallment($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function createFeeInstallment($name,$amount,$duedate,$smsflag,$smstype,$feeObj,$creator)
	{
		$conn = getConnection();
		$query = "SELECT * FROM feeinstallment WHERE name LIKE '%".$name."%' AND amount = '".$amount."' AND feestructureID = '".$feeObj->getID()."' AND duedate = '".$duedate."'";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$message;
		if($rows==0)
		{
			
			$query = "INSERT INTO `feeinstallment`  (`ID`, `feestructureID`, `activeflag`, `name`, `duedate`, `amount`, `smsflag`, `smstype`, `lastupdated`, `createdby`, `type`) VALUES(NULL,'".$feeObj->getID()."' ,1 ,'".$name."' ,'".$duedate."','".$amount."' , 0 ,0 ,CURRENT_TIMESTAMP ,'".$creator."',1)";
			$result = mysql_query($query);
			$id=0;
			if($result)  
			{
			$message="Fee Installments Created Successfully :".$name;
			$id=1;
			}
			else 
			$message=mysql_error();
			//$message="Fee Installments Creation Failed :".$name;
		}
		else
		{
			$id=3;
			$message="Fee Installments Failed : Similar Installment exists -".$name;
		}

		return array($message,$id);
	}
	
	function getAllFeeInstallmentsByBatch($batchObj)
	{
		$conn=getConnection();
		
		$list=array();
		$temp=array();
		$temp=getAllFeeStructureByBatch($batchObj);
		for($i=0;$i<count($temp);$i++)
		{
		$conn=getConnection();
			
		$query = "SELECT * FROM feeinstallment WHERE activeflag<>0 AND feestructureID = '".$temp[$i]->getID()."' ORDER BY duedate ASC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getFeeInstallment($member['ID']);
			array_push($list,$temp);
		}
			}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		}
		
		function getActiveFeeInstallmentsByStructure($Obj)
	{
		
		
		$list=array();
		
	    $conn=getConnection();
			
		$query = "SELECT * FROM feeinstallment WHERE activeflag=1 AND feestructureID = '".$Obj->getID()."' ORDER BY duedate DESC";
		
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$temp = getFeeInstallment($member['ID']);
			array_push($list,$temp);
		}
			
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		}
		
		function updateFeeInstallment($feeinstallmentID,$name,$amount,$duedate,$activeflag,$id)
	{
		$conn=getConnection();
	    $Obj=getFeeInstallment($feeinstallmentID);
		$Obj->setName($name);
		$Obj->setAmount($amount);
		$Obj->setDueDate($duedate);
	    $Obj->setActiveFlag($activeflag);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Fee Installment Updated Successfully :".$name;
	else 
	$message="Fee Installment Updation Failed : ".$name;
	return $message;
		
		}
		
		
/* <-------------------------------------Fee Payement Functions---------------------------------> */

	function getFeePayement($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM feepayement WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new FeePayement($member['ID']);
			return $tempObj;
		}
		return NULL;
	}	
	
	function getPendingPayementStudentList($feeObj,$feeInstallmentObj)
	{
		$conn=getConnection();
		$stulist=array();
		$list=array();
		
		$stuobj=getAllActiveStudentsByBatch($feeObj->getBatchObj(),1);
		
		for($i=0;$i<count($stuobj);$i++)
		
		{
			$flag=studentPayementExists($stuobj[$i],$feeInstallmentObj);
			if(!$flag)
			{
			array_push($list,$stuobj[$i]);
			}
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
		
		function getPaidPayementStudentList($feeInstallmentObj)
	{
		$conn=getConnection();
		
		$list=array();
		$query = "SELECT * FROM feepayement WHERE activeflag=1 AND installmentID = '".$feeInstallmentObj->getID()."'";
		$result = mysql_query($query);
		while($member = mysql_fetch_array($result))
		{
			$temp = getFeePayement($member['ID']);
			array_push($list,$temp);
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		}
		
		function studentPayementExists($stuobj,$feeInstallmentObj)
		{
		
		$conn=getConnection();
		$query = "SELECT * FROM feepayement WHERE studentID = '".$stuobj->getID()."' AND activeflag=1 AND installmentID = '".$feeInstallmentObj->getID()."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		$flag=false;
		if($numrows == 1)
		{
			$flag=true;
		}
		
		return $flag;
			}
			
			function getstudentPayement($stuobj,$feeInstallmentObj)
		{
		
		$conn=getConnection();
		$query = "SELECT * FROM feepayement WHERE studentID = '".$stuobj->getID()."' AND activeflag=1 AND installmentID = '".$feeInstallmentObj->getID()."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		$temp=NULL;
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$temp = getFeePayement($member['ID']);
		}
		
		return $temp;
			}
			
			
			function addStudentPayment($stu,$feeInstallmentObj,$amount,$comment,$duedate,$discount,$feeStructureID,$user)
			{
			
			$flag=true;
			$flag=studentPayementExists($stu,$feeInstallmentObj);
			if(!$flag)
			{
			$conn=getConnection();
			$receiptno=getNewReceiptNo($feeStructureID);
			$query = "INSERT INTO `feepayement`(`ID`, `installmentID`, `studentID`, `paid`, `discount`, `comment`, `datepaid`,`receiptno`, `activeflag`, `createdby`, `lastupdated`) VALUES (NULL,'".$feeInstallmentObj->getID()."','".$stu->getID()."','".$amount."' ,'".$discount."' ,'".$comment."' ,'".$duedate."','".$receiptno."' ,1,'".$user."' ,CURRENT_TIMESTAMP)";
			$result = mysql_query($query);
			return mysql_insert_id();
			}
				
				}
				
				function  editStudentPayment($payID,$amount,$comment,$duedate,$discount,$id)
	{
		$conn=getConnection();
	    $Obj=getFeePayement($payID);
		$name=$Obj->getStudentObj()->getName();
		$Obj->setPaid($amount);
		$Obj->setDiscount($discount);
	    $Obj->setComment($comment);
		$Obj->setDatepaid($duedate);
	    $Obj->setCreatedBy($id);
	    $result=$Obj->update();
		
		if($result)  
	$message="Fee Payment Updated Successfully :".$name;
	else 
	$message=mysql_error();
	//$message="Fee Payment Updation Failed : ".$name;
	return $message;
		
		}
		
		function  updateFeeReceipt($payID,$batchname,$standard,$sumofrupees,$chequeno,$chequedrawn,$id)
	{
		$conn=getConnection();
	    $Obj=getFeePayement($payID);
		$Obj->setStd($standard);
	    $Obj->setBatchName($batchname);
		$Obj->setSumWords($sumofrupees);
	    $Obj->setPayementInfo($chequeno);
		$Obj->setChequeDrawn($chequedrawn);
		$Obj->setCreatedBy($id);
	    $result=$Obj->update1();
		
		if($result)  
	$message="Fee Payment Updated Successfully :".$name;
	else 
	$message=mysql_error();
	//$message="Fee Payment Updation Failed : ".$name;
	return $message;
		
		}
		
		/* <-------------------------------------Fee Payement Functions---------------------------------> */

	function getFeeReceipt($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM feereceipt WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new FeeReceipt($member['ID']);
			return $tempObj;
		}
		return NULL;
	}	
	
	function getLatestReceiptByInstallment($pay)
	{
		
		$conn=getConnection();
		$query = "SELECT * FROM feereceipt WHERE payementID = '".$pay."' and activeflag = 1 ORDER BY ID DESC";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		if($numrows >0)
		{
			$member = mysql_fetch_array($result);
			$tempObj = getFeeReceipt($member['ID']);
			return $tempObj;
		}
		return NULL;
		}
		
		function getAllReceiptByInstallment($pay)
	{
		$list=array();
		$conn=getConnection();
		$query = "SELECT * FROM feereceipt WHERE payementID = '".$pay."' and activeflag <>0 ORDER BY ID DESC";
		$result = mysql_query($query);
		
		while($member = mysql_fetch_array($result))
		{
			$tempObj = getFeeReceipt($member['ID']);
			array_push($list,$tempObj);
		}
		
		if(count($list) != 0)
		{
			return $list;
		}

		return NULL;
		
		}
		
		function createFeeReceipt($payID,$studentID,$datepaid,$receiptNo,$amount,$paid,$discount,$batchname,$standard,$sumofrupees,$chequeno,$chequedrawn,$user,$logo_type)
		{
			$conn=getConnection();
			$query = "INSERT INTO `feereceipt`(`ID`, `payementID`, `studentID`, `amount`, `paid`, `discount`, `datepaid`, `receiptno`, `standard`, `batchname`, `sumwords`, `chequeno`, `chequedrawn`, `activeflag`, `createdby`, `lastupdated`,`logo_type`) VALUES (NULL,'".$payID."','".$studentID."','".$amount."','".$paid."','".$discount."','".$datepaid."','".$receiptNo."','".$standard."','".$batchname."','".$sumofrupees."','".$chequeno."','".$chequedrawn."',1,'".$user."' ,CURRENT_TIMESTAMP,'".$logo_type."')";
			$result = mysql_query($query);
			if($result)  
	$message="Fee Receipt Updated Successfully ";
	else 
	$message=mysql_error();
	//$message="Fee Receipt Updation Failed : ".$name;
	return $message;
			}
			
			function getNewReceiptNo($ID)
	{
		$conn=getConnection();
		$query = "SELECT * FROM feestructure WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$temp = $member['currentreceiptno'];
			$temp++;
			
			$query1 = "UPDATE feestructure SET currentreceiptno = '".$temp."' WHERE ID= ".$ID;
			$result1 = mysql_query($query1);
			
			if($result1)
			return $temp;
			
		}
		return NULL;
	}
	
	function verifySuperAdmin($creatorID,$userID)
	{
		if($creatorID==39)
			if($creatorID==$userID)
			return true;
			else
			return false;
		else
		return true;
		}
	?>