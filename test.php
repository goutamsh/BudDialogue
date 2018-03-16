<?php

include('groupDao.php');
$groupDao = new GroupDao();
$groups = $groupDao->getAllGroups();
while($row = mysql_fetch_array($groups))
{
	echo $row['GROUP_NAME'] ." ". $row['DESCRIPTION'];
}
?>