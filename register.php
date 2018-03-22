<?php

	session_start();
	if (isset($_SESSION['user']))
		header('Location: index.php');

	require_once 'UserController.php';

	if (isset($_POST['username'], $_POST['password'], $_POST['password-confirmation'])) {
		$userController = new UserController;
		if ($userController -> create($_POST['username'], $_POST['password'], $_POST['password-confirmation']))
			header('Location: login.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Register</title>
	<script type="text/javascript" src="js/http.js"></script>
	<script type="text/javascript" src="js/validator.js"></script>
	<script type="text/javascript">

		function submitRegistration() {
			var username = document.getElementById('username');
			var usernameValue = username.value.trim();
			if (usernameValue == '') {
				validator.setErrorField(username, 'Enter your username');
				return;
			} else if (username.value != usernameValue) {
				validator.setErrorField(username, 'You have whitespace in your username');
				return;
			} else if (usernameValue.length < 4) {
				validator.setErrorField(username, 'Username must be at least 4 characters long');
				return;
			}
			var password = document.getElementById('password');
			var passwordValue = password.value.trim();
			if (passwordValue == '') {
				validator.setErrorField(password, 'Enter your password');
				return;
			} else if (password.value != passwordValue) {
				validator.setErrorField(password, 'You have whitespace in your password');
				return;
			} else if (passwordValue.length < 4) {
				validator.setErrorField(password, 'Password must be at least 4 characters long');
				return;
			}
			var passwordConfirmation = document.getElementById('password-confirmation');
			if (passwordConfirmation.value != passwordValue) {
				validator.setErrorField(passwordConfirmation, 'This does not match your password');
				return;
			}
			validator.usernameExists(function(data) {
				if (data == '0') document.getElementById('register').submit();
			});
		}

	</script>
</head>
<body>

	<main>

		<a class="corner-btn" href="login.php">Log in</a>

		<h1>Workout</h1>

		
		<table class="register">

			<form method="POST", action="register.php" id="register">

				<tr>
					<th>Username: </th>
					<td><input autocomplete="off" type="text" name="username" id="username" onblur="validator.usernameExists()">
						<span class="error"></span></td>
				</tr>

				<tr>
					<th>Password: </th>
					<td><input autocomplete="off" type="password" name="password" id="password">
						<span class="error"></span></td>
				</tr>

				<tr>
					<th>Confirm password: </th>
					<td><input autocomplete="off" type="password" name="password-confirmation" id="password-confirmation">
						<span class="error"></span></td>
				</tr>

			</form>

				<tr>
					<td colspan="2" align="center"><button onclick="submitRegistration()" class="submit-btn">Register</button></td>
				</tr>

		</table>

	</main>

</body>
</html>