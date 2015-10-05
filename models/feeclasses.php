<?php

include_once 'feefunctions.php';

class FeeStructure
{
	    var $ID;
		var $batchID;
		
		var $name;
		var $amount;
		var $activeflag;
		var $createdby;
		var $lastupdated;
		var $type;
		var $receiptno;
		var $currentreceiptno;
		
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}
		
		function setBatchID($a)
		{
			$this->batchID = $a;
		}
		
		
		
		function setName($a)
		{
			$this->name = $a;
		}
		
		function setAmount($a)
		{
			$this->amount = $a;
		}
		
		function setType($a)
		{
			$this->type= $a;
		}
		
		
		
		function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	
	    function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	    function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function setReceiptNo($receiptno)
		{
			$this->receiptno = $receiptno;
		}
		
		function setCurrentReceiptNo($currentreceiptno)
		{
			$this->currentreceiptno = $currentreceiptno;
		}
		
		function getBatchID()
		{
			return $this->batchID;
		}
		
		function getBatchObj()
		{
			return getBatch($this->batchID);
		}
		
		function getName()
		{
			return $this->name;
		}
		
		function getAmount()
		{
			return $this->amount;
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
		
		function getReceiptNo()
		{
			return $this->receiptno;
		}
		
		function getCurrentReceiptNo()
		{
			return $this->currentreceiptno;
		}
		
		function getBestDisplay()
		{
			
			return $this->getBatchObj()->getBestDisplay()." : ".$this->getName()." : Rs ".$this->getAmount();
			}
		
		function getBestDisplay1()
		{
			
			return $this->getName()." : Rs ".$this->getAmount();
			}
				
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE feestructure SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM feestructure WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setName(trim($member['name']));
$this->setBatchID(trim($member['batchID']));

$this->setAmount(trim($member['amount']));
$this->setType(trim($member['type']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setReceiptNo(trim($member['receiptno']));
$this->setCurrentReceiptNo(trim($member['currentreceiptno']));
		}
		}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE feestructure SET activeflag = '".$this->activeflag."', name = '".$this->name."', receiptno = '".$this->receiptno."', currentreceiptno = '".$this->currentreceiptno."',amount = '".$this->amount."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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
			
		function getAllObjFeeInstallments()
	{
		$conn=getConnection();
		$list = array();
		$query = "SELECT * FROM feeinstallment WHERE activeflag=1 AND feestructureID='".$this->ID."' ORDER BY ID DESC";
		
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
	}

class FeeInstallment
{
	    var $ID;
		var $feeStructureID;
		var $name;
		var $amount;
		var $duedate;
		var $smsflag;
		var $smstype;
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
		
		function setFeeStructureID($a)
		{
			$this->feeStructureID = $a;
		}
		
		
		
		function setName($a)
		{
			$this->name = $a;
		}
		
		function setAmount($a)
		{
			$this->amount = $a;
		}
		
		function setType($a)
		{
			$this->type= $a;
		}
		
		function setDueDate($a)
		{
			$this->duedate = $a;
		}
		
		function setSmsFlag($a)
		{
			$this->smsflag = $a;
		}
		
		function setSmsType($a)
		{
			$this->smstype = $a;
		}
		
				
		function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	
	    function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	    function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function getFeeStructureID()
		{
			return $this->feeStructureID;
		}
		
		function getFeeStructureObj()
		{
			return getFeeStructure($this->feeStructureID);
		}
		
		function getName()
		{
			return $this->name;
		}
		
		function getAmount()
		{
			return $this->amount;
		}
		
		function getType()
		{
			return $this->type;
		}
		
		function getDueDate()
		{
			return $this->duedate;
		}
		
		function getSmsFlag()
		{
			return $this->smsflag;
		}
		
		function getSmsType()
		{
			return $this->smstype;
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
		
		function getBestDisplay()
		{
			$date = date("j-M-Y", strtotime($this->getDueDate()));
		
			return $this->getName()." : ".$date." : Rs ".$this->getAmount();
			}
			
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE feeinstallment SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM feeinstallment WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setFeeStructureID(trim($member['feestructureID']));

$this->setName(trim($member['name']));
$this->setDueDate(trim($member['duedate']));
$this->setAmount(trim($member['amount']));
$this->setSmsFlag(trim($member['smsflag']));
$this->setSmsType(trim($member['smstype']));
$this->setType(trim($member['type']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));

		}
		}
		
		function update()
		{
			$conn = getConnection();
			$query = "UPDATE feeinstallment SET activeflag = '".$this->activeflag."', name = '".$this->name."', duedate = '".$this->duedate."', amount = '".$this->amount."', createdby = '".$this->createdby."', lastupdated = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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

class FeePayement
{
	
	    var $ID;
		var $installmentID;
		var $studentID;
		var $paid;
		var $discount;
		var $comment;
		var $datepaid;
		var $receiptno;
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
		
		function setInstallmentID($a)
		{
			$this->installmentID = $a;
		}
		
		function setStudentID($a)
		{
			$this->studentID = $a;
		}
		
		
		
		function setPaid($a)
		{
			$this->paid = $a;
		}
		
		function setDiscount($a)
		{
			$this->discount = $a;
		}
		
		function setComment($a)
		{
			$this->comment = $a;
		}
		
		function setDatepaid($a)
		{
			$this->datepaid = $a;
		}
		
		function setReceiptNo($a)
		{
			$this->receiptno = $a;
		}
		
		
				
		function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	
	    function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	    function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
	
	    function getInstallmentID()
		{
			return $this->installmentID ;
		}
		
		function getStudentID()
		{
			return $this->studentID ;
		}
		
		function getStudentObj()
		{
			return getStudent($this->studentID,1);
		}
		
		function getPaid()
		{
			return $this->paid ;
		}
		
		function getDiscount()
		{
			return $this->discount ;
		}
		
		function getBalance()
		{
			$amount=getFeeInstallment($this->installmentID)->getAmount();
			
			$balance=$amount-$this->paid-$this->discount;
			
			return $balance;
		}
		
		function getComment()
		{
			return $this->comment ;
		}
		
		function getDatepaid()
		{
			return $this->datepaid ;
		}
		
		function getReceiptNo()
		{
			return $this->receiptno;
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
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE feepayement SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM feepayement WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setInstallmentID(trim($member['installmentID']));
$this->setStudentID(trim($member['studentID']));
$this->setPaid(trim($member['paid']));
$this->setDiscount(trim($member['discount']));
$this->setComment(trim($member['comment']));
$this->setDatepaid(trim($member['datepaid']));
$this->setReceiptNo(trim($member['receiptno']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));

		}
		}
				
				function update()
		{
			$conn = getConnection();
			$query = "UPDATE `feepayement` SET `paid`= ".$this->paid.", `discount`= ".$this->discount.",`comment`= '".$this->comment."',`datepaid`= '".$this->datepaid."',`createdby`= ".$this->createdby.",`lastupdated` = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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

class FeeReceipt
{
	
	    var $ID;
		var $payementID;
		var $studentID;
		var $paid;
		var $discount;
		var $amount;
		var $datepaid;
		var $receiptno;
		var $standard;
		var $batchname;
		var $sumWords;
		var $chequeno;
		var $chequeDrawn;
		var $activeflag;
		var $createdby;
		var $lastupdated;
		var $logo_type;
		
		function __construct($ID)
		{
			$this->ID = $ID;
			$this->read();
		}

	    function getID()
		{
			return $this->ID;
		}
		
		function setPayementID($a)
		{
			$this->payementID = $a;
		}
		
		function setStudentID($a)
		{
			$this->studentID = $a;
		}
		
		
		
		function setPaid($a)
		{
			$this->paid = $a;
		}
		
		function setDiscount($a)
		{
			$this->discount = $a;
		}
		
		function setAmount($a)
		{
			$this->amount = $a;
		}
		
		function setDatepaid($a)
		{
			$this->datepaid = $a;
		}
		
		function setReceiptNo($a)
		{
			$this->receiptno = $a;
		}
		
		
		function setStandard($a)
		{
			$this->standard = $a;
		}
		
		function setBatchName($a)
		{
			$this->batchname = $a;
		}
		
		function setSumWords($a)
		{
			$this->sumWords = $a;
		}
		
		function setChequeNo($a)
		{
			$this->chequeno = $a;
		}
		
		function setChequeDrawn($a)
		{
			$this->chequeDrawn = $a;
		}
		
		function setActiveFlag($activeflag)
		{
			$this->activeflag = $activeflag;
		}
	
	
	    function setCreatedBy($createdby)
		{
			$this->createdby = $createdby;
		}
	
	    function setLastUpdated($lastupdated)
		{
			$this->lastupdated = $lastupdated;
		}
		
		function setLogoType($l)
		{
			$this->logo_type = $l;
		}
	
	    function getPayementID()
		{
			return $this->payementID ;
		}
		
		function getStudentID()
		{
			return $this->studentID ;
		}
		
		function getStudentObj()
		{
			return getStudent($this->studentID,1);
		}
		
		function getPaid()
		{
			return $this->paid ;
		}
		
		function getDiscount()
		{
			return $this->discount ;
		}
		
		function getBalance()
		{
			
			$balance=$this->amount-$this->paid-$this->discount;
			
			return $balance;
		}
		
		function getAmount()
		{
			return $this->amount;
		}
		
		function getDatepaid()
		{
			return $this->datepaid ;
		}
		
		function getReceiptNo()
		{
			return $this->receiptno;
		}
		
		
		function getStandard()
		{
			return $this->standard;
		}
		
		function getBatchName()
		{
			return $this->batchname;
		}
		
		function getSumWords()
		{
			return $this->sumWords;
		}
		
		function getChequeNo()
		{
			return $this->chequeno;
		}
		
		function getChequeDrawn()
		{
			return $this->chequeDrawn;
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
		
		function getLogoType()
		{
			return $this->logo_type;
		}
		
		function updateActiveFlag($ac)
		{
			$conn = getConnection();
			$query = "UPDATE feereceipt SET activeflag = '".$ac."' WHERE ID= ".$this->ID;
			$result = mysql_query($query);
		}
		
		function read()
		{
			$conn = getConnection();
			$query = "SELECT * FROM feereceipt WHERE ID='".$this->ID."'";
			$result = mysql_query($query);
			
			if(!$result)return;
			else
			{
$member = mysql_fetch_array($result);
$this->setPayementID(trim($member['payementID']));
$this->setStudentID(trim($member['studentID']));
$this->setPaid(trim($member['paid']));
$this->setDiscount(trim($member['discount']));
$this->setAmount(trim($member['amount']));
$this->setDatepaid(trim($member['datepaid']));
$this->setReceiptNo(trim($member['receiptno']));
$this->setStandard(trim($member['standard']));
$this->setBatchName(trim($member['batchname']));
$this->setSumWords(trim($member['sumwords']));
$this->setChequeNo(trim($member['chequeno']));
$this->setChequeDrawn(trim($member['chequedrawn']));
$this->setActiveFlag(trim($member['activeflag']));
$this->setCreatedBy(trim($member['createdby']));
$this->setLastUpdated(trim($member['lastupdated']));
$this->setLogoType(trim($member['logo_type']));
		}
		}
				
				function update()
		{
			$conn = getConnection();
			$query = "UPDATE `feereceipt` SET `paid`= ".$this->paid.", `discount`= ".$this->discount.",`comment`= '".$this->comment."',`datepaid`= '".$this->datepaid."',`createdby`= ".$this->createdby.",`lastupdated` = CURRENT_TIMESTAMP WHERE ID = ".$this->ID."";
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