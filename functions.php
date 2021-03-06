<?php
	require_once("../config_global.php");
	$database = "if15_ruzjaa_3";

	session_start();
	
	function createUser($create_email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
		$stmt->bind_param("ss", $create_email, $hash);
		$stmt->execute();
		$stmt->close();
		
		$mysqli->close();
	}

	function loginUser($email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		if($stmt->fetch()){
			//ab'i oli midagi
			echo "Email ja parool oiged, kasutaja id=".$id_from_db;
			
			$_SESSION["logged_in_user_id"] = $id_from_db;
			$_SESSION["logged_in_user_email"] = $email_from_db;
			
			header("Location: data.php");
			
		}else{
			//ei leidnud
			echo "Wrong redentials";
		}
		
		$stmt->close();
		
		$mysqli->close();
	}
	
	function addCarPlate($car_plate, $car_color){
		
		
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO car_plates (user_id, number_plate, color) VALUES (?,?,?)");
		$stmt->bind_param("iss", $_SESSION["logged_in_user_id"], $car_plate, $car_color);
		
		//sonum
		$message = "";
		
		if($stmt->execute()){
			//kui on tõene, siis INSERT õnnestus
			$message = "Sai edukalt lisatud";
		}else{
			//kui on väär, siis kuvame error
			echo $stmt->error;
		}
		
		return $message;
		
		$stmt->close();
		
		$mysqli->close();
	}
?>