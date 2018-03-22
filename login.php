<?php

	session_start();
	if (isset($_SESSION['user']))
		header('Location: index.php');

	require_once 'Repository.php';
	require_once 'UserRepository.php';

	if (isset($_POST['username'], $_POST['password'])) {
		$userRep = new UserRepository;
		$id = $userRep -> loginUser($_POST['username'], $_POST['password']);
		if ($id != null) {
			$_SESSION['user'] = $id;
			header('Location: index.php');
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Log in</title>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/validator.js"></script>
</head>
<body>

	<main>

		<a class="corner-btn" href="register.php">Register</a>

		<h1>Workout</h1>

		<form method="POST", action="login.php" onsubmit="return validator.login()">

			<table class="login">

				<tr>
					<th>Username: </th>
					<td><input autocomplete="off" type="text" name="username" id="username">
						<span class="error"></span></td>
				</tr>

				<tr>
					<th>Password: </th>
					<td><input autocomplete="off" type="password" name="password" id="password">
						<span class="error"></span></td>
				</tr>

				<tr>
					<td colspan="2" align="center"><input type="submit" value="Log in" class="submit-btn"></td>
				</tr>

			</table>

		</form>

	</main>

</body>
</html>