<?php
class Reading{

	private $conn;
	private $table_name = "pm_reading";

	public $id;
	public $date;
	public $pm10;
	public $pm25;

	public function __construct($db){
		$this->conn = $db;
	}

	function read(){
		$query = "SELECT * FROM " . $this->table_name . "";// ORDER BY p.date DESC";
		$statement = $this->conn->prepare($query);
		$statement->execute();
		return $statement;
	}
}
?>
