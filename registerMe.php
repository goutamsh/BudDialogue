<?php

/*
 * Created on Jun 19, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include ('groupDao.php');
$invitationId = $_GET['inviteId'];

$groupDao = new GroupDao();

if (!$groupDao->checkIfValidInvitation($invitationId)) {
	$msg = "Invalid Invitation !!";
	header("Location: errorPage.php?msg=" . $msg);
	return;
}
if ($groupDao->checkIfInvitationProcessed($invitationId)) {
	header("Location: login.php");
	return;
}
$emailId = $groupDao->getEmailByInvitation($invitationId);
$groupId = $groupDao->getGroupIdByInvitation($invitationId);
// echo $row['E_MAIL_ID'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>BudDialogue - Buddy Registration</title>
<link rel="stylesheet" href="stylesheet/default.css" type="text/css">
<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
<div class="SECTION_TITLE">
<center><h4>BudDialogue®</h4></center>
</div>
<script type="text/javascript">
function validate(){
	if(document.registerBuddyForm.firstName.value == ""){
		alert('Please enter First Name');
		return false;
	}
	if(document.registerBuddyForm.password.value != document.registerBuddyForm.password2.value){
		alert('Password dont match');
		return false;
	}
	return true;
}

</script>
</head>
<body>
<?php

if (isset ($_GET['msg'])) {
	$msg = $_GET['msg'];
	echo $msg;
}
?>
<form name="registerBuddyForm" action="_registerBuddy.php" method="post" onsubmit="return validate();">
	<input type="hidden" name="inviteId" value="<?php echo $invitationId?>" />
	<input type="hidden" name="groupId" value="<?php echo $groupId?>" />
	<table>
	<tr>
		<td>
			First Name* :
		</td>
		<td>
			<input type="text" name="firstName" maxlength="60"/>
		</td>
	</tr>
		<tr>
		<td>
			Last Name* :
		</td>
		<td>
			<input type="text" name="lastName" maxlength="60"/>
		</td>
	</tr>
		<tr>
		<td>
			Nick Name :
		</td>
		<td>
			<input type="text" name="nickName" maxlength="60"/>
		</td>
	</tr>
	<tr>
		<td>
			E-mail Id* :
		</td>
		<td>
			<input type="text" name="emailId" maxlength="60" value='<?php echo $emailId?>'/>
		</td>
	</tr>
	<tr>
		<td>
			User Id* :
		</td>
		<td>
			<input type="text" name="userId" maxlength="60"/>
		</td>
		<td>
			<input type="button" name="checkUserId" value="Check Availability" onclick="checkUserId()"/>
		</td>
	</tr>
	<tr>
		<td>
			Password* :
		</td>
		<td>
			<input type="password" name="password" maxlength="60"/>
		</td>
	</tr>
	<tr>
		<td>
			Conform Password* :
		</td>
		<td>
			<input type="password" name="password2" maxlength="60"/>
		</td>
	</tr>
	<tr>
		<td>
			Gender * :
		</td>
		<td>
			<select name="gender">
				<option value="0">Select Gender</option>
				<option value="M">Male</option>
				<option value="F">Female</option>
			</select>
		</td>
	</tr>
	</table>

		<input type="submit" value="Submit" />
		<input type="reset" value="Reset" />
	
</form>
<br><br>
</body>
</html>
