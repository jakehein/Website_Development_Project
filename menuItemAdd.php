<?php
error_reporting(E_ALL | E_STRICT);
require_once("session.php");
require_once("database/menuUtility.php");

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
    $category = $_POST("category");

    add_menu_item($itemName, $largePrice, $smallPrice, $category);
}

?>
<!DOCTYPE html>
<html lang="en">
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
</html>