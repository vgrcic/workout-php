<?php

	require_once 'UserRepository.php';

	class UserController {

		public function __construct() {
			$this -> userRep = new UserRepository;
		}

		private $userRep;

		public function exists($username) {
			print $this -> userRep -> exists($username) ? 1 : 0;
		}

		public function create($username, $password, $passwordConfirmation) {
			if (strlen(trim($username)) < 4 ||
				strlen(trim($password)) < 4 ||
				$username !== trim($username) ||
				$password !== trim($password) ||
				$password !== $passwordConfirmation ||
				$this -> userRep -> exists($username))
				return false;
			$this -> userRep -> store($username, $password);
			return true;
		}

	}

?>