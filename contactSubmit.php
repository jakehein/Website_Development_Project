<?php error_reporting(E_ALL | E_STRICT); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta name="author" content="Jacob Hein, Jason Hoffman, Luke Rolf">
        <meta name="description" content="This is a student made website for Jade Dragon.">
        <meta name="robots" content="noindex, nofollow">
        <meta name="keywords" content="food, chinese, take out, delivery, rice, noodle, chicken, pork, jade, dragon, crab, rangoon, general, tso, Jade Dragon, Oshkosh, WI, 54901, Chinese Menu, Chinese restaurant Oshkosh, Chinese restaurant 54901, Chinese food Oshkosh, Chinese food 54901, Chinese food delivery, Chinese delivery Oshkosh, Chinese delivery 54901, Chinese food catering, Chinese carry out, Chinese dine in, Chinese party trays, Chinese food order online">
        <title>Jade Dragon</title>
        <link rel="icon" href="images/dragon.jpg">
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
	</head>
	<body>
		<?php
			$message = "";
			$sendTo = "thefulljadedragon@gmail.com";

			$message .= getInput("customerName") . "\n\n"
					 . getInput("customerEmail") . "\n\n"
					 . getInput("commentText");

			mail($sendTo, "Contact Us Email", $message);
			header("Location: jadeDragon.php");
			function getInput($field){
				$value = trim($_POST["$field"]);
				return htmlspecialchars($value);
			}
		?>
	</body>
</html>
