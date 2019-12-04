<?php
    error_reporting(E_ALL | E_STRICT);
	require_once("initialize.php");
	
	function get_approved_images(){
		global $db;
		try{
			$sql = "SELECT * FROM GalleryList WHERE status = 1";
			$statement = $db->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			echo $e;
			?>
				error getting approved images from db
			<?php
		}
		return $result;
	}

	function get_unapproved_images(){
		global $db;
		try{
			$sql = "SELECT * FROM GalleryList WHERE status = 0";
			$statement = $db->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			echo $e;
			?>
				error getting unapproved images from db
			<?php
		}
		return $result;
	}

?>