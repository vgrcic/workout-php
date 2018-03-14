<?php

	session_start();

	require_once 'StatController.php';

	$controller = new StatController;
	$user = null;

	if (!isset($_SESSION['user'])) {
		http_response_code(401); exit;
	} $user = $_SESSION['user'];



	if (isset($_GET['stat'], $_GET['increment'])) {
		$controller -> updateStat($_GET['stat'], $_GET['increment'], $user);

	} else if (isset($_POST['name'])) {
		$controller -> createStat($_POST['name'], $user);

	} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		$stat = trim($_SERVER['PATH_INFO'], '/stats/');
		$controller -> deleteStat($stat, $user);

	} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if ($_SERVER['PATH_INFO'] == '/stats')
			$controller -> getStats($user);

	} else {
		http_response_code(400); exit;
	}


?>