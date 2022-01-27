<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formule 1 Zandvoort</title>
</head>
<body>
    <Form method="post">
        <input placeholder="Voornaam" type="text" name="txtVoornaam">
        <input placeholder="Achternaam" type="text" name="txtAchternaam">
        <input placeholder="Email" type="email" name="txtMail">
        <input placeholder="Nummer" type="text" name="txtTelefoon">
        <input type="date" name="gebDatum">
        <input type="submit" name="btnBestel" value="Bestel">
    </Form>

    <?php
    require("config.php");
    if(isset($_POST['btnBestel']))
    {
        $id = 0;
        $vnaam = $_POST['txtVoornaam'];
        $anaam = $_POST['txtAchternaam'];
        $email = $_POST['txtMail'];
        $nummer = $_POST['txtTelefoon'];
        $gebdatum = $_POST['gebDatum'];

        $query = "INSERT INTO event VALUES (:id,
                                            :vnaam,
                                            :anaam,
                                            :nummer,
                                            :email,
                                            :gebdatum)";
        $stm = $conn->prepare($query);
        $stm->bindParam(":id", $id);
        $stm->bindParam(":vnaam", $vnaam);
        $stm->bindParam(":anaam", $anaam);
        $stm->bindParam(":email", $email);
        $stm->bindParam(":nummer", $nummer);
        $stm->bindParam(":gebdatum", $gebdatum);
        if ($stm->execute() == true) {
            echo  "<b>Gegevens succesvol</b>";
        }
    } else echo "Geen gegevens verstuurd."

    ?>
</body>
</html>

<?php
if(isset($_POST['btnDelete'])){
    echo "verwijderen maar";
    $id = $_POST['txtId'];
    $query = "DELETE FROM event WHERE id = :id";
    $stm = $conn->prepare($query);
    $stm->bindparam(":id", $id);

    if($stm->execute()) {
        header("url=index.php");
    }
}


if(isset($_POST['btnUpdate'])){
    echo "updaten maar";
    $id = $_POST['txtId'];
    $id = $_POST['txtId'];
    $id = $_POST['txtId'];
    $id = $_POST['txtId'];
    $id = $_POST['txtId'];

    $query = "UPDATE event SET naam =:naam, id =:id, id =:id, id =:id WHERE id =:id";
    $stm = $conn->prepare($query);
    $stm->bindparam(":id", $id);
    $stm->bindparam(":id", $id);
    $stm->bindparam(":id", $id);
    $stm->bindparam(":id", $id);
    $stm->bindparam(":id", $id);

    if($stm->execute()) {
        header("url=index.php");
    }
}
?>