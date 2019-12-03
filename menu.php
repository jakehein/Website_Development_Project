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
        <link rel="icon" href="dragon.jpg"> <!-- #Test Your Might -->
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
    </head>
    <body>
        <?php include "heading.php";?>
        <h1>Menu:</h1>

        <?php
            $categories = get_categories();

            foreach($categories as $category){
                $items = get_menu_by_category($category);

                // check if there needs to be separate large/small prices
                $differentSizes = false;
                foreach($items as $item){
                    if ($item[3] > 0){
                        $differentSizes = true;
                    }
                }
        ?>
            <button class="accordion"> <?= $category ?> </button>
            <div class="panel">
                <table>
                    <tr>
                        <th>Name</th>
        <?php
                        if($differentSizes) {
        ?>
                        <th>Large Price</th>
                        <th>Small Price</th>
        <?php
                        } else {
        ?>
                        <th>Price</th>
        <?php
                        }
        ?>
                    </tr>
        <?php
                    foreach($items as $item){
        ?>
                    <tr>
                        <td><?= $item[1] ?></td>
                        <td><?= $item[2] ?></td>
        <?php
                        if($differentSizes){
        ?>
                        <td><?= $item[3] ?></td>
        <?php
                        }
        ?>
                    </tr>
        <?php
                    }
        ?>
                </table>
            </div>
        <?php
            }
        ?>
        <?php include "footer.html";?>
        <script src="menu.js"></script>
    </body>
</html>
