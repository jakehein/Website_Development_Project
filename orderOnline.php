<?php
    error_reporting(E_ALL | E_STRICT);
    require_once("database/menuUtility.php");
    require_once("session.php");
    ensure_logged_in("orderOnline.php");
    $onlineOrderMenu = true;
    global $onlineOrderMenu;

    


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
        <script src="cart.js"></script>
        <script src="menu.js"></script>
    </head>
    <body>
        <?php include "heading.php";?>

        <section class="menu">
            <h1>Menu: </h1>
            <?php include "menuBody.php";?>
        </section>

        <section class="cart">
            <h1>Cart: </h1>
            <?php include "cart.php";?>
        </section>

        <?php include "footer.html";?>
    </body>
</html>
