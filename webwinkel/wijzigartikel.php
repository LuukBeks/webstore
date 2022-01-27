<?php
include "config.php";
require "controllerartikel.php";
$cc = new controllerartikel("localhost", "webwinkel", "root", "");

if (isset($_POST['btnOpslaan'])) {
    //Update naar de database
    $artikelnaam = $_POST['txtArtikel'];
    $artikelCode = $_POST['txtArtikelCode'];
    $prijs = $_POST['txtPrijs'];
    $image = $_POST['txtImage'];
    $aid = $_GET['aid'];

    $cc->WijzigenArtikel($artikelnaam, $artikelCode, $prijs, $image, $aid);
}

//id ophalen uit de URL
$aid = $_GET['aid'];
//QUERY maken die voldoet aan het id
$query = "SELECT * FROM artikel WHERE aid = $aid";
//Voorbereiden op de database
$stm = $conn->prepare($query);
//Query uitvoeren op de database
if ($stm->execute()) {
    //Een resultaat ophalen
    $res = $stm->fetch(PDO::FETCH_OBJ);
?>
    <form method="POST">
        <input type="text" name="txtID" readonly value="<?php echo $res->aid; ?>" /></br>
        <input type="text" name="txtArtikel" value="<?php echo $res->artikelnaam; ?>" /></br>
        <input type="text" name="txtArtikelCode" value="<?php echo $res->artikelCode; ?>" /></br>
        <input type="text" name="txtImage" value="<?php echo $res->image; ?>" /></br>
        <input type="text" name="txtPrijs" value="<?php echo $res->prijs; ?>" /></br>
        <input type="submit" name="btnOpslaan" value="Opslaan" />
    </form>
<?php
}
?>
</body>

</html>