<?php
    error_reporting(E_ALL | E_STRICT);
	require_once("session.php");
	require_once("database/accountUtility.php");
	if(is_logged_in()){
		redirect("jadeDragon.php");
	}
	$username = "";
	$password = "";
	$errorMsg = "";
	if(isset($_SESSION["flash"])){
		$errorMsg = $_SESSION["flash"];
		unset($_SESSION["flash"]);
	}
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		if(check_credentials($username, $password)){
			$_SESSION["name"] = $username;
			redirect("jadeDragon.php");
		}else{
			$errorMsg = "Username and Password do not match";
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Jacob Hein, Jason Hoffman, Luke Rolf">
        <meta name="description" content="This is a student made website for Jade Dragon.">
        <meta name="robots" content="noindex, nofollow">
        <meta name="keywords" content="food, chinese, take out, delivery, rice, noodle, chicken, pork, jade, dragon, crab, rangoon, general, tso, Jade Dragon, Oshkosh, WI, 54901, Chinese Menu, Chinese restaurant Oshkosh, Chinese restaurant 54901, Chinese food Oshkosh, Chinese food 54901, Chinese food delivery, Chinese delivery Oshkosh, Chinese delivery 54901, Chinese food catering, Chinese carry out, Chinese dine in, Chinese party trays, Chinese food order online">
        <title>Login</title>
        <link rel="icon" href="dragon.jpg"> <!-- #Test Your Might -->
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
		<link rel="stylesheet" type="text/css" href="registration.css">
    </head>
    <body>
        <?php include "heading.php";?>
		<h1>Login</h1>
		<form method="POST" id="loginForm>
			<div class="registerlabel">
				<label for="username">Username: </label>
				<input id="username" name="username" value='<?= $username ?>' required>
			</div>
			<div class="registerlabel">
				<label for="password">Password: </label>
				<input type="password" id="password" name="password" value='<?= $password ?>' required>
			</div>
			<div>
				<span><?= $errorMsg ?></span>
			</div>
			<input type="submit" value="Login" id="submit">
		</form>
        <?php include "footer.html";?>
    </body>
</html>