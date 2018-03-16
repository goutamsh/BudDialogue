<?php

/*
 * Created on Oct 16, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 *
 */

include ('Db.php');

$username = $_POST['user'];
$password = ($_POST['password']);
//echo $username.'hi';
if ($username == '' && $password == '') {
	header("Location: login.php");
	return;
}

//function getBuddyEmailID($loggedInUserId) {
//
//	//chets-added below lines
//	$getEmailIDSQL = "SELECT E_MAIL_ID, FIRST_NAME ";
//	$getEmailIDSQL .= "FROM BUDDIES ";
//	$getEmailIDSQL .= "WHERE USER_ID IN ('sso','ram') ";
//	//chets-end
//	
//	$db = new DBConn();
//	$con = $db->getConnection();
//	mysql_select_db("gshepurc_buddydialogue", $con);
//
//	//chets-added below lines
//	$emails_array = array();
//	$getEmailIDResult = mysql_query($getEmailIDSQL, $con);
//	while($row = mysql_fetch_array($getEmailIDResult)) {
//		$emails_array[$row['FIRST_NAME']] = $row['E_MAIL_ID'];
//	}
//	$commaDelimitedEmailID = implode(",",$emails_array);
//	
//	//chets-end
//	mysql_close($con);
//	
//	return $emails_array;
//
//}

$sql = "SELECT * ";
$sql .= "FROM BUDDIES ";
$sql .= "WHERE USER_ID='" . $username . "' AND PASSWORD='" . $password . "'";




$db = new DBConn();
$con = $db->getConnection();
//  $con = mysql_connect('localhost', 'root', '');
// 		if (!$con)
//	  	{
//	  		die('Could not connect to database : ' . mysql_error());
//	  	}

mysql_select_db("gshepurc_buddydialogue", $con);
$result = mysql_query($sql, $con);
$row = mysql_fetch_array($result);
$validateUser = $row['USER_ID'];
$validatePass = $row['PASSWORD'];





//$stmt = $pdo->prepare($sql);
//$stmt->execute(array(
//          ":u"=>$username,
//          ":p"=>$password
//        ));
//$row = $stmt->fetch();

// clear out any existing session that may exist
session_start();
session_destroy();
session_start();

if ($username == $validateUser && $password == $validatePass) {
	//$_SESSION['buddyEmailIDArray'] = getBuddyEmailID($validateUser);
	$_SESSION['signed_in'] = true;
	$_SESSION['sendNotification'] = "N";
	$_SESSION['userId'] = $row['USER_ID'];
	$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
	$_SESSION['LAST_NAME'] = $row['LAST_NAME'];
	$_SESSION['buddyId'] = $row['BUDDY_ID'];
	//chets - added below line
	$_SESSION['buddyEmailID'] = $row['E_MAIL_ID'];
	//chets - end
	//echo 'yes';
	header("Location: budDialogue.php");
	return;
} else {
	$_SESSION['flash_error'] = "Invalid username or password";
	$_SESSION['signed_in'] = false;
	$_SESSION['username'] = null;
	header("Location: login.php?msg=Invalid UserId or Password.");
	return;
}
?>
	