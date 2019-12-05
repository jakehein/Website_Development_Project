<?php
    error_reporting(E_ALL | E_STRICT);
	require_once("session.php");
	require_once("database/accountUtility.php");
	if(is_logged_in()){
		redirect("jadeDragon.php");
	}
	$username = "";
	$firstname = "";
	$lastname = "";
	$email = "";
	$address1 = "";
	$address2 = "";
	$state = "";
	$city = "";
	$zipcode = "";
	$password = "";

	$validLengthImg = "images/invalid.png";
	$validLowerImg = "images/invalid.png";
	$validUpperImg = "images/invalid.png";
	$validSpecialImg = "images/invalid.png";
	$validNumberImg = "images/invalid.png";
	$validMatchImg = "images/invalid.png";

	$valid_password = true;
	$invalid_password_msg = "";
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$address1 = $_POST["address1"];
		$address2 = $_POST["address2"];
		$state = $_POST["state"];
		$city = $_POST["city"];
		$zipcode = $_POST["zipcode"];

		$passwordConfirm = $_POST["passwordConfirm"];
		if(is_username_free($username)){
			if(!preg_match("/[A-Z]/", $password)){
				$valid_password = false;
			}else{
				echo "UPPER";
				$validUpperImg = "images/valid.png";
			}

			if(!preg_match("/[a-z]/", $password)){
				$valid_password = false;
			}else{
				echo "LOWER";
				$validLowerImg = "images/valid.png";
			}

			if(!preg_match("/[0-9]/", $password)){
				$valid_password = false;
			}else{
				echo "Number";
				$validNumberImg = "images/valid.png";
			}

			if(!preg_match("/[^A-z0-9]/", $password)){
				$valid_password = false;
			}else{
				echo "Special";
				$validSpecialImg = "images/valid.png";
			}

			if(strlen($password) < 8){
				$valid_password = false;
			}else{
				echo "Length";
				$validLengthImg = "images/valid.png";
			}

			if($valid_password){
				register_user($username, $password, $firstname, $lastname, $email, $address1, $address2, $state, $city, $zipcode);
				redirect("login.php", "Account Created Successfully");
			}else{
				$invalid_password_msg = "Password must contain a letter, number, and special character and be at least characters long.";
				$invalid_password = true;
			}
		}else{
			$registration_failed = true;
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
        <title>Register</title>
        <link rel="icon" href="images/dragon.jpg"> <!-- #Test Your Might -->
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
		<link rel="stylesheet" type="text/css" href="registration.css">
		<script src="registration.js" defer></script>
    </head>
    <body>
        <?php include "heading.php";?>
		<h1>Create An Account</h1>
		<form method="POST" id="registrationForm">
			<div class="registrationForm">
				<div class="credentials">
					<div id="fields">
						<div class="registerlabel">
							<label for="username">* Username: </label><br>
							<input class="registerField" id="username" name="username" value='<?= $username ?>' required>
						</div>
						<div class="registerlabel">
							<label for="password">* Password: </label><br>
							<input type="password" class="registerField" id="password" name="password" value='<?= $password ?>' required>
						</div>
						<div class="registerlabel">
							<label for="passwordConfirm">* Confirm Password: </label><br>
							<input type="password" class="registerField" id="passwordConfirm" name="passwordConfirm" required>
						</div>
					</div>
					<div id="passwordRequirements">
						<fieldset>
							<legend>Password Requirements</legend>
							<div>
								<img id="validLength" src='<?= $validLengthImg ?>'>
								<span id="passwordLength">8 characters or longer</span>
							</div>
							<div>
								<img id="validLower" src='<?= $validLowerImg ?>'>
								<span id="passwordLowerCase">Contains a lowercase character</span>
							</div>
							<div>
								<img id="validUpper" src='<?= $validUpperImg ?>'>
								<span id="passwordUpperCase">Contains an uppercase character</span>
							</div>
							<div>
								<img id="validNumber" src='<?= $validNumberImg ?>'>
								<span id="passwordNumber">Contains a number</span>
							</div>
							<div>
								<img id="validSpecial" src='<?= $validSpecialImg ?>'>
								<span id="passwordSpecial">Contains a special character</span>
							</div>
							<div>
								<img id="validMatch" src='<?= $validMatchImg ?>'>
								<span id="passwordMatch">Passwords must match</span>
							</div>
						</fieldset>
					</div>
				</div>
				<fieldset>
					<legend>Personal Info</legend>
					<div class="registerlabel">
						<label for="firstname">* First Name: </label><br>
						<input class="registerField" id="firstname" name="firstname" value='<?= $firstname ?>' required>
					</div>
					<div class="registerlabel">
						<label for="lastname">* Last Name: </label><br>
						<input class="registerField" id="lastname" name="lastname" value='<?= $lastname ?>' required>
					</div>
					<div class="registerlabel">
						<label for="email">* E-Mail: </label><br>
						<input type="email" class="registerField" id="email" name="email" value='<?= $email ?>' required>
					</div>
					</legend>
				</fieldset>
				<fieldset>
						<legend>Address</legend>
						<div class="registerlabel">
							<label for="address1">* Street Address: </label><br>
							<input class="registerField" id="address1" name="address1" value='<?= $address1 ?>' required>
						</div>
						<div class="registerlabel">
							<label for="address2">Address 2 (optional): </label><br>
							<input class="registerField" id="address2" name="address2" value='<?= $address2 ?>' >
						</div>
						<div class="registerlabel">
							<label for="city">* City</label><br>
							<input class="registerField" id="city" name="city" value='<?= $city ?>' required>
						</div>
						<div class="registerlabel">
							<label for="state">* State:</label><br>
							<input class="registerField" id="state" name="state" value='<?= $state ?>' required>
						</div>
						<div class="registerlabel">
							<label for="zipcode">* Zipcode:</label><br>
							<input class="registerField" id="zipcode" name="zipcode" value='<?= $zipcode ?>' required>
						</div>
					</fieldset>
				<input type="submit" value="Register" id="register">
				<div>
					<span>* Required Field</span>
				</div>
			</div>
		</form>
        <?php include "footer.html";?>
    </body>
</html>
