<?php
/*
 * Created on Oct 14, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  include('groupDao.php');
 include('_htmlHelper.php');
	$groupDao = new GroupDao();
	$htmlHelper = new htmlHelper();
	session_start();
	$dialogueId = $_GET['dialogueId'];//$_POST['dialogueId'];

   	$signedIn = $_SESSION['signed_in'];
   	if($signedIn == null || $signedIn == false){
   		header("Location: login.php");
   		return;
   	}
   	$buddyId = $_SESSION['buddyId'];
    $pplSaidSuper = $groupDao->getPeopleWhoSaidSuper($dialogueId);
    
    
   	$pplSaidSuperHtmlString = $htmlHelper->constuctListOfPplSaidSuper($pplSaidSuper);
    

	echo $pplSaidSuperHtmlString;
?>
