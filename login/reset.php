<?php
require_once "config.php";
require_once "functions_def.php";
// https://www.php.net/manual/en/reserved.variables.request

if (isset($_GET['token'])) {
    $token = trim($_GET['token']);
}

if (isset($_POST['token'])) {
    $token = trim($_POST['token']);
}

$method = strtolower(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED));

switch ($method) {
    case "get":
        if (!empty($token) and strlen($token) === 40) {

            $sql = "SELECT id_user FROM users 
            WHERE binary change_password_token = :token AND change_password_expires>now() AND active= 1";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                include_once "reset_pass.php";
            } else {
                redirection('reset_form_message.php?rf=15');
            }
        } else {
            redirection('reset_form_message.php?rf=0');
        }
        break;

    case "post":
        if (!empty($token) and strlen($token) === 40) {

            if (isset($_POST['resetPassword'])) {
                $resetPassword = trim($_POST["resetPassword"]);
            }

            if (isset($_POST['resetPasswordConfirm'])) {
                $resetPasswordConfirm = trim($_POST["resetPasswordConfirm"]);
            }

            if (empty($resetPassword)) {
                redirection('reset_pass.php?rf=9');
            }

            if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $resetPassword)) {
                redirection('reset_pass.php?rf=10');
            }

            if (empty($resetPasswordConfirm)) {
                redirection('reset_pass.php?rf=9');
            }

            if ($resetPassword !== $resetPasswordConfirm) {
                redirection('reset_pass.php?rf=7');
            }

            $passwordHashed = password_hash($resetPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET change_password_token = '', change_password_expires = null, password = :resetPassword
            WHERE binary change_password_token = :token AND change_password_expires>now() AND active = 1";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':resetPassword', $passwordHashed, PDO::PARAM_STR);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['login_ch']=1;
                redirection('../index.php');
            } else {
                redirection('reset_form_message.php?rf=15');
            }
        } else {
            redirection('reset_form_message.php?rf=0');
        }
        break;
}

