<?php
session_start();
require_once "login/config.php";
require_once "login/functions_def.php";
$email=$_SESSION['username'];
$token = createToken(20);
if ($token) {
        setChangeToken($pdo, $email, $token);
        $id_user = getUserData($pdo, 'id_user', 'email', $email);
        try {
            $body = "To start the process of changing password, visit <a href=" . SITE . "reset.php?token=$token>link</a>.";
            sendEmail($pdo, $email, $emailMessages['change'], $body, $id_user);
            $_SESSION['change_pass'] = 1;
            redirection('index.php');
        }catch (PDOException $e)
        {
            exit("Error: " . $e->getMessage());
        }
}
