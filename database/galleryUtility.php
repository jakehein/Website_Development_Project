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
	
	function upload_image_details($fileType, $description){
		global $db;
		try{
			$sql = "INSERT INTO GalleryList(fileName, description, status) VALUES('tempFile', :description, 0)";
			$statement = $db->prepare($sql);
			$statement->bindParam(":description", $description);
			$statement->execute();
			
			$sql = "SELECT galleryID FROM GalleryList WHERE fileName = 'tempFile' LIMIT 1";
			$statement = $db->prepare($sql);
			$statement->execute();
			foreach($statement as $row){
				$filename = "galleryImage" . $row["galleryID"] . "." . $fileType;
			}
			
			$sql = "UPDATE GalleryList SET fileName = :fileName WHERE fileName = 'tempFile'";
			$statement = $db->prepare($sql);
			$statement->bindParam("fileName", $filename);
			$statement->execute();
		}catch(PDOException $e){
			echo $e;
			?>
				error uploading image info
			<?php
		}
		return $filename;
	}
?>