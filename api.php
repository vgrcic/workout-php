<?php

	session_start();

	require_once 'StatController.php';

	$controller = new StatController;
	$user = null;

	if (!isset($_SESSION['user'])) {
		http_response_code(401); exit;
	} $user = $_SESSION['user'];

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (isset($_GET['stat'], $_GET['increment'])) {
			$controller -> updateStat($_GET['stat'], $_GET['increment'], $user);

		} else if (isset($_GET['name'])) {
			$controller -> createStat($_GET['name'], $user);

		} else if (isset($_GET['stat'])) {
			$controller -> deleteStat($_GET['stat'], $user);

		} else if (isset($_GET['user'])) {
			$controller -> getStats($user);

		} else {
			http_response_code(400); exit;
		}
	}

?>