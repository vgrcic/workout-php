class validator {

	static login() {
		var username = document.getElementById('username');
		if (username.value.trim() == '') {
			this.setErrorField(username, 'Enter your username');
			return false;
		}
		var password = document.getElementById('password');
		if (password.value.length < 4) {
			this.setErrorField(password, 'Enter your password');
			return false;
		}
		return true;
	}

	static setErrorField(element, message = '') {
		element.classList.add('error-input');
		if (message !== '') {
			element.nextElementSibling.innerHTML = message;
			element.addEventListener('focus', function() {
				element.classList.remove('error-input');
				element.nextElementSibling.innerHTML = '';
			});
		} else {
			element.addEventListener('focus', function() {
				element.classList.remove('error-input');
			});
		}
	}

	static usernameExists(callback) {
		var username = document.getElementById('username');
		if (username.value.trim() != '')
			http.get('api.php/users/username=' + username.value + '/exists', function(data) {
				if (data == '1')
					validator.setErrorField(document.getElementById('username'), 'Username already exists')
				if (callback != null)
					callback(data);
			});
	}

}