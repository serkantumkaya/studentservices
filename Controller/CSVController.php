<?php
require_once ("C:xampp/htdocs/StudentServices/Controller/OpleidingController.php");
require_once ("C:xampp/htdocs/StudentServices/Controller/CategorieController.php");
require_once ("C:xampp/htdocs/StudentServices/Controller/schoolController.php");

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
        $this->schoolcontroller    = new SchoolController();
        $this->categoriecontroller = new CategorieController();
    }

    public function generatecsvfileopleiding(){
        $output =
            fopen("C:/xampp/htdocs/StudentServices/Controller/files/" . $this->getFileopleidingname() . ".csv","w") or
        die("Unable to open file!"); //open file;
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
        $output =
            fopen("C:/xampp/htdocs/StudentServices/Controller/files/" . $this->getFilecategoriename() . ".csv","w") or
        die("Unable to open file!"); //open file;
        fputcsv($output,array('categorieid','categorienaam'));
        foreach ($this->categoriecontroller->getCategorieen() as $categorie){
            $data["categorieid"]   = $categorie->getCategorieID();
            $data["categorienaam"] = $categorie->getCategorienaam();
            fputcsv($output,$data);
        }
        fclose($output);
    }

    public function generatecsvfileschool(){
        $output =
            fopen("C:/xampp/htdocs/StudentServices/Controller/files/" . $this->getFileschoolname() . ".csv","w") or
        die("Unable to open file!"); //open file;
        fputcsv($output,array('schoolid','schoolnaam'));

        foreach ($this->schoolcontroller->GetScholen() as $school){
            $data["schoolid"]   = $school->getSchoolID();
            $data["schoolnaam"] = $school->getSchoolnaam();
            fputcsv($output,$data);
        }
        fclose($output);//sluit file
    }

    public function settodatabaseopleiding($data,$errorindex){
        $counter = 0;
        $databew = ["update" => 0,"add" => 0];
        var_dump($data);
        foreach ($data as $record){
            $counter++;
            if (!empty($errorindex) == true?(array_search($counter,$errorindex) == false):true){
                if ($this->opleidingcontroller->getById((int)$record[0]) != null){
                    $opleidingobj = $this->opleidingcontroller->getById($record[0]);
                    $opleidingobj->setNaamopleiding($record[1]);
                    $opleidingobj->setVoltijdDeeltijd($record[2]);
                    $this->opleidingcontroller->update($opleidingobj);
                    $databew["update"]++;
                } else{
                    $this->opleidingcontroller->add($record[1],$record[2]);
                    $databew["add"]++;
                }
            }
        }
        return $databew;
    }

    public function settodatabaseschool($data,$errorindex){
        $counter = 0;
        $databew = ["update" => 0,"add" => 0];
        foreach ($data as $record){
            $counter++;
            if (!empty($errorindex) == true?(array_search($counter,$errorindex) == false):true){
                if ($this->schoolcontroller->getById((int)$record[0]) != null){
                    $schoolobj = $this->schoolcontroller->getById($record[0]);
                    $schoolobj->setSchoolnaam($record[1]);
                    $this->schoolcontroller->update($schoolobj);
                    $databew["update"]++;
                } else{
                    $this->schoolcontroller->add($record[1]);
                    $databew["add"]++;
                }
            }
        }
        return $databew;
    }

    public function settodatabasecategorie($data,$errorindex){
        $counter = 0;
        $databew = ["update" => 0,"add" => 0];
        foreach ($data as $record){
            $counter++;
            if (!empty($errorindex) == true?(array_search($counter,$errorindex) == false):true){
                if ($this->categoriecontroller->getById((int)$record[0]) != null){
                    $categorieobj = $this->categoriecontroller->getById($record[0]);
                    $categorieobj->setCategorienaam($record[1]);
                    $this->categoriecontroller->update($categorieobj);
                    $databew["update"]++;
                } else{
                    $this->categoriecontroller->add($record[1]);
                    $databew["add"]++;
                }
            }
        }
        return $databew;
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
        $filepath = 'C:/xampp/htdocs/StudentServices/Controller/files/' . $namefile . '.csv"';
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . (filesize($filepath)+1));
        flush(); // Flush system output buffer
        readfile($filepath);
    }

    public function uploadcsv($data){
        $errors      = "";
        $errorsindex = array();
        if ($data["fileToUpload"]["name"] == ''){
            $errors .= "geen bestand toegevoegt <br>";
        }
        if (!strpos($data["fileToUpload"]["name"],".csv")){
            $errors .= "ongeldig bestandsformaat <br>";
        }
        $array = array();
        if ($errors == ""){
            $counter = 0;
            foreach (preg_split('/\r\n|\r|\n/',file_get_contents($data['fileToUpload']['tmp_name'])) as $csvelement){
                $counter++;
                $result = $this->explodeX(array(';',','),$csvelement);
                $record = array();
                if ((!is_numeric($result[0])) && $counter>1 && !empty($result[0])){
                    $errors       .= "ongeldige id " . $result[0] . " op regel" . $counter . " <br>";
                    $errorindex[] = $counter-1;
                }


                if (($counter>1?count($result):false)>($counter>1?count($array[0]):false)){
                    $errors       .= "te veel waardes op regel " . $counter . " mogen er " . count($array[0]) .
                        " zijn  er " . count($result) . "<br>";
                    $errorindex[] = $counter-1;
                }
                foreach ($result as $element){
                    if (strrpos($element," ") != 0){
                        $record[] = substr($element,1,(strlen($element)-2));
                    } else{
                        $record[] = $element;
                    }
                }
                $array[] = $record;
            }
            unset($array[0]);
            unset($array[count($array)]);
        }
        return ["result" => (empty($array) != true?$array:null),"errors" => (empty($errors) != true?$errors:null),
            "errorindex" => (empty($errorindex) != true?$errorindex:null)];
    }

    private function explodeX($delimiters,$string){
        $return_array = Array($string); // The array to return
        $d_count      = 0;
        while (isset($delimiters[$d_count])) // Loop to loop through all delimiters
        {
            $new_return_array = Array();
            foreach ($return_array as $el_to_split) // Explode all returned elements by the next delimiter
            {
                $put_in_new_return_array = explode($delimiters[$d_count],$el_to_split);
                foreach ($put_in_new_return_array as $substr) // Put all the exploded elements in array to return
                {
                    $new_return_array[] = $substr;
                }
            }
            $return_array = $new_return_array; // Replace the previous return array by the next version
            $d_count++;
        }
        return $return_array; // Return the exploded elements
    }
}



