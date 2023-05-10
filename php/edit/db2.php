<?php

//ligacao BD
$databaseHost = 'localhost';
$databaseName = 'ciresbio_cires';
$databaseUsername = 'root';
$databasePassword = '';


$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
if ($mysqli->connect_error)
	{
	die("Connection failed: " . $mysqli->connect_error);
	}

?>
