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
	$statement1 = $reading->readDay();
	$data1 = $statement1->execute();

	$statement2 = $reading->readWeek();
	$data2 = $statement2->execute();

	if($data1->numColumns() > 0 && $data2->numColumns() > 0){// && $data->columnType(0) != SQLITE3_NULL){
		$reading_array = array();
		$reading_array["day"]=array();
		$reading_array["week"]=array();

		while ($row = $data1->fetchArray(SQLITE3_ASSOC)){
			array_push($reading_array["day"], $row);
		}
		while ($row = $data2->fetchArray(SQLITE3_ASSOC)){
			array_push($reading_array["week"], $row);
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
