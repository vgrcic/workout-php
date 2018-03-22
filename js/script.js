function addStat(json) {
	document.getElementById('stats').innerHTML +=
		'<div class="stat" id="' + json.id + '">' +
		'<h3>' + json.name + '</h3>' +
		'<p class="level">Level: <span id="level-' + json.id + '">' + json.level.id + '</span></p>' +
		'<p>Current points: <span id="current-' + json.id + '">' + json.points + '</span></p>' +
		'<p>Until next level: <span id="remaining-' + json.id + '">' + (json.level.max - json.points) + '</span></p>' +
		'<progress value="' + (json.points - json.level.min) + '"' +
		'		   max="' + (json.level.max - json.level.min) + '"' +
		'		   id="progressbar-' + json.id + '"></progress>' +
		'<div class="progress"><input type="text" id="progress-' + json.id + '">' +
		'<button onclick="updateStat(' + json.id + ')">Progress</button></div>' +
		'<button class="delete" onclick="deleteStat(' + json.id + ')">Delete</button>'
	'</div>';
}

function deleteStat(stat) {
	if (confirm('Are you sure you want to delete this activity?')) {
		http.delete('api.php/stats/' + stat, function(data) {
			document.getElementById('stats').removeChild(
				document.getElementById(data)
			);
		});
	}
}

function createStat() {
	var newStatInput = document.getElementById('newStatInput');
	http.post('api.php', 'name=' + newStatInput.value, function(data) {
		addStat(JSON.parse(data));
		newStatInput.value = '';
	});
}

function updateStat(stat) {
	var progressInput = document.getElementById('progress-' + stat);
	if (validProgress(stat)) {
		http.get('api.php?stat=' + stat + '&increment=' + progressInput.value, function(data) {
			var json = JSON.parse(data);
			var bar = document.getElementById('progressbar-' + stat);	
			progressInput.value = '';
			bar.value = json.points - json.level.min;
			bar.max = json.level.max - json.level.min;
			document.getElementById('level-' + stat).innerHTML = json.level.id;
			document.getElementById('current-' + stat).innerHTML = json.points;
			document.getElementById('remaining-' + stat).innerHTML = json.level.max - json.points;
		});
	}
}

function getStats() {
	http.get('api.php/stats', function(data) {
		var stats = JSON.parse(data);
		for (var i = 0; i < stats.length; i++) {
			addStat(stats[i]);
		}
	});
}

function validProgress(id) {
	var progressInput = document.getElementById('progress-' + id);
	var regex = /^[1-9][0-9]*$/;
	if (!regex.test(progressInput.value)) {
		validator.setErrorField(progressInput);
		return false;
	} return true;
}