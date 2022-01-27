<?php
require("../backend/config.php");
session_start();

try  
 {  
    $connect = new PDO("mysql:host=$host; dbname=$dbnaam", $gebruiker, $ww);  
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["btnLogin"]))  
      {  
           if(empty($_POST["gebruikersnaam"]) || empty($_POST["wachtwoord"]))  
           {  
                $message = '<label>All fields are required</label>';
                echo($message);  
           }  
           else  
           {  
                $query = "SELECT * FROM login WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'gebruikersnaam'     =>     $_POST["gebruikersnaam"],  
                          'wachtwoord'     =>     $_POST["wachtwoord"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["gebruikersnaam"] = $_POST["gebruikersnaam"];  
                     header("location:pagina2.php");  
                }  
                else  
                {  
                     $message = '<label>Wrong Data</label>';  
                     echo($message);
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }   

?>
<form method="POST">
    <input type="text" name="gebruikersnaam"><br>
    <input type="text" name="wachtwoord"><br>
    <input type="submit" name="btnLogin" value="Login">
</form>