<?php
session_start();

if(isset($_POST['btnDestroy']))
{
    session_destroy();
    header("location: pagina1.php");

}

if(isset($_SESSION["gebruikersnaam"])){
    echo"login success";
} else {
    header("location: pagina1.php");
}

?>
<form method="POST">
    <input type="submit" name="btnDestroy" value="destroy">
</form>
