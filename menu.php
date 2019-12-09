<?php
    error_reporting(E_ALL | E_STRICT);
    require_once("session.php");
    require_once("database/menuUtility.php");
    $onlineOrderMenu = false;
    global $onlineOrderMenu;

    $owner = false;
    if(isset($_SESSION["status"])){
		$owner = $_SESSION["status"] == "Owner";
    }

    $itemName = "";
    $largePrice = "";
    $smallPrice = "";
    $category = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $itemName = $_POST["itemName"];
        $largePrice = $_POST["largePrice"];
        if(isset($_POST["smallPrice"])){
            $smallPrice = $_POST["smallPrice"];
        } else {
            $smallPrice = 0.00;
        }
        $category = $_POST["category"];

        add_menu_item($itemName, $largePrice, $smallPrice, $category);
        $_SESSION["addItemSuccess"] = TRUE;
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
        <link rel="icon" href="dragon.jpg">
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
    </head>
    <body>
        <?php include "heading.php";?>
        <?php
        if ($owner){
            if(isset($_SESSION["addItemSuccess"])){
                ?>
                <p><?= $itemName ?> item successfully added!</p>
                <?php
                unset($_SESSION["addItemSuccess"]);
            }
            ?>
            <br>
            <button class="accordion">Add new item: </button>
            <div class="panel">
            <h2>Add new menu item:</h2>
                <form method="POST" id="addItemForm">
                    <label for="itemName">Item Name:</label><br>
                    <input type="text" name="itemName" id="itemName" value="<?= $itemName ?>" required><br>

                    <p>Note: If there are no separate large/small sizes, only enter large price</p>

                    <label for="largePrice">Large Price:</label><br>
                    <input type="text" name="largePrice" id="largePrice" value="<?= $largePrice ?>" required><br>

                    <label for="smallPrice">Small Price:</label><br>
                    <input type="text" name="smallPrice" id="largePrice" value="<?= $smallPrice ?>"><br>

                    <label for="category">Category:</label><br>
                    <input type="text" name="category" id="category" value="<?= $category ?>" required><br>

                    <input type="submit" id="submitItem" value="Add Item">
                </form>
            </div>
            <?php
        }
        ?>
        <div id="menuPage">
            <h1>Menu:</h1>
            <div class="flexRow">
                <div class="flexColumn">
                    <?php include "menuBody.php"; ?>
                </div>
                <div class="flexColumn">
                </div>
            </div>
        </div>

        <?php include "footer.html";?>
        <script src="menu.js"></script>
    </body>
</html>
