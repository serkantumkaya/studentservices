<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/OpleidingController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/CategorieController.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/StudentServices/Controller/schoolController.php");

class CSVController
{
    private OpleidingController $opleidingcontroller;
    private SchoolController $schoolcontroller;
    private CategorieController $categoriecontroller;
    private $fileprofielname;
    private $filecategoriename;
    private $fileschoolname;

   public function __construct(){
$this->opleidingcontroller = new OpleidingController();
$this->schoolcontroller = new SchoolController();
$this->categoriecontroller = new CategorieController();
}

public function generatecsvfileopleiding(){
    $output = fopen("C:/xampp/htdocs/StudentServices/Controller/files/".$this->getFileopleidingname().".csv", "w") or die("Unable to open file!"); //open file;
    fputcsv($output,array('opleidingid','opleidingnaam','voltijd_deeltijd'));

    foreach ($this->opleidingcontroller->GetOpleidingen() as $opleiding){
        $data["opleidingid"]      = $opleiding->getOpleidingID();
        $data["opleidingnaam"]    = $opleiding->getNaamopleiding();
        $data["voltijd_deeltijd"] = $opleiding->getVoltijdDeeltijd();
        fputcsv($output,$data);
    }
    fclose($output);//sluit file
}

public function generatecsvfilecategorie(){
        $output = fopen("C:/xampp/htdocs/StudentServices/Controller/files/".$this->getFilecategoriename().".csv", "w") or die("Unable to open file!"); //open file;
        fputcsv($output,array('categorieid','categorienaam'));
    foreach ($this->categoriecontroller->getCategorieen() as $categorie){
        $data["categorieid"]      = $categorie->getCategorieID();
        $data["categorienaam"]    = $categorie->getCategorienaam();
        fputcsv($output,$data);
    }
    fclose($output);
}

    public function generatecsvfileschool(){
        $output = fopen("C:/xampp/htdocs/StudentServices/Controller/files/".$this->getFileschoolname().".csv", "w") or die("Unable to open file!"); //open file;
        fputcsv($output,array('schoolid','schoolnaam'));

        foreach ($this->schoolcontroller->GetScholen() as $school){
            $data["schoolid"]         = $school->getSchoolID();
            $data["schoolnaam"]       = $school->getSchoolnaam();
            fputcsv($output,$data);
        }
        fclose($output);//sluit file
    }

    /**
     * @return mixed
     */
    public function getFilecategoriename(){
        return $this->filecategoriename;
    }

    /**
     * @return mixed
     */
    public function getFileopleidingname(){
        return $this->fileprofielname;
    }

    /**
     * @return mixed
     */
    public function getFileschoolname(){
        return $this->fileschoolname;
    }

    /**
     * @param mixed $filecategoriename
     */
    public function setFilecategoriename($filecategoriename): void{
        $this->filecategoriename = $filecategoriename;
    }

    /**
     * @param mixed $fileschoolname
     */
    public function setFileschoolname($fileschoolname): void{
        $this->fileschoolname = $fileschoolname;
    }
    /**
     * @param mixed $fileprofielname
     */
    public function setFileopleidingname($fileprofielname): void{
        $this->fileprofielname = $fileprofielname;
    }

    public function downloadcsv($namefile){
   $filepath = 'C:/xampp/htdocs/StudentServices/Controller/files/'.$namefile.'.csv"';
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
   }

   public function uploadcsv($data, $namedfile){
        $errors = "";
        if($data["fileToUpload"]["name"] == ""){
            $errors .= "geen bestand toegevoegt <br>";
        }
        if(preg_match("/{'.csv'}/i", $data["fileToUpload"]["name"])){
            $errors .= "ongeldig bestandsformaat <br>";
        }
        var_dump(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
        return $errors;

        //hier ga ik morgen weer verder;
   }

}