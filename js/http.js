function http(method, url, callback) {
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			callback(this.responseText);
		}
	}
	ajax.open(method, url, true);
	ajax.send();
}

function deleteStat(stat) {
	http('GET', 'api.php?stat=' + stat, function(data) {
		document.getElementById('stats').removeChild(
			document.getElementById(stat)
		);
	});
}

function createStat() {
	var newStatInput = document.getElementById('newStatInput');
	http('GET', 'api.php?name=' + newStatInput.value, function(data) {
		addStat(JSON.parse(data));
		newStatInput.value = '';
	});
}

function updateStat(stat) {
	var progressInput = document.getElementById('progress-' + stat);
	http('GET', 'api.php?stat=' + stat + '&increment=' + progressInput.value, function(data) {
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