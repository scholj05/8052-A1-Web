<?php
class Reading{

	private $conn;
	private $table_name = "pm_reading";
	private $tz = 'Pacific/Auckland';
	private $format = 'Y-m-d H:i:s';

	public $id;
	public $date;
	public $pm10;
	public $pm25;

	public function __construct($db){
		$this->conn = $db;
	}

	function readDay(){
		
		date_default_timezone_set($this->tz);
		$currentDate = date($this->format);
		$datetime = new DateTime(date($this->format), new DateTimeZone($this->tz));
		$yesterday = date_sub($this->datetime, date_interval_create_from_date_string("1 Day"));
		$strYesterday = $yesterday->format($this->format);
		$query = "SELECT * FROM " . $this->table_name . "WHERE " . $this->table_name . ".date > \"" . $strYesterday . "\" ORDER BY pm_reading.date DESC";
		$statement = $this->conn->prepare($query);
		$statement->execute();
		return $statement;
	}

	function readWeek(){
		date_default_timezone_set($this->tz);
		$currentDate = date($this->format);
		$datetime = new DateTime(date($this->format), new DateTimeZone($this->tz));
		$yesterday = date_sub($this->datetime, date_interval_create_from_date_string("1 Week"));
		$strYesterday = $yesterday->format($this->format);
		$query = "SELECT * FROM " . $this->table_name . "WHERE " . $this->table_name . ".date > \"" . $strYesterday . "\" ORDER BY pm_reading.date DESC";
		$statement = $this->conn->prepare($query);
		$statement->execute();
		return $statement;
	}
}
?>
