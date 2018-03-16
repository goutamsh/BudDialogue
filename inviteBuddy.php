<?php
/*
 * Created on Jun 19, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  include('groupDao.php');
  session_start();

  $userId = $_SESSION['userId'];
 	if($userId != 'sso'){
		header("Location: login.php");
		return;
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>BudDialogue - Invite Buddy</title>
<link rel="stylesheet" href="stylesheet/default.css" type="text/css">

<script type="text/javascript">
function validate(){
	if(document.inviteBuddyForm.emailId.value == ""){
		alert('Please enter Email Id');
		return false;
	}
	return true;
}
</script>

</head>
<body>
<?php 
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		echo $msg;
	}
?>
<form name="inviteBuddyForm" action="_inviteBuddy.php" method="post" onsubmit="return validate();">
	<table>
	<tr>
		<td>
			E-mail Id* :
		</td>
		<td>
			<input type="text" name="emailId" maxlength="60"/>
		</td>
	</tr>
	<tr>
		<td>
			Group :
		</td>
		<td>
			<select name="group">
				<option value="0">Select Group</option>
			<?php 
					$groupDao = new GroupDao();
					$groups = $groupDao->getAllGroups();
					while($row = mysql_fetch_array($groups))
  					{
			?>
						<option value="<?php echo $row['GROUP_ID'] ?>"><?php echo $row['GROUP_NAME'] ?></option>
			<?php }
			?>
			</select>		
		</td>
	</tr>
	
	</table>

		<input type="submit" value="Submit" />
		<input type="reset" value="Reset" />
	
</form>
<h3>Groups</h3>
<br><br>
<table>
<?php
	$groupDao = new GroupDao();
	$groups = $groupDao->getAllGroups();
	while($row = mysql_fetch_array($groups))
  	{
?>
		<tr>
			<td>
				<?php echo $row['GROUP_NAME'] ?> 
			</td>
						<td>
				<?php echo $row['DESCRIPTION'] ?> 
			</td>
		</tr>
		
<?php 
  	}
  ?>
</table>
</body>
</html>
