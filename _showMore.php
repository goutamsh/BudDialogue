<?php
/*
 * Created on Jul 1, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 include('groupDao.php');
 include('_htmlHelper.php');
$groupDao = new GroupDao();
$htmlHelper = new htmlHelper();
session_start();
$limit = $_GET['limit'];//$_POST['dialogueId'];


   $signedIn = $_SESSION['signed_in'];
   if($signedIn == null || $signedIn == false){
   		header("Location: login.php");
   		return;
   }
   $firstName = $_SESSION['FIRST_NAME'];
   $lastName = $_SESSION['LAST_NAME'];
   $buddyId = $_SESSION['buddyId'];
   	$buddy = $groupDao->getBuddyByBuddyId($buddyId);
		$dialogues = $groupDao->getDialogues($limit);

	$arrayOfDivs = array();
	$i = 0;
	while($row = mysql_fetch_array($dialogues))
  	{
		$arrayOfDivs[$i] = $htmlHelper->constructDialogWithComment($row, $buddy);
		$i++;
  	}
	for ($index = 0, $max_count = sizeof( $arrayOfDivs ); $index < $max_count; $index++) {
	$array_element = $arrayOfDivs[ $index ];
	if($index != 0)
		echo "<li>";
	echo $array_element;
	if($index != $max_count-1)	
		echo "</li>";
}

	   	
 
?>
