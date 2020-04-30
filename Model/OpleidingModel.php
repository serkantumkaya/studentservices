<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/School.php");
require_once  ($_SERVER['DOCUMENT_ROOT']."/StudentServices/includes/DB.php");

class SchoolModel
{
    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection
    private School $school;

    public function __construct()
    {
        $this->ConnectDb = new ConnectDb();
        $this->conn = $this->ConnectDb->GetConnection();
    }

    public function GetScholen()
    {
        $sql = "SELECT SchoolID,Schoolnaam FROM School";
        return $this->conn->query($sql);

        $stmt = $db->prepare('SELECT price, quantity FROM stock');
        $stmt->setFetchMode(PDO::FETCH_CLASS,'School');
        $result = $stmt->fetch();

    }
    function add(string $schoolNaam)
    {
        //deze functie kan nog veul mooier. ID terug geven.
        //$this->conn->execute("INSERT INTO School (Naam) VALUES ('$schoolNaam')");

        $statement = $this->conn->prepare("INSERT INTO School (SchoolNaam) VALUES (:Naam)");
        $statement->execute([
            'Naam' => $schoolNaam
        ]);
        return true;
        //i van integer. s voor string enz enz //bindparam kreeg ik niet aan de praat. Maar is wel beter
       /// $sql->bind_param("s", $schoolNaam);//https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        //{
        //    $last_id = $this->conn->insert_id;
        //    return get($last_id);//nieuwe object terugsturen met nieuwe ID
        //} else {
        //    echo "Error: " . $sql . "<br>" . $this->conn->error;
       // }
    }

    function delete(int $ID) {
        //delete school
        $sql = $this->conn->prepare("DELETE FROM School WHERE SCHOOLID  =:SID");

        $parameters = [
            'SID' => $ID
        ];

        if ($sql->execute($parameters) == TRUE)
        {
            return "Record verwijderd";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }

    function update(School $school)
    {

        $sql = $this->conn->prepare("UPDATE SCHOOL SET Schoolnaam=:SN Where SchoolID =:SID");//let op id geen quotes
        $schoolnaam = $school->getSchoolnaam();
        $id = $school->getSchoolID();
        $parameters = [
            'SN' => $schoolnaam,
            'SID' => $id
        ];

        if ($sql->execute($parameters) == TRUE)
        {
            return "Record gewijzigd";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function get(int $ID)
    {
        $sql = "Select SchoolID,Schoolnaam from SCHOOL WHERE SCHOOLID =$ID";
        return $this->conn->query($sql);
    }
}

