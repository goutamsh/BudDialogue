<?php
/*
 * Created on Jun 2, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class Buddy{
 	private $buddyId;
 	private $firstName;
 	private $lastName;
 	private $nickName;
 	private $eMail;
 	private $userId;
 	private $accEnabled;
 	private $sex;
 	
 	public function setBuddyId($buddyId1){
 		$this->$buddyId = $buddyId1;
 	}
 	
 	public function setFirstName($firstName1){
 		$this->$firstName = $firstName1;
 	}
 	
 	public function setLstName($lastName1){
 		$this->$lastName = $lastName1;
 	}
 	
 	public function setNickName($nickName1){
 		$this->$nickName = $nickName1;
 	}
 	
 	public function setEMail($eMail1){
 		$this->$eMail = $eMail1;
 	}
 	
 	public function setUserId($userId1){
 		$this->$userId = $userId1;
 	}
 	
 	public function setAccEnabled($accEnabled1){
 		$this->$accEnabled = $accEnabled1;
 	}
 	
 	public function setSex($sex1){
 		$this->$sex = $sex1;
 	}
 	
 	public function getBuddyId(){
 		return $buddyId;
 	}
 	
 	public function getFirstName(){
 		return $firstName;
 	}
 	
 	public function getLstName(){
 		return $lastName;
 	}
 	
 	public function getNickName(){
 		return $nickName;
 	}
 	
 	public function getEMail(){
 		return $eMail;
 	}
 	
 	public function getUserId(){
 		return $userId;
 	}
 	
 	public function getAccEnabled(){
 		return $accEnabled;
 	}
 	
 	public function getSex(){
 		return $sex;
 	}
 }
?>
