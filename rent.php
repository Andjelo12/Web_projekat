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

$sql_query="SELECT * FROM users WHERE email = :email";
$query= $dbh1 -> prepare($sql_query);
$query->bindParam(':email',$_POST['email']);
$query->execute();
if($query->rowCount() > 0 && $_POST['email']!=$_SESSION['username']) {
    $sql = "INSERT INTO rented(email, email_renter, id_estate, rent_end) VALUES (:email,:renter,:id_estate,DATE_ADD(now(),interval :n day))";
    $query = $dbh1->prepare($sql);
    $query->bindParam(':email', $_POST["email"]);
    $query->bindParam(':id_estate', $_POST["id"]);
    $query->bindParam(':renter', $_SESSION["username"]);
    $query->bindParam(':n', $_POST["days"]);
    $query->execute();
    $sql2 = "UPDATE estates SET status='izdato' WHERE id_estate=:id";
    $query2 = $dbh1->prepare($sql2);
    $query2->bindParam(':id', $_POST["id"]);
    $query2->execute();


    $token = bin2hex(random_bytes(20));//createToken
    try {
        $sql3 = "INSERT INTO comments(email,comment_token,id_estate,active,granted_posting,comment) VALUES (:email,:token,:id,'No',DATE_ADD(now(),interval 14 day),'')";
        $stmt = $dbh1->prepare($sql3);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':email', $_POST["email"], PDO::PARAM_STR);
        $stmt->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }

    $phpmailer = new PHPMailer(true);

    try {

        $phpmailer->isSMTP();
        $phpmailer->Host = 'mail.tim.stud.vts.su.ac.rs';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = 'tim';
        $phpmailer->Password = 'Xj3W3WLgQeQxOp6';

        $phpmailer->setFrom($_SESSION["username"]);
        $phpmailer->addAddress($_POST["email"]);

        $phpmailer->isHTML(true);
        $phpmailer->Subject = "Informacija o izdavanju";
        $phpmailer->Body = "Tražena nekretnina Vam je izdata na naznačeni vremenski period. Nakon 14 dana je moguće dodati komentar na ovom <a href='https://tim.stud.vts.su.ac.rs/post_comment.php?token=$token'>linku</a>";

        $phpmailer->send();
        header("Location: list_estates.php");
    } catch (Exception $e) {
        $message = "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }
}else{
    $_SESSION['unknown_usr']=1;
    header("Location: rent_property.php?id=".$_POST['id']."&days=".$_POST['days']);
}
?>