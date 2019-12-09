<?php
    error_reporting(E_ALL | E_STRICT);
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
        <link rel="stylesheet" type="text/css" href="contactUs.css" >
    </head>
    <body>
        <?php include "heading.php";?>
        <form action="contactSubmit.php" method="post">
			<div class="contactDiv">
				<label for="customerName">Name(Optional):</label>
				<input type="text" id="customerName" name="customerName">
			</div>
			<div class="contactDiv">
				<label for="customerEmail">E-mail(Optional):</label>
				<input type="email" id="customerEmail" name="customerEmail">
			</div>
			<div class="contactDiv">
				<div>
					<label for="commentText">Tell Us What You Think!!!</label>
				</div>
				<textarea class="commentField" id="commentText" name="commentText" required></textarea>
			</div>
			<div class="contactDiv">
				<input type="submit" value="Submit">
			</div>
		</form>
        <?php include "footer.html";?>
    </body>
</html>
