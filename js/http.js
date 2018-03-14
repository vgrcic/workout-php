class http {

	static get(url, callback) {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				callback(this.responseText);
			}
		}
		ajax.open('GET', url, true);
		ajax.send();
	}

	static post(url, data, callback) {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				callback(this.responseText);
			}
		}
		ajax.open('POST', url, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(data);
	}

	static delete(url, callback) {
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				callback(this.responseText);
			}
		}
		ajax.open('DELETE', url, true);
		ajax.send();
	}

}