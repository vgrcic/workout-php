<?php

	require_once 'Repository.php';
	require_once 'LevelRepository.php';

	class StatRepository extends Repository {

		public function __construct() {
			$this -> levelRepository = new LevelRepository;
		}

		private $levelRepository;

		public function createStat($name, $user) {
			$mysqli = $this -> connect();
			$stmt = $mysqli -> stmt_init();
			$stmt -> prepare("insert into stats (name, user_id) values (?, ?)");
			$stmt -> bind_param("si", $name, $user);
			$stmt -> execute();
			$id = $mysqli -> insert_id;
			$stmt -> close();
			return $id;
		}

		public function getStats($user) {
			$stats = [];
			$result = $this -> query('select id, name, points, user_id from stats where user_id = ' . $user);
			while ($row = $result -> fetch_assoc())
				$stats[] = $this -> populateStat($row);
			return $stats;
		}

		public function getStat($id) {
			$result = $this -> query('select id, name, points, user_id from stats where id = ' . $id);
			if ($row = $result -> fetch_assoc())
				return $this -> populateStat($row);
			return null;
		}

		public function updateStat($stat, $increment) {
			$this -> query('update stats set points = points + ' . $increment . ' where id = ' . $stat);
			return $this -> getStat($stat);
		}

		public function deleteStat($stat) {
			$this -> query('delete from stats where id = ' . $stat);
		}

		public function populateStat($row) {
			return [
				'id' => $row['id'],
				'level' => $this -> levelRepository -> getLevel($row['points']),
				'name' => $row['name'],
				'points' => $row['points'],
				'user_id' => $row['user_id']
			];
		}

	}

?>