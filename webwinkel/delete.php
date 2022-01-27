<?php
include "config.php";
require "controller.php";

$cc = new controller("localhost", "webwinkel", "root", "");
if (isset($_GET['kid'])) {
?>

    <b> Verwijderen?</b>

    <form method="post">

        <input type="submit" name="btnJa" value="Ja" />

    </form>

<?php
    $cc->verwijderen();
}
?>