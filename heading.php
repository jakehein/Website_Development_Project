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
<header class="center">
	<div id="headerContainer">
		<img src = "images/banner.jpg" alt = "website_banner">
		<div id="userControls"><a href='<?= $userURL ?>'><?= $signUp ?> </a>|<a href='<?= $loginURL ?>'> <?= $login ?></a></div>
	</div>
</header>
<div class = "outer">
    <div class = "center_column">
        <nav class="center">
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