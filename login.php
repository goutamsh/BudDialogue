<?php
/*
 * Created on Oct 15, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>BudDialogue - Login page</title>
<link rel="stylesheet" href="stylesheet/default.css" type="text/css">
<link rel="icon" 
      type="image/x-icon" 
      href="images/favicon.ico" />
</head>
<body>


<form action="_signin.php" method="post">
<center>
<table border="2">
<tr><td>
<img src="images/logo.jpg"/>
</td>
<td>
<table width="50%" border="0" cellspacing="0" cellpadding="2" height="78" align="center">
<tr>
				<td class="SECTION_TITLE" colspan="2">
					<div align = "center"><b>  BudDialogue® </b></div>
				</td>
</tr>
<tr>
	<td colspan="2">
		<div align="center">
			<?php 
				if(isset($_GET['msg'])){
					$msg = $_GET['msg'];
					echo $msg;
				}
			?>		
		</div>
	</td>
</tr>
<tr> 
         	<td width="183" height="21"> 
           		<div align="left"><b>UserID</b></div>
         	</td> 
         	<td width="374" height="21"> <b> 
           		<input type="text" name="user">
           	</b></td>
</tr>

<tr> 
         	<td width="183" height="23">
		<div align="left"><b>Password</b></div>
	</td>
         	<td width="374" height="23"><b> 
           		<input type="password" name="password">
	</td>
</tr>

			<tr>
				<td></td>
				<td>
              		<div align = "left"><input type="submit" name="submit" value="Submit" class = "BUTTON_STYLE">
					<input type="reset" value="Reset" name="reset" class = "BUTTON_STYLE"></div>
				</td> 		          
          	</tr>
</table>
</td></tr>
</table></center>
</form>
</body>
</html>