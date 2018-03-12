<?php

	class LevelRepository extends Repository {

		public function __construct() {
			$this -> levels = $this -> getLevels();
		}

		private $levels;

		public function getLevel($points) {
			foreach ($this -> levels as $level) {
				if ($points >= $level['min'])
					return $level;
			} return null;
		}

		public function getLevels() {
			$levels = [];
			$result = $this -> query('select id, min_points, max_points from levels order by id desc');
			while ($row = $result -> fetch_assoc()) {
				$levels[] = [
					'id' => $row['id'],
					'min' => $row['min_points'],
					'max' => $row['max_points']
				];
			}
			return $levels;
		}

	}

?>