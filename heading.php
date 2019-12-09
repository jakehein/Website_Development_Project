<?php error_reporting(E_ALL | E_STRICT);
	require_once("session.php");
	$signUp = "Sign up ";
	$login = "Login ";
	$userURL = "registration.php";
	$loginURL = "login.php";
	if(is_logged_in()){
		$signUp = $_SESSION["name"];
		$login = "Logout";
		$userURL = "account.php";
		$loginURL = "logout.php";
	}
?>
<!--
<DOCTYPE HTML>
<html lang = "en">
    <head>
          <meta charset="UTF-8">
          <meta name="author" content="Jacob Hein, Jason Hoffman, Luke Rolf">
          <meta name="description" content="This is a student made website for Jade Dragon.">
          <meta name="keywords" content="food, chinese, take out, delivery, rice, noodle, chicken, pork, jade, dragon, crab, rangoon, general, tso, Jade Dragon, Oshkosh, WI, 54901, Chinese Menu, Chinese restaurant Oshkosh, Chinese restaurant 54901, Chinese food Oshkosh, Chinese food 54901, Chinese food delivery, Chinese delivery Oshkosh, Chinese delivery 54901, Chinese food catering, Chinese carry out, Chinese dine in, Chinese party trays, Chinese food order online">
          <title>Jade Dragon</title>
          <link rel="icon" href="images/dragon.jpg"> #Test Your Might
          <link rel="stylesheet" type="text/css" href="jadeDragon.css">
    </head>
    <body>
		-->
		<header align = "center">
			<div id="headerContainer">
				<img src = "images/banner.jpg" alt = "website_banner">
				<div id="userControls"><a href='<?= $userURL ?>'><?= $signUp ?> </a>|<a href='<?= $loginURL ?>'> <?= $login ?></a></div>
			</div>
		</header>
        <div id = "outer">
            <div id = "center_column">
                <nav align = "center">
                    <a href="jadeDragon.php">Home</a>
                    <a href="menu.php">Menu</a>
                    <a href="gallery.php">Gallery</a>
                    <a href="promotions.php">Promotions</a>
                    <a href="directions.php">Directions</a>
                    <a href="orderOnline.php">Order Online</a>
                    <a href="contactUs.php">Contact Us</a>
                </nav>
            </div>
        </div>
<!--
    </body>
</html>
	-->