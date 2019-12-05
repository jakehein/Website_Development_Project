<?php
    error_reporting(E_ALL | E_STRICT);
	require_once("session.php");
	require_once("database/galleryUtility.php");
	
	$errorMsg = "";
	$flashMsg = "";
	$owner = false;
	if(isset($_SESSION["status"])){
		$owner = strcmp($_SESSION["status"],"Owner") === 0;
		if($_SERVER['REQUEST_METHOD'] === 'POST' && $owner){
			var_dump($_POST);
			if(isset($_POST["approve"])){
				approve_image($_POST["filename"]);
			}
			if(isset($_POST["delete"])){
				delete_image($_POST["filename"]);
			}
		}
	}
	if(isset($_SESSION["flash"])){
		$flashMsg = $_SESSION["flash"];
		unset($_SESSION["flash"]);
	}
	$images = get_approved_images();
	$pending = get_unapproved_images();
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
		<link rel="stylesheet" type="text/css" href="gallery.css">
    </head>
    <body>
        <?php include "heading.php";?>
		<div>
			<?php
				if($owner){
					?>
					<p>---Pending Approval---</p>
						<?php
							if(count($pending) === 0){
								
								?>
									<p>No Pending Images</p>
								<?php
							}else{
								foreach($pending as $image){
									if(file_exists("uploads/" . $image["fileName"])){
										?>
										<div class="gallery">
											<div>
												<a target="_blank" href="uploads/<?= $image["fileName"] ?>">
												<img src="uploads/<?= $image["fileName"] ?>" alt="<?= $image["fileName"] ?>" width="200">
												</a>
											</div>
											<div>
												<form method="post">
													<input type="hidden" name="filename" value="<?= $image["fileName"] ?>"/>
													<input type="submit" name="approve" value="Approve"/>
													<input type="submit" name="delete" value="delete"/>
												</form>
											</div>
											<div class="desc"><?= $image["description"] ?></div>
										</div>
										<?php
									}
								}
							}
						?>
					<p class="clearFloat">---Approved---</p>
					<?php
				}
			?>
		</div>
        <h1><a href="galleryUpload.php">Submit images here!</a></h1>
		<p><?= $flashMsg ?></p>
		<div>
			<?php
				if(count($images) === 0){
					$errorMsg = "No images yet. Be the first to upload!!!";
				}else{
					foreach($images as $image){
						if(file_exists("uploads/" . $image["fileName"])){
							?>
							<div class="gallery">
								<a target="_blank" href="uploads/<?= $image["fileName"] ?>">
								<img src="uploads/<?= $image["fileName"] ?>" alt="<?= $image["fileName"] ?>" width="200">
								</a>
								<div class="desc"><?= $image["description"] ?></div>
							</div>
							<?php
						}
					}
				}
			?>
		</div>
		<p><?= $errorMsg ?></p>
        <?php include "footer.html";?>
    </body>
</html>
