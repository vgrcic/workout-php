<?php

	abstract class Repository {

		protected function connect() {
			$ini = parse_ini_file('config.ini');
			return new mysqli($ini['host'], $ini['user'], $ini['pass'], $ini['db']);
		}

		public function query($string) {
			$mysqli = $this -> connect();
			return $mysqli -> query($string);
		}

	}

?>