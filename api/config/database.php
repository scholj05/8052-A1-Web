<?php
class Database{

	private $host = "localhost";
	private $db_name = "/home/ubuntu/db/pm_readings_db.sqlite";
	public $conn;

	public function getConnection(){
		$this->conn = null;

		try{
			$this->conn = new SQLite3($this->db_name, SQLITE3_OPEN_READONLY);
		}catch(Exception $e){
			echo "db connection error: " . $e.getMessage();
		}
		return $this->conn;
	}
}
?>
