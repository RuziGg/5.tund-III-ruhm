<?php

	require_once("functions.php");

	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: data.php");
	}

	if(isset($_GET["logout"])){
		
		session_destroy();
		
		header("Location: login_sample.php");
	}

	$number_plate = $color = "";
	$number_plate_error = $color_error = "";
	
	if(isset($_POST["add_plate"])){
		
		echo $_SESSION["logged_in_user_id"];
		
		if ( empty($_POST["number_plate"]) ) {
			$number_plate_error = "See väli on kohustuslik";
		}else{
			$number_plate = cleanInput($_POST["number_plate"]);
		}
		
		if ( empty($_POST["color"]) ) {
				$color_error = "See väli on kohustuslik";
		}else{
			$color = cleanInput($_POST["color"]);
		}
		
		if($color_error == "" && $number_plate_error == ""){
			addCarPlate($number_plate, $color);
		}
	}
		
			

			
  function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
?>
<p>
	Tere, <? echo $_SESSION["logged_in_user_id"];?>
	<a href="?logout=1"> Logi valja<a>
</p>

<html>
<head>
</head>
<body>

<h2>Lisa autonumbrimarki</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<label for="number_plte">Auto numbrimärk</label><br>
	<input id="number_plate" type="text" value="<?php echo $number_plate; ?>"> <?php echo $number_plate_error; ?><br><br>
	<label for="color">Värv</label><br>
	<input name="color" type="text" value="<?php echo $color; ?>"> <?php echo $color_error; ?><br><br>
	<input type="submit" name="add_plate" value="Add">
</form>
<body>
<html>