<?php

	require_once 'StatRepository.php';

	class StatController {

		public function __construct() {
			$this -> statRep = new StatRepository;
		}

		private $statRep;

		public function getStats() {
			$stats = $this -> statRep -> getStats($_SESSION['user']);
			header('Content-Type: application/json');
			print json_encode($stats);
		}

		public function updateStat($id, $increment) {
			$this -> validateRequest($id, $_SESSION['user']);
			$this -> statRep -> updateStat($id, $increment);
			$stat = $this -> statRep -> getStat($id);
			header('Content-Type: application/json');
			print json_encode($stat);
		}

		public function createStat($name) {
			$id = $this -> statRep -> createStat($name, $_SESSION['user']);
			$stat = $this -> statRep -> getStat($id);
			header('Content-Type: application/json');
			print json_encode($stat);
		}

		public function deleteStat($stat) {
			$this -> validateRequest($stat);
			$this -> statRep -> deleteStat($stat);
			print $stat;
		}

		public function validateRequest($id) {
			$stat = $this -> statRep -> getStat($id);
			if ($stat == null) {
				http_response_code(404); exit;
			} else if ($stat['user_id'] != $_SESSION['user']) {
				http_response_code(401); exit;
			}
		}

	}

?>