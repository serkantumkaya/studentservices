<?php

require_once ("C:xampp/htdocs/StudentServices/BaseClass/ZoekOpdracht.php");
require_once ("C:xampp/htdocs/StudentServices/includes/DB.php");

class ZoekModel{

    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function getZoekOpdrachten(): array {
        $sql = "Select * FROM zoek";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $ID){
        //delete feedback
        $sql = $this->conn->prepare("DELETE FROM zoek WHERE ZoekID  =:ZoekID");
        $parameters = [
            'ZoekID' => $ID
        ];
        if ($sql->execute($parameters) == true){
            return "Record verwijderd";
        } else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function add($woorden,$resultaat):bool{
        $sql = $this->conn->prepare("INSERT into zoek (Zoekwoorden,Resultaat) VALUES (:Woorden,:Resultaat)");
        $parameters = [
            'Woorden' => $woorden,
            'Resultaat' => $resultaat
        ];
        return $sql->execute($parameters);
    }



}