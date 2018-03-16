<?php
/*
 * Created on Jun 19, 2012
 * Author: Goutam SH
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 /* A uniqid, like: 4b3403665fea6 */
//printf("uniqid(): %s\r\n", uniqid());

/* We can also prefix the uniqid, this the same as 
 * doing:
 *
 * $uniqid = $prefix . uniqid();
 * $uniqid = uniqid($prefix);
 */
//printf("uniqid('php_'): %s\r\n", uniqid('php_'));

/* We can also activate the more_entropy parameter, which is 
 * required on some systems, like Cygwin. This makes uniqid()
 * produce a value like: 4b340550242239.64159797
 */
 $uni = uniqid();
 echo $uni;
//printf("uniqid('', true): %s\r\n", uniqid('', true));
?>
