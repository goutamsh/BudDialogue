<?php
/*
 * Created on Jun 2, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 header('Refresh: 300');
   session_start();
   $signedIn = $_SESSION['signed_in'];
   
   if($signedIn == null || $signedIn == false){
   		header("Location: login.php");
   		return;
   }

   $userId = $_SESSION['userId'];
   $buddyId = $_SESSION['buddyId'];


	include('groupDao.php');
	include('_htmlHelper.php');
	$groupDao = new GroupDao();
	$htmlHelper = new htmlHelper($groupDao);
	$buddy = $groupDao->getBuddyByBuddyId($buddyId);
	$dialogues = $groupDao->getDialogues(0);
	//echo $tweets;
	$arrayOfDivs = array();
	$i = 0;
	while($row = mysql_fetch_array($dialogues))
  	{
		$arrayOfDivs[$i] = $htmlHelper->constructDialogWithComment($row, $buddy);
		$i++;
  	}
  	
//  	$sendNotification = $_SESSION['sendNotification'];
//  	if($sendNotification == "Y") {
//  		$buddyName = $_SESSION['FIRST_NAME'];
//  		//chets-added below lines
//		$buddyEmailIDArray = $_SESSION['buddyEmailIDArray'];
//		$subject = "Buddy Posted in BD";
//		$from = "buddymessenger@bd.com";
//		$headers = "From:" . $from ."\r\n";
//		$headers .= "MIME-Version: 1.0\r\n";
//		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//		foreach($buddyEmailIDArray as $key => $value) {	
//			$message = '<html><body>';
//			$message .= '<img src="http://gshepur.com/BudDialogue/images/BDHeader.png"/>';
//			$message .= '<p><font size="6" face="Andalus" color="royalblue">Dear ' . $key . ',';
//			$message .= '<p>Your Buddy <b>' . $buddyName . '</b> has posted a Dialogue ! <a href="http://gshepur.com/BudDialogue/budDialogue.php"> Check Now !!! </a><p>Thanks,<br>Buddy Messenger</font><p><i>This is a system generated email. Do not reply to this email</i>';
//			$message .= '<p><br><hr><p><center><a href="http://gshepur.com/BudDialogue/budDialogue.php" target="_blank"><img src="http://gshepur.com/BudDialogue/images/BDFooter.png"/></a></center><p><center>Copyright&copy;2012-2013 Best Buddies, All rights reserved.</body></html>'; 
//			mail($value,$subject,$message,$headers);
//		}
//		
//		$_SESSION['sendNotification'] = "N";  	
//  	}

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>BudDialogue - Dialogues Page</title>

	<link rel="stylesheet" href="stylesheet/default.css" type="text/css">
	
	
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/container/assets/skins/sam/container.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.9.0/build/container/container-min.js"></script>
	

	<link rel="stylesheet" type="text/css" href="stylesheet/yui/fonts-min.css" />
	<link rel="stylesheet" type="text/css" href="stylesheet/yui/autocomplete.css" />
	<script type="text/javascript" src="js/yui/yahoo-dom-event.js"></script>
	<script type="text/javascript" src="js/yui/connection-min.js"></script>
	<script type="text/javascript" src="js/yui/animation-min.js"></script>
	<script type="text/javascript" src="js/yui/datasource-min.js"></script>
	<script type="text/javascript" src="js/yui/autocomplete-min.js"></script>
	<script type="text/javascript" src="js/bdJS.js"></script>
	
<style type="text/css">
#myAutoComplete {
    width:25em; /* set width here or else widget will expand to fit its container */
    padding-bottom:2em;
}
body {
	margin:0;
	padding:0;
}
</style>	
</head>
<?php include("header.php");?>
<body class="yui-skin-sam" id="BDbodyId">
	<table border="2" width="70%" align="center" padding-top="50px">
	<tr>
		<td>
		<div id="layoutDiv">
			<?php
			   if($userId == 'sso'){
			   	?>
			   	<a href='createGroups.php'>Create Groups</a><br>
			   	<a href='inviteBuddy.php'>Invite Buddy</a><br>
			   	<a href='registerMe.php?inviteId=bestBuddy_4fe0bc1a9896b'>Register Buddy</a>
			   	<?
			   }
			?>
			<form name="postDialogue" method="post">
				<textarea rows="3" cols="80" name="dialogue" id="dialogueTextArea" placeholder="Enter the dialogue"></textarea>
			
				<div id="myAutoComplete">
					<input id="authorInput" type="text" name="whose_dialogue" placeholder="Who said so ?">
					<div id="myContainer"></div>
				</div>
				<input type="button" value="Post Dialogue" class = "BUTTON_STYLE" onclick="checkMsgNSubmit()">
			</form>
			<div id="panelShowPplSaidSuper">
			</div>
			<div id="container">
			</div>
			<center>
			<table width="100%">
				<tr>
					<td>
						<table align="left" border="0" width="80%" id="dialogueTable">
							<tr>
								<td>
									<ul id="dialogueUi">
										<?php 
										  	for ($index = 0, $max_count = sizeof( $arrayOfDivs ); $index < $max_count; $index++) {
											$array_element = $arrayOfDivs[ $index ];
											?>
												<li>
													<?php echo $array_element?>
												</li>
											<?php 
											  }
											?>
									</ul>	
									
								</td>
							</tr>						
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<center>
							<div id="noMoreData" class="noMoreData" style="display:none;">
								<span id="infoText">No More Data</span>
							</div>
							<div id="showMore">
								<a href="#" onclick="showSomeMore(); return false;">Show More</a>
							</div>
						</center>
					</td>
				</tr>
				<tr>
					<td>
						<center><h5>©Copy Right: BudDialogue - 2012</h5></center>
					</td>
				</tr>
			</table>
			</center>
			</div>
		</td>
	</tr>
</table>
</body>
<script type="text/javascript">
YAHOO.example.BasicRemote = function() {
    // Use an XHRDataSource
    var oDS = new YAHOO.util.XHRDataSource("_getBuddyNames.php");
    // Set the responseType
    oDS.responseType = YAHOO.util.XHRDataSource.TYPE_TEXT;
    // Define the schema of the delimited results
    oDS.responseSchema = {
        recordDelim: "\n",
        fieldDelim: "\t"
    };
    // Enable caching
    oDS.maxCacheEntries = 5;

    // Instantiate the AutoComplete
    var oAC = new YAHOO.widget.AutoComplete("authorInput", "myContainer", oDS);
    
    return {
        oDS: oDS,
        oAC: oAC
    };
}();
</script>
</html>