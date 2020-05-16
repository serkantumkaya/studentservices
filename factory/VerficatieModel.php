<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/includes/DB.php");


class verficatieModel{

    private PDO $conn;//current connection
    private ConnectDB $ConnectDb;//current connection

    public function __construct(){
        $this->ConnectDb = new ConnectDb();
        $this->conn      = $this->ConnectDb->GetConnection();
        self::checkoftabelexsist();
    }


    private function checkoftabelexsist(){
        $sql = "SELECT TABLE_NAME
        FROM information_schema.TABLES
        WHERE TABLE_NAME = 'TOACTIVATEUSERS'";
        $result = $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        if(empty($result)) {
           $sql =
                $this->conn->prepare(
                    "USE StudentServices;
                    CREATE TABLE TOACTIVATEUSERS(
                    UserID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    Username varchar(50) NOT NULL UNIQUE,
                    Wachtwoord varchar(90) NOT NULL,
                    Email varchar(50) NOT NULL,
                    Timestamp varchar(50) NOT NULL,
                    Activationcode varchar(30) NOT NULL);
                    ALTER TABLE TOACTIVATEUSERS AUTO_INCREMENT = 1000;
                    "

                );
           $sql->execute();
        }
    }

    public function ADD($Gebruikersnaam, $Wachtwoord, $Email, $activationcode){
        date_default_timezone_set(date_default_timezone_get()); //voor het bepalen van de tijd
        $sql      =
            $this->conn->prepare("INSERT INTO TOACTIVATEUSERS(Username,Wachtwoord,Email,Timestamp, Activationcode) Values(:Username, :Wachtwoord, :Email, :Timestamp, :Activationcode)");
            $sha256ww = $this->ConnectDb->makeSafe($Wachtwoord);
        $parameters = ([
            'Username' => $Gebruikersnaam,
            'Wachtwoord' => $sha256ww,
            'Email' => $Email,
            'Timestamp' =>  date('m/d/Y h:i:s a', time()),
            'Activationcode' => $activationcode
        ]);

        return $sql->execute($parameters);
    }

    public function delete(int $UserID){
        $query="DELETE FROM TOACTIVATEUSERS  WHERE UserID = $UserID";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
           // $stmt->bind_param('i', $UserID);
            $stmt->execute();
            return $UserID;

        }else{
            return "niet gelukt";
        }
    }

    public function getuser($username, $Activationcode){
        $sql = "SELECT UserID, Timestamp FROM TOACTIVATEUSERS WHERE Username = '" . $username . "' and Activationcode = '" . $Activationcode . "'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function getusername($username){
        $sql = "SELECT Username FROM TOACTIVATEUSERS WHERE Username = '" . $username . "'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function getuserpassword($username, $Activationcode){
        $sql = "SELECT Wachtwoord FROM TOACTIVATEUSERS WHERE Username = '" . $username . "' and Activationcode = '" . $Activationcode . "'";
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);

    }
}
?>