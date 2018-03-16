<?php
/*
 * Created on Jun 2, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  	include('groupDao.php');
	$groupDao = new GroupDao();
   	session_start();
 	$groupId = $_POST['group'];
 	$emailId = $_POST['emailId'];
 	$buddyId = $_SESSION['buddyId'];
  	$invitationId = uniqid('bestBuddy_');
 
 	$groupDao->insertIntoInvitation($invitationId, $emailId, $buddyId, $groupId);
   	
	$subject = 'Buddy Dialogue :-)';
	$from = 'goutam.s.h@gmail.com';
	$headers = "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: "."Goutam S.H"." <".$from.">";
	$message = 'Hi,' .
			'<br>' .
			'You have been Invited to join <b>'.$groupDao->getGroupNameByGroupId($groupId).'</b> group.<br>' .
					'Please register.<br>' .
					'http://gshepur.com/BudDialogue/registerMe.php?inviteId='.$invitationId.'<br>' .
							'<br>' .
							'Thanks,' .
							'<br>' .
							'Goutam';
	
	if(mail($emailId, $subject, $message, $headers)){
		$msg = 'Buddy Invitation Sent.';
	}
	else{
		$msg = "Some Problem !! Couldn't send Inviation'";
	}
	//echo "Mail send failure - message not sent";
   	
   	header("Location: inviteBuddy.php?msg=".$msg);
   	
 
?>
