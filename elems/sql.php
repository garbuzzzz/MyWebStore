<?php
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db_name = 'test';
	
	$link = mysqli_connect($host, $user, $password, $db_name);
	mysqli_query($link, "SET names 'utf8'");
?>