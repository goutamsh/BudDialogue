<?php

/*
 * Created on Jun 25, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

include ('groupDao.php');
$groupDao = new GroupDao();
session_start();
$dialogueId = $_GET['dialogueId'];

$signedIn = $_SESSION['signed_in'];
if ($signedIn == null || $signedIn == false) {
	header("Location: login.php");
	return;
}

$buddyId = $_SESSION['buddyId'];
$whoPosted = $groupDao->getBuddyIdWhoPostedDialogue($dialogueId);
if($buddyId != $whoPosted){
	$msg = "Invalid Permissions !!";
	header("Location: errorPage.php?msg=".$msg);
	return;
}
$result = $groupDao->deleteDialogue($dialogueId);
?>
