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
        <link rel="icon" href="dragon.jpg"> <!-- #Test Your Might -->
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
    </head>
    <body>
        <?php include "heading.php";?>
        <h1>Submit images here!</h1>
        <div class="gallery">
            <a target="_blank" href = "chinese1.jpeg">
                <img src="chinese1.jpeg" alt="Chinese1" width="500">
            </a>
            <div class="desc">This is definitely chinese food</div>
        </div>
        <div class="gallery">
            <a target="_blank" href = "chinese2.jpg">
                <img src="chinese2.jpg" alt="Chinese2" width="500">
            </a>
            <div class="desc">This is definitely chinese food</div>
        </div>
        <div class="gallery">
            <a target="_blank" href = "chinese3.jpg">
                <img src="chinese3.jpg" alt="Chinese3" width="500">
            </a>
            <div class="desc">This is definitely chinese food</div>
        </div>
        <p>Customers add photos to Server, manager approves photos to website and owner can delete images</p>
        <?php include "footer.html";?>
    </body>
</html>
