<?php


require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Model/VerficatieModel.php");

use PHPMailer\PHPMailer\PHPMailer;

class createEmail
{
    private PHPMailer $mail;
    public verficatieModel $dataaccessmodel;
    private string $emailtext = "Gebruik de link voor het bevestigen van je studentservice account.<br> Druk op de link om de pagina te openen. <br>";
    private string $emailtextresetpassword = "Gebruik de link voor het resetten van Wachtwoord.<br> Druk op de link om de pagina te openen. <br>";
    protected string $createURL = "";

    public function __construct(){
        $this->mail            = new PHPMailer();
        $this->dataaccessmodel = new verficatieModel();
        //SMTP Settings
        $this->mail->isSMTP();
        $this->mail->Host       = "smtp.gmail.com";
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = "donoreplystudentservice@gmail.com";
        $this->mail->Password   = '^D%!oAAC1yQ0@pD@XzKim';
        $this->mail->Port       = 587; //587
        $this->mail->SMTPSecure = "tls"; //tls

        //Email Settings
        $this->mail->isHTML(true);
        $this->mail->setFrom("donoreplystudentservice@gmail.com","Studentservices");
    }

    public function sendEmail($gebruikernaam,$wachtwoord,$Email,$encryptedcode){
        $this->createURL =
            "http://localhost/StudentServices/View/Emailverficatie/Bevestingenaccount.php?" . $encryptedcode .
            "&username=" .
            $gebruikernaam . "&email=" . $Email;
        $this->mail->addAddress($Email);
        $this->mail->Subject = "activation mail studentsservice";
        $this->mail->Body    = $this->emailtext . $this->createURL;
        if ($this->mail->send()){
            $this->dataaccessmodel->ADD($gebruikernaam,$wachtwoord,$Email,$encryptedcode);
            return true;
        }
        return false;
    }

    public function sendWachwoordreset($gebruikernaam,$Email,$encryptedcode){
        $this->createURL =
            "http://localhost/StudentServices/View/Emailverficatie/resetWachwoord.php?" . $encryptedcode .
            "&username=" .
            $gebruikernaam . "&email=" . $Email;
        $this->mail->addAddress($Email);
        $this->mail->Subject = "Wachtwoord resetmail studentsservice";
        $this->mail->Body    = $this->emailtextresetpassword . $this->createURL;
        if ($this->mail->send()){
            return true;
        }
        return false;
    }

    public function sendcontactmail($fullname,$Email,$telefoonnummer,$question,$gebruikerid){

        date_default_timezone_set(date_default_timezone_get()); //voor het bepalen van de tijd
        $this->mail->addAddress($this->mail->Username);
        $this->mail->Subject = "Contact formulier";
        $this->mail->Body    = "verzonden vanaf de Studentservices Website om ". date('m/d/Y h:i:s a', time()). "<br>".
            "door ". $fullname . " emailadres = " .$Email. " telefoonnummer = " . $telefoonnummer. " gebruikers id = ".$gebruikerid."<br>".
            "de vraag is <br>". $question;
        if ($this->mail->send()){
            return true;
        }
        return false;
    }


    public function getemailerrorinfo(): string{
        return ($this->mail->ErrorInfo);
    }
}

