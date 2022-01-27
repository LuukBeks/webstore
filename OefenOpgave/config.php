<?php
    $host = "localhost";
    $dbnaam = "formule1";
    $gebruiker = "root";
    $ww = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbnaam;",$gebruiker,$ww);
?>