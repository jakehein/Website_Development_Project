<?php
    error_reporting(E_ALL | E_STRICT);
    require_once("initialize.php");

    function get_menu(){
        global $db;
        $sql = "SELECT * FROM MenuItem ORDER BY ItemID";
        $statement = $db->prepare($sql);
        $statement->execute();

        $menuItems = array();

        foreach($statement as $row){
            $menuItem = array($row["itemID"], $row["itemName"], $row["largePrice"], $row["smallPrice"], $row["category"]);
            array_push($menuItems, $menuItem);
        }

        return $menuItems;
    }

    function get_categories(){
        global $db;
        $sql = "SELECT DISTINCT category FROM MenuItem";
        $statement = $db->prepare($sql);
        $statement->execute();

        $categories = array();

        foreach($statement as $row){
            array_push($categories, $row["category"]);
        }

        return $categories;
    }

    function get_menu_by_category($category){
        global $db;
        $sql = "SELECT * FROM MenuItem WHERE category = ?";
        $statement = $db->prepare($sql);
        $statement->execute([$category]);

        $menuItems = array();

        foreach($statement as $row){
            $menuItem = $menuItem = array($row["itemID"], $row["itemName"], $row["largePrice"], $row["smallPrice"]);
            array_push($menuItems, $menuItem);
        }

        return $menuItems;
    }
?>