<?php
	ini_set('display_errors', 1);
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");
	header("Content-Type: application/json; charset=UTF-8");

	// include db and object
	include_once '../config/database.php';
	include_once '../objects/reading.php';

	// init
	$database = new Database();
	$db = $database->getConnection();

	$reading = new Reading($db);

	// read
	$statement = $reading->read();
	$data = $statement->execute();

	if($data->numColumns() > 0){// && $data->columnType(0) != SQLITE3_NULL){
		$reading_array = array();
		//$reading_array["readings"]=array();

		while ($row = $data->fetchArray(SQLITE3_ASSOC)){
			array_push($reading_array, $row);
		}

		http_response_code(200);
		echo json_encode($reading_array);
	}
	else{
		http_response_code(404);
		echo json_encode(array("message" => "No Readings Found",
			"numColumns" => $data->numColumns(),
			"columnType(0)" => $data->columnType(0),
			"SQLITE3_NULL" => SQLITE3_NULL));
	}
?>
