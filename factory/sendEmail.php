<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/PHPMailer/PHPMailer.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/PHPMailer/SMTP.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/Includes/PHPMailer/Exception.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/StudentServices/factory/VerficatieModel.php");
use PHPMailer\PHPMailer\PHPMailer;

class createEmail
{
    private PHPMailer $mail;
    public verficatieModel $dataaccessmodel;
    private string $emailtext = "Gebruik de link voor het bevestigen van je studentservice account.<br> Druk op de link om de pagina te openen. <br>";
    protected string $createURL = "";

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->dataaccessmodel = new verficatieModel();
        //SMTP Settings
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "donoreplystudentservice@gmail.com";
        $this->mail->Password = '^D%!oAAC1yQ0@pD@XzKim';
        $this->mail->Port = 587; //587
        $this->mail->SMTPSecure = "tls"; //tls

        //Email Settings
        $this->mail->isHTML(true);
        $this->mail->setFrom("donoreplystudentservice@gmail.com", "Studentservices");
    }

    public function sendEmail($gebruikernaam, $wachtwoord, $Email, $encryptedcode)
    {
        $this->createURL = "http://localhost/StudentServices/factory/bevestingenaccount.php?" . $encryptedcode . "&username=" . $gebruikernaam . "&email=" . $Email;
        $this->mail->addAddress($Email);
        $this->mail->Subject = "activation mail studentsservice";
        $this->mail->Body = $this->emailtext. $this->createURL;
        if($this->mail->send()){
            $this->dataaccessmodel->ADD($gebruikernaam, $wachtwoord, $Email, $encryptedcode);
            return true;
        }
        return false;
    }


    public function getemailerrorinfo(): string
    {
        return($this->mail->ErrorInfo);
    }
}

