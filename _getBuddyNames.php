<?php
include ('groupDao.php');
session_start();

$signedIn = $_SESSION['signed_in'];
if ($signedIn == null || $signedIn == false) {
	header("Location: login.php");
	return;
}

header('Content-type: text/plain');
$search_queries = initArray();
$query = $_GET['query'];
$results = search($search_queries, $query);
sendResults($query, $results);

function search($search_queries, $query) {
	if (strlen($query) == 0)
		return;

	$query = strtolower($query);

	$firstChar = $query[0];

	if (!preg_match('/[0-9a-z]/', $firstChar, $matches))
		return;

	$charQueries = $search_queries; //$search_queries[$firstChar];

	$results = array ();

	for ($i = 0; $i < count($charQueries); $i++) {
		if (strcasecmp(substr($charQueries[$i], 0, strlen($query)), $query) == 0)
			$results[] = $charQueries[$i];
	}

	return $results;
}

function sendResults($query, $results) {
	for ($i = 0; $i < count($results); $i++)
		print "$results[$i]\n";
}

function initArray() {
	$groupDao = new GroupDao();

	$buddyId = $_SESSION['buddyId'];
	$result = $groupDao->getBuddyNamesByBuddyIdGroup($buddyId);
	$array1 = array ();
	$i = 0;
	while ($row = mysql_fetch_array($result)) {
		$array1[$i] = $row['FIRST_NAME'] . ' ' . $row['LAST_NAME'];
		$i++;
	}
	return $array1;
}
?>