<?php
    $host = "localhost";
    $dbnaam = "webwinkel";
    $gebruiker = "root";
    $ww = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbnaam;",$gebruiker,$ww);
?>