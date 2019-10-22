<?php
    error_reporting(E_ALL | E_STRICT);
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Jacob Hein, Jason Hoffman, Luke Rolf">
        <meta name="description" content="This is a student made website for Jade Dragon.">
        <meta name="keywords" content="food, chinese, take out, delivery, rice, noodle, chicken, pork, jade, dragon, crab, rangoon, general, tso, Jade Dragon, Oshkosh, WI, 54901, Chinese Menu, Chinese restaurant Oshkosh, Chinese restaurant 54901, Chinese food Oshkosh, Chinese food 54901, Chinese food delivery, Chinese delivery Oshkosh, Chinese delivery 54901, Chinese food catering, Chinese carry out, Chinese dine in, Chinese party trays, Chinese food order online">
        <title>Jade Dragon</title>
        <link rel="icon" href="dragon.jpg"> <!-- #Test Your Might -->
        <link rel="stylesheet" type="text/css" href="jadeDragon.css">
    </head>
    <body>
        <?php include "heading.html";?>
        <h1>My First Google Map</h1>
        <div id="map" style="width:100%;height:400px;"></div>
        <script>
            function myMap() {
                var restaurant = {lat: 44.021431, lng: -88.546825};
                var map = new google.maps.Map(document.getElementById('map'), {zoom: 20, center: restaurant});
                var marker = new google.maps.Marker({position: restaurant, map: map});
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK3QMxsqxPpNHILkkGhHUvdQCPf-dm6OI&callback=myMap"></script>
    </body>
</html>
