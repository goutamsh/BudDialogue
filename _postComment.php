<?php
/*
 * Created on Jun 25, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 include('groupDao.php');
 include('_htmlHelper.php');
 include ('_sendNotification.php');
	$groupDao = new GroupDao();
	$htmlHelper = new htmlHelper();
	$sendNotification = new SendNotification();
	session_start();
	$dialogueId = $_GET['dialogueId'];//$_POST['dialogueId'];
	$comment = $_GET['comment'];//$_POST['comment'];

   	$signedIn = $_SESSION['signed_in'];
   	if($signedIn == null || $signedIn == false){
   		header("Location: login.php");
   		return;
   	}
    $firstName = $_SESSION['FIRST_NAME'];
   	$lastName = $_SESSION['LAST_NAME'];
   	$buddyId = $_SESSION['buddyId'];
    $buddy = $groupDao->getBuddyByBuddyId($buddyId);
	$result = $groupDao->insertIntoComment($dialogueId, $comment,$buddyId);
	
	//Send Notification
	$notificationParams = array();
	$notificationParams['who_name'] = $_SESSION['FIRST_NAME'];
	$notificationParams['who_id'] = $buddyId;
	$notificationParams['what'] = 'comment';
	$notificationParams['dialogue_id'] = $dialogueId;
	$sendNotification->sendNotification1($notificationParams);

	
	$div2 = '<div class="commentsDiv" id="commentsDiv'.$dialogueId.'">'.
			'<ul>';
	$comments = $groupDao->getDialogueComments($dialogueId);
	while($commentsRow = mysql_fetch_array($comments)){
		$div2 = $div2.$htmlHelper->constructEachComment($commentsRow);
	}
	$div2 = $div2.$htmlHelper->constructEnterCommentSection($buddy, $dialogueId) .'</div>';
	echo $div2;
?>
