<?php
	require_once '../bootstrap.php';

	session_start();

	Auth::logoutUser();
	header('Location: index.php');
	exit;

?>
