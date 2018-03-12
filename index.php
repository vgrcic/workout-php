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
	<script type="text/javascript">

		function progress(id) {
			var progressInput = document.getElementById('progress-' + id);
			updateStat(id, progressInput.value);
			progressInput.value = '';
		}

		function create() {
			var newStatInput = document.getElementById('newStatInput');
			createStat(newStatInput.value);
			newStatInput.value = '';
		}

		function deleteStat(id) {
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById('stats').removeChild(
						document.getElementById(id)
					);
				}
			}
			ajax.open('GET', 'api.php?stat=' + id, true);
			ajax.send();
		}

		function createStat(statName) {
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var json = JSON.parse(this.responseText);
					document.getElementById('stats').innerHTML +=
							'<div class="stat" id="' + json.id + '">' +
							'<h3>Activity: ' + json.name + '</h3>' +
							'<p>Level: <span id="level-' + json.id + '">' + json.level.id + '</span></p>' +
							'<p>Current points: <span id="current-' + json.id + '">' + json.points + '</span></p>' +
							'<p>Until next level: <span id="remaining-' + json.id + '">' + (json.level.max - json.points) + '</span></p>' +
							'<progress value="' + (json.points - json.level.min) + '"' +
							'		  max="' + (json.level.max - json.level.min) + '"' +
							'		  id="progressbar-' + json.id + '"></progress>' +
							'<input type="text" id="progress-' + json.id + '">' +
							'<button onclick="progress(' + json.id + ')">Progress</button>' +
							'<button onclick="deleteStat(' + json.id + ')">Delete</button>'
						'</div>';
				}
			}
			ajax.open('GET', 'api.php?name=' + statName, true);
			ajax.send();
		}
		
		function updateStat(stat, increment) {
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			    	var json = JSON.parse(this.responseText);
			    	var bar = document.getElementById('progressbar-' + stat);
			    	bar.value = json.points - json.level.min;
			    	bar.max = json.level.max - json.level.min;
			    	document.getElementById('level-' + stat).innerHTML = json.level.id;
			    	document.getElementById('current-' + stat).innerHTML = json.points;
			    	document.getElementById('remaining-' + stat).innerHTML = json.level.max - json.points;
			    }
		  	}
			ajax.open('GET', 'api.php?stat=' + stat + '&increment=' + increment, true);
			ajax.send();
		}

	</script>
	<title>Workout</title>
</head>
<body>

	<div class="stats" id="stats">

		<?php foreach ($stats as $stat) { ?>

		<div class="stat" id="<?php print $stat['id'] ?>">
			<h3>Activity: <?php print $stat['name'] ?></h3>
			<p>Level: <span id="level-<?php print $stat['id'] ?>"><?php print $stat['level']['id'] ?></span></p>
			<p>Current points: <span id="current-<?php print $stat['id'] ?>"><?php print $stat['points'] ?></span></p>
			<p>Until next level: <span id="remaining-<?php print $stat['id'] ?>"><?php print $stat['level']['max'] - $stat['points'] ?></span></p>
			<progress value="<?php print $stat['points']-$stat['level']['min'] ?>"
					  max="<?php print $stat['level']['max']-$stat['level']['min'] ?>"
					  id="progressbar-<?php print $stat['id'] ?>"></progress>
			<input type="text" id="progress-<?php print $stat['id'] ?>">
			<button onclick="progress(<?php print $stat['id'] ?>)">Progress</button>
			<button onclick="deleteStat(<?php print $stat['id'] ?>)">Delete</button>
		</div>

		<?php } ?>

	</div>

	<div>
		<h3>Create new activity</h3>
		<input type="text" id="newStatInput">
		<button onclick="create()">Create</button>
	</div>

</body>
</html>