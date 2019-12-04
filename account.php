<?php
    error_reporting(E_ALL | E_STRICT);
	require_once("session.php");
	require_once("database/accountUtility.php");
	if(!is_logged_in()){
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
	$usernameErrorMsg = "";
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$originalUsername = $_POST["originalUsername"];
		$username = $_POST["username"];
		if(isset($_POST["password"])){
			$password = $_POST["password"];
		}
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$address1 = $_POST["address1"];
		$address2 = $_POST["address2"];
		$state = $_POST["state"];
		$city = $_POST["city"];
		$zipcode = $_POST["zipcode"];
		if(isset($_POST["passwordConfirm"])){
			$passwordConfirm = $_POST["passwordConfirm"];
		}
		$usernameChanged = strcmp($username, $originalUsername);
		if($usernameChanged == 0 || ($usernameChanged != 0 && is_username_free($username))){
			
			if(isset($_POST["passwordCheckbox"])){
				if(!preg_match("/[A-Z]/", $password)){
					$valid_password = false;
				}else{
					$validUpperImg = "images/valid.png";
				}

				if(!preg_match("/[a-z]/", $password)){
					$valid_password = false;
				}else{
					$validLowerImg = "images/valid.png";
				}

				if(!preg_match("/[0-9]/", $password)){
					$valid_password = false;
				}else{
					$validNumberImg = "images/valid.png";
				}

				if(!preg_match("/[^A-z0-9]/", $password)){
					$valid_password = false;
				}else{
					$validSpecialImg = "images/valid.png";
				}

				if(strlen($password) < 8){
					$valid_password = false;
				}else{
					$validLengthImg = "images/valid.png";
				}
				if($valid_password){
					update_user_info_with_password($originalUsername, $username, $password, $firstname, $lastname, $email, $address1, $address2, $state, $city, $zipcode);
					$_SESSION["name"] = $username;
					//redirect("account.php", "Account updated");
				}else{
					$invalid_password_msg = "Password must contain a letter, number, and special character and be at least characters long.";
					$invalid_password = true;
				}
			}else{
				update_user_info($originalUsername, $username, $firstname, $lastname, $email, $address1, $address2, $state, $city, $zipcode);
				$_SESSION["name"] = $username;
				//redirect("account.php", "Account updated");
			}			
		}else{
			$registration_failed = true;
			$usernameErrorMsg = "That username is already in use.";
		}
	}else{
		$user = retrieve_user_info();
		$username = $_SESSION["name"];
		$firstname = $user["firstName"];
		$lastname = $user["lastName"];
		$email = $user["email"];
		$address1 = $user["address1"];
		$address2 = $user["address2"];
		$state = $user["state"];
		$city = $user["city"];
		$zipcode = $user["zipcode"];
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
        <title>Account</title>
        <link rel="icon" href="images/dragon.jpg"> <!-- #Test Your Might -->
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
		<link rel="stylesheet" type="text/css" href="registration.css">
		<link rel="stylesheet" type="text/css" href="account.css">
		<script src="account.js" defer></script>
    </head>
    <body>
        <?php include "heading.php";?>
		<h1>Account Management</h1>
		<form method="POST" id="registrationForm">
			<div class="registrationForm">
				<div class="credentials">
					<div id="fields">
						<div class="registerlabel">
							<label for="username">* Username: </label><br>
							<input class="registerField" id="username" name="username" value='<?= $username ?>' required>
							<input type="hidden" name="originalUsername" value='<?= $username ?>'>
							<div>
								<span class="error"><?= $usernameErrorMsg ?></span>
							</div>
						</div>
						<div class="registerlabel">
							<label for="password">* Password: </label><br>
							<input type="password" class="registerField" id="password" name="password" value='<?= $password ?>' disabled>
						</div>
						<div class="registerlabel">
							<label for="passwordConfirm">* Confirm Password: </label><br>
							<input type="password" class="registerField" id="passwordConfirm" name="passwordConfirm" disabled>
						</div>
						<div class="registerlabel">
							<label for="passwordCheckbox">Update Password </label>
							<input type="checkbox" id="passwordCheckbox" name="passwordCheckbox">
						</div>
					</div>
					<div id="passwordRequirements" class="hidden">
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
				<div>
				<fieldset id="personalFields">
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
				</div>
				<div>
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
				</div>
				<input type="submit" value="Update" id="update">
				<div>
					<span>* Required Field</span>
				</div>
			</div>
		</form>
        <?php include "footer.html";?>
    </body>
</html>
