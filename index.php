<?php

	session_start();
	if (!isset($_SESSION['user'])) {
		header('Location: login.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/http.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<title>Workout</title>
</head>
<body>

	<div class="main">

		<a class="logout" href="logout.php">Log out</a>

		<h1>Workout</h1>

		<div class="create">
			<h2>Create new activity</h3>
			<input type="text" id="newStatInput" placeholder="Activity name">
			<button onclick="createStat()">Create</button>			
		</div>		

		<div class="stats" id="stats"></div>

	</div>

</body>
</html>