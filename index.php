<?php

	session_start();
	if (!isset($_SESSION['user'])) {
		header('Location: login.php');
	}

	require_once 'StatRepository.php';
	$statRepository = new StatRepository;
	$stats = $statRepository -> getStats($_SESSION['user']);

?>

<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="js/http.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<title>Workout</title>
</head>
<body>

	<div class="stats" id="stats">

		<?php foreach ($stats as $stat) { ?>

		<div class="stat" id="<?php print $stat['id'] ?>">
			<h3><?php print $stat['name'] ?></h3>
			<p>Level: <span id="level-<?php print $stat['id'] ?>"><?php print $stat['level']['id'] ?></span></p>
			<p>Current points: <span id="current-<?php print $stat['id'] ?>"><?php print $stat['points'] ?></span></p>
			<p>Until next level: <span id="remaining-<?php print $stat['id'] ?>"><?php print $stat['level']['max'] - $stat['points'] ?></span></p>
			<progress value="<?php print $stat['points']-$stat['level']['min'] ?>"
					  max="<?php print $stat['level']['max']-$stat['level']['min'] ?>"
					  id="progressbar-<?php print $stat['id'] ?>"></progress>
			<input type="text" id="progress-<?php print $stat['id'] ?>">
			<button onclick="updateStat(<?php print $stat['id'] ?>)">Progress</button>
			<button onclick="deleteStat(<?php print $stat['id'] ?>)">Delete</button>
		</div>

		<?php } ?>

	</div>

	<div>
		<h3>Create new activity</h3>
		<input type="text" id="newStatInput">
		<button onclick="createStat()">Create</button>
	</div>

</body>
</html>