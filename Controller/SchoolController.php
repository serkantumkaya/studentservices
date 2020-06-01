<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/SchoolModel.php");
//require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/BaseClass/School.php");

require_once ("C:xampp/htdocs/StudentServices/Model/SchoolModel.php");
require_once ("C:xampp/htdocs/StudentServices/BaseClass/School.php");

//hier doe je de crud afvangen vanuit de gebruiker.
class SchoolController
{
    private SchoolModel $schoolmodel;

    public function __construct(){
        $this->schoolmodel = new SchoolModel();
    }

    public function GetScholen(){
        $SchoolArray = [];
        foreach ($this->schoolmodel->GetScholen() as $school){
            $school         = new School($school['SchoolID'], $school['Schoolnaam']);
            $SchoolArray [] = $school;
        }
        return $SchoolArray;
    }

    //voor parameters bindparam gebruiken. Named parameters
    function add(string $Schoolnaam){
        return $this->schoolmodel->Add($Schoolnaam);
    }

    function delete(int $Id){
        return $this->schoolmodel->Delete($Id);
    }

    function update(School $School){
        return $this->schoolmodel->Update($School);
    }

    function getById(int $id){
        $School = $this->schoolmodel->get($id);
        if(!empty($School) && $School != null){
            return new School($School['SchoolID'],$School['Schoolnaam']);
        }
        else{
            return null;
        }
    }
}
