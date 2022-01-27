<?php
class Controller
{
    public $conn;
    public function __construct()
    {
        $conn = new PDO("mysql:host=localhost;dbname=webwinkel;", "root", "");
        $this->conn = $conn;
    }

    public function toevoegen($vnaam,$anaam,$telnummer,$email) {
        
        $query = "INSERT INTO klant VALUES (:kid,
                                            :voornaam,
                                            :achternaam,
                                            :telnummer,
                                            :email)";
        $stm = $this->conn->prepare($query);
        $stm->bindParam(":kid", $kid);
        $stm->bindParam(":voornaam", $vnaam);
        $stm->bindParam(":achternaam", $anaam);
        $stm->bindParam(":telnummer", $telnummer);
        $stm->bindParam(":email", $email);
        
        if ($stm->execute() == true) {
            echo  "<b>Gegevens succesvol verzonden</b> ";
        } else {
            echo "Geen gegevens verstuurd.";
        } 
    }

//toon list
    public function getList() {
        $query = "SELECT * FROM klant";
        $stm = $this->conn->prepare($query);
        if($stm->execute()==true){
            $klanten = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($klanten as $klant){
                echo "<tr>";
                ?>
                <div class="container-fluid">
                    <div class="row row-cols-5 mt-3">
                        <div class="col"><mark>Voornaam:</div><br>
                        <div class="col"><mark>achternaam:</div><br>
                        <div class="col"><mark>telefoonnummer:</div>
                        <div class="col"><mark>e-mail:</div>
                        <div class="col"><mark>Delete:</div>
                        <div class="col"><?php echo "<a href=wijzig.php?kid=".$klant->kid.">".$klant->voornaam."</a>"; ?></div>
                        <div class="col"><?= $klant->achternaam?></div>
                        <div class="col"><?= $klant->telnummer?></div>
                        <div class="col"><?= $klant->email?></div>
                        <div class="col"><?php echo "<a href=delete.php?kid=".$klant->kid.">delete </a>"; ?></div>
                    </div>
                </div>
                <?php
            }
        }
    }

    public function Verwijderen()
    {
        if (isset($_POST['btnJa'])) {

            $kid = $_GET['kid'];
    
            $query = "DELETE FROM klant WHERE kid = $kid";
            $stm = $this->conn->prepare($query);
            if ($stm->execute()) {
                header('Location: index.php');
            }
        }
    }

    public function Wijzigen($voornaam, $achternaam, $telefoon, $email, $kid)
    {
        
        $query = "UPDATE klant SET  voornaam = :voornaam,
                                    achternaam = :achternaam,
                                    telnummer = :telnummer,
                                    email = :email WHERE kid = :kid ";
        $stm = $this->conn->prepare($query);
        $stm->bindParam(":kid", $kid);
        $stm->bindParam(":voornaam", $voornaam);
        $stm->bindParam(":achternaam", $achternaam);
        $stm->bindParam(":telnummer", $telefoon);
        $stm->bindParam(":email", $email);
        if ($stm->execute() == true) {
            header('Location: index.php');
        } else {
            echo "Geen gegevens verstuurd.";
        } 
    }
}
?>