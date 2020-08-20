<?php 
	Class Query {
		private $host = 'localhost'; //nama host sql, defaultnya 127.0.0.1 atau localhost
		private $username = "root"; //username untuk sql, defaultnya root
		private $pass = ""; //kalau sql nya ada password, maka dituliskan disini.
		private $db = "db_spk_saw"; //nama Database
		private $port = 3308; //optional, tergantung port sql. kalau port sql = 3306 (default) maka tidak usah diberi port
		private $con;

		function __construct() {
			$this->connect();
		} 

		//fungsi untuk menyambungkan ke database SQL, fungsi ini dipanggil di __construct
		public function connect() {
			$this->con = mysqli_connect($this->host,$this->username,$this->pass,$this->db,$this->port) or die(mysqli_error());
		}

		public function selectAll($table) {
			$select = mysqli_query($this->con, "SELECT * FROM ".$table);
			return $select;
		}

		public function store($query) {
			$item = array();
			while($data = mysqli_fetch_array($query)){
				array_push($item, $data);
			}
			return $item;
		}

		//fungsi ini untuk menggantikan penulisan mysqli_query pada setiap halaman kode. karena jika versi php berbeda akan kesulitan
		public function query($query) {
			$exe = mysqli_query($this->con, $query) or die(mysqli_error($this->con));
			return $exe;
		}

		public function lastid() {
			$exe = mysqli_insert_id($this->con);
			return $exe;

		}

		public function count($query) {
			$count = mysqli_num_rows($query) or die(mysqli_error($this->con));
			return $count;
		}

		public function fetching_single($query) {
			$data = mysqli_fetch_array($query);
			return $data;
		}

		public function convertRating($data) {
			if($data >= 85 && $data <= 100) {
				$n = 5;
			} else if($data >= 80 && $data <= 84.9) {
				$n = 4;
			} else if($data >= 70 && $data <= 79.9) {
				$n = 3;
			} else if($data >= 60 && $data <= 69.9) {
				$n = 2;
			} else if($data >= 50 && $data <= 59.9) {
				$n = 1;
			}
			return $n;
		}
	}	