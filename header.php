<?php
/*
 * Created on Oct 15, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

   $signedIn = $_SESSION['signed_in'];
   
   if($signedIn == null || $signedIn == false){
   		header("Location: login.php");
   		return;
   }
   $firstName = $_SESSION['FIRST_NAME'];
      $buddyId = $_SESSION['buddyId'];
      $buddy = $groupDao->getBuddyByBuddyId($buddyId);
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
<link rel="stylesheet" href="stylesheet/default.css" type="text/css">

<div id="header">
<table width="70%" align="center"><tr><td>
<div align="left">
<a href="budDialogue.php"><img src="images/logo.jpg" id="bdLogo"></img>&nbsp;&nbsp;<span id="headerDataSpan">BudDialogue</span></a>
</div>
</td>
<td>
<div align="right"><a href="buddyProfile.php?profileId=<?php echo $buddyId?>"><?php if($buddy['PROFILE_PIC_PATH'] == 0){
	echo '<img id="headerProfilePic" src="images/photo.jpg"/>';
}else{
	echo '<img id="headerProfilePic" src="images/profilePics/b_'.$buddyId.'_pp.jpg"/>';
}
?></a>&nbsp;&nbsp;&nbsp;<span id="headerDataSpan"><?php echo $firstName?>
|<a href=_logout.php>Logout</a>|</span></div>
</td>
</tr>
</table>
</div>


