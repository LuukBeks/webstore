<?php
class Controller
{
    private $conn;
    public function __construct()
    {
        $conn = new PDO("mysql:host=localhost;dbname=formule1;", "root", "");
        $this->conn = $conn;
    }

    public function geefoverzicht(){

    }

}
?>