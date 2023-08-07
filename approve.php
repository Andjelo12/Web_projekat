<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'login/PHPMailer/src/Exception.php';
require 'login/PHPMailer/src/PHPMailer.php';
require 'login/PHPMailer/src/SMTP.php';
require_once "login/config.php";

include('includes/config.php');
$sql = "UPDATE estates SET approved='Yes' WHERE id_estate=:id";
$query = $dbh1 -> prepare($sql);
$query->bindParam(':id',$_GET["id"], PDO::PARAM_INT);
$query->execute();
if($query->rowCount() > 0)
{
    $sql = "SELECT email FROM user_estate WHERE id_estate=:id";
    $query = $dbh1 -> prepare($sql);
    $query->bindParam(':id',$_GET["id"], PDO::PARAM_INT);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    $phpmailer = new PHPMailer(true);

    try {

        $phpmailer->isSMTP();
        $phpmailer->Host = 'mail.tim.stud.vts.su.ac.rs';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = 'tim';
        $phpmailer->Password = 'Xj3W3WLgQeQxOp6';



        $email=$results[0]->email;
        $phpmailer->setFrom('tim@tim.stud.vts.su.ac.rs','Webmaster');
        $phpmailer->addAddress($email);

        $phpmailer->isHTML(true);
        $phpmailer->Subject = "Informacija o izdavanju";
        $phpmailer->Body = "Izdavanje nekretnine je odobreno";

        $phpmailer->send();
        header("Location: list_estates.php");
    } catch (Exception $e) {
        $message = "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }
    header("Location: list_estates_admin.php");
}




?>