<?php
	include 'elems/init.php';

	$_SESSION['auth'] = null;
	$_SESSION['id'] = null;
	$_SESSION['status'] = null;
	$_SESSION['user'] = null;
	$_SESSION['user_id'] = null;
	
	header('Location: /'); 
	die();
?>