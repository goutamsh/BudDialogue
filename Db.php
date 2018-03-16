<?php
/*
 * Created on Jun 2, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class DBConn{
 	public function getConnection(){
 		$con = mysql_connect('localhost:2083', 'gshepurc_buddy', 'gshepurc_buddy');
 		if (!$con)
	  	{
	  		die('Could not connect to database : ' . mysql_error());
	  	}
	  	return $con;
 	}
 }
?>