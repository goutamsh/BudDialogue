<?php

/*
 * Created on Oct 16, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

session_start();
session_destroy();
header("Location: login.php?msg=You have successfully Logged out.");
?>
