<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Model/SchoolModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/POCO/School.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class SchoolController
{
    private SchoolModel $schoolmodel;

    public function __construct() {
        $this->schoolmodel = new SchoolModel();
    }

    public function GetScholen()
    {
        return $this->schoolmodel->GetScholen()->fetchAll(PDO::FETCH_ASSOC);
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $Schoolnaam) {
        return $this->schoolmodel->Add($Schoolnaam);
    }

    function delete(int $Id)
    {
        return $this->schoolmodel->Delete($Id);
    }

    //ja jullie hebben gelijk gekregen. Update ipv save.
    function update(School $School)
    {
        return $this->schoolmodel->Update($School);
    }

    //ja jullie hebben gelijk gekregen. Update ipv save.
    function getById(int $id)
    {
        $school = $this->schoolmodel->Get($id)->fetchAll(PDO::FETCH_ASSOC);

        return $school[0];

    }
}
