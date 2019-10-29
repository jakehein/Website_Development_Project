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
        <?php include "heading.html";?>
        <h1>Find Us At:</h1>
        <div id="map" style="width:50%; height:400px;"></div>
<!--        <script>
            function myMap() {
                var restaurant = {lat: 44.021431, lng: -88.546825};
                var map = new google.maps.Map(document.getElementById('map'), {zoom: 20, center: restaurant});
                var marker = new google.maps.Marker({position: restaurant, map: map});
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK3QMxsqxPpNHILkkGhHUvdQCPf-dm6OI&callback=myMap"></script>
-->
        <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2868.996227205137!2d-88.54903428449026!3d44.02147247911045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8803ebef8aa5829f%3A0xcc9f48d7d15771e6!2s252%20Wisconsin%20St%2C%20Oshkosh%2C%20WI%2054901!5e0!3m2!1sen!2sus!4v1571941600164!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></p>
        <p>Directions form goes here</p>
        <?php include "footer.html";?>
    </body>
</html>
