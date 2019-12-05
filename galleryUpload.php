<?php
    error_reporting(E_ALL | E_STRICT);
	require_once("session.php");
	require_once("database/galleryUtility.php");
	ensure_logged_in();
	$errorMsg = "";
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$comment = "";
		if(isset($_POST["commentField"])){
			$comment = $_POST["commentField"];
		}
		if(isset($_FILES)){
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($_FILES["imageSelect"]["name"],PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["imageSelect"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				$errorMsg = "File is not an image.";
				$uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				$errorMsg = "Sorry, only JPG, JPEG & PNG files are allowed.";
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			// if everything is ok, try to upload file
			} else {
				$target_dir = "uploads/";
				$filename = upload_image_details($comment);
				$target_file = $target_dir . $filename . "." . $imageFileType;
				if (move_uploaded_file($_FILES["imageSelect"]["tmp_name"], $target_file)) {
					redirect("gallery.php", "File successfully uploaded! Pending approval.");
				}
			}
		}else{
			$errorMsg = "No Image Selected. Try Again";
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
        <title>Jade Dragon</title>
        <link rel="icon" href="images/dragon.jpg"> <!-- #Test Your Might -->
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
		<link rel="stylesheet" type="text/css" href="galleryUpload.css">
		<script src="galleryUpload.js"></script>
    </head>
    <body>
        <?php include "heading.php";?>
			<form method="POST" enctype="multipart/form-data">
				<div>
					<input type="file" name="imageSelect" id="imageSelect" accept=".jpg,.jpeg,.png">
				</div>
				<div>
					<img id="uploadPreview" class="thumbnail">
				</div>
				<div>
					<label for="commentField">Add a comment!</label>
				</div>
				<div>
					<input id="commentField" name="commentField">
				</div>
				<div><?= $errorMsg ?></div>
				<div>
					<input type="submit" id="submit" value="submit">
				</div>
			</form>
		<?php include "footer.html";?>
    </body>
</html>
