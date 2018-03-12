<?php

	require_once 'StatRepository.php';

	class StatController {

		public function __construct() {
			$this -> statRep = new StatRepository;
		}

		private $statRep;

		public function getStats($user) {
			$stats = $this -> statRep -> getStats($user);
			print json_encode($stats);
		}

		public function updateStat($id, $increment, $user) {
			$this -> validateRequest($id, $user);
			$this -> statRep -> updateStat($id, $increment);
			$stat = $this -> statRep -> getStat($id);
			print json_encode($stat);
		}

		public function createStat($name, $user) {
			$id = $this -> statRep -> createStat($name, $user);
			$stat = $this -> statRep -> getStat($id);
			print json_encode($stat);
		}

		public function deleteStat($stat, $user) {
			$this -> validateRequest($stat, $user);
			$this -> statRep -> deleteStat($stat);
		}

		public function validateRequest($id, $user) {
			$stat = $this -> statRep -> getStat($id);
			if ($stat == null) {
				http_response_code(404); exit;
			} else if ($stat['user_id'] != $user) {
				http_response_code(401); exit;
			}
		}

	}

?>