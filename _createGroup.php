<?php
/*
 * Created on Jun 2, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
	include('Db.php');
	session_start();
	$groupName = $_POST['groupName'];
	$groupDesc = $_POST['groupDesc'];
	$buddyId = $_SESSION['buddyId'];
 
   	$sql  = "INSERT INTO GROUPS(GROUP_NAME,DESCRIPTION,WHO_CREATED,WHEN_CREATED) " .
   		"VALUES('".$groupName."','".$groupDesc."',".$buddyId.", SYSDATE())";
   	$db = new DBConn();
   	$con = $db ->getConnection();

   	mysql_select_db("gshepurc_buddydialogue", $con);
   	$result = mysql_query($sql, $con);
   	header("Location: budDialogue.php");
 	
?>
