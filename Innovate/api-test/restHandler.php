<?php
require"../include/DBConnect.php"

$requestMethod = $_SERVER['REQUEST_METHOD'];

if (in_array($requestMethod, ["POST"])) {
	$requestArray = array();

	if

	$sql = "INSERT INTO data(username, password) VALUES (?, ?)";
	
	