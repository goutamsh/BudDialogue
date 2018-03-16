<?php
/*
 * Created on Oct 7, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
	

 class htmlHelper {
 	
 	public function constructDialogElement($dialog, $buddyId) {
	$groupDao = new GroupDao();
	$superStringDisplay = '';
	$howmanyPeopleSaidSuperStrDisplay = '';
	$howmanySaidSuper = $groupDao->howmanyPplSaidSuperForThisDialog($dialog["DIALOGUE_ID"]);
	if(!$groupDao->isUserSaidSuperForThisDialog($buddyId, $dialog["DIALOGUE_ID"])){
		$superStringDisplay = '<a id="superLink" href="#" onclick="saysSuper('.$dialog["DIALOGUE_ID"].');return false" title="Say Super"><img id="dialogSuperImgLnk" src="images/super.jpg"/></a>';
	}
	
	if($howmanySaidSuper > 0){
		$singularOrPlural = '';
		if($howmanySaidSuper == 1){
			$singularOrPlural = 'Person';
		}else{
			$singularOrPlural = 'People';
		}
		$howmanyPeopleSaidSuperStrDisplay = '<span id="superLink"><a href="#" onclick="showPplWhoSaidSuper('.$dialog["DIALOGUE_ID"].');return false;">'.$howmanySaidSuper.' '.$singularOrPlural.'</a> Said <img id="dialogSuperImgLnk" src="images/super.jpg"/> !! </span>';
	}
	
	$div = '<div class="divStyle" id="dialogueDiv'.$dialog['DIALOGUE_ID'].'">';
  		
  		if($buddyId == $dialog['WHO_CREATED']){
  			$div =	$div.'<a href="#" onclick="deleteDialogue('.$dialog["DIALOGUE_ID"].'); return false;"><img id="img1" src="images/close.png"/></a>';
  		}
		$div =	$div.'<table id="table2">'.
				'<tr>'.
					'<td width="70px">';
		if($dialog['PROFILE_PIC_PATH'] == 0){
			$div .= '<a href="buddyProfile.php?profileId='.$dialog['BUDDY_ID'].'"><img id="dialoguePostPic" src="images/photo.jpg"/></a>';
		}else{
			$div .= '<a href="buddyProfile.php?profileId='.$dialog['BUDDY_ID'].'"><img id="dialoguePostPic" src="images/profilePics/b_'.$dialog['BUDDY_ID'].'_pp.jpg"/></a>';
		}
		$div .=	'</td>'.
					'<td >'.
					'<a href="buddyProfile.php?profileId='.$dialog['BUDDY_ID'].'"><span id="nameDisplay">'.
						$dialog['FIRST_NAME'].' '.$dialog['LAST_NAME'].'  '.
						'</span></a><br>' .
						$dialog['DIALOGUE'].
					'</td>'.
				'</tr>'.
				'<tr height="15px">'.
					'<td>'.
					'</td>'.
					'<td>'.$superStringDisplay.'   '.$howmanyPeopleSaidSuperStrDisplay.
						'<div id="authorDiv"><center><span id="authorNameDisplay">-'.$dialog['WHOSE_DIALOGUE'].'</span><br>' .
								$dialog['DATE1'].'</center></div>'.
					'</td>'.
				'</tr>'.
			'</table>'.
		'</div>';
		return $div;
		
	}
	
	public function constructEachComment($comment) {
		
			$div2 = '<li>' .
					'<div class="eachCommentDivStyle" id="eachCommentDivStyle'.$comment['COMMENT_ID'].'"><table><tr><td width="50px">' ;
			if($comment['PROFILE_PIC_PATH'] == 0){
				$div2 .= '<a href="buddyProfile.php?profileId='.$comment['BUDDY_ID'].'"><img id="commentPic" src="images/photo.jpg"/></a>';
			}else{
				$div2 .= '<a href="buddyProfile.php?profileId='.$comment['BUDDY_ID'].'"><img id="commentPic" src="images/profilePics/b_'.$comment['BUDDY_ID'].'_pp.jpg"/></a>';
			}
				$div2 .=	'</td><td>' .
							'<a href="buddyProfile.php?profileId='.$comment['BUDDY_ID'].'"><span id="commentsNameDisplay">' .
								$comment['FIRST_NAME'].' '.$comment['LAST_NAME'].'</span></a>'.'  '.$comment['COMMENT'].
							'</td></tr>' .
							'<tr>' .
							'<td></td>' .
							'<td>' .
							'<div id="authorDiv"><center><span id="commentsTime">'.$comment['WHEN_COMMENTED'].'</span></center></div>' .
							'</td>' .
							'</tr></table></div></li>';

			return $div2;	
	}
	
	public function constructEnterCommentSection($buddy, $dialogId) {
	
		$div2 = '<li>' .
				'<table><tr><td width="50px">';
			if($buddy['PROFILE_PIC_PATH'] == 0){
				$div2 .= '<a href="buddyProfile.php?profileId='.$buddy['BUDDY_ID'].'"><img id="enterCommentPic" src="images/photo.jpg"/></a>';
			}else{
				$div2 .= '<a href="buddyProfile.php?profileId='.$buddy['BUDDY_ID'].'"><img id="enterCommentPic" src="images/profilePics/b_'.$buddy['BUDDY_ID'].'_pp.jpg"/></a>';
			}
				$div2.=	'</td><td>'.
						'<form name="commentForm" method="post" action="_postComment.php">' .
							'<input type="hidden" name="dialogueId" value="'.$dialogId.'"/><textarea id="enterCommentTextArea" name="comment" row="1" cols="40" onkeyup="Javascript: if(event.keyCode == 13) postComment(this,'.$dialogId.');" placeholder="Enter your comment"></textarea>' .
						'</form>' .
						'</td></tr></table></li>';
		return $div2;
	}
	
	public function constructDialogWithComment($dialog, $buddy) {
		$groupDao = new GroupDao();
		$div = '<div class="dialogueAndCommentsDiv" id="dialogueAndCommentsDiv'.$dialog['DIALOGUE_ID'].'">';
		$div .= $this->constructDialogElement($dialog, $buddy['BUDDY_ID']);
		$div .= '<div id="commentOuterDiv'.$dialog['DIALOGUE_ID'].'"><div class="commentsDiv" id="commentsDiv'.$dialog['DIALOGUE_ID'].'">' .
				'<ul>';
		$comments = $groupDao->getDialogueComments($dialog['DIALOGUE_ID']);
		while($commentsRow = mysql_fetch_array($comments)){
				$div .= $this->constructEachComment($commentsRow);
		}
		$div .= $this->constructEnterCommentSection($buddy, $dialog['DIALOGUE_ID']);
		$div .= '</ul></div></div></div>';
		return $div;
		
	}
	
	public function constuctListOfPplSaidSuper($pplSaidSuper){
		$div = '<table>';
		while($row = mysql_fetch_array($pplSaidSuper)){
			$profilePic = '';
					if($row['PROFILE_PIC_PATH'] == 0){
						$profilePic = '<a href="buddyProfile.php?profileId='.$row['BUDDY_ID'].'"><img id="picInPanel" src="images/photo.jpg"/></a>';
					}else{
						$profilePic = '<a href="buddyProfile.php?profileId='.$row['BUDDY_ID'].'"><img id="picInPanel" src="images/profilePics/b_'.$row['BUDDY_ID'].'_pp.jpg"/></a>';
					}
			$displayName = '<a href="buddyProfile.php?profileId='.$row['BUDDY_ID'].'"><span id="nameDisplay">'.
						$row['FIRST_NAME'].' '.$row['LAST_NAME'].'</span></a>';
			$div .= '<tr>' .
						'<td>' .$profilePic.'</td>' .
						'<td>'.$displayName.'</td>';
		}
		$div.= '</table>';
		return $div;
	}
	
	public function constructEmailBody($params){
		
			if($params['what'] == 'post'){
				$postOrComment = 'posted a Dialogue';
			}else if ($params['what'] == 'comment'){
				$postOrComment = 'commented on your post';
			}
			$message = '<html><body>';
			$message .= '<img src="http://gshepur.com/BudDialogue/images/BDHeader.png"/>';
			$message .= '<p><font size="6" face="Andalus" color="royalblue">Dear ' . $params['to_name'] . ',';
			$message .= '<p>Your Buddy <b>' . $params['from_name'] . '</b> '.$postOrComment.' ! <a href="http://gshepur.com/BudDialogue/budDialogue.php"> Check Now !!! </a><p>Thanks,<br>Buddy Messenger</font><p><i>This is a system generated email. Do not reply to this email</i>';
			$message .= '<p><br><hr><p><center><a href="http://gshepur.com/BudDialogue/budDialogue.php" target="_blank"><img src="http://gshepur.com/BudDialogue/images/BDFooter.png"/></a></center><p><center>Copyright&copy;2012-2013 Best Buddies, All rights reserved.</body></html>';
			
			return  $message;
	}
 }
?>