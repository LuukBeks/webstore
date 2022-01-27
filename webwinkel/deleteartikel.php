<?php
include "config.php";
require "controllerartikel.php";

$cc = new controllerartikel("localhost", "webwinkel", "root", "");
if (isset($_GET['aid'])) {
?>

    <b> Verwijderen?</b>

    <form method="post">

        <input type="submit" name="btnJa" value="Ja" />

    </form>

<?php
    $cc->VerwijderenArtikel();
}
?>