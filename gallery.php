<?php
    error_reporting(E_ALL | E_STRICT);
	require_once("database/galleryUtility.php");
	
	$images = get_approved_images();
	$errorMsg = "";
	$flashMsg = "";
	if(isset($_SESSION["flash"])){
		$flashMsg = $_SESSION["flash"];
		unset($_SESSION["flash"]);
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
		<link rel="stylesheet" type="text/css" href="gallery.css">
    </head>
    <body>
        <?php include "heading.php";?>
        <h1><a href="galleryUpload.php">Submit images here!</a></h1>
		<p>'<?= $flashMsg ?>'</p>
		<?php
			if(count($images) === 0){
				$errorMsg = "No images yet. Be the first to upload!!!";
			}else{
				foreach($images as $image){
					?>
					<div class="gallery">
						<a target="_blank" href="uploads/<?= $image["fileName"] ?>.jpg">
						<img src="uploads/<?= $image["fileName"] ?>.jpg" alt="<?= $image["fileName"] ?>" width="200">
						</a>
						<div class="desc"><?= $image["description"] ?></div>
					</div>
					<?php
				}
			}
		?>
		<p><?= $errorMsg ?></p>
        <?php include "footer.html";?>
    </body>
</html>
