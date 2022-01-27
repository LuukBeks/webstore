<?php
include "config.php";
require "controller.php";
$cc = new controller("localhost", "webwinkel", "root", "");

if (isset($_POST['btnOpslaan'])) {
    //Update naar de database
    $voornaam = $_POST['txtvoornaam'];
    $achternaam = $_POST['txtachternaam'];
    $email = $_POST['txtemail'];
    $telefoon = $_POST['txttelefoon'];
    $kid = $_GET['kid'];
    
    $cc->wijzigen($voornaam, $achternaam, $telefoon, $email, $kid);
}

//id ophalen uit de URL
$kid = $_GET['kid'];
//QUERY maken die voldoet aan het id
$query = "SELECT * FROM klant WHERE kid = $kid";
//Voorbereiden op de database
$stm = $conn->prepare($query);
//Query uitvoeren op de database
if ($stm->execute()) {
    //Een resultaat ophalen
    $res = $stm->fetch(PDO::FETCH_OBJ);
?>
    <form method="POST">
        <input type="text" name="txtID" readonly value="<?php echo $res->kid; ?>" /></br>
        <input type="text" name="txtvoornaam" value="<?php echo $res->voornaam; ?>" /></br>
        <input type="text" name="txtachternaam" value="<?php echo $res->achternaam; ?>" /></br>
        <input type="text" name="txtemail" value="<?php echo $res->email; ?>" /></br>
        <input type="text" name="txttelefoon" value="<?php echo $res->telnummer; ?>" /></br>
        <input type="submit" name="btnOpslaan" value="Opslaan" />
    </form>
<?php
}
?>
</body>

</html>