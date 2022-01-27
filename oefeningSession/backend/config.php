<?php
    $host = "localhost";
    $dbnaam = "oefeningsession";
    $gebruiker = "root";
    $ww = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbnaam;",$gebruiker,$ww);
?>