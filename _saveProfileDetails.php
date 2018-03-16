<?php
/*
 * Created on Jul 20, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

error_reporting(0);
include ('groupDao.php');
$groupDao = new GroupDao();
$buddyId = $_POST['buddyId'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$nickName = $_POST['nickName'];
$emailId = $_POST['emailId'];
//echo $buddyId.' '.$firstName.' '.$lastName.' '.$nickName.' '. $emailId;
$change="";
$abc="";


 define ("MAX_SIZE","4000");
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 $errors=0;
  
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
 	$image =$_FILES["profilePic"]["name"];
	$uploadedfile = $_FILES['profilePic']['tmp_name'];
     
 
 	if ($image) 
 	{
 	
 		$filename = stripslashes($_FILES['profilePic']['name']);
 		//echo $filename;
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
		
		
 		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
			$msg = 'Error saving profile info. Profile Pic is in invalid format';
 			$errors=1;
 		}
 		else
		{
			
			 $size=filesize($_FILES['profilePic']['tmp_name']);
			
			
			if ($size > MAX_SIZE*1024)
			{
				$msg = 'Error saving profile info. Profile Pic should not be greater than 4 MB';
				$errors=1;
			}
			if($errors == 0){
				if($extension=="jpg" || $extension=="jpeg" )
				{
					$uploadedfile = $_FILES['profilePic']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);
					
				}
				else if($extension=="png")
				{
					$uploadedfile = $_FILES['profilePic']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				
				}
				else 
				{
					$src = imagecreatefromgif($uploadedfile);
				}
				
				//echo $scr;
				
				list($width,$height)=getimagesize($uploadedfile);
				/*
				if($width >= $height){
					$newwidth=60;
					$newheight=($height/$width)*$newwidth;
					
					$newwidth1=45;
					$newheight1=($height/$width)*$newwidth1;
				
					$newwidth2=250;
					$newheight2=($height/$width)*$newwidth2;
					
					$newwidth3=30;
					$newheight3=($height/$width)*$newwidth3;
				}else{
					$newheight=60;
					$newwidth=($width/$height)*$newheight;
					
					$newheight1=45;
					$newwidth1=($width/$height)*$newheight1;
				
					$newheight2=250;
					$newwidth2=($width/$height)*$newheight2;
						
					$newheight3=30;
					$newwidth3=($width/$height)*$newheight3;
				}
				
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				
				$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
				
				$tmp2=imagecreatetruecolor($newwidth2,$newheight2);
				
				$tmp3=imagecreatetruecolor($newwidth3,$newheight3);
				
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				
				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
				
				imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);
				
				imagecopyresampled($tmp3,$src,0,0,0,0,$newwidth3,$newheight3,$width,$height);
				
				$filename = "images/profilePics/b_". $buddyId.'_pp.jpg';
				
				$filename1 = "images/profilePics/b_". $buddyId.'_dp.jpg';
				
				$filename2 = "images/profilePics/b_". $buddyId.'_c.jpg';
				
				$filename3 = "images/profilePics/b_". $buddyId.'_hp.jpg';
				*/
				$newwidth=400;
				$newheight=($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				$filename = "images/profilePics/b_". $buddyId.'_pp.jpg';
				imagejpeg($tmp,$filename,100);
				//imagejpeg($tmp1,$filename2,100);
				//imagejpeg($tmp2,$filename,100);
				//imagejpeg($tmp3,$filename3,100);
				
				imagedestroy($src);
				imagedestroy($tmp);
				//imagedestroy($tmp1);
				//imagedestroy($tmp2);
				//imagedestroy($tmp3);
			}
			
}}

}

//If no errors registred, print the success message
 if($errors) 
 {
   
   header("Location: buddyProfile.php?msg=".$msg);
   return;
 }else{
 	$msg = 'Profile Info saved.';
 	$result = $groupDao->updateBuddies($buddyId, $firstName, $lastName, $nickName, $emailId, 1);
 	header("Location: buddyProfile.php?msg=".$msg);
 }
 
?>
