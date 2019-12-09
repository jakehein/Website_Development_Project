<?php
    error_reporting(E_ALL | E_STRICT);
    require_once("database/menuUtility.php");
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
        <link rel="icon" href="images/dragon.jpg">
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
    </head>
    <body>
        <?php include "heading.php";?>
        <section id="promotionsSection">
            <h1>Special promotion items:</h1>
            <h2>Lunch specials: $6.29 each!</h2>
            <table id="promotionsTable">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
                <?php
                $items = get_menu_by_category("Lunch Special");
                foreach ($items as $item){
                ?>
                <tr>
                    <td class="itemId"><?= $item[0] ?></td>
                    <td class="itemName"><?= $item[1] ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </section>
        <?php include "footer.html";?>
    </body>
</html>
