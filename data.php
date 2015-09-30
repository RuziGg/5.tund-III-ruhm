<?php

	require_once("functions.php");

	if(!isset($_SESSION["logged_in_user_id"])){
		
		header("Location: login_sample.php")
	}

	if(isset($_GET["logout"])){
		
		session_destroy();
		
		header("Location: login.php");
	}

?>

<p>
	Tere, <? echo $_SESSION["logged_in_user_id"];?>
	<a href="?logout=1"> Logi valja<a>