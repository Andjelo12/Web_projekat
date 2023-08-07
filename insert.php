<?php
session_start();
include('includes/config.php');
$sql = "INSERT INTO estates(description, estate_type, location, price, rent_period,status, foto,approved,active) VALUES (:description, :estate_type, :location, :price, :period, 'slobodno', :foto,'No','Yes')";
$query = $dbh1 -> prepare($sql);
$foto=file_get_contents($_FILES['img']['tmp_name']);
$query->bindParam(':foto',$foto);
$query->bindParam(':description',$_POST["details"], PDO::PARAM_STR);
$query->bindParam(':estate_type',$_POST["type"], PDO::PARAM_STR);
$query->bindParam(':location',$_POST["location"], PDO::PARAM_STR);
$query->bindParam(':price',$_POST["price"], PDO::PARAM_STR);
$query->bindParam(':period',$_POST["period"], PDO::PARAM_INT);
$query->execute();
$id=$dbh1->lastInsertId();
if($query->rowCount() > 0)
{
    $sql2 = "INSERT INTO user_estate(email, id_estate) VALUES (:email, :id)";
    $query2 = $dbh1 -> prepare($sql2);
    $query2->bindParam(':email',$_SESSION["username"], PDO::PARAM_STR);
    $query2->bindParam(':id',$id, PDO::PARAM_INT);
    $query2->execute();
    $_SESSION['message_added'] = 'Nekretnina uspesno ubacena!';
    header("Location: list_estates.php");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'login/PHPMailer/src/Exception.php';
require 'login/PHPMailer/src/PHPMailer.php';
require 'login/PHPMailer/src/SMTP.php';
require_once "login/config.php";


$phpmailer = new PHPMailer(true);

try {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'mail.tim.stud.vts.su.ac.rs';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 587;
    $phpmailer->Username = 'tim';
    $phpmailer->Password = 'Xj3W3WLgQeQxOp6';

    $phpmailer->setFrom('tim@tim.stud.vts.su.ac.rs','Webmaster');
    $phpmailer->addAddress('tim@tim.stud.vts.su.ac.rs');

    $phpmailer->isHTML(true);
    $phpmailer->Subject = "Nova nekretnina postavljena";
    $korisnik=$_SESSION['username'];
    $phpmailer->Body = "Korisnik $korisnik je postavio novu nekretninu i potrebno je njeno odobravanje. Proveriti <a href='https://tim.stud.vts.su.ac.rs/list_estates_admin.php'>listu nekretnina</a>";
    $phpmailer->send();
    header("Location: list_estates.php");
} catch (Exception $e) {
    $message = "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
}

?>