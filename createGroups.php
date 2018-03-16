<?php
/*
 * Created on Jun 2, 2012
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
<title>BudDialogue - Create Groups</title>
<link rel="stylesheet" href="stylesheet/default.css" type="text/css">

<script type="text/javascript">
function validate(){
	if(document.createGpForm.groupName.value == ""){
		alert('Please enter group name');
		return false;
	}
	return true;
}
</script>
</head>
<body>
<form name="createGpForm" action="_createGroup.php" method="post" onsubmit="return validate();">
	<table>
	<tr>
		<td>
			Group Name* :
		</td>
		<td>
			<input type="text" name="groupName" maxlength="30"/>
		</td>
	</tr>
	<tr>
		<td>
			Group Description :
		</td>
		<td>
			<textarea name="groupDesc" rows="3" cols="50" wrap="off"></textarea>
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
