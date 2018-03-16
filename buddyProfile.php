<?php
/*
 * Created on Jul 19, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
    include('groupDao.php');
 session_start();
	$signedIn = $_SESSION['signed_in'];
   
   if($signedIn == null || $signedIn == false){
   		header("Location: login.php");
   		return;
   }
   $buddyId = $_SESSION['buddyId'];
   $profileId = -1;
   
   if(isset($_GET['profileId'])){
   		$profileId = $_GET['profileId'];
   }

	$groupDao = new GroupDao();
	$buddyProfile = $groupDao->getBuddyByBuddyId($profileId);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="stylesheet" href="stylesheet/default.css" type="text/css">
	<title>BudDialogue - Buddy Profile</title>
	<style type="text/css">
		body {
			margin:0;
			padding:0;
		}
	</style>
	<script type="text/javascript">
		function saveProfileInfo(){
			//alert('Hi');
			if(document.buddyDetailsForm.firstName.value == '' || document.buddyDetailsForm.lastName.value == '' ||
				document.buddyDetailsForm.nickName.value == ''||document.buddyDetailsForm.emailId.value == '' ){
				alert('Please enter all the detils');
				return false;
			}
			if(document.buddyDetailsForm.profilePic.value == ''){
				alert('Please choose the pic to upload');
				return false;
			}
			document.buddyDetailsForm.action = "_saveProfileDetails.php";
			document.buddyDetailsForm.submit();
		}
	</script>
</head>
<?php  include("header.php");?>
<body>
	<table border="0" width="70%" align="center" padding-top="50px">
		<tr>
			<td>
				<div id="layoutDiv">
				<table width="100%">
					<tr>
						<?php if($profileId == $buddyId){ ?>
						<td width="300px">
								<img id="buddyProfilePagePic" src="<?php if($buddyProfile['PROFILE_PIC_PATH'] == 0){
									echo 'images/photo.jpg';
								}else{
									echo 'images/profilePics/b_'.$buddyId.'_pp.jpg';
								}?>"/>
						</td>
						<td>
							<form method="post" enctype="multipart/form-data" name="buddyDetailsForm">
								<input type="hidden" name="buddyId" value="<?php echo $buddyId?>">
							<table>
								<tr>
									<td>
										First Name : <input type="text" name="firstName" value="<?echo $buddyProfile['FIRST_NAME']?>">
									</td>
								</tr>
								<tr>
									<td>
										Last Name : <input type="text" name="lastName" value="<?echo $buddyProfile['LAST_NAME']?>">
									</td>
								</tr>
								<tr>
									<td>
										Nick Name : <input type="text" name="nickName" value="<?echo $buddyProfile['NICK_NAME']?>">
									</td>
								</tr>
								<tr>
									<td>
										Email Id  : <input type="text" name="emailId" value="<?echo $buddyProfile['E_MAIL_ID']?>">
									</td>
								</tr>
								<tr>
									<td>
										Select Profile Pic  : <input size="25" name="profilePic" type="file" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10pt"/>
										<br>
										(Please select .jpg .jpeg .png .gif files only)
									</td>
								</tr>
								<tr>
									<td>
										<input type="button" value="Save" name="Submit" onclick="saveProfileInfo();"/>
									</td>
								</tr>
							</table>
							</form>
						</td>
					
					<?php }else{
					?>
					<td>
						<center><img src="<?php if($buddyProfile['PROFILE_PIC_PATH'] == 0){
									echo 'images/photo.jpg';
								}else{
									echo 'images/profilePics/b_'.$profileId.'_pp.jpg';
								}?>"/>
								</center>
					</td>
				
					<?php }?>
					</tr>
					<tr>
						<td colspan="<?php if($profileId == $buddyId) echo '2'; else echo '1';?>">
							<center><span id='textInfo'><?php 
								 	if(isset($_GET['msg'])){
										$msg = $_GET['msg'];
										echo $msg;
									}
	?></span></center>
						</td>
					</tr>
					<tr>
						<td colspan="<?php if($profileId == $buddyId) echo '2'; else echo '1';?>">
							<center><h5>©Copy Right: BudDialogue - 2012</h5></center>
						</td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>
