<?php
    error_reporting(E_ALL | E_STRICT);
	require_once("initialize.php");
	
	function is_username_free($username){
		global $db;
		try{
			$sql = "SELECT * FROM User WHERE userName = ?";
			$statement = $db->prepare($sql);
			$statement->execute([$username]);
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		}catch (PDOException $e){
			?>
				Error getting user from database
			<?php
			db_disconnect();
			exit();
		}
		return count($result) === 0;
	}
	
	function register_user($username, $password, $firstname, $lastname, $email, $address1, $address2, $state, $city, $zipcode){
		global $db;
		$status = "User";
		$hashedPassword = crypt($password);
		try{
			$sql = "INSERT INTO User(userName, status, email, password, firstName, lastName) VALUES(:username, :status, :email, :password, :firstname, :lastname)";
			$statement = $db->prepare($sql);
			$statement->bindParam(":username", $username);
			$statement->bindParam(":status", $status);
			$statement->bindParam(":email", $email);
			$statement->bindParam(":password", $hashedPassword);
			$statement->bindParam(":firstname", $firstname);
			$statement->bindParam(":lastname", $lastname);
			$statement->execute();
			
			if(!address_exist($address1, $address2, $state, $city, $zipcode)){
				$sql = "INSERT INTO Address(address1, address2, state, city, zipcode) VALUES(:address1, :address2, :state, :city, :zipcode)";
				$statement = $db->prepare($sql);
				$statement->bindParam(":address1", $address1);
				$statement->bindParam(":address2", $address2);
				$statement->bindParam(":state", $state);
				$statement->bindParam(":city", $city);
				$statement->bindParam(":zipcode", $zipcode);
				$statement->execute();
			}
			
			$sql = "SELECT addressID FROM Address WHERE address1 = :address1 AND address2 = :address2 AND state = :state AND city = :city AND zipcode = :zipcode LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->bindParam(":address1", $address1);
			$statement->bindParam(":address2", $address2);
			$statement->bindParam(":state", $state);
			$statement->bindParam(":city", $city);
			$statement->bindParam(":zipcode", $zipcode);
			$statement->execute();
			
			foreach($statement as $row){
				$addressID = $row["addressID"];
			} 
			
			$sql = "INSERT INTO UserAddress(userName, addressID) VALUES(?, ?)";
			$statement = $db->prepare($sql);
			$statement->execute([$username, $addressID]);
		}catch(PDOException $e){
			echo $e;
			?>
				Error entering into database
			<?php
			db_disconnect();
			exit();
		}
	}
	
	function address_exist($address1, $address2, $state, $city, $zipcode){
		global $db;
		try{
		$sql = "SELECT * FROM Address WHERE address1 = :address1 AND address2 = :address2 AND state = :state AND city = :city AND zipcode = :zipcode LIMIT 1";
		$statement = $db->prepare($sql);
		$statement->bindParam(":address1", $address1);
		$statement->bindParam(":address2", $address2);
		$statement->bindParam(":state", $state);
		$statement->bindParam(":city", $city);
		$statement->bindParam(":zipcode", $zipcode);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		}catch (PDOException $e){
			echo $e;
			?>
				Error getting address from database
			<?php
			db_disconnect();
			exit();
		}
		return count($result) !== 0;
	}
	
	function check_credentials($username, $password){
		global $db;
		try{
			$sql = "SELECT password FROM User WHERE userName = ? LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->execute([$username]);
		}catch (PDOException $e){
			?> 
			There was a problem with the database queries
			<?php
			db_disconnect();
			exit();
		}
		$validLogin = FALSE;
		if ($statement) {
			foreach ($statement as $row) {
				$correct_password = $row["password"];
				$validLogin = $correct_password === crypt($password, $correct_password);
			}
		}
		return $validLogin;
	}
	
	function update_user_info($username, $password, $first, $last, $email, $address1, $address2, $state, $city, $zip){
		global $db;
		try{
			
		}catch(PDOException $e){
			
		}
	}
?>