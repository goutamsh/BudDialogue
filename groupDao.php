<?php
/*
 * Created on Jun 3, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
  include('Db.php');
 class GroupDao{
	
 	public function getAllGroups(){
		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select * from GROUPS';
	   	$result = mysql_query($sql, $con);
	   	return $result;
 	}
 	
 	public function getEmailByInvitation($inviteId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select E_MAIL_ID from INVITATION where INVITATION_ID = "'.$inviteId.'"';
	   	$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row['E_MAIL_ID'];
 	}
 	
 	public function checkUserIdExists($userId) {
		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select count(*) as count from BUDDIES where USER_ID = "'.$userId.'"';
	   	$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row['count'];
 	}
 	
 	public function getGroupIdByInvitation($inviteId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select FOR_WHICH_GP as GROUP_ID from INVITATION where INVITATION_ID = "'.$inviteId.'"';
	   	$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row['GROUP_ID'];
 	}
 	
 	public function getBuddyIdByUserId($userId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select BUDDY_ID from BUDDIES where USER_ID = "'.$userId.'"';
	   	$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row['BUDDY_ID'];
 	}
 	
 	public function insertIntoBuddies($firstName, $lastName, $nickName, $emailId, $userId, $password, $gender){
 		 $db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		   $sql  = "INSERT INTO BUDDIES(FIRST_NAME,LAST_NAME,NICK_NAME, E_MAIL_ID, USER_ID, PASSWORD, ACC_ENABLED, SEX ) " .
   		"VALUES('".$firstName."','".$lastName."','".$nickName."','".$emailId."','".$userId."','".$password."','Y','".$gender."')";
   		$result = mysql_query($sql, $con);
	   	return $$result;
 	}
 	
 	public function insertIntoGroupsBuddies($groupId, $buddyId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 			$sql = "INSERT INTO GROUPS_BUDDIES (GROUP_ID, BUDDY_ID) VALUES (".$groupId.",".$buddyId.")"; 
   		$result = mysql_query($sql, $con);
	   	return $$result;
 	}
 	
 	public function insertIntoInvitation($invitationId, $emailId, $buddyId, $groupId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql  = "INSERT INTO INVITATION(INVITATION_ID,E_MAIL_ID,WHO_INVITED,ACCEPTED,FOR_WHICH_GP) " .
   		"VALUES('".$invitationId."','".$emailId."',".$buddyId.",'N',".$groupId.")"; 
   		$result = mysql_query($sql, $con);
	   	return $$result;
 	}
 	
 	public function updateInvitationAccepted($invitationId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql = "UPDATE INVITATION SET ACCEPTED = 'Y' WHERE INVITATION_ID = '".$invitationId."'"; 
   		$result = mysql_query($sql, $con);
	   	return $$result;
 	}
 	
 	public function checkIfInvitationProcessed($invitationId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql = 'select ACCEPTED from INVITATION where INVITATION_ID = "'.$invitationId.'"'; 
   		$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	if($row['ACCEPTED'] == 'Y'){
	   		return true;
	   	}else{
	   		return false;;
	   	}
	   	
 	}
 	
 	public function checkIfValidInvitation($invitationId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql = 'select COUNT(*) as COUNT from INVITATION where INVITATION_ID = "'.$invitationId.'"'; 
   		$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	if($row['COUNT'] > 0){
	   		return true;
	   	}else{
	   		return false;;
	   	}
	   	
 	}
 	
 	 public function getGroupNameByGroupId($groupId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select GROUP_NAME from GROUPS where GROUP_ID = '.$groupId;
	   	$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row['GROUP_NAME'];
 	}
 	
 	public function insertIntoDialogue($dialogue, $buddyId,$whose_dialogue){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql  = "INSERT INTO DIALOGUE(DIALOGUE,WHO_CREATED,WHOSE_DIALOGUE_JUST_NAME,WHEN_CREATED) " .
   		"VALUES('".mysql_real_escape_string($dialogue)."',".$buddyId.",'".mysql_real_escape_string($whose_dialogue)."',NOW())"; 
   		$result = mysql_query($sql, $con);
	   	return $result;
 	}
 	
 	public function getDialogues($limit){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select B.FIRST_NAME as FIRST_NAME, B.LAST_NAME as LAST_NAME, B.PROFILE_PIC_PATH as PROFILE_PIC_PATH, B.BUDDY_ID as BUDDY_ID, D.Dialogue as DIALOGUE,  ' .
	   			'D.WHO_CREATED as WHO_CREATED, D.WHOSE_DIALOGUE_JUST_NAME as WHOSE_DIALOGUE, DATE_FORMAT(D.WHEN_CREATED, "%h:%i %p %a, %D %b %y") as DATE1, D.DIALOGUE_ID as DIALOGUE_ID ' .
	   			' from DIALOGUE D, BUDDIES B Where B.BUDDY_ID = D.WHO_CREATED order by D.WHEN_CREATED DESC' .
	   			' limit '.($limit*10).', 10';
	   	$result = mysql_query($sql, $con) or die(mysql_error());
	   	return $result;
 	}
 	
 	public function getDialogueComments($dialogueId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select B.FIRST_NAME as FIRST_NAME, B.LAST_NAME as LAST_NAME, B.PROFILE_PIC_PATH as PROFILE_PIC_PATH, B.BUDDY_ID as BUDDY_ID, C.COMMENT_ID as COMMENT_ID, C.COMMENT, DATE_FORMAT(C.WHEN_COMMENTED, "%h:%i %p %a, %D %b %y") as WHEN_COMMENTED ' .
	   			' from DIALOGUE D, BUDDIES B, COMMENTS C Where D.DIALOGUE_ID = C.DIALOGUE_ID and B.BUDDY_ID = C.WHO_COMMENTED and D.DIALOGUE_ID ='.$dialogueId.' order by C.WHEN_COMMENTED ASC';
	   	$result = mysql_query($sql, $con);
	   	return $result;
 	}
 	
 	public function insertIntoComment($dialogueId, $comment,$buddyId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql  = "INSERT INTO COMMENTS(DIALOGUE_ID,COMMENT,WHO_COMMENTED,WHEN_COMMENTED) " .
   		"VALUES(".$dialogueId.",'".mysql_real_escape_string($comment)."',".$buddyId.",SYSDATE())"; 
   		$result = mysql_query($sql, $con);
	   	return $result;
 	}
 	public function deleteDialogue($dialogueId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql  = "delete from COMMENTS where DIALOGUE_ID = ".$dialogueId; 
   		$result = mysql_query($sql, $con);
   		$sql = "delete from DIALOGUE where DIALOGUE_ID = ".$dialogueId;
   		$result = mysql_query($sql, $con);
	   	return $result;
 	}
 	
 	public function getBuddyNamesByBuddyIdGroup($buddyId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select FIRST_NAME, LAST_NAME from BUDDIES where BUDDY_ID in (select B.BUDDY_ID from GROUPS_BUDDIES A, GROUPS_BUDDIES B where A.BUDDY_ID='.$buddyId.' and A.GROUP_ID = B.GROUP_ID) ';
	   	$result = mysql_query($sql, $con);
	   	return $result;
 	}
 	
 	 public function getBuddyIdWhoPostedDialogue($dialogueId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select WHO_CREATED from DIALOGUE where DIALOGUE_ID = '.$dialogueId;
	   	$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row['WHO_CREATED'];
 	}
 	
 	public function getBuddyByBuddyId($buddyId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select FIRST_NAME, LAST_NAME, NICK_NAME, E_MAIL_ID, PROFILE_PIC_PATH, BUDDY_ID from BUDDIES where BUDDY_ID = "'.$buddyId.'"';
	   	$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row;
 	}

	public function updateBuddies($buddyId, $firstName, $lastName, $nickName, $emailId, $profilePic){
 		 $db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		   $sql  = "UPDATE BUDDIES set FIRST_NAME = '".$firstName."', LAST_NAME = '".$lastName."', " .
 		   		"NICK_NAME = '".$nickName."', E_MAIL_ID = '".$emailId."', PROFILE_PIC_PATH = ".$profilePic." where BUDDY_ID = ".$buddyId;
   		$result = mysql_query($sql, $con);
	   	return $result;
 	}
 	
 	public function isUserSaidSuperForThisDialog($buddyId, $dialogueId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql = 'select COUNT(*) as COUNT from DIALOGUE_LIKES where DIALOGUE_ID = '.$dialogueId.' and BUDDY_ID = '.$buddyId; 
   		$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	if($row['COUNT'] > 0){
	   		return true;
	   	}else{
	   		return false;;
	   	}
 	}
 	
 	 public function howmanyPplSaidSuperForThisDialog($dialogueId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql = 'select COUNT(*) as COUNT from DIALOGUE_LIKES where DIALOGUE_ID = '.$dialogueId; 
   		$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row['COUNT'];
 	}
 	
 	public function saidSuper($dialogueId, $buddyId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql  = "INSERT INTO DIALOGUE_LIKES(DIALOGUE_ID,BUDDY_ID) " .
   		"VALUES(".$dialogueId.",".$buddyId.")"; 
   		$result = mysql_query($sql, $con);
	   	return $result;
 	}
 	
 	public function getDialogueRow($dialogueId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
 		$sql = 'select B.FIRST_NAME as FIRST_NAME, B.LAST_NAME as LAST_NAME, B.PROFILE_PIC_PATH as PROFILE_PIC_PATH, B.BUDDY_ID as BUDDY_ID, D.Dialogue as DIALOGUE,  ' .
	   			'D.WHO_CREATED as WHO_CREATED, D.WHOSE_DIALOGUE_JUST_NAME as WHOSE_DIALOGUE, DATE_FORMAT(D.WHEN_CREATED, "%h:%i %p %a, %D %b %y") as DATE1, D.DIALOGUE_ID as DIALOGUE_ID ' .
	   			' from DIALOGUE D, BUDDIES B Where B.BUDDY_ID = D.WHO_CREATED and D.DIALOGUE_ID = '.$dialogueId;
   		$result = mysql_query($sql, $con);
	   	$row = mysql_fetch_array($result);
	   	return $row;
 	}
 	
 	public function getPeopleWhoSaidSuper($dialogueId){
 		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select B.FIRST_NAME as FIRST_NAME, B.LAST_NAME as LAST_NAME, B.PROFILE_PIC_PATH as PROFILE_PIC_PATH, B.BUDDY_ID as BUDDY_ID ' .
	   			' from DIALOGUE_LIKES DL, BUDDIES B Where B.BUDDY_ID = DL.BUDDY_ID and DL.DIALOGUE_ID = '.$dialogueId;
	   	$result = mysql_query($sql, $con) or die(mysql_error());
	   	return $result;
 	}
}
?>
