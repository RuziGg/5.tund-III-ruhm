<?php
	require_once("../config_global.php");
	$database = "if15_ruzjaa_3";
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);
	
	
	function createUser(){
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
		echo $mysqli->error;
		echo $stmt->error;
		
		// asendame ? margid, ss - s on string email, s on string password
		$stmt->bind_param("ss", $create_email, $create_password);
		$stmt->execute();
		$stmt->close();
	}

	function loginUser(){
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
		
		//muutujad tulemustele
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		
		//Kontrolli kas tulemusi leiti
		if($stmt->fetch()){
			//ab'i oli midagi
			echo "Email ja parool oiged, kasutaja id=".$id_from_db;
		}else{
			//ei leidnud
			echo "Wrong redentials";
		}
		
		$stmt->close();
	}
	
	$mysqli->close();
?>