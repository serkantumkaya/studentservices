<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ("C:xampp/htdocs/StudentServices/BaseClass/Categorie.php");
require_once ("C:xampp/htdocs/StudentServices/includes/DB.php");

class CategorieModel
{

    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
    }

    public function getCategorieen(){
        $sql = "SELECT * FROM Categorie";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * @param string $categorieNaam
     * @return bool
     */
    function add(string $categorieNaam){
        $statement = $this->conn->prepare("INSERT INTO Categorie (CategorieNaam) VALUES (:Naam)");
        $statement->execute([
            'Naam' => $categorieNaam
        ]);
        return true;
    }

    function delete(int $ID){
        $sql        = $this->conn->prepare("DELETE FROM Categorie WHERE CategorieID =:CID");

        $parameters = [
            'CID' => $ID
        ];

        if ($sql->execute($parameters) == true){
            return "Record Verwijderd";
        } else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function update(Categorie $categorie){
        $sql           =
            $this->conn->prepare("UPDATE CATEGORIE SET Categorienaam=:CN Where CategorieID =:CID");//let op id geen quotes
        $categorienaam = $categorie->getCategorienaam();
        $id            = $categorie->getCategorieID();
        $parameters    = [
            'CN' => $categorienaam,
            'CID' => $id
        ];

        return $sql->execute($parameters);
    }

    function get(int $ID){
        $sql = "Select CategorieID,Categorienaam FROM CATEGORIE WHERE CATEGORIEID =$ID";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}