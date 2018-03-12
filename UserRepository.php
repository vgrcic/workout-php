<?php

	class UserRepository extends Repository {

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

	}

?>