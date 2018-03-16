<?php

/*
 * Created on Jun 25, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

include ('groupDao.php');
 include('_htmlHelper.php');
include ('_sendNotification.php');
$groupDao = new GroupDao();
session_start();
$dialogue = $_POST['dialogue'];
$whose_dialogue = $_POST['whose_dialogue'];

$signedIn = $_SESSION['signed_in'];
if ($signedIn == null || $signedIn == false) {
	header("Location: login.php");
	return;
}

$buddyId = $_SESSION['buddyId'];

$result = $groupDao->insertIntoDialogue($dialogue, $buddyId, $whose_dialogue);
$notificationParams = array();
$notificationParams['who_name'] = $_SESSION['FIRST_NAME'];
$notificationParams['who_id'] = $buddyId;
$notificationParams['what'] = 'post';
//$notificationParams['emailIds'] = $_SESSION['buddyEmailIDArray'];
$sendNotification = new SendNotification();
$sendNotification->sendNotification1($notificationParams);
flush();
//$_SESSION['sendNotification'] = "Y";
header("Location: budDialogue.php");
?>