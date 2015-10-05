<?php

/*

Branch : 1

Add Branch : 11
View Branch : 12

Batch : 2

Add Batch : 21
View Batch : 22

Batch Class : 3

Add Batch Class : 31
View Batch Class : 32

Student : 4

Add : 41
Add Excel : 46
View : 42
Student Mass Action : 43
Change Batch : 44
Upload Photos : 45

Test : 5

Add : 51
Update : 52
Disable : 53
View : 54
Test Category : 55

Marks : 6

Report Card : 7

Add : 71
View : 72
Remark : 73

Marks Statistics : 8 

View Test Marks : 81
View Report Marks : 82

Notes : 9

Category : 91
Upload Notes : 92
View Notes : 93

SMS : 10

Sms marks : 101
Sms message : 102
View Sent Sms : 103

Fees : 11

Structure : 111
Installment : 112
Payment : 113

Test Series : 12

Chapter : 121
Home Test : 122
Correction Test : 123
Online Test : 124
Fill in the blanks : 125
Question Bank : 126

Staff : 13

Lecture : 131
Upload Video :132
View Video :133

Announcement : 14

Add : 141
View : 142

Calender : 151

Download : 16

Report Card : 161
Report toppers : 162
Mark List : 163
Student Info : 164
Attendance records : 165
Attendence Sheet : 166
Fee : 167

Graphs : 17

Report : 171

Settings : 18

System : 181 

Android  : 19

base : 191
test series : 192

*/


	function getPermission($ID)
	{
		$conn=getMainConnection();
		$query = "SELECT * FROM permission WHERE ID = '".$ID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$tempObj = new Permission($member['ID']);
			return $tempObj;
		}
		return NULL;
	}
	
	function setStaffPermission($permission,$value,$staffID)
	{
		$conn=getMainConnection();
		$query = "SELECT * FROM permission WHERE permissionType = '".$permission."' AND userID = '".$staffID."'";
		$result = mysql_query($query);
		$numrows = mysql_affected_rows();
		
		if($numrows == 1)
		{
			$member = mysql_fetch_array($result);
			$temp = $member['ID'];
			
			$query = "UPDATE permission SET activeflag = '".$value."' WHERE ID= ".$temp;
			$result = mysql_query($query);
		//	return "Update ".$permission." : ".$value;
		}
		else
		{
		
		$query = "INSERT INTO permission(userID,permissionType,activeflag,lastupdated) VALUES(".$staffID.",".$permission.",".$value.",NOW())";
		$result = mysql_query($query);	
		//return "Add ".$permission." : ".$value;
		}
	}
	
	function getAllUserPermissions($ID)
	{
	    $conn=getMainConnection();
		$query = "SELECT * FROM permission WHERE userID = '".$ID."' AND activeflag = 1";
		$result = mysql_query($query);
		$temp=array();
		while($member = mysql_fetch_array($result))
		{
		array_push($temp,$member['permissionType']);	
		}
		
		return $temp;
	}
	
	function isAllowedForUser($type,$permission)
	{
	if(in_array($type,$permission))
	{
		return true;
	}
	
	return false;	
	}
	
	
	function isAllowedForMe($level,$type,$permission)
	{
	
	if($level==1)
	return true;
	
	else
	{
		if($permission!=NULL)
		{
		if(in_array($type,$permission))
	{
		return true;
	}
		}
	return false;
	}
	}
	
	function checkUrlPermission($permission,$url)
	{
	
	$temp=array();
	$temp=explode('/',$url);
	$position=count($temp);
	$final_url=$temp[$position-1];
	
	if($final_url!='permissionDenied.php'&&$final_url!='staff.php'&&$final_url!='index.php'&&$final_url!='studentAddComplete.php'&&$final_url!='viewTestByBatch.php'&&$final_url!='updateModuleProcessor.php'&&$final_url!='smsMessageProcessor.php'&&$final_url!='updateHomeTestQuestions.php'&&$final_url!='updateHomeTestQuestionsProcessor.php'&&$final_url!='updateTest.php')
	{
	$url_no=getUrlPermNo($final_url);
	
	if(in_array($url_no,$permission))
	{
		return true;
	}
	
	return false;
	}
	else
	return true;
	}
	
	function getUrlPermNo($url)
	{
	
	$no=0;	
	
	if($url=='addBranch.php'||$url=='addBranchProcessor.php'||$url=='updateBranchProcessor.php')
	$no=11;
	
	
	
	
	if($url=='addBatch.php'||$url=='addBatchProcessor.php'||$url=='updateBatchProcessor.php')
	$no=21;
	
	
	if($url=='viewBatch.php')
	$no=22;
	
	
	if($url=='addBatchClass.php'||$url=='addBatchClassProcessor.php'||$url=='updateBatchClassProcessor.php')
	$no=31;
	
	
	if($url=='viewBatchClass.php')
	$no=32;
	
	
	if($url=='addStudent.php'||$url=='addStudentLessInfo.php'||$url=='addStudentProcessor.php'||$url=='addStudentLessInfoProcessor.php')
	$no=41;
	
	if($url=='addStudentFromExcel.php'||$url=='addStudentFromExcel.php'||$url=='studentExcelAddProcessor.php')
	$no=46;
	
	if($url=='viewAllStudent.php'||$url=='viewStudentByBranch.php'||$url=='viewStudentByBatch.php'||$url=='viewStudentByBatchClass.php')
	$no=42;
	
	
	if($url=='studentMassAction.php'||$url=='editMassStudents.php')
	$no=43;
	
	
	if($url=='changeBatch.php'||$url=='editMassStudentsbatch.php')
	$no=44;
	
	
	if($url=='uploadPhoto.php')
	$no=45;
	
	
	if($url=='viewTestByBatch.php')
	$no=54;
	
	
	if($url=='addTest.php'||$url=='addTestProcessor.php')
	$no=51;
	
	
	if($url=='updateTest.php'||$url=='updateTestProcessor.php')
	$no=52;
	
	
	if($url=='disableTest.php'||$url=='disableTestProcessor.php')
	$no=53;
	
	if($url=='addTestCategory.php'||$url=='addTestModuleProcessor.php'||$url=='addTestModuleProcessor.php')
	$no=55;
	
	
	if($url=='addMarks.php'||$url=='addMarksProcessor.php')
	$no=6;
	
	
	if($url=='addReport.php'||$url=='addReportProcessor.php'||$url=='updateReport.php'||$url=='updateReportProcessor.php')
	$no=71;
	
	
	if($url=='viewReport.php')
	$no=72;
	
	
	if($url=='reportRemark.php'||$url=='addReportRemarkProcessor.php'||$url=='updateRemarkProcessor.php')
	$no=73;
	
	
	if($url=='viewMarks.php')
	$no=81;
	
	
	if($url=='viewReportMarks.php')
	$no=82;
	
	
	if($url=='addNoteModule.php'||$url=='addNotesModuleProcessor.php')
	$no=91;
	
	
	if($url=='addNotes.php'||$url=='addNotesProcessor.php')
	$no=92;
	
	
	if($url=='viewNotes.php'||$url=='updateNoteProcessor.php')
	$no=93;
	
	
	if($url=='smsMarks.php'||$url=='smsTestMarkProcessor.php')
	$no=101;
	
	
	if($url=='smsMessage.php'||$url=='smsMessageProcessor.php')
	$no=102;
	
	if($url=='viewSentSms.php')
	$no=103;
	
	
	if($url=='addFeeStructure.php'||$url=='viewFeeStructure.php'||$url=='addFeeStructureProcessor.php'||$url=='updateFeeStructureProcessor.php')
	$no=111;
	
	
	if($url=='addFeeInstallment.php'||$url=='viewFeeInstallments.php'||$url=='addFeeInstallmentProcessor.php'||$url=='updateFeeInstallment.php')
	$no=112;
	
	
	if($url=='viewPendingPayements.php'||$url=='viewPaidPayements.php'||$url=='pendingPayementProcess.php'||$url=='addFeePayments.php'||$url=='addFeePaymentProcessor.php'||$url=='printFeePayments.php'||$url=='viewPrintedReceipts.php'||$url=='editFeePayments.php'||$url=='downloadReceiptProcessor.php'||$url=='editFeePaymentProcessor.php')
	$no=113;
	
	
	if($url=='addModule.php'||$url=='addModuleProcessor.php')
	$no=121;
	
	if($url=='addHomeTest.php'||$url=='addHomeTestSolution.php'||$url=='viewHomeTestByBatch.php'||$url=='addHomeTestProcessor.php'||$url=='addHomeTestQuestions.php'||$url=='addHomeTestSolution.php'||$url=='addHomeTestSolutionProcessor.php')
	$no=122;
	
	if($url=='addPaperCorrectionTest.php'||$url=='viewPaperCorrectionTestByBatch.php'||$url=='correctTestPaper.php'||$url=='addPaperCorrectionTestProcessor.php'||$url=='addPaperCorrectionTestQuestions.php'||$url=='addPaperCorrectionQuestionsProcessor.php'||$url=='correctPaper.php'||$url=='correctPaperProcessor.php')
	$no=123;
	
	if($url=='addOnlineTest.php'||$url=='addOnlineTestProcessor.php'||$url=='addOnlineTestQuestions.php'||$url=='addOnlineTestQuestionsProcessor.php'||$url=='viewOnlineTestByBatch.php'||$url=='viewOnlineTestDemo.php'||$url=='updateOnlineTestQuestions.php'||$url=='editOnlineTestQuestion.php'||$url=='editOnlineTestQuestionProcessor.php'||$url=='updateAllOnlineTestQuestions.php'||$url=='updateAllOnlineTestQuestionsProcessor.php'||$url=='viewOnlineTest.php')
	$no=124;
	
	if($url=='addFIB.php'||$url=='viewFIBByBatch.php'||$url=='viewFIBDemo.php'||$url=='addFIBProcessor.php'||$url=='addFIBQuestions.php'||$url=='addFIBQuestionsProcessor.php'||$url=='updateFIBQuestions.php'||$url=='editFIBQuestion.php'||$url=='editFIBQuestionProcessor.php'||$url=='viewFIBTest.php')
	$no=125;
	
	if($url=='addQuestions.php'||$url=='viewQuestionsByChapter.php'||$url=='addQuestionsProcessor.php'||$url=='editMassQuestions.php'||$url=='updateQuestion.php'||$url=='updateQuestionProcessor.php')
	$no=126;
	
	
	if($url=='addLectureTemplate.php'||$url=='viewLectureTemplate.php'||$url=='addLecture.php'||$url=='viewPendingLectures.php'||$url=='viewLecture.php'||$url=='')
	$no=131;
	
	
	if($url=='addAnnouncement.php'||$url=='')
	$no=141;
	
	if($url=='viewAnnouncement.php')
	$no=142;
	
	
	if($url=='calendar.php')
	$no=15;
	
	if($url=='downloadReportMarks.php')
	$no=161;
	
	if($url=='downloadReportToppersMarks.php')
	$no=162;
	
	if($url=='downloadStudentInfo.php')
	$no=163;
	
	if($url=='downloadTopperList.php')
	$no=164;
	
	if($url=='downloadAttendaceSheet.php')
	$no=166;
	
	if($url=='downloadFeeInfo.php')
	$no=167;
	
	if($url=='reportGraph.php'||$url=='')
	$no=171;
	
	if($url=='systemSettings.php'||$url=='')
	$no=181;
	
	if($url=='baseAppStudents.php')
	$no=191;
	
	if($url=='testAppStudents.php')
	$no=192;
	
	return $no;
	
	}
	?>