<?php

	session_start();

	require_once 'StatController.php';
	require_once 'UserController.php';

	$statcontroller = new StatController;
	$userController = new UserController;
	$user = null;

	if (isset($_SERVER['PATH_INFO']) && preg_match('#/users/username=([^/]*)/exists#', $_SERVER['PATH_INFO'], $matches)) {
		$userController -> exists($matches[1]); exit;
	}



	if (!isset($_SESSION['user'])) {
		http_response_code(401); exit;
	}



	if (isset($_GET['stat'], $_GET['increment'])) {
		$statcontroller -> updateStat($_GET['stat'], $_GET['increment']);

	} else if (isset($_POST['name'])) {
		$statcontroller -> createStat($_POST['name']);

	} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		$stat = trim($_SERVER['PATH_INFO'], '/stats/');
		$statcontroller -> deleteStat($stat);

	} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if ($_SERVER['PATH_INFO'] == '/stats')
			$statcontroller -> getStats();

	} else {
		http_response_code(400); exit;
	}


?>