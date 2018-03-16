/*
 * @author goutam.sh
 * contact : goutam.s.h@gmail.com
 */
var limit=0;
YAHOO.namespace("example.container");
YAHOO.example.container.panel2 = new YAHOO.widget.Panel("panel2", { width:"320px", visible:false, draggable:false, close:false,fixedcenter: true } );
function showPplWhoSaidSuper1($dialogId) {
	// Instantiate a Panel from script
	alert($dialogId);
	//YAHOO.example.container.panel2.setHeader("");
	YAHOO.example.container.panel2.setBody("This is a dynamically generated Panel.");
	YAHOO.example.container.panel2.setFooter('<a align="right" href="#" onclick="close12();return false;">Close</a>');
	YAHOO.example.container.panel2.render("container");
	//YAHOO.example.container.panel1.render();
	YAHOO.example.container.panel2.show();
	YAHOO.util.Event.addListener("show2", "click", YAHOO.example.container.panel2.show, YAHOO.example.container.panel2, true);
	YAHOO.util.Event.addListener("hide2", "click", YAHOO.example.container.panel2.hide, YAHOO.example.container.panel2, true);
}
function close12(){
	YAHOO.example.container.panel2.hide();
}

		function checkMsgNSubmit(){

			if(document.postDialogue.dialogue.value == ""){
				alert("Please write the dialogue.");	
				return;
				
			}
			if(document.postDialogue.whose_dialogue.value == ""){
				alert("Please tell us who said so.");	
				return;
				
			}
			document.postDialogue.action = "_postDialoue.php";
			document.postDialogue.submit();
			
		}
//		function submitComment(dialogueId){
//			alert(dialogueId.parent);
//			document.postDialogue.action = "_postComment.php";
//			alert(document.commentForm.action);
//			document.postDialogue.submit();
//			alert('what happened??');
//		}		
		
		function postComment($commentEl,$dialogueId){
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    	//alert(xmlhttp.responseText);
			    	//alert(document.getElementById("commentOuterDiv"+$dialogueId).innerHTML);
			    document.getElementById("commentOuterDiv"+$dialogueId).innerHTML=xmlhttp.responseText;
			    }
			  }
			xmlhttp.open("GET","_postComment.php?comment="+$commentEl.value+"&dialogueId="+$dialogueId,true);
			xmlhttp.send();
		}
		function deleteDialogue($dialogueId){
			var ok = confirm("Do you want to remove the Dialogue ?");
			if(ok != true){
				return;
			}
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    	//alert(document.getElementById("dialogueDiv"+$dialogueId));
			    	//alert(document.getElementById("commentOuterDiv"+$dialogueId));
			    	//alert(document.getElementById("commentOuterDiv"+$dialogueId).innerHTML);
			    	 var div1 = document.getElementById("dialogueAndCommentsDiv"+$dialogueId);
			    	 var li = div1.parentNode;
			    	 li.removeChild(div1);
			    	 li.parentNode.removeChild(li);
			    	//var div2 = document.getElementById("commentOuterDiv"+$dialogueId);
			    	//div2.parentNode.removeChild(div2);
			    }
			  }
			xmlhttp.open("GET","_deleteDialogue.php?dialogueId="+$dialogueId,true);
			xmlhttp.send();
		}
		function showSomeMore(){
			limit = limit+1;
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    	//alert(xmlhttp.responseText);
			    	if(xmlhttp.responseText != ""){
			    		var liEmement = document.createElement("li");
			    		liEmement.innerHTML = xmlhttp.responseText;
			    		document.getElementById("dialogueUi").appendChild(liEmement);
			    	}else{
			    		document.getElementById("noMoreData").style.display = 'block';
			    		document.getElementById("showMore").style.display = 'none';
			    	}
			    	
			    }
			  }
			xmlhttp.open("GET","_showMore.php?limit="+limit,true);
			xmlhttp.send();
		}
		
		function saysSuper($dialogueId){
			//alert('did u Say super ?');
			//alert($dialogueId);
			
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					refreshDialog($dialogueId);
			    }
			 }
			xmlhttp.open("GET","_saySuper.php?dialogueId="+$dialogueId,true);
			xmlhttp.send();
		}
		
		function refreshDialog($dialogueId){
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
			    	//alert(document.getElementById("dialogueDiv"+$dialogueId));
			    	//alert(document.getElementById("commentOuterDiv"+$dialogueId));
			    	//alert(document.getElementById("commentOuterDiv"+$dialogueId).innerHTML);
					
					var dialogueDiv = document.getElementById("dialogueAndCommentsDiv"+$dialogueId);
					var parentOfDialogueDiv = dialogueDiv.parentNode;
					parentOfDialogueDiv.removeChild(dialogueDiv);
					parentOfDialogueDiv.innerHTML=xmlhttp.responseText;
			    	//var div2 = document.getElementById("commentOuterDiv"+$dialogueId);
			    	//div2.parentNode.removeChild(div2);
			    }
			 }
			xmlhttp.open("GET","_getDialogue.php?dialogueId="+$dialogueId,true);
			xmlhttp.send();
		}
		
		function showPplWhoSaidSuper($dialogueId){
			//alert('did u Say super ?');
			//alert($dialogueId);
			//alert($dialogueId);
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					YAHOO.example.container.panel2.setBody(xmlhttp.responseText);
					YAHOO.example.container.panel2.setFooter('<a align="right" href="#" onclick="close12();return false;">Close</a>');
					YAHOO.example.container.panel2.render("container");
					//YAHOO.example.container.panel1.render();
					YAHOO.example.container.panel2.show();
			    }
			 }
			xmlhttp.open("GET","_showPeopleSaidSuper.php?dialogueId="+$dialogueId,true);
			xmlhttp.send();
		}