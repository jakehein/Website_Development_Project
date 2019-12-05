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
				Error getting user from database check if user free
			<?php
			db_disconnect();
			exit();
		}
		return count($result) === 0;
	}
	
	function get_user_status($username){
		global $db;
		try{
			$sql = "SELECT status FROM User WHERE userName = ? LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->execute([$username]);
		}catch (PDOException $e){
			?>
				Error getting user from database check if user free
			<?php
			db_disconnect();
			exit();
		}
		$status = "";
		foreach($statement as $row){
			$status = $row["status"];
		}
		
		return $status;
	}
	
	function register_user($username, $password, $firstname, $lastname, $email, $address1, $address2, $state, $city, $zipcode){
		global $db;
		$status = "Customer";
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
			
			$addressID = create_address($address1, $address2, $state, $city, $zipcode);		 
			
			$sql = "INSERT INTO UserAddress(userName, addressID) VALUES(?, ?)";
			$statement = $db->prepare($sql);
			$statement->execute([$username, $addressID]);
		}catch(PDOException $e){
			?>
				Error entering into database create user
			<?php
			db_disconnect();
			exit();
		}
	}
	
	function create_address($address1, $address2, $state, $city, $zipcode){
		global $db;
		try{
			$address = get_address($address1, $address2, $state, $city, $zipcode);
			if(count($address) === 0){
				$sql = "INSERT INTO Address(address1, address2, state, city, zipcode) VALUES(:address1, :address2, :state, :city, :zipcode)";
				$statement = $db->prepare($sql);
				$statement->bindParam(":address1", $address1);
				$statement->bindParam(":address2", $address2);
				$statement->bindParam(":state", $state);
				$statement->bindParam(":city", $city);
				$statement->bindParam(":zipcode", $zipcode);
				$statement->execute();
				$address = get_address($address1, $address2, $state, $city, $zipcode);
			}
			foreach($address as $row){
				$addressID = $row["addressID"];
			}			
		}catch(PDOException $e){
			?>
				Error entering into database create address
			<?php
			db_disconnect();
			exit();
		}
		return $addressID;
	}
	
	function get_address($address1, $address2, $state, $city, $zipcode){
		global $db;
		try{
		$sql = "SELECT * FROM Address WHERE address1 = :address1 AND address2 = :address2 AND state = :state AND city = :city AND zipcode = :zipcode LIMIT 1";
		$statement = $db->prepare($sql);
		$statement->bindParam(":address1", $address1);
		$statement->bindParam(":address2", $address2);
		$statement->bindParam(":state", $state);
		$statement->bindParam(":city", $city);
		$statement->bindParam(":zipcode", $zipcode);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		}catch (PDOException $e){
			echo $e;
			?>
				Error getting address from database
			<?php
			db_disconnect();
			exit();
		}
		return $result;
	}
	
	function check_credentials($username, $password){
		global $db;
		try{
			$sql = "SELECT password FROM User WHERE userName = ? LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->execute([$username]);
		}catch (PDOException $e){
			?> 
			There was a problem with the database queries login
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
	
	function retrieve_user_info(){
		global $db;
		try{
			$sql = "SELECT User.email, User.firstName, User.lastName, Address.address1, Address.address2, Address.state, Address.city, Address.zipcode 
			FROM User
			INNER JOIN UserAddress USING(userName)
			INNER JOIN Address USING(addressID)
			WHERE userName = ? LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->execute([$_SESSION["name"]]);
		}catch (PDOException $e){
			?> 
			There was a problem with the database queries get user info
			<?php
			db_disconnect();
			exit();
		}
		$userInfo = "";
		if ($statement) {
			foreach ($statement as $row) {
				$userInfo = $row;
			}
		}
		return $userInfo;
	}
	
	function update_user_info_with_password($originalUsername, $username, $password, $firstname, $lastname, $email, $address1, $address2, $state, $city, $zipcode){
		global $db;
		try{
			$hashedPassword = crypt($password);
			$sql = "UPDATE User SET userName = :username, password = :password, email = :email, firstName = :firstname, lastName = :lastname WHERE userName = :originalUsername"; 
			$statement = $db->prepare($sql);
			$statement->bindParam(":username", $username);
			$statement->bindParam(":password", $hashedPassword);
			$statement->bindParam(":email", $email);
			$statement->bindParam(":firstname", $firstname);
			$statement->bindParam(":lastname", $lastname);
			$statement->bindParam(":originalUsername", $originalUsername);
			$statement->execute();
			
			$addressID = create_address($address1, $address2, $state, $city, $zipcode);		 
			
			$sql = "UPDATE UserAddress SET userName = ?, addressID = ? WHERE userName = ?";
			$statement = $db->prepare($sql);
			$statement->execute([$username, $addressID, $originalUsername]);
		}catch(PDOException $e){
			echo $e;
			?> 
			There was a problem with the database queries update with password
			<?php
			db_disconnect();
			exit();
		}
	}		
	
	function update_user_info($originalUsername, $username, $firstname, $lastname, $email, $address1, $address2, $state, $city, $zipcode){
		global $db;
		try{
			$addressID = create_address($address1, $address2, $state, $city, $zipcode);
			
			$sql = "UPDATE UserAddress SET userName = ?, addressID = ? WHERE userName = ?";
			$statement = $db->prepare($sql);
			$statement->execute([$username, $addressID, $originalUsername]);
			
			$sql = "UPDATE User SET userName = :username, email = :email, firstName = :firstname, lastName = :lastname WHERE userName = :originalUsername"; 
			$statement = $db->prepare($sql);
			$statement->bindParam(":username", $username);
			$statement->bindParam(":email", $email);
			$statement->bindParam(":firstname", $firstname);
			$statement->bindParam(":lastname", $lastname);
			$statement->bindParam(":originalUsername", $originalUsername);
			$statement->execute();
		}catch(PDOException $e){
			echo $e;
			?> 
			There was a problem with the database queries update without pass
			<?php
			db_disconnect();
			exit();
		}
	}
?>