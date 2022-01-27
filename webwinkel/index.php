<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>webwinkel</title>
</head>
<body class="bg-light">

<h3><a class="btn btn-primary" href="shopping-cart.php">naar producten lijst gaan</a></h3>

<!--toevoegen-->
<div class="container">
  <div class="row">
    <div class="col"> 
    <h1>Klant toevoegen</h1>
    <Form method="post">
        <input placeholder="Voornaam" type="text" name="txtVoornaam">
        <input placeholder="Achternaam" type="text" name="txtAchternaam">
        <input placeholder="Email" type="email" name="txtMail">
        <input placeholder="Nummer" type="text" name="txtTelefoon">
        <input class="btn btn-info" type="submit" name="btnKlant" value="Voeg toe">
    </Form>
    </div>
    <div class="col">
    </div>
    <div class="col">
    <h1>product toevoegen</h1>
    <Form method="post">
        <input placeholder="Artikel" type="text" name="txtArtikel">
        <input placeholder="Code" type="text" name="txtArtikelCode">
        <input placeholder="Image" type="text" name="txtImage">
        <input placeholder="Prijs" type="text" name="txtPrijs">
        <input class="btn btn-info" type="submit" name="btnArtikel" value="Voeg toe">
    </Form>
    </div>
  </div>
</div>

    <?php
    require("controller.php");
    $klant = new controller();
    if(isset($_POST['btnKlant']))
    {
        $kid = 0;
        $vnaam = $_POST['txtVoornaam'];
        $anaam = $_POST['txtAchternaam'];
        $email = $_POST['txtMail'];
        $telnummer = $_POST['txtTelefoon'];

        $klant->toevoegen($vnaam,$anaam,$telnummer,$email);
    }
    ?>
    <br>


<h1>gegevens tonen klant</h1>
<!--lijst-->
    <table>
        <?php
        $klant = new controller();
        $klant->getList();
        ?>
    </table>
<br>

<!-- product toevoegen -->
    <?php
    require("controllerartikel.php");
    $artikel = new controllerartikel();
    if(isset($_POST['btnArtikel']))
    {
        $aid = 0;
        $artikelnaam = $_POST['txtArtikel'];
        $artikelCode = $_POST['txtArtikelCode'];
        $image = $_POST['txtImage'];
        $prijs = $_POST['txtPrijs'];

        $artikel->toevoegenartikel($artikelnaam,$artikelCode,$image,$prijs);
    }
    ?>
    <br>
<h1>gegevens tonen product</h1>
    <table>
        <?php
        $artikel->getListProduct();
        ?>
    </table>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
