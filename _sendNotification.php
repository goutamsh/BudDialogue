<?php
/*
 * Created on Nov 25, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class SendNotification{
 	
 	function sendNotification1($notificationParams) {
		$htmlHelper = new htmlHelper();
  		$buddyName = $notificationParams['who_name'];
  		$buddyId = $notificationParams['who_id'];
		$from = "buddymessenger@bd.com";
		$headers = "From:" . $from ."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$emailParams['what'] = $notificationParams['what'];
		$emailParams['from_name'] = $buddyName;
		if($notificationParams['what'] == 'post'){
			$subject = "Buddy Posted in BD";
			$buddyEmailIDArray = $this->getBuddiesMailIdForPost($buddyId);
		}else if($notificationParams['what'] == 'comment'){
			$subject = "Buddy Commented in BD";
			$buddyEmailIDArray = $this->getBuddyMailIdForComment($notificationParams['dialogue_id'],$buddyId );
		}
		if( count($buddyEmailIDArray) > 0){
				foreach($buddyEmailIDArray as $key => $value) {	
					$emailParams['to_name'] = $key;
					$message = $htmlHelper->constructEmailBody($emailParams);
					mail($value,$subject,$message,$headers);
				}
			}
	}

	function getBuddiesMailIdForPost($buddyId){
		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
	   	$sql = 'select E_MAIL_ID, FIRST_NAME from BUDDIES where BUDDY_ID in (select B.BUDDY_ID from GROUPS_BUDDIES A, GROUPS_BUDDIES B where A.BUDDY_ID='.$buddyId.' and A.GROUP_ID = B.GROUP_ID) and BUDDY_ID not in ('.$buddyId.')';
	   	$result = mysql_query($sql, $con);
	   	$emails_array = array();
	   	while($row = mysql_fetch_array($result)) {
			$emails_array[$row['FIRST_NAME']] = $row['E_MAIL_ID'];
		}
	   	return $emails_array;
	}
	
	function getBuddyMailIdForComment($dialogueId, $buddyId){
		$db = new DbConn();
		$con = $db->getConnection();
	   	mysql_select_db("gshepurc_buddydialogue", $con);
			   	$sql = 'select E_MAIL_ID, FIRST_NAME from BUDDIES B, DIALOGUE D where B.BUDDY_ID = D.WHO_CREATED and D.DIALOGUE_ID = '.$dialogueId.' and B.BUDDY_ID <> '.$buddyId;
	   	$result = mysql_query($sql, $con);
	   	$emails_array = array();
		while($row = mysql_fetch_array($result)) {
			$emails_array[$row['FIRST_NAME']] = $row['E_MAIL_ID'];
		}
	   	return $emails_array;
	}
 }
?>