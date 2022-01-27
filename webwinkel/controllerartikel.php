<?php
class Controllerartikel
{
    public $conn;
    public function __construct()
    {
        $conn = new PDO("mysql:host=localhost;dbname=webwinkel;", "root", "");
        $this->conn = $conn;
    }



    public function toevoegenartikel($artikelnaam,$artikelCode,$image,$prijs) {
        $query = "INSERT INTO artikel VALUES (:aid,
                                            :artikelnaam,
                                            :artikelCode,
                                            :prijs,
                                            :image)";
        $stm = $this->conn->prepare($query);
        $stm->bindParam(":aid", $aid);
        $stm->bindParam(":artikelnaam", $artikelnaam);
        $stm->bindParam(":artikelCode", $artikelCode);
        $stm->bindParam(":image", $image);
        $stm->bindParam(":prijs", $prijs);
        
        if ($stm->execute() == true) {
            echo  "<b>Gegevens succesvol verzonden</b> ";
        } else {
            echo "Geen gegevens verstuurd.";
        } 
    }



//toon list
    public function getListProduct() {
        $query = "SELECT * FROM artikel";
        $stm = $this->conn->prepare($query);
        if($stm->execute()==true){
            $artikelen = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($artikelen as $artikel){
                echo "<tr>";
                ?>
                <div class="container-fluid">
                    <div class="row row-cols-5 mt-3">
                        <div class="col"><mark>Artikel:</div><br>
                        <div class="col"><mark>Artikel Code:</div><br>
                        <div class="col"><mark>image:</div>
                        <div class="col"><mark>Prijs:</div>
                        <div class="col"><mark>Delete:</div>
                        <div class="col"><?php echo "<a href=wijzigartikel.php?aid=".$artikel->aid.">".$artikel->artikelnaam."</a>"; ?></div>
                        <div class="col"><?= $artikel->artikelCode?></div>
                        <div class="col"><?= $artikel->image?></div>
                        <div class="col"><?= $artikel->prijs?></div>
                        <div class="col"><?php echo "<a href=deleteartikel.php?aid=".$artikel->aid.">delete </a>"; ?></div>
                    </div>
                </div>
                <?php
            }
        }
    }

    public function VerwijderenArtikel()
    {
        if (isset($_POST['btnJa'])) {

            $aid = $_GET['aid'];
    
            $query = "DELETE FROM artikel WHERE aid = $aid";
            $stm = $this->conn->prepare($query);
            if ($stm->execute()) {
                header('Location: index.php');
            }
        }
    }

    public function WijzigenArtikel($artikelnaam,$artikelCode, $prijs, $image, $aid)
    {
        
        $query = "UPDATE artikel SET  artikelnaam = :artikelnaam,
                                    artikelCode = :artikelCode,
                                    prijs = :prijs,
                                    image = :image WHERE aid = :aid ";
        $stm = $this->conn->prepare($query);
        $stm->bindParam(":aid", $aid);
        $stm->bindParam(":artikelnaam", $artikelnaam);
        $stm->bindParam(":artikelCode", $artikelCode);
        $stm->bindParam(":prijs", $prijs);
        $stm->bindParam(":image", $image);
        if ($stm->execute() == true) {
            header('Location: index.php');
        } else {
            echo "Geen gegevens verstuurd.";
        } 
    }
}
?>