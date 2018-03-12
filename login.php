<?php

	require_once 'Repository.php';
	require_once 'UserRepository.php';

	session_start();
	if (isset($_SESSION['user']))
		header('Location: index.php');

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
	<title>Log in</title>
</head>
<body>

	<form method="POST", action="login.php">

		<table>

			<tr>
				<th>Username: </th>
				<td><input type="text" name="username"></td>
			</tr>

			<tr>
				<th>Password: </th>
				<td><input type="password" name="password"></td>
			</tr>

			<tr>
				<td colspan="2"><input type="submit" value="Log in"></td>
			</tr>

		</table>

	</form>

</body>
</html>