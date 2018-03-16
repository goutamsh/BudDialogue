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
$dialogue = $_POST['dialogue'];
$whose_dialogue = $_POST['whose_dialogue'];

$signedIn = $_SESSION['signed_in'];
if ($signedIn == null || $signedIn == false) {
	header("Location: login.php");
	return;
}

$buddyId = $_SESSION['buddyId'];

$result = $groupDao->insertIntoDialogue($dialogue, $buddyId, $whose_dialogue);
//chets-added below lines
$to = $_SESSION['buddyEmailIDArray'];
echo $to;
$subject = "Buddy Posted in BD";
$message = "Hello! Your Buddy posted a dialoge in BD";
$from = "noreply@bd.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//chets - code change end
header("Location: budDialogue.php");
?>