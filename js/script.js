function addStat(json) {
	document.getElementById('stats').innerHTML +=
		'<div class="stat" id="' + json.id + '">' +
		'<h3>' + json.name + '</h3>' +
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