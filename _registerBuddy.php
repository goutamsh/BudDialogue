<?php

/*
 * Created on Jun 2, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ('groupDao.php');
$groupDao = new GroupDao();
session_start();
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$nickName = $_POST['nickName'];
$emailId = $_POST['emailId'];
$userId = $_POST['userId'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$groupId = $_POST['groupId'];
$invitationId = $_POST['inviteId'];
if ($groupDao->checkUserIdExists($userId) > 0) {
	$msg = "User Id is not available. Please use another one !!";
	header("Location: registerMe.php?inviteId=" . $invitationId . "&msg=" . $msg);
	return;
}
$result = $groupDao->insertIntoBuddies($firstName, $lastName, $nickName, $emailId, $userId, $password, $gender);
$buddyId = $groupDao->getBuddyIdByUserId($userId);

$result = $groupDao->insertIntoGroupsBuddies($groupId, $buddyId);
$result = $groupDao->updateInvitationAccepted($invitationId);
//echo 'Hi'.$result;
header("Location: budDialogue.php");
?>
