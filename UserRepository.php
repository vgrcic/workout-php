<?php

	require_once 'Repository.php';

	class UserRepository extends Repository {

		public function exists($username) {
			$mysqli = $this -> connect();
			$stmt = $mysqli -> stmt_init();
			$stmt -> prepare('select id from users where username = ?');
			$stmt -> bind_param('s', $username);
			$stmt -> execute();
			if ($stmt -> fetch())
				return true;
			return false;
		}

		public function loginUser($username, $password) {
			$retVal = null;
			$mysqli = $this -> connect();
			$stmt = $mysqli -> stmt_init();
			$stmt -> prepare('select id from users where username = ? and password = ?');
			$stmt -> bind_param('ss', $username, $password);
			$stmt -> execute();
			$stmt -> bind_result($id);
			if ($stmt -> fetch())
				$retVal = $id;
			$stmt -> close();
			return $retVal;
		}

		public function store($username, $password) {
			$mysqli = $this -> connect();
			$stmt = $mysqli -> stmt_init();
			$stmt -> prepare('insert into users (username, password) values (?,?)');
			$stmt -> bind_param('ss', $username, $password);
			$stmt -> execute();
			$stmt -> close();
		}

	}

?>